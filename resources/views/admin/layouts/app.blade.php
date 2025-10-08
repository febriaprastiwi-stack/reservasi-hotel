<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin - Grand Royal Hotel' }}</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body {
            background: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 220px;
            /* lebar sidebar */
            background: #222;
            color: #fff;
            z-index: 1020;
        }

        /* Navbar */
        .navbar-custom {
            position: fixed;
            top: 0;
            left: 220px;
            /* sejajar setelah sidebar */
            right: 0;
            z-index: 1030;
        }

        /* Konten utama */
        .content-wrapper {
            margin-left: 220px;
            /* agar tidak ketimpa sidebar */
            margin-top: 70px;
            /* agar tidak ketimpa navbar */
            padding: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .navbar-custom {
                left: 0;
            }

            /* Tabel responsif */
            .table td,
            .table th {
                vertical-align: middle;
                /* sejajarkan isi tabel di tengah vertikal */
            }

            .table .text-center {
                text-align: center;
            }
        }
    </style>

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="layout-wrapper layout-content-navbar d-flex flex-grow-1">
        {{-- Sidebar --}}
        @include('admin.layouts.sidebar')

        <div class="flex-grow-1 d-flex flex-column">
            {{-- Navbar --}}
            @include('admin.layouts.navbar')

            {{-- Konten --}}
            <main class="flex-grow-1 p-4">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('admin.layouts.footer')
        </div>
    </div>
@stack('scripts')
</body>

</html>
