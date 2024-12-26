@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Booking</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Merek Motor</th>
                <th>Tanggal Booking</th>
                <th>Jenis Servis</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->merek_motor }}</td>
                    <td>{{ $booking->tanggal_booking }}</td>
                    <td>{{ $booking->jenis_servis }}</td>
                    <td>
                        @if($booking->rating)
                            ⭐️ {{ $booking->rating->rating }}
                        @else
                            Belum diberi rating
                        @endif
                    </td>
                    <td>
                        @if(!$booking->rating)
                            <a href="{{ route('ratings.create', $booking->id) }}" class="btn btn-sm btn-warning">Beri Rating</a>
                        @else
                            <span class="text-success">Rating Diberikan</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection