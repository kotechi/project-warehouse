<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form barang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-4">
    <div class="flex flex-col justify-center items-center border-1 border-gray-300 rounded-lg p-4" >
        <h1 style="">form tambah stock barang</h1>
        <form action="{{route('barang.store')}}" style="flex-direction: column; width: 50%; display: flex; gap: 1rem;" method="POST" enctype="multipart/form-data">
        @csrf
            <label for="nama_barang">Nama Barang:</label>
                <input type="text" id="nama_barang" name="nama_barang" required> 
                <label for="qty">Jumlah Barang:</label>
                <input type="text" id="jumlah_barang" name="jumlah_barang" required> 
                <label for="line_divisi">Line Divisi:</label>
                <input type="text" id="line_divisi" name="line_divisi" required>
                <label for="production_date">Production Date:</label>
                <input type="date" id="production_date" name="production_date" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>