@extends('home.layouts.app')

@section('title', 'Room Detail')

@section('content')
<div class="room-detail py-5">
    <div class="container">
        <div class="row g-4 align-items-start">
            {{-- Foto kamar --}}
            <div class="col-md-6">
                <div class="image-wrapper shadow-lg rounded-4 overflow-hidden">
                    @if ($room->gambar_kasur)
                        <img src="{{ asset('storage/' . $room->gambar_kasur) }}" 
                             class="img-fluid w-100 h-100 object-fit-cover" 
                             alt="{{ $room->jenis_kamar }}">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" 
                             class="img-fluid w-100 h-100 object-fit-cover" 
                             alt="No Image">
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
                        <a href="{{ route('home.reservations.create', ['room_id' => $room->id]) }}" 
                           class="btn btn-book px-4 py-2">
                            <i class="bi bi-calendar-check"></i> Book Now
                        </a>

                        {{-- Kembali ke daftar kamar --}}
                        <a href="{{ route('home.rooms.index') }}" 
                           class="btn btn-outline-secondary px-4 py-2 rounded-pill">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tambahan deskripsi panjang --}}
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
    .image-wrapper {
        height: 400px;
        border-radius: 20px;
    }
    .object-fit-cover {
        object-fit: cover;
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
