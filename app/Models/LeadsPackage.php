<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_usaha',
        'alamat_usaha',
        'email',
        'nama_pemilik',
        'nomor_telepon',
        'produk',
        'komisi',
        'setuju',
    ];
}
