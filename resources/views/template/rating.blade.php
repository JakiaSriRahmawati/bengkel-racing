@php
    $totalRating = $rating->sum('rating');
    $totalUsers = $rating->count();         
    $averageRating = $totalUsers > 0 ? number_format($totalRating / $totalUsers, 1, ',', '.') : '0,0'; 
@endphp

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <div class="card" style="height: 200px;">
                <div class="card-header">
                    <h5 class="card-title">Customer Review</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="position: relative;">
                    <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel" style="width: 100%;">
                        <div class="carousel-inner">
                            @foreach($rating as $key => $item)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <p class="card-text text-black text-center">{{ $item->review ?? 'No Review' }}</p>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev" style="position: absolute; top: 50%; left: 0; transform: translateY(-50%); z-index: 5;">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next" style="position: absolute; top: 50%; right: 0; transform: translateY(-50%); z-index: 5;">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card" style="height: 200px; background: #dbd3d3; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="rating-display">
                        <div class="star-container">
                            <span class="star">&#9733;</span>
                        </div>
                        <div class="average-rating">
                            <h2>{{ $averageRating }}</h2>
                        </div>
                    </div>
                    <p class="rating-info">
                        {{-- <strong>Total Rating:</strong> {{ $totalRating }} dari {{ $totalUsers }} user --}}
                        <strong>Rating bengkel dari {{ $totalUsers }} Customer</strong> 
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rating-display {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .star-container {
        font-size: 4rem;
        color: #f5b301;
        margin-right: 15px;
    }

    .average-rating h2 {
        font-size: 3.5rem;
        font-weight: bold;
        color: #333;
    }

    .rating-info {
    font-size: 1.2rem;
    color: #777;
    text-align: center;
    }

</style>
