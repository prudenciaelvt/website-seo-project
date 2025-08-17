<?php

namespace App\Exports;

use App\Models\SeoPackage;
use App\Models\LeadsPackage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
{
    // menyiapkan data dan header kolom yang akan diekspor ke file Excel saat dipanggil oleh Excel
    public function collection()
    {
        // Ambil data SEO
        $seo = SeoPackage::select(
            DB::raw("created_at as tanggal_masuk"),
            DB::raw("'SEO' as paket"),
            'produk as produk_jasa',
            DB::raw("COALESCE(nama_usaha, '-') as nama_usaha"),
            'website_usaha',
            'nama_pemilik as nama_pemilik',
            'nomor_telepon as kontak',
            DB::raw("'-' as email"),
            DB::raw("'-' as alamat_usaha"),
            DB::raw("'-' as komisi"),
            'jangka_waktu',
            'target_market',
            DB::raw("'-' as status_invoice")
        );

        // Ambil data Leads
        $leads = LeadsPackage::select(
            DB::raw("created_at as tanggal_masuk"),
            DB::raw("'LEADS' as paket"),
            'produk as produk_jasa',
            DB::raw("COALESCE(nama_usaha, '-') as nama_usaha"),
            DB::raw("'-' as website_usaha"),
            'nama_pemilik as nama_pemilik',
            'nomor_telepon as kontak',
            'email',
            'alamat_usaha',
            'komisi',
            DB::raw("'-' as jangka_waktu"),
            DB::raw("'-' as target_market"),
        );

        // Gabungkan data dengan unionAll
        $customers = $seo->unionAll($leads);

        // Bungkus dengan subquery supaya bisa orderBy
        return DB::query()->fromSub($customers, 'customers')
            ->orderByDesc('tanggal_masuk')
            ->get();
    }

    public function headings(): array
    {
        return [
            'TANGGAL MASUK',
            'PAKET',
            'PRODUK / JASA',
            'NAMA USAHA',
            'WEBSITE USAHA',
            'NAMA PEMILIK',
            'KONTAK',
            'EMAIL',
            'ALAMAT USAHA',
            'KOMISI',
            'JANGKA WAKTU',
            'TARGET MARKET',
        ];
    }
}
