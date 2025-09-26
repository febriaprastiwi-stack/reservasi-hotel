@extends('admin.layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="content" style="background:#f9f9f9; min-height:100vh; padding:40px 0;">
    <div class="container">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2"
             style="border-color:#d4af37 !important;">
            <h3 class="fw-bold" style="color:#d4af37;">
                 Tambah Kamar Baru
            </h3>
            <a href="{{ route('rooms.index') }}" 
               class="btn btn-outline-dark rounded-pill px-4 fw-bold"
               style="border-color:#d4af37; color:#d4af37;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Card Form -->
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header text-white fw-bold fs-5"
                 style="background: linear-gradient(135deg, #d4af37, #f5e79e);">
                Form Tambah Kamar
            </div>
            <div class="card-body p-4">

                <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nomor Kamar -->
                    <div class="mb-3">
                        <label class="fw-bold">Nomor Kamar</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-door-closed"></i></span>
                            <input type="text" name="nomor_kamar" class="form-control" required>
                        </div>
                    </div>

                    <!-- Jenis Kamar -->
                    <div class="mb-3">
                        <label class="fw-bold">Jenis Kamar</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                            <input type="text" name="jenis_kamar" class="form-control" required>
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div class="mb-3">
                        <label class="fw-bold">Fasilitas</label>
                        <textarea name="fasilitas_kamar" rows="3" class="form-control"></textarea>
                    </div>

                    <!-- Jumlah Kasur -->
                    <div class="mb-3">
                        <label class="fw-bold">Jumlah Kasur</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-hospital"></i></span>
                            <input type="number" name="jumlah_kasur" class="form-control" min="1" required>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label class="fw-bold">Harga per Malam</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-cash-stack"></i></span>
                            <input type="number" name="harga_per_malam" class="form-control" min="0" step="1000" required>
                        </div>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label class="fw-bold">Gambar Kasur</label>
                        <input type="file" name="gambar_kasur" class="form-control">
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex gap-3 mt-4">
                        <button class="btn rounded-pill px-4 fw-bold text-white"
                                style="background:#d4af37; border:none;">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                        <a href="{{ route('rooms.index') }}" 
                           class="btn btn-secondary rounded-pill px-4 fw-bold">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
