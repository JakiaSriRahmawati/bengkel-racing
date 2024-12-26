<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @include('template.navadmin')
</head>

<body>
    <div class="sidebar">
        <a href="#users">Kelola User</a>
        <a href="#owners">Kelola Owner</a>
        <a href="#cashiers">Kelola Kasir</a>
        <a href="#mechanics">Kelola Mekanik</a>
        <a href="#reports">Laporan Grafik</a>
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

        <div id="users" class="container mt-5">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <h2 class="display-4">Kelola User</h2>
                    <p class="lead">Manajemen data user.</p>
                </div>
                <div class="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
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

        <div id="owners" class="container mt-5">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <h2 class="display-4">Kelola Owner</h2>
                    <p class="lead">Manajemen data owner.</p>
                </div>
                <div class="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Owner</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($owners as $index => $owner)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $owner->nama }}</td>
                                    <td>{{ $owner->email }}</td>
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

        <div id="cashiers" class="container mt-5">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <h2 class="display-4">Kelola Kasir</h2>
                    <p class="lead">Manajemen data kasir.</p>
                </div>
                <div class="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kasir</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashiers as $index => $cashier)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $cashier->nama }}</td>
                                    <td>{{ $cashier->email }}</td>
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

        <div id="mechanics" class="container mt-5">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <h2 class="display-4">Kelola Mekanik</h2>
                    <p class="lead">Manajemen data mekanik.</p>
                </div>
                <div class="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mekanik</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mechanics as $index => $mechanic)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mechanic->nama }}</td>
                                    <td>{{ $mechanic->email }}</td>
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
</body>

</html>
