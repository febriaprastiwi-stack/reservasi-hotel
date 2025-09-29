@extends('admin.layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')
<div class="content" style="background-color: #f9f9f9; min-height: 100vh; padding:70px 0;">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-gradient-gold text-white rounded-top-4">
                <h4 class="mb-0 fw-bold">Edit Fasilitas</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('fasilitas.update', $fasilita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="nama" class="form-control form-control-lg custom-input" 
                               value="{{ $fasilita->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control custom-input" rows="4">{{ $fasilita->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar</label>
                        <input type="file" name="image" class="form-control custom-input">
                        @if ($fasilita->image)
                            <div class="mt-3">
                                <p class="fw-semibold mb-2">Gambar Saat Ini:</p>
                                <img src="{{ asset('storage/' . $fasilita->image) }}" 
                                     width="150" class="rounded shadow-sm border">
                            </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('fasilitas.index') }}" class="btn btn-gradient-dark me-2 fw-bold px-4">Batal</a>
                        <button type="submit" class="btn btn-gradient-gold fw-bold px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-gold {
        background: linear-gradient(135deg, #d4af37, #b8860b);
    }
    .custom-input {
        border-radius: 12px;
        border: 1px solid #ddd;
        transition: 0.3s ease;
    }
    .custom-input:focus {
        border-color: #d4af37;
        box-shadow: 0 0 8px rgba(212, 175, 55, 0.3);
    }
    .btn-gradient-gold {
        background: linear-gradient(135deg, #d4af37, #b8860b);
        color: #fff;
        border: none;
        transition: 0.3s;
    }
    .btn-gradient-gold:hover {
        background: linear-gradient(135deg, #b8860b, #d4af37);
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
    }
    .btn-gradient-dark {
        background: linear-gradient(135deg, #555, #333);
        color: #fff;
        border: none;
        transition: 0.3s;
    }
    .btn-gradient-dark:hover {
        background: linear-gradient(135deg, #333, #555);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }
</style>
@endsection
