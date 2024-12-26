{{-- <div class="container mt-5">
    <div class="card mb-4">
      <div class="card-body text-center"> --}}
        <div class="container mt-4">
        <div class="row">
          @foreach ($rating as $item)
          <div class="col-md-3">
            <div class="card card-custom h-100">
              <div class="card-body">
                <h5 class="card-title">{{$item->rating }}</h5>
                <p class="card-text">{{$item->deskripsi }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
        </div>