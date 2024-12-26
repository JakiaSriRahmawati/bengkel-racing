<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <title>Tambah Barang</title>
</head>
<body>

    <div class="container mt-5">
        <div class="card card-custom">
            <div class="card-body">
                <h2 class="display-4">Tambah Barang</h2>
                <form action="{{ route('addPart') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_barang">Harga Barang</label>
                        <input type="number" id="harga_barang" name="harga_barang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" id="stok" name="stok" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Tambah Barang</button>
                    <a href="{{ route('mekanik') }}" class="btn btn-primary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>