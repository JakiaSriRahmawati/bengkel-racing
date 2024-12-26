<div class="container mt-5">
    <div class="card mb-4">
        <div class="card text-center">
            <h4 class="display-4">ARTIKEL</h4>
        </div>
    </div>
    
        <div class="row">
            @foreach ($artikel as $item)
            <div class="col-md-3">
                <div class="card card-custom h-100">
                    <img src="{{ asset($item->gambar) }}" class="card-img-top" alt="Merawat Motor">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text">{{ $item->berita }}</p>
                    </div>
                </div>
            </div>
    @endforeach
