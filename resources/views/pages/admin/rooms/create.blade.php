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

                    <!-- Gambar Kasur -->
                    <div class="mb-3">
                        <label class="fw-bold">Gambar Kasur</label>
                        <input type="file" name="gambar_kasur" id="gambar_kasur" class="form-control" accept="image/*">
                        <div id="preview-gambar" class="mt-3"></div>
                    </div>

                    <!-- Foto Tambahan -->
                    <div class="mb-3">
                        <label for="images" class="form-label fw-bold">Foto Tambahan</label>
                        <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">Pilih beberapa gambar</small>
                        <div id="preview-images" class="d-flex flex-wrap gap-2 mt-3"></div>
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

{{-- Script Preview Gambar --}}
<script>
    // Preview untuk gambar kasur
    document.getElementById('gambar_kasur').addEventListener('change', function (event) {
        const preview = document.getElementById('preview-gambar');
        preview.innerHTML = '';
        const file = event.target.files[0];
        if (file) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.classList.add('img-fluid', 'rounded', 'shadow-sm');
            img.style.maxWidth = '300px';
            img.style.maxHeight = '200px';
            preview.appendChild(img);
        }
    });

    // Preview untuk banyak gambar tambahan
    document.getElementById('images').addEventListener('change', function (event) {
        const previewContainer = document.getElementById('preview-images');
        previewContainer.innerHTML = '';
        const files = event.target.files;
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('rounded', 'shadow-sm');
                img.style.width = '120px';
                img.style.height = '90px';
                img.style.objectFit = 'cover';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

<style>
    #preview-images img:hover {
        transform: scale(1.05);
        transition: 0.3s ease;
    }
</style>
@endsection
