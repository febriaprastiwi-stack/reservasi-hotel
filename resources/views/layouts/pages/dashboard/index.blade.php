<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Royal Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- Navbar --}}
    @include('layouts.inc_dashboard.navbar')

    <div class="d-flex">
        {{-- Sidebar --}}
        @include('layouts.inc_dashboard.sidebar')

        {{-- Konten Utama --}}
        <div class="flex-grow-1 p-4">
            <h2>Selamat Datang di Grand Royal Hotel</h2>
            <p>Ini adalah halaman dashboard tanpa login.</p>
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.inc_dashboard.footer')

</body>

</html>
