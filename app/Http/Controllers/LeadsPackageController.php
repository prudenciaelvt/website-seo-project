<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadsPackage; 

class LeadsPackageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'alamat_usaha' => 'required|string',
            'email' => 'required|email',
            'nama_pemilik' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'produk' => 'nullable|string',
            'komisi' => 'required|string',
            'setuju' => 'required|boolean',
        ]);

        LeadsPackage::create($validated);

        return redirect()->route('form.berhasil')->with('success', 'Formulir berhasil dikirim!');
    }

}
