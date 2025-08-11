<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    // ubah menjadi int
    protected function parseNumber(mixed $value): int
    {
        if ($value === null || $value === '') return 0;
        // hapus semua kecuali digit dan minus
        $clean = preg_replace('/[^\d\-]/', '', (string)$value);
        return (int)$clean;
    }

    public function generateInvoice(Request $request)
    {
        $paket = [];

        //Paket pertama
        $p1_name  = $request->input('paket1_produk') ?? $request->input('paket1_nama');
        $p1_qty   = $request->input('paket1_qty') ?? $request->input('paket1_qty_custom') ?? 0;
        $p1_price = $request->input('paket1_harga') ?? 0;
        $p1_total = $request->input('paket1_total');

        if (!empty($p1_name)) {
            $qty = (int)$p1_qty;
            $unit_price = $this->parseNumber($p1_price);
            $line_total = $p1_total !== null && $p1_total !== '' 
                          ? $this->parseNumber($p1_total) 
                          : ($qty * $unit_price);

            $paket[] = [
                'nama'       => $p1_name,
                'qty'        => $qty,
                'unit_price' => $unit_price,
                'line_total' => $line_total,
            ];
        }

        //Paket tambahan
        $names  = $request->input('paket_produk') ?? $request->input('paket_nama') ?? [];
        $qtys   = $request->input('paket_qty') ?? [];
        $prices = $request->input('paket_harga') ?? [];
        $tots   = $request->input('paket_total') ?? [];

        if (is_array($names)) {
            foreach ($names as $i => $name) {
                if (trim((string)$name) === '') continue;
                $qty = isset($qtys[$i]) ? (int)$qtys[$i] : 0;
                $unit_price = isset($prices[$i]) ? $this->parseNumber($prices[$i]) : 0;
                $line_total = isset($tots[$i]) && $tots[$i] !== null && $tots[$i] !== ''
                              ? $this->parseNumber($tots[$i])
                              : ($qty * $unit_price);

                $paket[] = [
                    'nama'       => $name,
                    'qty'        => $qty,
                    'unit_price' => $unit_price,
                    'line_total' => $line_total,
                ];
            }
        }

        // kalau benar-benar kosong, tambahkan baris kosong (opsional)
        if (empty($paket)) {
            $paket[] = ['nama'=>'-','qty'=>0,'unit_price'=>0,'line_total'=>0];
        }

        // hitung subtotal & total (belum fiks)
        $subtotal = array_sum(array_column($paket, 'line_total'));
        $totalFromRequest = $request->input('grand_total') ?? $request->input('total') ?? null;
        $total = $totalFromRequest !== null && $totalFromRequest !== ''
                 ? $this->parseNumber($totalFromRequest)
                 : $subtotal;

        //logo generate
        $logoPath = public_path('assets/picture/pic_logoImersa.png'); //path image
        $logoBase64 = null;
        if (file_exists($logoPath) && is_readable($logoPath)) {
            $ext = strtolower(pathinfo($logoPath, PATHINFO_EXTENSION));
            $type = in_array($ext, ['png','jpg','jpeg','gif']) ? $ext : 'png';
            $data = file_get_contents($logoPath);
            $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        // data untuk view
        $data = [
            'invoice_no'   => rand(10, 9999),
            'invoice_date' => now()->format('n/j/Y H:i:s'),
            'client'       => $request->input('client'),
            'email'        => $request->input('email'),
            'paket'        => $paket,
            'subtotal'     => $subtotal,
            'total'        => $total,
            'logo'         => $logoBase64,
        ];

        // render PDF
        $pdf = Pdf::loadView('templates.invoiceTemplate', $data)->setPaper('A4', 'portrait');

        return $pdf->download('Invoice-'.$data['invoice_no'].'.pdf');
    }
}
