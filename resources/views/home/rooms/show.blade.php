@extends('home.layouts.app')

@section('title', 'Room Detail')

@section('content')
<div class="room-detail py-5">
    <div class="container">
        <div class="row g-4 align-items-start">
            {{-- Foto kamar --}}
            <div class="col-md-6">
                @php
                    $images = [];
                    if ($room->gambar_kasur) $images[] = $room->gambar_kasur;
                    if ($room->images) $images = array_merge($images, json_decode($room->images, true));
                @endphp

                <div id="carouselRoomDetail{{ $room->id }}" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
                    {{-- Indicator titik --}}
                    <div class="carousel-indicators">
                        @foreach ($images as $index => $img)
                            <button type="button" 
                                data-bs-target="#carouselRoomDetail{{ $room->id }}" 
                                data-bs-slide-to="{{ $index }}" 
                                class="{{ $index == 0 ? 'active' : '' }}" 
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>

                    {{-- Foto-foto kamar --}}
                    <div class="carousel-inner">
                        @forelse ($images as $index => $img)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $img) }}" 
                                     class="d-block w-100 room-image" 
                                     alt="Room Image">
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <img src="{{ asset('images/no-image.png') }}" 
                                     class="d-block w-100 room-image" 
                                     alt="No Image">
                            </div>
                        @endforelse
                    </div>

                    {{-- Tombol navigasi --}}
                    @if (count($images) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselRoomDetail{{ $room->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselRoomDetail{{ $room->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            </div>

            {{-- Detail kamar --}}
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4 p-4 detail-card">
                    <h2 class="fw-bold mb-2 text-primary-emphasis">
                        {{ $room->jenis_kamar }} <span class="text-muted">({{ $room->nomor_kamar }})</span>
                    </h2>

                    <p class="text-secondary mb-2">
                        <i class="bi bi-bed"></i> <strong>Beds:</strong> {{ $room->jumlah_kasur }}
                    </p>
                    <p class="text-secondary mb-2">
                        <i class="bi bi-star"></i> <strong>Fasilitas:</strong> {{ $room->fasilitas_kamar }}
                    </p>

                    {{-- Harga --}}
                    @if (!empty($room->harga_per_malam))
                        <div class="price-badge my-3 px-4 py-2">
                            💰 Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }} / night
                        </div>
                    @endif

                    <div class="mt-4 d-flex gap-3">
                        {{-- Tombol pesan --}}
                        @if ($room->status === 'reserved')
                            <button class="btn btn-secondary px-4 py-2 rounded-pill" disabled>
                                <i class="bi bi-lock-fill"></i> Not Available
                            </button>
                        @else
                            <a href="{{ route('home.reservations.create', ['room_id' => $room->id]) }}" 
                               class="btn btn-book px-4 py-2 rounded-pill">
                                <i class="bi bi-calendar-check"></i> Book Now
                            </a>
                        @endif

                        {{-- Kembali ke daftar kamar --}}
                        <a href="{{ route('home.rooms.index') }}" 
                           class="btn btn-outline-secondary px-4 py-2 rounded-pill">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-light">
                    <h4 class="fw-bold mb-3 text-primary-emphasis">Room Description</h4>
                    <p class="text-secondary">
                        {{ $room->deskripsi ?? 'This luxurious room offers a perfect blend of elegance, comfort, and modern facilities. Designed to provide an unforgettable stay experience for our guests.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom Style --}}
<style>
    .room-detail {
        background: linear-gradient(135deg, #fdfdfd, #f5f8f8);
        min-height: 100vh;
    }
    .room-image {
        height: 400px;
        object-fit: cover;
    }
    .carousel-indicators {
        bottom: 10px;
    }
    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.7);
        border: none;
        margin: 0 4px;
        transition: all 0.3s ease;
    }
    .carousel-indicators .active {
        background-color: #c8a97e;
        transform: scale(1.2);
    }
    .detail-card {
        background: #fff;
        border-radius: 20px;
    }
    .price-badge {
        background: linear-gradient(135deg, #d4af37, #c5a028);
        color: #fff;
        font-weight: 600;
        display: inline-block;
        border-radius: 50px;
        font-size: 1.1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .btn-book {
        background: linear-gradient(135deg, #136f70, #0d3b3d);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .btn-book:hover {
        background: linear-gradient(135deg, #0d3b3d, #136f70);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.25);
    }
</style>
@endsection
