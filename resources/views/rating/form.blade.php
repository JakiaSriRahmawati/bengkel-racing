@extends('layout.app')

@section('content')
<div class="container">
    <h2>Rate Service for Booking #{{ $booking->id }}</h2>

    @if ($userRating)
        <div class="alert alert-info">
            <strong>Your Rating:</strong> {{ $userRating->rating }} <br>
            <strong>Your Review:</strong> {{ $userRating->review }}
        </div>
        <button class="btn btn-secondary" disabled>Rating Anda</button>
    @else
        <form action="{{ route('rating.submit', $booking->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5" required/>
                    <label for="star5" title="5 stars">&#9733;</label>

                    <input type="radio" id="star4" name="rating" value="4" />
                    <label for="star4" title="4 stars">&#9733;</label>

                    <input type="radio" id="star3" name="rating" value="3" />
                    <label for="star3" title="3 stars">&#9733;</label>

                    <input type="radio" id="star2" name="rating" value="2" />
                    <label for="star2" title="2 stars">&#9733;</label>

                    <input type="radio" id="star1" name="rating" value="1" />
                    <label for="star1" title="1 star">&#9733;</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea id="review" name="review" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Rating</button>
        </form>
    @endif
</div>

<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
    }

    .rating > input {
        display: none;
    }

    .rating > label {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
    }

    .rating > input:checked ~ label {
        color: #f5b301;
    }

    .rating:not(:checked) > label:hover,
    .rating:not(:checked) > label:hover ~ label {
        color: #ffcc00;
    }

    .rating > input:checked + label:hover,
    .rating > input:checked + label:hover ~ label {
        color: #ffcc00;
    }
</style>
@endsection
