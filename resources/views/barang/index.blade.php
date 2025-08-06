<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>list barang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>halaman index barang</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Line Divisi</th>
                <th>Production Date</th>
                <th>Kode Barcode</th>
                <th>Gambar Barcode</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $item)
                <tr>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah_barang }}</td>
                    <td>{{ $item->line_divisi }}</td>
                    <td>{{ $item->production_date }}</td>
                    <td>{{ $item->kode_barcode }}</td>
                    <td><img src="{{ asset('storage/' . $item->gambar_barcode) }}" alt="Barcode Image" width="100"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>