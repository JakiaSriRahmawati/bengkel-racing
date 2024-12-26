<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        @media print {
            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2 class="display-4">BENGKEL RACING TEAM</h2>
            <p class="lead">Detail transaksi layanan dan barang.</p>
        </div>
        @foreach ($details as $index => $detail)
            <div class="card card-custom mb-5 page-break">
                <div class="card-body">
                    <h5>Transaksi #{{ $index + 1 }}</h5>
                    <p><strong>Kode Invoice:</strong> {{ $detail->invoice }}</p>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>Nama User</th>
                                <td>{{ $detail->booking->user->nama }}</td>
                            </tr>
                            <tr>
                                <th>Merek Motor</th>
                                <td>{{ $detail->booking->merek_motor }}</td>
                            </tr>
                            <tr>
                                <th>Seri Motor</th>
                                <td>{{ $detail->booking->seri_motor }}</td>
                            </tr>
                            <tr>
                                <th>Mesin Motor</th>
                                <td>{{ $detail->booking->mesin_motor }}</td>
                            </tr>
                            <tr>
                                <th>No Plat</th>
                                <td>{{ $detail->booking->no_plat }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Servis</th>
                                <td>{{ $detail->booking->jenis_servis }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Booking</th>
                                <td>{{ $detail->booking->tanggal_booking }}</td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td>{{ $detail->nama_barang }}</td>
                            </tr>
                            <tr>
                                <th>Harga Barang</th>
                                <td>{{ $detail->harga_barang }}</td>
                            </tr>
                            <tr>
                                <th>Biaya Jasa</th>
                                <td>{{ $detail->biaya_jasa }}</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>{{ $detail->harga_barang + $detail->biaya_jasa }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
        <div class="text-center mt-4">
            <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
        </div>
    </div>
</body>

</html>
