<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome - Grand Royal Hotel</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@300;400;600&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Lato', sans-serif;
      background-color: #0d0d0d;
      color: #fff;
    }

    .navbar {
      background: rgba(0, 0, 0, 0.65) !important;
      backdrop-filter: blur(8px);
      padding: 15px 30px;
    }

    .navbar-brand {
      font-family: 'Playfair Display', serif;
      font-size: 1.7rem;
      color: #d4af37 !important;
      letter-spacing: 2px;
    }

    .nav-link {
      color: #fff !important;
      margin-left: 20px;
      position: relative;
      font-weight: 500;
    }

    .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -5px;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #f5d76e, #d4af37);
      transition: 0.4s;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    /* Hero Section */
    .hero-section {
      height: 100vh;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      overflow: hidden;
    }

    /* Layer untuk slideshow */
    .slideshow {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
    }

    .slide {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background-size: cover;
      background-position: center;
      opacity: 0;
      transition: opacity 1.5s ease-in-out;
    }

    .slide.active {
      opacity: 1;
    }

    /* Overlay gelap agar teks lebih jelas */
    .hero-section::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(15, 15, 15, 0.9));
      z-index: 1;
    }

    .hero-content {
      z-index: 2;
      position: relative;
    }

    .logo-wrapper {
      margin-bottom: 20px;
      animation: logoShine 3s linear infinite;
    }

    .logo-wrapper img {
      height: 80px;
      width: auto;
      display: inline-block;
    }

    .hero-content h1 {
      font-family: 'Playfair Display', serif;
      font-size: 4rem;
      font-weight: 700;
      color: #f5d76e;
      text-transform: uppercase;
      text-shadow: 0px 6px 20px rgba(0, 0, 0, 0.8);
    }

    .hero-content p {
      font-size: 1.3rem;
      margin-top: 15px;
      color: #ddd;
    }

    .btn-gold {
      display: inline-block;
      margin-top: 30px;
      padding: 14px 45px;
      border-radius: 50px;
      font-size: 1.1rem;
      font-weight: 600;
      text-transform: uppercase;
      color: #111;
      background: linear-gradient(45deg, #f5d76e, #d4af37);
      border: none;
      letter-spacing: 3px;
      box-shadow: 0 0 20px rgba(245, 215, 110, 0.6);
      transition: all 0.4s ease;
    }

    .btn-gold:hover {
      background: linear-gradient(45deg, #d4af37, #f5d76e);
      transform: scale(1.07);
      box-shadow: 0 0 30px rgba(245, 215, 110, 0.9);
    }

    @keyframes logoShine {
      0% { filter: drop-shadow(0 0 2px #f5d76e); }
      50% { filter: drop-shadow(0 0 8px #fff5c3); }
      100% { filter: drop-shadow(0 0 2px #f5d76e); }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">GRAND ROYAL HOTEL</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-white"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">LOGIN</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">DASHBOARD</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="hero-section">
    <!-- Slideshow Background -->
    <div class="slideshow" id="slideshow">
      <div class="slide active" style="background-image: url('{{ asset('img/hotel-bg.jpg') }}');"></div>
      <div class="slide" style="background-image: url('{{ asset('img/foto.jpg') }}');"></div>
      <div class="slide" style="background-image: url('{{ asset('img/foto2.jpg') }}');"></div>
      <div class="slide" style="background-image: url('{{ asset('img/foto5.jpg') }}');"></div>

    </div>

    <!-- Konten -->
    <div class="hero-content">
      <div class="logo-wrapper">
        <img src="{{ asset('img/logo.jpg') }}" alt="Hotel Logo">
      </div>
      <h1>Grand Royal Hotel</h1>
      <p>Experience The Pinnacle of Luxury & Comfort</p>
      <a href="{{ route('home.rooms.index') }}" class="btn btn-gold">Explore Now</a>
    </div>
  </header>

  <script>
    const slides = document.querySelectorAll('.slide');
    let current = 0;

    function changeSlide() {
      slides[current].classList.remove('active');
      current = (current + 1) % slides.length;
      slides[current].classList.add('active');
    }

    setInterval(changeSlide, 3000); // ganti setiap 3 detik
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
