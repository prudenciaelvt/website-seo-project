<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoPackage extends Model
{
    use HasFactory;
    // Model untuk menyimpan data formulir layanan paket SEO ke database.
    protected $fillable = [
        'nama_usaha',
        'website_usaha',
        'nama_pemilik',
        'nomor_telepon',
        'jangka_waktu',
        'produk',
        'target_market',
        'setuju',
    ];
}
