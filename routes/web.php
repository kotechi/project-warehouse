<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\barangController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/barang', barangController::class);