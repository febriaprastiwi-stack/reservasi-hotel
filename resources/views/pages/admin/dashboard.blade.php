@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - Grand Royal Hotel')

@section('content')
    <div class="content-wrapper text-center fade-in">
        <h1 class="mb-3 fw-bold">Selamat Datang di Dashboard Admin - Grand Royal Hotel</h1>
        <p class="text-muted fs-5">Gunakan menu sidebar untuk mengelola data kamar dan fasilitas.</p>

        <!-- Cards -->
        <div class="container mt-4">
            <div class="row justify-content-center g-4">
                <!-- Card Kamar -->
                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <h5 class="card-title mb-3">Kamar</h5>
                            <p class="card-text">Kelola data kamar hotel.</p>
                            <a href="{{ route('rooms.index') }}" class="btn btn-primary mt-auto">Kelola Kamar</a>
                        </div>
                    </div>
                </div>

                <!-- Card Fasilitas -->
                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <h5 class="card-title mb-3">Fasilitas</h5>
                            <p class="card-text">Kelola fasilitas hotel.</p>
                            <a href="{{ route('fasilitas.index') }}" class="btn btn-success mt-auto">Kelola Fasilitas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .content-wrapper {
            margin-left: 250px; /* geser konten biar gak ketutup sidebar */
            margin-top: 70px;   /* jarak aman dari navbar */
            padding: 20px;
        }

        /* Animasi fade-in */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsif */
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0;
                margin-top: 70px;
            }
        }
    </style>
@endsection