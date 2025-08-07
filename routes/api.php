<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\User;

use App\Http\Resources\Api\V1\BarangCollection;
use App\Http\Controllers\Api\V1\BarangController;

Route::post('/login', function (Request $request) {
    $credentials = $request->only('name', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('access-token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
});
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1' ,'namespace' => 'App\Http\Controllers\Api\V1'], function () {

        Route::apiResource('barang', BarangController::class);
        Route::post('barang/{id}/stock-in', [BarangController::class, 'stockIn']);
        Route::post('barang/{id}/stock-out', [BarangController::class, 'stockOut']);
});
