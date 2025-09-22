<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Royal Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar-custom {
            background-color: #000;
            /* warna hitam */
        }

        .navbar-custom .nav-link {
            color: white;
            margin: 0 10px;
        }

        .navbar-custom .nav-link:hover {
            color: #0d6efd;
            /* warna biru saat hover */
        }

        .logo-center {
            height: 50px;
        }

        .table td,
        .table th {
            vertical-align: middle;
            /* biar angka sejajar tengah secara vertikal */
        }

        .table .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="d-flex">

        <div class="flex-grow-1 d-flex flex-column">
            {{-- Navbar --}}
            @include('home.layouts.navbar')

            {{-- Konten --}}
            <main class="flex-grow-1 p-4">
                @yield('content')
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
