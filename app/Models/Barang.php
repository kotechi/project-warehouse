<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        
        'nama_barang',
        'kode_barcode',
        'gambar_barcode',
        'line_divisi',
        'production_date',
    ];

}
