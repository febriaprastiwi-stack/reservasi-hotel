@extends('admin.layouts.app')

@section('title', 'Data Fasilitas')

@section('content')

<div class="content" style="background-color: #f9f9f9; min-height: 100vh; padding:50px 0;">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold" style="color: #333;">
                <i class="bi bi-building-check me-2"></i> Daftar Fasilitas Hotel
            </h3>
            <a href="{{ route('fasilitas.create') }}" 
               class="btn btn-gold fw-bold shadow-sm">
               + Tambah Fasilitas
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse($fasilitas as $item)
                <div class="col-md-3 mb-4">
                    <div class="card card-fasilitas h-100 rounded-4 overflow-hidden position-relative">
                        
                        {{-- Tombol Edit & Hapus (floating di pojok kanan atas) --}}
                        <div class="action-buttons">
                            <a href="{{ route('fasilitas.edit', $item->id) }}" 
                               class="btn btn-sm btn-edit-icon" 
                               data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-delete-icon" 
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        onclick="return confirm('Yakin hapus fasilitas ini?')">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Gambar fasilitas --}}
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $item->nama }}" 
                                 style="height: 180px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" 
                                 class="card-img-top" 
                                 alt="No Image" 
                                 style="height: 180px; object-fit: cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="fw-bold text-dark mb-2">{{ $item->nama }}</h5>
                            <p class="text-muted" style="font-size: 14px;">
                                {{ Str::limit($item->deskripsi, 60) }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted mt-5">
                    <p class="fw-bold">Belum ada data fasilitas</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    /* Card Fasilitas */
    .card-fasilitas {
        border: 1px solid #eee;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    .card-fasilitas:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    /* Tombol Floating */
    .action-buttons {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        gap: 6px;
    }
    .btn-edit-icon, .btn-delete-icon {
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        font-size: 14px;
        transition: 0.3s;
    }
    .btn-edit-icon {
        background-color: #d4af37;
        color: #fff;
    }
    .btn-edit-icon:hover {
        background-color: #bfa12f;
        transform: scale(1.1);
    }
    .btn-delete-icon {
        background-color: #555;
        color: #fff;
    }
    .btn-delete-icon:hover {
        background-color: #333;
        transform: scale(1.1);
    }

    /* Tombol Tambah */
    .btn-gold {
        background-color: #d4af37;
        border-radius: 25px;
        color: #fff;
        padding: 8px 20px;
        transition: 0.3s;
    }
    .btn-gold:hover {
        background-color: #bfa12f;
        color: #fff;
    }
</style>

{{-- Script tooltip --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

@endsection
