<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class barangController extends Controller
{
    /**
     * Display a listing of the resource.\
     */
    public function index()
    {
        $barang = Barang::all();
        return view('barang/index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang/create');        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'line_divisi' => 'required',
            'jumlah_barang' => 'required|integer|min:1',
            'production_date' => 'required|date',
        ]);

        $barcodeText = 'production-' . Carbon::parse($validated['production_date'])->format('Y-m-d');

        $barcode = new DNS1D();
        $barcode->setStorPath(storage_path('framework/barcodes/'));
        $barcodeImageData = $barcode->getBarcodePNG($barcodeText, 'C128');

        $filename = 'barcodes/' . $barcodeText . '.png';
        Storage::disk('public')->put($filename, base64_decode($barcodeImageData));

        $product = Barang::create([
            'nama_barang' => $validated['nama_barang'],
            'production_date' => $validated['production_date'],
            'line_divisi' => $validated['line_divisi'],
            'jumlah_barang' => $validated['jumlah_barang'],
            'kode_barcode' => $barcodeText,
            'gambar_barcode' => $filename,
        ]);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'data' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
