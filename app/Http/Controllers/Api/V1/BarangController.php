<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Http\Resources\Api\V1\BarangResource;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        return  BarangResource::collection(Barang::all());
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
            'nama_barang' => 'required|string|max:255',
            'line_divisi' => 'required',
            'kode_qr' => 'required|string|max:255|unique:barangs,kode_qr',
            'production_date' => 'required|date',
        ]);

        $barang = Barang::create([
            'nama_barang' => $request->nama_barang,
            'line_divisi' => $request->line_divisi,
            'kode_qr' => $request->kode_qr,
            'production_date' => $request->production_date,
            'stock_awal' => $request->stock,
            'stock_sekarang' => $request->stock,
        ]);

        return response()->json($barang, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = Barang::findOrFail($id);
        return new BarangResource($barang);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'line_divisi' => 'required',
            'kode_qr' => 'required|string|max:255|unique:barangs,kode_qr,' . $id,
            'production_date' => 'required|date',
            'stock'> 'required|integer|min:0',
        ]);
        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'line_divisi' => $request->line_divisi,
            'kode_qr' => $request->kode_qr,
            'production_date' => $request->production_date,
            'stock_awal' => $request->stock,
            'stock_sekarang' => $request->stock,
        ]);
        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return response()->json(200);
    }

    public function stockIn(Request $request, string $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->stock_sekarang += $request->stock;
        $barang->save();

        return response()->json([
            'message' => 'Stock updated successfully',
            'data' => new BarangResource($barang),
        ]);
    }

    public function stockOut(Request $request, string $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($id);
        if ($barang->stock_sekarang < $request->stock) {
            return response()->json(['message' => 'Insufficient stock'], 400);
        }

        $barang->stock_sekarang -= $request->stock;
        $barang->save();

        return response()->json([
            'message' => 'Stock updated successfully',
            'data' => new BarangResource($barang),
        ]);
    }
}
