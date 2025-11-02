<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SeoPackageController;
use App\Http\Controllers\LeadsPackageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KwitansiController;
use App\Models\Invoice;

// ===== Halaman Utama =====
Route::get('/', fn() => view('dashboard'))->name('home'); // Halaman dashboard utama (landing admin)

Route::view('/paket-seo-garansi', 'paketSeoGaransi')->name('paket.seo.garansi'); // Halaman Paket SEO Garansi
Route::view('/form-paket-seo', 'formPaketSEO')->name('form.paket.seo'); // Form pemesanan Paket SEO
Route::view('/form-paket-leads', 'formPaketLeads')->name('form.paket.leads'); // Form pemesanan Paket Leads
Route::view('/form-berhasil', 'formBerhasil')->name('form.berhasil'); // Halaman setelah form berhasil disubmit

// ===== Submit data form (Frontend -> Backend) =====
Route::post('/seo-package', [SeoPackageController::class, 'store'])->name('seo-package.store'); // Simpan data paket SEO
Route::post('/paket-leads', [LeadsPackageController::class, 'store'])->name('paket-leads.store'); // Simpan data paket Leads


// ===== Admin Section =====
Route::prefix('admin')->group(function () {
    // === Auth ===
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login'); // Tampilkan form login admin
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit'); // Proses login admin
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout'); // Proses logout admin

    // === Dashboard & Export Data Customer ===
    Route::get('/beranda', [CustomerController::class, 'index'])->name('admin.beranda'); // Dashboard admin (daftar customer)
    Route::get('/customers/pdf', [CustomerController::class, 'exportPdf'])->name('admin.customers.pdf'); // Export customer ke PDF
    Route::get('/customers/excel', [CustomerController::class, 'exportExcel'])->name('admin.customers.excel'); // Export customer ke Excel

Route::delete('/customers/{type}/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // === Invoice & Kwitansi ===
    // Route::view('/invoice', 'admin.invoice')->name('admin.invoice'); // Halaman view invoice (static view)
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('admin.invoice');


    
    // Detail customer berdasarkan tipe paket
    Route::get('/customer/{type}/{id}', [CustomerController::class, 'show'])->name('admin.customer.show'); 

    // Generate invoice manual dari data customer
    Route::post('/invoice/generate', [InvoiceController::class, 'generateInvoice'])->name('admin.invoice.generate'); 

    // Halaman Kwitansi + pencarian invoice
    Route::get('/kwitansi', function () {
        $search = request('search');
        $invoices = Invoice::when($search, function ($query, $search) {
            $query->where('client', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })->latest()->get();

        return view('admin.kwitansi', compact('invoices'));
    })->name('admin.kwitansi');

    // Generate Kwitansi berdasarkan ID Invoice
    Route::get('/kwitansi/generate/{id}', [KwitansiController::class, 'generate'])
        ->name('kwitansi.generate');

    Route::get('/invoices/{id}/generate', [InvoiceController::class, 'generate'])
    ->name('invoices.generate');


    // === Export Data Invoice ===
    Route::get('/invoices/export-flatten', [InvoiceController::class, 'exportFlattened'])
        ->name('invoices.export.flatten'); // Export invoice versi flatten (1 row per customer, paket tambahan dijadikan kolom)

    Route::get('/invoices/export', [InvoiceController::class, 'exportExcel'])
        ->name('invoices.export'); // Export invoice detail ke Excel

    // Export PDF 
    Route::get('/customers/pdf', [CustomerController::class, 'exportPdf'])->name('customers.pdf'); 
    
    // Export Excel 
    Route::get('/customers/excel', [CustomerController::class, 'exportExcel'])->name('customers.excel');

    // Form tambah invoice
    Route::get('/admin/invoice/create', [InvoiceController::class, 'create'])->name('admin.invoice.create');

    // Simpan invoice baru
    Route::post('/admin/invoice/generate', [InvoiceController::class, 'store'])->name('admin.invoice.generate');

    // Simpan invoice baru
Route::post('/admin/invoice', [InvoiceController::class, 'store'])
    ->name('admin.invoice.store');

});