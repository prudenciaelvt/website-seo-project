<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

//menampilkan halaman dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('home');

//Rute ke Garansi paket SEO
Route::get('/paket-seo-garansi', function () {
    return view('paketSeoGaransi');
})->name('paket.seo.garansi');

//Rute ke form paket SEO
Route::view('/form-paket-seo', 'formPaketSEO')->name('form.paket.seo');
//Rute ke form paket LEADS
Route::view('/form-paket-leads', 'formPaketLeads')->name('form.paket.leads');

// Muat file admin.php
require __DIR__.'/admin.php';
