@extends('layouts.app')

@section('title', 'Ketersediaan Kamar')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Ketersediaan Kamar</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($rooms as $room)
            <div class="bg-white p-4 rounded shadow">
                <img src="{{ asset('storage/' . $room->gambar_kasur) }}" alt="Gambar Kamar"
                    class="w-full h-48 object-cover mb-4 rounded">
                <h2 class="text-xl font-semibold mb-2">Kamar {{ $room->nomor_kamar }} - {{ $room->tipe_kamar }}</h2>
                <p class="mb-2">Harga: Rp {{ number_format($room->harga, 0, ',', '.') }} per malam</p>
                <p class="mb-4">Status:
                    @if ($room->status === 'available')
                        <span class="text-green-600 font-semibold">Tersedia</span>
                    @else
                        <span class="text-red-600 font-semibold">Tidak Tersedia</span>
                    @endif
                </p>
                @if ($room->status === 'available')
                    <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Pesan Sekarang</a>
                @else
                    <button class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed" disabled>Pesan
                        Sekarang</button>
                @endif
            </div>
        @endforeach
    </div>
@endsection
Compare this snippet from resources/views/hotel/hotel.blade.php:
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero {
            background: url('{{ asset('img/hotel-bg.jpg') }}') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            position: relative;
        }

        .hero::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .gallery img {
            border-radius: 10px;
            transition: 0.3s;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Star Hotel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#rooms">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#facilities">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="hero">
        <div class="hero-content">
            <h1>Welcome to Star Hotel</h1>
            <p>Your comfort is our priority</p>
            <a href="#rooms" class="btn btn-primary btn-lg">Explore Rooms</a>
        </div>
    </div>
    <div class="container my-5" id="rooms">
        <h2 class="text-center mb-4">Our Rooms</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('img/room1.jpg') }}" class="card-img-top" alt="Room 1">
                    <div class="card-body">
                        <h5 class="card-title">Deluxe Room</h5>
                        <p class="card-text">A spacious room with a king-size bed, ensuite bathroom, and city view.</p>
                        <p class="card-text"><strong>Price:</strong> $150/night</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('img/room2.jpg') }}" class="card-img-top" alt="Room 2">
                    <div class="card-body">
                        <h5 class="card-title">Standard Room</h5>
                        <p class="card-text">Comfortable room with a queen-size bed and modern amenities.</p>
                        <p class="card-text"><strong>Price:</strong> $100/night</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('img/room3.jpg') }}" class="card-img-top" alt="Room 3">
                    <div class="card-body">
                        <h5 class="card-title">Suite</h5>
                        <p class="card-text">Luxurious suite with separate living area, kitchenette, and balcony.</p>
                        <p class="card-text"><strong>Price:</strong> $250/night</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5" id="facilities">
        <h2 class="text-center mb-4">Our Facilities</h2>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <i class="fa fa-swimming-pool fa-3x mb-3"></i>
                <h5>Swimming Pool</h5>
                <p>Enjoy our outdoor swimming pool with a beautiful view.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fa fa-dumbbell fa-3x mb-3"></i>
                <h5>Fitness Center</h5>
                <p>Stay fit during your stay with our state-of-the-art fitness center.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fa fa-spa fa-3x mb-3"></i>
                <h5>Spa</h5>
                <p>Relax and rejuvenate with our luxurious spa services.</p>
            </div>
        </div>
    </div>
</body>

</html>
