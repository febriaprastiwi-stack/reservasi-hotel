<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <!-- Left Menu -->
        <div class="d-flex align-items-center">
            <a class="nav-link" href="{{ route('home') }}">Home</a>
            <a class="nav-link" href="{{ route('home.fasilitas.index') }}">Fasilitas</a>
        </div>

        <!-- Logo Tengah -->
        <a class="navbar-brand mx-auto" href="{{ route('home.rooms.index') }}">
            <img src="{{ asset('img/logo.jpg') }}" alt="Hotel Logo" class="logo-center">
        </a>
    </div>
</nav>

<style>
    .navbar-custom {
        background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
        padding: 15px 0;
    }

    .navbar-custom .nav-link {
        color: #f1f1f1 !important;
        font-weight: 500;
        margin: 0 10px;
        transition: color 0.3s ease;
    }

    .navbar-custom .nav-link:hover {
        color: #ffcc00 !important;
    }

    .navbar-custom .navbar-brand img.logo-center {
        height: 50px;
    }

    .navbar-custom .btn-primary {
        background-color: #ffcc00;
        border: none;
        color: #000;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .navbar-custom .btn-primary:hover {
        background-color: #e6b800;
        color: #fff;
    }
</style>