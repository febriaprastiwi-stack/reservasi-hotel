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
            background: linear-gradient(180deg, #0f2027, #203a43, #2c5364);
            /* gradasi vertikal biar beda dengan navbar */
            color: #f1f1f1;
        }

        .sidebar .nav-link {
            color: #f1f1f1;
            font-weight: 500;
            margin: 5px 0;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 204, 0, 0.2); /* efek hover emas transparan */
            color: #ffcc00;
        }

        .sidebar .nav-link.active {
            background-color: #ffcc00;
            color: #000 !important;
            font-weight: bold;
        }

        .content {
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

       /* === Navbar === */
        .navbar-custom {
            background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
            padding: 10px 20px;
        }

        .navbar-custom .navbar-brand {
            color: #fff !important;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .navbar-custom .navbar-brand:hover {
            color: #ffcc00 !important;
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

        .logo-left {
            height: 40px;   /* sesuaikan ukuran logo */
            width: auto;
        }

    </style>

    @stack('styles')
</head>

<body>

     {{-- Navbar Full Width --}}
    @include('layouts.inc_dashboard.navbar')

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