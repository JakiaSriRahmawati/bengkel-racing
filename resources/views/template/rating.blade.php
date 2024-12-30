<div class="container">
  <h2>Service Ratings</h2>

  @if(count($rating) > 0)
      @foreach($rating as $item)
          <div class="card mb-3">
              <div class="card-body">
                  <h5 class="card-title">Booking #{{ $item->booking_id }}</h5>
                  <div class="stars">
                      @for ($i = 1; $i <= 5; $i++)
                          @if ($i <= $item->rating)
                              <span class="star">&#9733;</span>  {{-- Full Star --}}
                          @else
                              <span class="star">&#9734;</span>  {{-- Empty Star --}}
                          @endif
                      @endfor
                  </div>
                  <p class="card-text text-black">{{ $item->review ?? 'No Review' }}</p>
              </div>
          </div>
      @endforeach
  @else
      <p>No ratings available</p>
  @endif
</div>

<style>
  .stars {
      color: #f5b301;
      font-size: 1.5rem;
  }
  .star {
      display: inline-block;
  }
</style>
