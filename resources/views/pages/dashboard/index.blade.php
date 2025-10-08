@extends('layouts.app')

@section('title', 'Dashboard - Grand Royal Hotel')

@section('content')
<div class="content-wrapper fade-in">
    <div class="text-center mb-5">
        <h1 class="mb-3 fw-bold text-gold">Selamat Datang di Dashboard Khusus Admin & Resepsionis</h1>
        <p class="text-muted fs-5">Kelola data reservasi dan pendapatan dengan mudah dan efisien.</p>
    </div>

    <!-- Cards -->
    <div class="container mt-4">
        <div class="row justify-content-center g-4">
            
            <!-- Card Reservasi -->
            <div class="col-md-4 col-sm-6">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-house-door-fill"></i>
                        </div>
                        <h5 class="card-title mb-2">Reservations</h5>
                        <p class="card-text">Kelola data reservasi hotel dengan mudah.</p>
                        <a href="{{ route('reservations.index') }}" class="btn btn-main mt-auto">Kelola Reservasi</a>
                    </div>
                </div>
            </div>

            <!-- Card Pendapatan -->
            <div class="col-md-4 col-sm-6">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <h5 class="card-title mb-2">Pendapatan</h5>
                        <p class="card-text">Kelola pendapatan hotel secara profesional.</p>
                        <a href="{{ route('pendapatan.index') }}" class="btn btn-main mt-auto">Lihat Pendapatan</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Wrapper dan background putih */
    .content-wrapper {
        margin-left: 0px;
        margin-top: 80px;
        padding: 50px;

        
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

    /* Warna gold hanya untuk judul */
    .text-gold {
        color: #30a192;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.15);
    }

    /* Card dashboard */
    .dashboard-card {
        background: #fff;
        border-radius: 15px;
        padding: 20px;
        border: 1px solid rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    /* Icon dalam kartu */
    .dashboard-card .icon-wrapper {
        font-size: 3rem;
        color: #004d4d; /* warna sesuai navbar/sidebar */
    }

    /* Button warna sesuai sidebar */
    .btn-main {
        background-color: #004d4d;
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .btn-main:hover {
        background-color: #006666;
        color: #fff;
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
