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
Route::get('/', fn() => view('dashboard'))->name('home');

Route::view('/paket-seo-garansi', 'paketSeoGaransi')->name('paket.seo.garansi');
Route::view('/form-paket-seo', 'formPaketSEO')->name('form.paket.seo');
Route::view('/form-paket-leads', 'formPaketLeads')->name('form.paket.leads');
Route::view('/form-berhasil', 'formBerhasil')->name('form.berhasil');

// Submit data form
Route::post('/seo-package', [SeoPackageController::class, 'store'])->name('seo-package.store');
Route::post('/paket-leads', [LeadsPackageController::class, 'store'])->name('paket-leads.store');

// ===== Admin Section =====
Route::prefix('admin')->group(function () {
    // Auth
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Dashboard & export
    Route::get('/beranda', [CustomerController::class, 'index'])->name('admin.beranda');
    Route::get('/customers/pdf', [CustomerController::class, 'exportPdf'])->name('admin.customers.pdf');
    Route::get('/customers/excel', [CustomerController::class, 'exportExcel'])->name('admin.customers.excel');

    // Halaman view invoice & kwitansi
    Route::view('/invoice', 'admin.invoice')->name('admin.invoice');

    // Customer Detail
    Route::get('/customer/{type}/{id}', [CustomerController::class, 'show'])->name('admin.customer.show');

    // Generate invoice & kwitansi
    Route::post('/invoice/generate', [InvoiceController::class, 'generateInvoice'])->name('admin.invoice.generate');

   Route::get('/kwitansi', function () {
        $search = request('search');

        $invoices = Invoice::when($search, function ($query, $search) {
            $query->where('client', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->latest()->get();

        return view('admin.kwitansi', compact('invoices'));
    })->name('admin.kwitansi');

    Route::get('/kwitansi/generate/{id}', [KwitansiController::class, 'generate'])
    ->name('kwitansi.generate');


    // Export PDF
    Route::get('/customers/pdf', [CustomerController::class, 'exportPdf'])->name('customers.pdf');

    // Export Excel
    Route::get('/customers/excel', [CustomerController::class, 'exportExcel'])->name('customers.excel');



});
