<div class="d-flex justify-content-between align-items-center bg-white p-2">
    <img src="{{asset('img/logo (1).png')}}" alt="Left image" height="60">
    <img src="{{asset('img/logo (3).png')}}" alt="Right image" height="40">
</div>
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="{{ route('home')}}">HOME</a>
        <a class="navbar-brand text-white" href="{{ route('about')}}">About Us</a>
        <a class="navbar-brand text-white" href="{{ route('login')}}">Login</a>
        <a class="navbar-brand text-white" href="{{ route('booking')}}">booking</a>
        <a class="navbar-brand text-white" href="{{ route('profile')}}">Profil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu">
                        @auth
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('booking') }}">Booking</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> 
