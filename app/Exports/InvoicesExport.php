<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Invoice::all([
            'id',
            'email',
            'client',
            'paket1_produk',
            'paket1_qty',
            'paket1_harga',
            'paket1_total',
            'paket_tambahan',
            'total_sebelum',
            'grand_total',
            'created_at',
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Email',
            'Client',
            'Paket 1 Produk',
            'Paket 1 Qty',
            'Paket 1 Harga',
            'Paket 1 Total',
            'Paket Tambahan',
            'Total Sebelum',
            'Grand Total',
            'Created At',
        ];
    }
}
