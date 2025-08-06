<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'id',
        'nama_barang',
        'kode_qr',
        'stock_awal',
        'stock_sekarang',
        'line_divisi',
        'production_date',
    ];

}
