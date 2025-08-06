<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Barang;
use App\Http\Resources\Api\V1\BarangCollection;
use App\Http\Controllers\Api\V1\BarangController;
Route::get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1' ,'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::group(['prefix' => 'barang'], function () {
        Route::apiResource('', BarangController::class);
        Route::post('{id}/stock-in', [BarangController::class, 'stockIn']);
        Route::post('{id}/stock-out', [BarangController::class, 'stockOut']);
    });
});
