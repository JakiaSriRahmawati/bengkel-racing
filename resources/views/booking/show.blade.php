@extends('layout.app')

@section('content')
<div class="container">
    <h2>Booking Details</h2>

    <p><strong>Service Name:</strong> {{ $booking->service_name }}</p>
    <p><strong>Status:</strong> {{ $booking->status }}</p>

    <!-- Rating & Review Section -->
    <h3>Ratings & Reviews</h3>
    
    <!-- Cek apakah booking memiliki ratings dan menampilkan jika ada -->
    @if($booking->ratings && $booking->ratings->isNotEmpty())
        @foreach($booking->ratings as $rating)
            <div class="rating">
                <strong>Rating:</strong> {{ $rating->rating }} / 5
                <p>{{ $rating->review }}</p>
            </div>
        @endforeach
    @else
        <p>No ratings yet.</p>
    @endif

    <!-- Jika booking sudah selesai dan user belum memberi rating, tampilkan tombol untuk memberi rating -->
    @if($booking->status === 'completed' && $booking->ratings->isEmpty())
        <a href="{{ route('rating.form', ['bookingId' => $booking->id]) }}" class="btn btn-primary">Rate this service</a>
    @endif
</div>
@endsection
