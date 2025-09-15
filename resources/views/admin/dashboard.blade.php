@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - Grand Royal Hotel')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-3">Selamat Datang di Dashboard Admin - Grand Royal Hotel</h1>
        <p class="text-muted">Gunakan menu sidebar untuk mengelola data kamar dan fasilitas.</p>

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
@endsection
