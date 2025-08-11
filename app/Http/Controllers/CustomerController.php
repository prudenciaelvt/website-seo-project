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
            'nama_pemilik as nama',
            'nomor_telepon as kontak',
            DB::raw("'SEO' as paket"),
            'produk as produk_jasa',
            'created_at as tanggal_masuk'
        );
        // Ambil data Leads
        $leads = LeadsPackage::select(
            'nama_pemilik as nama',
            'nomor_telepon as kontak',
            DB::raw("'LEADS' as paket"),
            'produk as produk_jasa',
            'created_at as tanggal_masuk'
        );
        // Gabungkan data SEO dan Leads
        $customers = $seo->unionAll($leads)->get()->sortByDesc('tanggal_masuk');

        $pdf = Pdf::loadView('exports.customer_pdf', compact('customers'));
        return $pdf->download('data_customer.pdf');
    }

    // Export data customer ke file Excel.
    public function exportExcel()
    {
        // Download file Excel dengan data customer
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
}
