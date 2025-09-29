@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - Grand Royal Hotel')

@section('content')
<div class="content-wrapper fade-in">
    <div class="text-center mb-5">
        <h1 class="mb-3 fw-bold text-gold">Selamat Datang di Dashboard Admin</h1>
        <p class="text-muted fs-5">Kelola data kamar dan fasilitas hotel dengan mudah dan efisien.</p>
    </div>

    <!-- Cards -->
    <div class="container mt-4">
        <div class="row justify-content-center g-4">
            
            <!-- Card Kamar -->
            <div class="col-md-4 col-sm-6">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-house-door-fill"></i>
                        </div>
                        <h5 class="card-title mb-2">Kamar</h5>
                        <p class="card-text">Kelola data kamar hotel dengan mudah.</p>
                        <a href="{{ route('rooms.index') }}" class="btn btn-gold mt-auto">Kelola Kamar</a>
                    </div>
                </div>
            </div>

            <!-- Card Fasilitas -->
            <div class="col-md-4 col-sm-6">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-gem"></i>
                        </div>
                        <h5 class="card-title mb-2">Fasilitas</h5>
                        <p class="card-text">Kelola fasilitas hotel secara profesional.</p>
                        <a href="{{ route('fasilitas.index') }}" class="btn btn-gold mt-auto">Kelola Fasilitas</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Wrapper dan background putih */
    .content-wrapper {
        margin-left: 250px;
        margin-top: 70px;
        padding: 20px;
        min-height: calc(100vh - 70px);
        background-color: #ffffff;
        color: #1e1e2f;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Fade-in animasi */
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

    /* Typography dan warna gold */
    .text-gold {
        color: #d4af37;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.15);
    }

    /* Card dashboard dengan glassmorphism */
    .dashboard-card {
        background: rgba(255, 255, 255, 0.6); /* transparan */
        border-radius: 20px;
        padding: 20px;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(212, 175, 55, 0.3);
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }

    .dashboard-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .dashboard-card .icon-wrapper {
        font-size: 3rem;
        color: #d4af37;
    }

    .btn-gold {
        background-color: #d4af37;
        border: none;
        color: #1e1e2f;
        font-weight: bold;
        transition: all 0.3s;
    }

    .btn-gold:hover {
        background-color: #e6c55f;
        color: #1e1e2f;
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
