<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Nama tabel (opsional kalau mengikuti default 'customers')
    protected $table = 'customers';

    // Kolom yang boleh diisi sekaligus
    protected $fillable = [
        'name',
        'email',
        'phone',
        'package_type',
    ];
}
