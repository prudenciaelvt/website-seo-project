<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeoPackage; 

class SeoPackageController extends Controller
{
    // Menyimpan data formulir paket SEO ke database.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha'     => 'required|string',
            'website_usaha'  => 'required|string',
            'nama_pemilik'   => 'required|string',
            'nomor_telepon'  => 'nullable|string',
            'jangka_waktu'   => 'required|string',
            'produk'         => 'nullable|string',
            'target_market'  => 'nullable|string',
            'setuju'         => 'required|boolean',
        ]);

        SeoPackage::create($validated);

        return redirect()->route('form.berhasil')->with('success', 'Formulir berhasil dikirim!');
    }

}
