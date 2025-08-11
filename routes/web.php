<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SeoPackageController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\LeadsPackageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;

// ===== Halaman Utama =====
Route::get('/', function () {
    return view('dashboard');
})->name('home');

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

    // Dashboard
    Route::get('/beranda', [CustomerController::class, 'index'])->name('admin.beranda');
    Route::get('/customers/pdf', [CustomerController::class, 'exportPdf'])->name('customers.pdf');
    Route::get('/customers/excel', [CustomerController::class, 'exportExcel'])->name('customers.excel');

    // Halaman lain
    Route::view('/invoice', 'admin.invoice')->name('admin.invoice');
    Route::view('/kwitansi', 'admin.kwitansi')->name('admin.kwitansi');

    // Customer Detail
    // di dalam Route::prefix('admin')->group(function () { ... });
    Route::get('/customer/{type}/{id}', [CustomerController::class, 'show'])->name('admin.customer.show');

    // generate invoice
    Route::post('/admin/invoice/generate', [InvoiceController::class, 'generateInvoice'])->name('admin.invoice.generate');



});
