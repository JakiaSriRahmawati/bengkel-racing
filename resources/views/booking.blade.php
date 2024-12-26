<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable.min.css') }}">
    <title>Form Booking </title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>

    @include('template.nav')

    <div class="container mt-5">
        <div class="form-container mx-auto" style="max-width: 600px;">
            <h2 class="text-center mb-4">Form Booking</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                {{-- @method('PUT') --}}
                <div class="form-group mb-3">
                    <label for="merek_motor">Merek Motor</label>
                    <input type="text" class="form-control" id="merek_motor" name="merek_motor"
                    placeholder="Masukkan merek motor" required>
                    {{-- <select class="form-control" id="merek_motor" name="merek_motor" required>
                        <option value="" disabled selected>Pilih Merek Motor</option>
                        <option value="YAMAHA">YAMAHA</option>
                        <option value="HONDA">HONDA</option>
                        <option value="SUZUKI">SUZUKI</option>
                    </select> --}}
                </div>

                <div class="form-group mb-3">
                    <label for="seri_motor">Seri Motor</label>
                    <input type="text" class="form-control" id="seri_motor" name="seri_motor"
                        placeholder="Masukkan seri motor" required>
                </div>

                <div class="form-group mb-3">
                    <label for="mesin_motor">Mesin Motor</label>
                    <input type="text" class="form-control" id="mesin_motor" name="mesin_motor"
                        placeholder="Masukkan mesin motor" required>
                </div>

                <div class="form-group mb-3">
                    <label for="no_plat">Plat Motor</label>
                    <input type="text" class="form-control" id="no_plat" name="no_plat"
                        placeholder="Masukkan plat motor" required>
                </div>

                <div class="form-group mb-3">
                    <label for="jenis_servis">Jenis Servis</label>
                    <input type="text" class="form-control" id="jenis_servis" name="jenis_servis"
                        placeholder="Masukkan Jenis Servis" required>
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal_booking">Tanggal Booking</label>
                    <input type="date" class="form-control" id="tanggal_booking" name="tanggal_booking" required>
                </div>

                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi" required></textarea>
                </div>

                <button type="submit" class="btn btn-success mt-5">Booking</button>
                <button type="reset" class="btn btn-secondary mt-5">Cancel</button>
            </form>
        </div>
    </div>

    @include('template.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
