<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Grand Royal Hotel')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }

        .sidebar {
            min-height: 100vh;
            background: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }

        .sidebar .nav-link {
            color: #333;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        .content {
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">GRAND ROYAL HOTEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                    @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar d-none d-md-block">
                @include('layouts.inc_dashboard.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-md-10 content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>

<style>
    .navbar-custom {
        background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
        /* gradasi elegan */
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
        /* efek hover emas */
    }

    .navbar-custom .navbar-brand img.logo-center {
        height: 50px;
        background: none;
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
