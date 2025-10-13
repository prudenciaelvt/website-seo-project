<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class KwitansiController extends Controller
{
    public function index()
    {
        // Cek login
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        // Lanjut ambil data dan render view
    }

    public function generate($id)
    {
        $invoice = Invoice::findOrFail($id);

        // Ambil data item
        $items = [];

        // Item paket utama
        $items[] = [
            'nama'         => $invoice->paket1_produk,
            'qty'          => $invoice->paket1_qty,
            'harga_satuan' => $invoice->paket1_harga,
            'jumlah'       => $invoice->paket1_total,
        ];

        // Item tambahan
        if (!empty($invoice->paket_tambahan)) {
            // Kalau string, decode
            if (is_string($invoice->paket_tambahan)) {
                $tambahan = json_decode($invoice->paket_tambahan, true);
            } else {
                // Kalau sudah array, langsung pakai
                $tambahan = $invoice->paket_tambahan;
            }

            if (is_array($tambahan)) {
                foreach ($tambahan as $t) {
                    $items[] = [
                        'nama'         => $t['nama'] ?? '',
                        'qty'          => $t['qty'] ?? 0,
                        'harga_satuan' => $t['unit_price'] ?? 0,
                        'jumlah'       => $t['line_total'] ?? 0,
                    ];
                }
            }
        }


        // Siapkan logo 
        $logo = null;
        $logoPath = public_path('assets/picture/pic_logoImersa.png');
        if (file_exists($logoPath)) {
            $ext = pathinfo($logoPath, PATHINFO_EXTENSION);
            $data = file_get_contents($logoPath);
            $logo = 'data:image/' . strtolower($ext) . ';base64,' . base64_encode($data);
        }

        // Format tanggal + jam saat generate

        // Kirim ke view
        $pdf = Pdf::loadView('templates.kwitansiTemplate', [
            'logo'        => $logo,
            'client'      => $invoice->client,
            'no_kwitansi' => 'KW-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT),
            'tanggal'     => now()->format('d/m/Y H:i:s'),
            'items'       => $items,
            'subtotal'    => $invoice->total_sebelum,
            'total'       => $invoice->grand_total,
            'keterangan'  => 'Pembayaran Lunas',
        ])->setPaper([0, 0, 420, 595], 'portrait'); // A5

        return $pdf->download('kwitansi-' . $invoice->id . '.pdf');
    }
}
