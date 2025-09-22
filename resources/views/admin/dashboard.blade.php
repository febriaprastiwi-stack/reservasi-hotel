@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - Grand Royal Hotel')

@section('content')
    <div class="content-wrapper d-flex flex-column align-items-center justify-content-center text-center fade-in"
        style="min-height: 70vh;">
        <div>
            <h1 class="mb-3 fw-bold">Selamat Datang di Dashboard Admin - Grand Royal Hotel</h1>
            <p class="text-muted fs-5">Gunakan menu sidebar untuk mengelola data kamar dan fasilitas.</p>
        </div>
    </div>

    <style>
        .content-wrapper {
            margin-left: 220px;
            /* agar tidak tertutup sidebar */
            margin-top: 70px;
            /* agar tidak ketimpa navbar */
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

        /* Responsif di mobile: sidebar otomatis ketutup */
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0;
                margin-top: 70px;
            }
        }
    </style>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Kamar</h5>
                    <p class="card-text">Kelola data kamar hotel.</p>
                    <a href="{{ route('rooms.index') }}" class="btn btn-primary">Kelola Kamar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Fasilitas</h5>
                    <p class="card-text">Kelola fasilitas hotel.</p>
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-success">Kelola Fasilitas</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
