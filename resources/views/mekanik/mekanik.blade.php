<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mekanik Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @include('template.navadmin')
</head>

<body>
    <div class="sidebar">
        <a href="#bookings">Kelola Booking</a>
        <a href="#parts">Kelola Parts</a>
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

        <div id="bookings" class="container mt-5">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <h2 class="display-4">Kelola Booking</h2>
                    <p class="lead">Manajemen data booking.</p>
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
                                <th>Deskripsi</th>
                                <th>Status Servis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $index => $booking)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $booking->user->nama }}</td>
                                    <td>{{ $booking->merk_motor }}</td>
                                    <td>{{ $booking->seri_motor }}</td>
                                    <td>{{ $booking->mesin_motor }}</td>
                                    <td>{{ $booking->no_plat }}</td>
                                    <td>{{ $booking->jenis_servis }}</td>
                                    <td>{{ $booking->tanggal_booking }}</td>
                                    <td>{{ $booking->deskripsi }}</td>
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
                                        <form action="{{ route('updateStatus', $booking->id) }}" method="POST">
                                            @csrf
                                            <select name="status_servis" class="form-select"
                                                onchange="this.form.submit()">
                                                <option value="pending"
                                                    {{ $booking->status_servis == 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="received"
                                                    {{ $booking->status_servis == 'received' ? 'selected' : '' }}>
                                                    Diterima Mekanik</option>
                                                <option value="in_progress"
                                                    {{ $booking->status_servis == 'in_progress' ? 'selected' : '' }}>
                                                    Sedang Dikerjakan</option>
                                                <option value="completed"
                                                    {{ $booking->status_servis == 'completed' ? 'selected' : '' }}>
                                                    Selesai</option>
                                                <option value="rejected"
                                                    {{ $booking->status_servis == 'rejected' ? 'selected' : '' }}>
                                                    Ditolak Mekanik</option>
                                            </select>
                                        </form>

                                        <form action="{{ route('deleteBooking', $booking->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</button>
                                        </form>


                                        <!-- Button to trigger modal -->
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $booking->id }}">
                                            Detail
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="detailModal{{ $booking->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('detail_transaksi.store', $booking->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="part_id" class="form-label">Pilih
                                                                    Barang</label>
                                                                <select id="part_id_{{ $booking->id }}" name="part_id"
                                                                    class="form-select" required>
                                                                    @foreach ($parts as $part)
                                                                        <option value="{{ $part->id }}"
                                                                            data-price="{{ $part->harga_barang }}"
                                                                            data-stock="{{ $part->stok }}">
                                                                            {{ $part->nama_barang }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="harga_barang_{{ $booking->id }}"
                                                                    class="form-label">Harga Barang</label>
                                                                <input type="number" class="form-control"
                                                                    id="harga_barang_{{ $booking->id }}"
                                                                    name="harga_barang" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jumlah_barang_{{ $booking->id }}"
                                                                    class="form-label">Jumlah Barang</label>
                                                                <input type="number" class="form-control"
                                                                    id="jumlah_barang_{{ $booking->id }}"
                                                                    name="jumlah_barang" min="1" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="biaya_jasa_{{ $booking->id }}"
                                                                    class="form-label">Biaya Jasa</label>
                                                                <input type="number" class="form-control"
                                                                    id="biaya_jasa_{{ $booking->id }}"
                                                                    name="biaya_jasa" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Tambah
                                                                Detail</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="parts" class="container mt-5">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <h2 class="display-4">Kelola Parts</h2>
                    <p class="lead">Manajemen data parts.</p>
                </div>
                <div class="mb-3">
                    <a href="{{ route('tambah_barang') }}" class="btn btn-success">Tambah Barang</a>
                </div>
                <div class="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parts as $index => $part)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $part->nama_barang }}</td>
                                    <td>{{ $part->harga_barang }}</td>
                                    <td>{{ $part->stok }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        @foreach ($bookings as $booking)
            const modal = document.getElementById('detailModal{{ $booking->id }}');
            if (modal) {
                const partSelect = modal.querySelector('#part_id_{{ $booking->id }}');
                const hargaBarangInput = modal.querySelector('#harga_barang_{{ $booking->id }}');
                
                if (partSelect && hargaBarangInput) {
                    partSelect.addEventListener('change', function () {
                        const selectedOption = partSelect.options[partSelect.selectedIndex];
                        const hargaBarang = selectedOption.getAttribute('data-price');
                        hargaBarangInput.value = hargaBarang;
                    });
    
                    // Trigger change event on page load to set the initial value
                    partSelect.dispatchEvent(new Event('change'));
                }
            }
        @endforeach
    });
    
    </script>
    
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('detailModal{{ $bookings->id }}');
            const partSelect = modal.querySelector('#part_id_{{ $booking->id }}');
            const hargaBarangInput = modal.querySelector('#harga_barang_{{ $booking->id }}');
    
            partSelect.addEventListener('change', function () {
                const selectedOption = partSelect.options[partSelect.selectedIndex];
                const hargaBarang = selectedOption.getAttribute('data-price');
                hargaBarangInput.value = hargaBarang;
            });
    
            // Trigger change event on page load to set the initial value
            partSelect.dispatchEvent(new Event('change'));
        });
    </script> --}}
</body>

</html>
