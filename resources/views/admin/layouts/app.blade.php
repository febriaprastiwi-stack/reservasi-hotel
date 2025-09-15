<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin - Grand Royal Hotel' }}</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            width: 250px;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            border-radius: 5px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff !important;
        }
    </style>
</head>

<body>
    <div class="d-flex">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
