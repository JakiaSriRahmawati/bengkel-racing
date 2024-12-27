@extends('layout.app')

@section('content')
<div class="container">
    <h2>Update Uang Masuk</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('booking.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="form-group">
            <label for="uang_masuk">Uang Masuk:</label>
            <input type="number" class="form-control" id="uang_masuk" name="uang_masuk" value="{{ old('uang_masuk') }}" required min="0">
            
            @error('uang_masuk')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
