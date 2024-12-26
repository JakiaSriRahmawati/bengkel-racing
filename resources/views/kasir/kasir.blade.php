<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @include('template.navadmin')
</head>

<body>
    <div class="sidebar">
        <a href="#orders">Kelola Pesanan</a>
        <a href="#transactions">Kelola Transaksi</a>
        <a href="{{ route('kasir.invoice') }}">Lihat Invoice</a>
    </div>

    <div class="main-content">
        <div class="container mt-5">
            <div class="card card-custom status-card">
                <div class="card-body text-center">
                    @if (Session::has('notifikasi'))
                        <h5 class="text-danger">{{ Session::get('notifikasi') }}</h5>
                    @endif
                </div>
            </div>
        </div>

        <div id="orders" class="container mt-5">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <h2 class="display-4">Kelola Pesanan</h2>
                    <p class="lead">Manajemen data pesanan.</p>
                </div>
                <div class="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Merek Motor</th>
                                <th>Seri Motor</th>
                                <th>Mesin Motor</th>
                                <th>No Plat</th>
                                <th>Jenis Servis</th>
                                <th>Tanggal Booking</th>
                                <th>Status Servis</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $index => $booking)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $booking->user->nama }}</td>
                                    <td>{{ $booking->merek_motor }}</td>
                                    <td>{{ $booking->seri_motor }}</td>
                                    <td>{{ $booking->mesin_motor }}</td>
                                    <td>{{ $booking->no_plat }}</td>
                                    <td>{{ $booking->jenis_servis }}</td>
                                    <td>{{ $booking->tanggal_booking }}</td>
                                    <td>
                                        @if ($booking->status_servis == 'received')
                                            <span class="badge bg-info">Diterima Mekanik</span>
                                        @elseif ($booking->status_servis == 'in_progress')
                                            <span class="badge bg-warning">Sedang Dikerjakan</span>
                                        @elseif ($booking->status_servis == 'completed')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif ($booking->status_servis == 'rejected')
                                            <span class="badge bg-danger">Ditolak Mekanik</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ asset($booking->buktiPembayaran->gambar) }}" alt="Bukti Pembayaran" style="height: 50px">
                                        
                                    </td>
                                    <td>
                                        @if ($booking->buktiPembayaran && !$booking->is_paid)
                                            <form action="{{ route('verifyPayment', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Verifikasi Pembayaran</button>
                                            </form>
                                        @elseif($booking->is_paid)
                                            <button class="btn btn-secondary btn-sm" disabled>Sudah Lunas</button>
                                        @endif
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Detail Transaksi -->
        <div id="transactions" class="container mt-5">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <h2 class="display-4">Detail Transaksi</h2>
                    <p class="lead">Manajemen detail transaksi.</p>
                </div>
                <div class="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Merek Motor</th>
                                <th>Seri Motor</th>
                                <th>Mesin Motor</th>
                                <th>No Plat</th>
                                <th>Jenis Servis</th>
                                <th>Tanggal Booking</th>
                                <th>Nama Barang</th>
                                <th>Harga Barang</th>
                                <th>Biaya Jasa</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->booking->user->nama }}</td>
                                    <td>{{ $detail->booking->merek_motor }}</td>
                                    <td>{{ $detail->booking->seri_motor }}</td>
                                    <td>{{ $detail->booking->mesin_motor }}</td>
                                    <td>{{ $detail->booking->no_plat }}</td>
                                    <td>{{ $detail->booking->jenis_servis }}</td>
                                    <td>{{ $detail->booking->tanggal_booking }}</td>
                                    <td>{{ $detail->nama_barang }}</td>
                                    <td>{{ $detail->harga_barang }}</td>
                                    <td>{{ $detail->biaya_jasa }}</td>
                                    <td>{{ $detail->harga_barang + $detail->biaya_jasa }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
