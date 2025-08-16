<?php

namespace App\Exports;

use App\Models\SeoPackage;
use App\Models\LeadsPackage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $seo = SeoPackage::select(
            'nama_pemilik as nama',
            'nomor_telepon as kontak',
            DB::raw("'SEO' as paket"),
            'produk as produk_jasa',
            DB::raw("'-' as status_invoice")
        );

        $leads = LeadsPackage::select(
            'nama_pemilik as nama',
            'nomor_telepon as kontak',
            DB::raw("'LEADS' as paket"),
            'produk as produk_jasa',
            DB::raw("'-' as status_invoice")
        );

        return $seo->unionAll($leads)->get();
    }

    public function headings(): array
    {
        return ['NAMA', 'KONTAK', 'PAKET', 'PRODUK / JASA', 'STATUS INVOICE'];
    }
}
