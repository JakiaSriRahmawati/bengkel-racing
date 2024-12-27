@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Profil</h1>

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
                                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#detail-{{ $order->id }}" aria-expanded="false"
                                            aria-controls="detail-{{ $order->id }}">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="10">
                                        <div class="collapse mt-2" id="detail-{{ $order->id }}">
                                            <div class="card card-body">
                                                <h5>Detail Transaksi</h5>

                                                @php
                                                    $filteredDetails = $details ? $details->where('booking_id', $order->id) : collect();
                                                @endphp

                                                @if ($filteredDetails->isEmpty())
                                                    <p>Belum ada transaksi untuk pesanan ini.</p>
                                                @else
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Barang</th>
                                                                <th>Harga Barang</th>
                                                                <th>Biaya Jasa</th>
                                                                <th>Total Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($filteredDetails as $detail)
                                                                <tr>
                                                                    <td>{{ $detail->nama_barang }}</td>
                                                                    <td>{{ $detail->harga_barang }}</td>
                                                                    <td>{{ $detail->biaya_jasa }}</td>
                                                                    <td>{{ $detail->harga_barang + $detail->biaya_jasa }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
