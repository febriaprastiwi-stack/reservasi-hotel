<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Grand Royal Hotel</title>

    <style>
        /* Mengimpor font dari Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap');

        .hero-section {
            height: 100vh;
            background-image: url("{{ asset('img/hotel-bg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            /* Overlay gelap untuk readability */
        }

        .hero-content {
            z-index: 1;
            padding: 20px;
        }

        body {
            padding-top: 56px;
            /* Tinggi default navbar */
        }

        /* CSS untuk font judul utama */
        .main-heading-font {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        {{-- Ubah href="#" menjadi route('login') --}}
                        <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        {{-- Tambahkan rute untuk register jika ada --}}
                        <a class="nav-link" href="{{ route('register') }}">REGISTER</a>
                    </li>
                    <li class="nav-item">
                        {{-- Tautan untuk dashboard setelah login --}}
                        <a class="nav-link" href="{{ route('dashboard') }}">DASHBOARD</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="hero-content">
            <a href="#" class="btn btn-lg btn-primary mb-5" style="letter-spacing: 5px;">HOME</a>

            <h1 class="display-4 main-heading-font">Welcome to Grand Royal Hotel</h1>
            <p class="lead">Enjoy The Experience of Comfort & Luxury</p>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
