<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'email',
        'client',
        'paket1_produk',
        'paket1_qty',
        'paket1_harga',
        'paket1_total',
        'paket_tambahan',
        'total_sebelum',
        'grand_total',
    ];

    protected $casts = [
        'paket_tambahan' => 'array',
    ];
}
