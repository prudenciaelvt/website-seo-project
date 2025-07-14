<?php

use Illuminate\Support\Facades\Route;

//menampilkan halaman dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('home');
