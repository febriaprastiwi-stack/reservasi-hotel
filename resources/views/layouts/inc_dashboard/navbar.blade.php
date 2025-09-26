<nav class="navbar navbar-expand-lg navbar-custom"
    style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;">
    <div class="container-fluid">
        <!-- Logo + Brand Kiri -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.jpg') }}" alt="Hotel Logo" class="logo-left me-2">
            GRAND ROYAL HOTEL
        </a>

        <!-- Toggle (untuk mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Kanan -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                @guest
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                   
                @endguest
            </ul>
        </div>
    </div>
</nav>