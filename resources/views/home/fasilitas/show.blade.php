@extends('home.layouts.app')

@section('title', 'Facility Detail')

@section('content')
<div class="facility-detail py-5">
    <div class="container">
        <div class="row g-4 align-items-start">
            {{-- Foto fasilitas --}}
            <div class="col-md-6">
                <div class="image-wrapper shadow-lg rounded-4 overflow-hidden">
                    @if ($fasilitas->image)
                        <img src="{{ asset('storage/' . $fasilitas->image) }}" 
                             class="img-fluid w-100 h-100 object-fit-cover" 
                             alt="{{ $fasilitas->nama }}">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" 
                             class="img-fluid w-100 h-100 object-fit-cover" 
                             alt="No Image">
                    @endif
                </div>
            </div>

            {{-- Detail fasilitas --}}
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4 p-4 detail-card">
                    <h2 class="fw-bold mb-2 text-primary-emphasis">
                        {{ $fasilitas->nama }}
                    </h2>

                    {{-- Deskripsi singkat --}}
                    <p class="text-secondary mb-3">
                        <i class="bi bi-info-circle"></i> 
                        <strong>Deskripsi:</strong> {{ $fasilitas->deskripsi ?? 'Deskripsi fasilitas belum tersedia.' }}
                    </p>

                    {{-- Kategori fasilitas (opsional jika ada kolom kategori) --}}
                    @if (!empty($fasilitas->kategori))
                        <p class="text-secondary mb-3">
                            <i class="bi bi-tags"></i> 
                            <strong>Kategori:</strong> {{ $fasilitas->kategori }}
                        </p>
                    @endif

                    {{-- Tombol Aksi --}}
                    <div class="mt-4 d-flex gap-3">
                        {{-- Tombol kembali --}}
                        <a href="{{ route('home.fasilitas.index') }}" 
                           class="btn btn-outline-secondary px-4 py-2 rounded-pill">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>

                        {{-- Tombol lihat kamar (opsional) --}}
                        <a href="{{ route('home.rooms.index') }}" 
                           class="btn btn-book px-4 py-2 rounded-pill">
                            <i class="bi bi-building"></i> View Rooms
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom Style --}}
<style>
    .facility-detail {
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