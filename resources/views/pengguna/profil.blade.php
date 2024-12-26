@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Profil </h1>

        <!-- Menampilkan pesan status -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Detail Pengguna -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Detail Pengguna</h5>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $user->nama }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        </div>

        <!-- Detail Pesanan -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Detail Pesanan</h5>
            </div>
            <div class="card-body">
                @if ($orders->isEmpty())
                    <p>Anda belum memiliki pesanan.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Merek Motor</th>
                                <th>Seri Motor</th>
                                <th>Mesin Motor</th>
                                <th>Plat Motor</th>
                                <th>Jenis Servis</th>
                                <th>Tanggal Booking</th>
                                <th>Status Pembayaran</th>
                                <th>Status Servis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->merek_motor }}</td>
                                    <td>{{ $order->seri_motor }}</td>
                                    <td>{{ $order->mesin_motor }}</td>
                                    <td>{{ $order->no_plat }}</td>
                                    <td>{{ $order->jenis_servis }}</td>
                                    <td>{{ $order->tanggal_booking->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($order->is_paid)
                                            <span class="badge bg-success">Lunas</span>
                                        @else
                                            <span class="badge bg-warning">Belum Lunas</span>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if ($order->status_servis == 'received')
                                            <span class="badge bg-info">Diterima Mekanik</span>
                                        @elseif ($order->status_servis == 'in_progress')
                                            <span class="badge bg-warning">Sedang Dikerjakan</span>
                                        @elseif ($order->status_servis == 'completed')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif ($order->status_servis == 'rejected')
                                            <span class="badge bg-danger">Ditolak Mekanik</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->status_servis == 'pending')
                                            <form action="{{ route('cancelOrder', $order->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Batalkan</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Detail Transaksi (Invoice) -->
        <div class="card" style="background-color: #ffffff;">
            <div class="card-header">
                <h5 class="card-title">Detail Transaksi</h5>
            </div>
            <div class="card-body">
                @if ($details->isEmpty())
                    <p>Belum ada transaksi.</p>
                @else
                    @foreach ($details as $index => $detail)
                        <div class="card card-custom mb-4" style="background-color: #ffffff;">
                            <div class="card-body">
                                <h5>Transaksi #{{ $index + 1 }}</h5>
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
                                            <td>{{ $detail->booking->tanggal_booking->format('d-m-Y') }}</td>
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
                                {{-- @if (!$detail->booking->is_paid) --}}
                                    <form action="{{ route('uploadPaymentProof', $detail->booking->id) }}" method="POST"
                                        enctype="multipart/form-data" class="mt-3">
                                        @csrf
                                        <input type="file" name="gambar" id="gambar" accept="image/*" required>
                                        <button type="submit" class="btn btn-primary mt-2">Bayar</button>
                                    </form>
                                {{-- @else
                                    <button class="btn btn-secondary" disabled>Bayar</button>
                                @endif --}}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
@endsection
