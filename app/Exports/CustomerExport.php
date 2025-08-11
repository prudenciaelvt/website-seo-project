<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Customer::select('nama', 'kontak', 'paket', 'produk_jasa', 'status_invoice')->get();
    }

    public function headings(): array
    {
        return ['NAMA', 'KONTAK', 'PAKET', 'PRODUK / JASA', 'STATUS INVOICE'];
    }
}
