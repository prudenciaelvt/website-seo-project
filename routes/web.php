<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SeoPackageController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\LeadsPackageController;


// Halaman dashboard utama
Route::get('/', function () {
    return view('dashboard');
})->name('home');

// Halaman paket SEO bergaransi
Route::get('/paket-seo-garansi', function () {
    return view('paketSeoGaransi');
})->name('paket.seo.garansi');

// Formulir paket SEO
Route::view('/form-paket-seo', 'formPaketSEO')->name('form.paket.seo');

// Formulir paket LEADS
Route::view('/form-paket-leads', 'formPaketLeads')->name('form.paket.leads');

// Halaman form berhasil
Route::view('/form-berhasil', 'formBerhasil')->name('form.berhasil');

// Submit data dari form paket SEO
Route::post('/seo-package', [SeoPackageController::class, 'store'])->name('seo-package.store');

// ===== Admin Section ===== //

// Halaman login admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

// Proses login admin
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Halaman logout admin
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Halaman beranda admin
Route::get('/admin/beranda', [AdminAuthController::class, 'beranda'])->name('admin.beranda');

// Halaman invoice admin
Route::get('/admin/invoice', function () {
    return view('admin.invoice');
})->name('admin.invoice');

// Halaman kwitansi admin
Route::get('/admin/kwitansi', function () {
    return view('admin.kwitansi');
})->name('admin.kwitansi');

Route::post('/paket-leads', [LeadsPackageController::class, 'store'])->name('paket-leads.store');
