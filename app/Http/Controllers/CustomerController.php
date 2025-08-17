<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadsPackage;
use App\Models\SeoPackage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerExport;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    
    public function show($type, $id)
    {
        // Cari data SEO berdasarkan id
        if ($type === 'seo') {
            $customer = SeoPackage::find($id);

        } elseif ($type === 'leads') {
            $customer = LeadsPackage::find($id);
        } else {
            return response()->json(['error' => 'Tipe tidak dikenal'], 404);
        }

        if (! $customer) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // return JSON utuh (model Eloquent => JSON)
        return response()->json($customer);
    }


    // Menampilkan daftar semua customer dari tabel SEO dan Leads.
    public function index(Request $request)
    {
        // Ambil input pencarian dari query string
        $search = $request->input('search');

        // Ambil data SEO
        $seo = SeoPackage::select(
            'nama_pemilik as nama',
            'nomor_telepon as kontak',
            DB::raw("'SEO' as paket"),
            'produk as produk_jasa',
            'created_at as tanggal_masuk',
            'id',
            DB::raw("'seo' as type")
        );

        // Ambil data Leads
        $leads = LeadsPackage::select(
            'nama_pemilik as nama',
            'nomor_telepon as kontak',
            DB::raw("'LEADS' as paket"),
            'produk as produk_jasa',
            'created_at as tanggal_masuk',
            'id',
            DB::raw("'leads' as type")
        );

        // Jika ada search, tambahkan filter where like untuk nama pada kedua query
        if (!empty($search)) {
            $seo->where('nama_pemilik', 'like', '%' . $search . '%');
            $leads->where('nama_pemilik', 'like', '%' . $search . '%');
        }

        // Menggabungka data 
        $customers = $seo->unionAll($leads)->get()->sortByDesc('tanggal_masuk');

        return view('admin.beranda', compact('customers'));
    }

    // * Export data customer (SEO + Leads) ke file PDF.
    public function exportPdf()
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
            DB::raw("'-' as status_invoice")
        );

        // Gabungkan data
        $customers = $seo->unionAll($leads);

        // Bungkus unionAll dengan query builder supaya bisa orderBy
        $customers = DB::query()->fromSub($customers, 'customers')
            ->orderByDesc('tanggal_masuk')
            ->get();

        // Buat PDF dengan orientasi Landscape
        $pdf = Pdf::loadView('templates.pdfTemplate', compact('customers'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('data_customer.pdf');
    }

    // Export data customer ke file Excel.
    public function exportExcel()
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
            DB::raw("'-' as status_invoice")
        );

        // Gabungkan data
        $customers = $seo->unionAll($leads);

        // Bungkus unionAll dengan query builder supaya bisa orderBy
        $customers = DB::query()->fromSub($customers, 'customers')
            ->orderByDesc('tanggal_masuk')
            ->get();
            
        // Download file Excel dengan data customer
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
}
