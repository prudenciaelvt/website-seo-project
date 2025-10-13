<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoicesFlattenedExport;
use Illuminate\Support\Facades\Session;




class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        // Cek login
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        // fitur search
        $search = $request->input('search');
        $query = Invoice::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('client', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $invoices = $query->get();

        return view('admin.invoice', compact('invoices'));

        // Ambil semua invoice, bisa diurutkan terbaru
        $invoices = Invoice::latest()->get();

        // Kirim data ke view admin.invoice
        return view('admin.invoice', compact('invoices'));
    }

    public function generate($id)
    {
        $invoice = Invoice::findOrFail($id);

        // Ambil semua paket (paket1 + tambahan)
        $paket = [];

        if ($invoice->paket1_produk) {
            $paket[] = [
                'nama'       => $invoice->paket1_produk,
                'qty'        => $invoice->paket1_qty,
                'unit_price' => $invoice->paket1_harga,
                'line_total' => $invoice->paket1_total,
            ];
        }

        // paket tambahan (sudah disimpan dalam JSON di database)
        if (is_array($invoice->paket_tambahan)) {
            foreach ($invoice->paket_tambahan as $item) {
                $paket[] = $item;
            }
        }

        // Ambil logo untuk PDF
        $logoBase64 = null;
        $logoPath   = public_path('assets/picture/pic_logoImersa.png');
        if (file_exists($logoPath)) {
            $ext       = pathinfo($logoPath, PATHINFO_EXTENSION);
            $data      = file_get_contents($logoPath);
            $logoBase64 = 'data:image/' . strtolower($ext) . ';base64,' . base64_encode($data);
        }

        // Data untuk template PDF
        $data = [
            'invoice_no'   => 'INV-' . str_pad($invoice->id, 4, '0', STR_PAD_LEFT),
            'invoice_date' => now()->format('d/m/Y H:i:s'),
            'client'       => $invoice->client,
            'email'        => $invoice->email,
            'paket'        => $paket,
            'subtotal'     => $invoice->total_sebelum,
            'total'        => $invoice->grand_total,
            'logo'         => $logoBase64,
        ];

        // Generate PDF sesuai template
        $pdf = Pdf::loadView('templates.invoiceTemplate', $data)->setPaper('A5', 'portrait');

            return $pdf->download('Invoice-' . $invoice->id . '.pdf');
        }

        public function create()
        {
            return view('admin.tambahInvoice'); 
        }



    // Fungsi untuk bersihkan input angka
    protected function parseNumber(mixed $value): int
    {
        if ($value === null || $value === '') return 0;
        return (int) preg_replace('/[^\d\-]/', '', (string)$value);
    }

    //fungsi generate invoicedata  baru
    public function generateInvoice(Request $request)
    {
        $paket = [];

        // Paket pertama
        $p1_name  = $request->input('paket1_produk');
        $p1_qty   = (int) ($request->input('paket1_qty') ?? 0);
        $p1_price = $this->parseNumber($request->input('paket1_harga') ?? 0);
        $p1_total = $request->input('paket1_total') !== null
                    ? $this->parseNumber($request->input('paket1_total'))
                    : ($p1_qty * $p1_price);

        if (!empty($p1_name)) {
            $paket[] = [
                'nama'       => $p1_name,
                'qty'        => $p1_qty,
                'unit_price' => $p1_price,
                'line_total' => $p1_total,
            ];
        }

        // Paket tambahan
        $names  = $request->input('paket_produk', []);
        $qtys   = $request->input('paket_qty', []);
        $prices = $request->input('paket_harga', []);
        $tots   = $request->input('paket_total', []);

        foreach ((array) $names as $i => $name) {
            if (trim((string) $name) === '') continue;
            $qty        = isset($qtys[$i]) ? (int) $qtys[$i] : 0;
            $unit_price = isset($prices[$i]) ? $this->parseNumber($prices[$i]) : 0;
            $line_total = isset($tots[$i]) && $tots[$i] !== ''
                          ? $this->parseNumber($tots[$i])
                          : ($qty * $unit_price);

            $paket[] = [
                'nama'       => $name,
                'qty'        => $qty,
                'unit_price' => $unit_price,
                'line_total' => $line_total,
            ];
        }

        if (empty($paket)) {
            $paket[] = ['nama' => '-', 'qty' => 0, 'unit_price' => 0, 'line_total' => 0];
        }

        // Hitung subtotal & total
        $subtotal = array_sum(array_column($paket, 'line_total'));
        $total    = $request->input('grand_total') !== null
                    ? $this->parseNumber($request->input('grand_total'))
                    : $subtotal;

        // Simpan ke database
        $invoice = Invoice::create([
            'email'          => $request->input('email'),
            'client'         => $request->input('client'),
            'paket1_produk'  => $p1_name,
            'paket1_qty'     => $p1_qty,
            'paket1_harga'   => $p1_price,
            'paket1_total'   => $p1_total,
            'paket_tambahan' => array_slice($paket, 1), // semua paket setelah paket pertama
            'total_sebelum'  => $subtotal,
            'grand_total'    => $total,
        ]);

        // Ambil logo untuk PDF
        $logoBase64 = null;
        $logoPath   = public_path('assets/picture/pic_logoImersa.png');
        if (file_exists($logoPath)) {
            $ext       = pathinfo($logoPath, PATHINFO_EXTENSION);
            $data      = file_get_contents($logoPath);
            $logoBase64 = 'data:image/' . strtolower($ext) . ';base64,' . base64_encode($data);
        }

        // Data untuk view PDF
        $data = [
            'invoice_no' => 'INV-' . str_pad($invoice->id, 4, '0', STR_PAD_LEFT),
            'invoice_date' => now()->format('d/m/Y H:i:s'),
            'client'       => $invoice->client,
            'email'        => $invoice->email,
            'paket'        => $paket,
            'subtotal'     => $subtotal,
            'total'        => $total,
            'logo'         => $logoBase64,
        ];

        // Generate PDF
        $pdf = Pdf::loadView('templates.invoiceTemplate', $data)->setPaper('A5', 'portrait');

        return $pdf->download('Invoice-' . $invoice->id . '.pdf');
    }

    public function store(Request $request)
    {
        // validasi sederhana
        $validated = $request->validate([
            'email'          => 'required|email',
            'client'         => 'required|string',
            'paket1_produk'  => 'required|string',
            'paket1_qty'     => 'required|numeric',
            'paket1_harga'   => 'required|numeric',
            'paket1_total'   => 'required|numeric',
            'total_sebelum'  => 'required|numeric',
            'grand_total'    => 'required|numeric',
        ]);

        // ambil paket tambahan dari input (kalau ada)
        $paketTambahan = [];
        if ($request->has('paket_produk')) {
            foreach ($request->paket_produk as $index => $produk) {
                if ($produk) {
                    $paketTambahan[] = [
                        'nama'       => $produk,
                        'qty'        => $request->paket_qty[$index] ?? 1,
                        'unit_price' => $request->paket_harga[$index] ?? 0,
                        'line_total' => $request->paket_total[$index] ?? 0,
                    ];
                }
            }
        }

        // simpan invoice
        $invoice = Invoice::create(array_merge($validated, [
            'paket_tambahan' => $paketTambahan,
        ]));

        // redirect ke halaman invoice index + flash message
        return redirect()->route('admin.invoice')->with('success', 'Invoice berhasil disimpan!');
    }



    public function kwitansiIndex(Request $request)
    {
        $query = Invoice::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('client', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $invoices = $query->get();

        return view('kwitansi.index', compact('invoices'));
    }

    //Generate Excel
    public function exportExcel()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function exportFlattened()
    {
        return Excel::download(new InvoicesFlattenedExport, 'invoices-flattened.xlsx');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->back()->with('success', 'Invoice berhasil dihapus.');
    }



}
