<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvoicesFlattenedExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected int $maxExtras;

    public function __construct()
    {
        // Cari jumlah paket_tambahan terbanyak agar header konsisten
        $this->maxExtras = Invoice::query()
            ->pluck('paket_tambahan')
            ->map(function ($v) {
                if (is_array($v)) return count($v);
                if (is_string($v)) {
                    $arr = json_decode($v, true);
                    return is_array($arr) ? count($arr) : 0;
                }
                return 0;
            })->max() ?? 0;
    }

    public function collection()
    {
        return Invoice::orderBy('id')->get();
    }

    public function headings(): array
    {
        $heads = [
            'ID',
            'Email',
            'Client',
            'Paket 1 Produk',
            'Paket 1 Qty',
            'Paket 1 Harga',
            'Paket 1 Total',
        ];

        // Tambah header untuk Paket 2..N
        for ($i = 2; $i <= $this->maxExtras + 1; $i++) {
            $heads[] = "Paket $i Produk";
            $heads[] = "Paket $i Qty";
            $heads[] = "Paket $i Harga";
            $heads[] = "Paket $i Total";
        }

        $heads[] = 'Total Sebelum';
        $heads[] = 'Grand Total';
        $heads[] = 'Created At';

        return $heads;
    }

    public function map($invoice): array
    {
        // Pastikan paket_tambahan jadi array
        $extras = $invoice->paket_tambahan;
        if (!is_array($extras)) {
            $tmp = json_decode($extras ?? '[]', true);
            $extras = is_array($tmp) ? $tmp : [];
        }

        // Kolom Paket 1 (sudah ada field terpisah)
        $row = [
            $invoice->id,
            $invoice->email,
            $invoice->client,
            $invoice->paket1_produk,
            (int) $invoice->paket1_qty,
            $invoice->paket1_harga !== null ? (float) $invoice->paket1_harga : null,
            $invoice->paket1_total !== null ? (float) $invoice->paket1_total : null,
        ];

        // Flatten Paket 2..N
        for ($k = 0; $k < $this->maxExtras; $k++) {
            $item = $extras[$k] ?? null;

            // Dukungan kedua skema key: {nama,qty,unit_price,line_total} ATAU {produk,qty,harga,total}
            $name  = $item['nama'] ?? $item['produk'] ?? null;
            $qty   = isset($item['qty']) ? (int) $item['qty'] : null;
            $harga = isset($item['unit_price']) ? (float) $item['unit_price']
                    : (isset($item['harga']) ? (float) $item['harga'] : null);
            $total = isset($item['line_total']) ? (float) $item['line_total']
                    : (($qty !== null && $harga !== null) ? $qty * $harga : null);

            $row[] = $name;
            $row[] = $qty;
            $row[] = $harga;
            $row[] = $total;
        }

        $row[] = $invoice->total_sebelum !== null ? (float) $invoice->total_sebelum : null;
        $row[] = $invoice->grand_total  !== null ? (float) $invoice->grand_total  : null;
        $row[] = optional($invoice->created_at)->format('Y-m-d H:i:s');

        return $row;
        }
}
