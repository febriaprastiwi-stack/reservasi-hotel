@extends('home.layouts.app')

@section('title', 'Our Facilities')

@section('content')

<div class="rooms-section py-5">
    <div class="container">

        <!-- Tombol kembali -->
        <div class="mb-4">
            <a href="{{ route('home.rooms.index') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                ← Kembali ke Our Rooms
            </a>
        </div>

        <!-- Judul -->
        <h2 class="text-center mb-4 section-title">OUR FACILITIES</h2>
        <p class="text-center text-muted mb-5">
            Nikmati berbagai fasilitas terbaik yang kami sediakan untuk kenyamanan Anda
        </p>

        <div class="row">
            {{-- Fasilitas Grid --}}
            <div class="col-12">
                <div class="row">
                    @forelse ($fasilitas as $item)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card shadow-sm h-100 room-card border-0 overflow-hidden fade-in">
                                {{-- Gambar fasilitas --}}
                                <div class="position-relative">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" 
                                             class="card-img-top room-image" 
                                             alt="{{ $item->nama }}">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" 
                                             class="card-img-top room-image" 
                                             alt="No Image">
                                    @endif
                                </div>

                                {{-- Detail fasilitas --}}
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold text-dark">{{ $item->nama }}</h5>
                                    <p class="text-muted small mb-3">{{ Str::limit($item->deskripsi, 100) }}</p>

                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                        <span class="badge fasilitas-badge">
                                            ⭐ Fasilitas Unggulan
                                        </span>
                                        <a href="{{ route('home.fasilitas.show', $item->id) }}" 
                                           class="btn btn-outline-dark btn-sm rounded-pill px-3">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada fasilitas yang ditambahkan.</p>
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
        --primary: #2f3e46;
        --accent: #c8a97e;
    }

    .rooms-section {
        background: linear-gradient(135deg, #fdfcf9, #f7f5f0, #ffffff);
        min-height: 100vh;
    }

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
        height: 230px;
        object-fit: cover;
        transition: 0.4s ease;
    }

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

    .section-title {
        color: var(--primary);
        font-weight: 700;
    }

    /* Animasi Fade-in */
    .fade-in {
        opacity: 0;
        transform: translate(30px) scale(0.95);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    .fade-in.visible {
        opacity: 1;
        transform: translate(0) scale(1);
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