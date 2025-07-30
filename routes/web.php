<?php

use Illuminate\Support\Facades\Route;

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

//Rute ke form paket LEADS
Route::view('/form-berhasil', 'formBerhasil')->name('form.berhasil');


// Admin login page (tampilan frontend)
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

// Admin login submit (dummy, frontend saja)
Route::post('/admin/login', function () {
    return redirect()->route('admin.login')->with('message', 'Fitur belum aktif');
})->name('admin.login.submit');

// Admin Beranda
Route::get('/admin/beranda', function () {
    return view('admin.beranda');
})->name('admin.beranda');

// Admin Invoice
Route::get('/admin/invoice', function () {
    return view('admin.invoice');
})->name('admin.invoice');

// Admin Kwitansi
Route::get('/admin/kwitansi', function () {
    return view('admin.kwitansi');
})->name('admin.kwitansi');
