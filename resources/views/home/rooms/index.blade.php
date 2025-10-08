@extends('home.layouts.app')

@section('title', 'Our Rooms')

@section('content')
<div class="rooms-section py-5">
    <div class="container">
        <!-- Judul -->
        <h2 class="text-center mb-4 section-title">OUR ROOMS</h2>
        <p class="text-center text-muted">
            {{ $rooms->where('status', '!=', 'reserved')->count() }} 
            Rooms Available to Make Your Stay Memorable
        </p>

        <!-- Notifikasi kecil hasil filter -->
        @if(request('check_in') || request('check_out') || request('person'))
            <div class="alert alert-info alert-dismissible fade show text-center mb-4 small" role="alert">
                Menampilkan hasil untuk:
                @if(request('check_in')) <strong>Check-in:</strong> {{ request('check_in') }} @endif
                @if(request('check_out')) | <strong>Check-out:</strong> {{ request('check_out') }} @endif
                @if(request('person')) | <strong>Tamu:</strong> {{ request('person') }} orang @endif

                <!-- Tombol close -->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
            </div>
        @endif


        <div class="row">
            {{-- Sidebar Filter --}}
            <div class="col-md-3 mb-4">
                <div class="card p-3 shadow-sm sticky-top filter-card" style="top: 80px; z-index: 100;">
                    <h5 class="mb-3 text-primary">🔎 Filters</h5>
                    <form method="GET" action="{{ route('home.rooms.index') }}">
                        <div class="mb-3">
                            <label class="form-label">Check-in</label>
                            <input type="date" name="check_in" class="form-control" value="{{ request('check_in') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Check-out</label>
                            <input type="date" name="check_out" class="form-control" value="{{ request('check_out') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guests</label>
                            <input type="number" name="person" class="form-control" value="{{ request('person', 1) }}" min="1">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn filter-btn w-100">SEARCH</button>

                            {{-- Reset hanya muncul kalau ada filter --}}
                            @if(request('check_in') || request('check_out') || request('person'))
                                <a href="{{ route('home.rooms.index') }}" class="btn btn-outline-secondary w-50">Reset</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Room Grid --}}
            <div class="col-md-9">
                <div class="row">
                    @forelse ($rooms as $room)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm h-100 room-card border-0 overflow-hidden fade-in">
                                {{-- Gambar kamar --}}
                                <div class="position-relative">
                                    @if ($room->status === 'reserved')
                                        <span class="badge bg-danger position-absolute top-0 end-0 m-2 px-3 py-2 shadow">
                                            RESERVED
                                        </span>
                                    @endif

                                    @if ($room->gambar_kasur)
                                        <img src="{{ asset('storage/' . $room->gambar_kasur) }}" 
                                             class="card-img-top room-image" 
                                             alt="{{ $room->jenis_kamar }}">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" 
                                             class="card-img-top room-image" 
                                             alt="No Image">
                                    @endif

                                    {{-- Harga box di bawah gambar --}}
                                    @if (!empty($room->harga_per_malam))
                                        <span class="harga-box position-absolute bottom-0 start-0 m-3 px-3 py-2">
                                            Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }} / night
                                        </span>
                                    @endif
                                </div>

                                {{-- Detail kamar --}}
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">{{ $room->jenis_kamar }}</h5>
                                    <p class="mb-1"><strong>No:</strong> {{ $room->nomor_kamar }}</p>
                                    <p class="mb-1"><strong>Beds:</strong> {{ $room->jumlah_kasur }}</p>

                                    {{-- Fasilitas sebagai badge --}}
                                    <div class="mb-3">
                                        @foreach (explode(',', $room->fasilitas_kamar ?? '-') as $fasilitas)
                                            <span class="badge fasilitas-badge">
                                                @if (stripos($fasilitas, 'kasur') !== false) 🛏
                                                @elseif (stripos($fasilitas, 'tv') !== false) 📺
                                                @elseif (stripos($fasilitas, 'ac') !== false) ❄️
                                                @elseif (stripos($fasilitas, 'shower') !== false) 🚿
                                                @elseif (stripos($fasilitas, 'wifi') !== false) 📶
                                                @else ⭐
                                                @endif
                                                {{ trim($fasilitas) }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <div class="mt-auto d-flex gap-2">
                                        @if ($room->status === 'reserved')
                                            <button class="btn btn-secondary w-50 py-2 rounded-pill" disabled>
                                                Not Available
                                            </button>
                                        @else
                                            <a href="{{ route('home.reservations.create', ['room_id' => $room->id]) }}" 
                                               class="btn btn-dark w-50 py-2 rounded-pill">
                                                Book
                                            </a>
                                        @endif
                                        
                                        {{-- Detail kamar --}}
                                        <a href="{{ route('home.rooms.show', $room->id) }}" 
                                           class="btn btn-detail w-50">
                                            <i class="bi bi-info-circle"></i> Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted text-center">No rooms available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CSS --}}
<style>
    :root {
        --primary: #2f3e46;  /* warna utama admin */
        --accent: #c8a97e;   /* warna soft gold admin */
    }

    /* Background */
    .rooms-section {
        background: linear-gradient(135deg, #fdfcf9, #f7f5f0, #ffffff);
        position: relative;
        min-height: 100vh;
    }

    /* Room card */
    .room-card {
        border-radius: 15px;
        transition: 0.3s;
    }
    .room-card:hover .room-image {
        transform: scale(1.05);
    }
    .room-card:hover {
        box-shadow: 0 6px 20px rgba(47, 62, 70, 0.25);
    }
    .room-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: 0.4s ease;
    }

    .badge.bg-danger {
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        font-weight: bold;
        font-size: 0.85rem;
        border-radius: 20px;
    }

    /* Harga box */
    .harga-box {
        background: var(--primary);
        color: #fff;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 8px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.3);
    }

    /* Fasilitas badge */
    .fasilitas-badge {
        background: #f8f1e9;
        border: 1px solid var(--accent);
        color: var(--primary);
        font-size: 0.8rem;
        border-radius: 30px;
        padding: 5px 12px;
        margin: 2px;
        font-weight: 500;
    }

    /* Tombol */
    .btn-book {
        background: var(--primary);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 50px;
        transition: 0.3s;
    }
    .btn-book:hover {
        background: #1f2a30;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(47, 62, 70, 0.4);
    }
    .btn-detail {
        border: 2px solid var(--accent);
        color: var(--accent);
        border-radius: 50px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-detail:hover {
        background: var(--accent);
        color: #fff;
    }

    /* Filter */
    .filter-card {
        border-radius: 15px;
        background: #fff;
    }
    .filter-btn {
        background: var(--primary);
        color: #fff;
        font-weight: 600;
        border-radius: 50px;
        transition: 0.3s;
    }
    .filter-btn:hover {
        background: #1f2a30;
        transform: translateY(-2px);
    }

    /* Reset button */
    .btn-outline-secondary {
        border-radius: 50px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-outline-secondary:hover {
        background: #e0e0e0;
        color: var(--primary);
    }

    /* Judul */
    .section-title {
        color: var(--primary);
        font-weight: 700;
    }

    /* Animasi Fade-in */
    .fade-in {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
</style>

{{-- Script animasi scroll --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cards = document.querySelectorAll('.fade-in');
        function checkVisible() {
            const triggerBottom = window.innerHeight * 0.9;
            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                if (cardTop < triggerBottom) {
                    card.classList.add('visible');
                }
            });
        }
        window.addEventListener('scroll', checkVisible);
        checkVisible();
    });
</script>
@endsection

