<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    // Fungsi untuk bersihkan input angka
    protected function parseNumber(mixed $value): int
    {
        if ($value === null || $value === '') return 0;
        return (int) preg_replace('/[^\d\-]/', '', (string)$value);
    }

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
            'invoice_no'   => $invoice->id,
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

}
