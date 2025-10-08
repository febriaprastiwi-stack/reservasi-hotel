@extends('admin.layouts.app')

@section('title', 'Detail Fasilitas')

@section('content')
<div class="content" style="background-color: #f9f9f9; min-height: 100vh; padding:70px 0;">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-gradient-gold text-white rounded-top-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">Detail Fasilitas</h4>
                <a href="{{ route('fasilitas.index') }}" class="btn btn-light fw-bold px-3">Kembali</a>
            </div>

            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-5 text-center mb-4 mb-md-0">
                        @if ($fasilita->image)
                            <img src="{{ asset('storage/' . $fasilita->image) }}" alt="{{ $fasilita->nama }}" 
                                 class="img-fluid rounded-4 shadow-sm" style="max-height: 320px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="No Image" 
                                 class="img-fluid rounded-4 shadow-sm" style="max-height: 320px;">
                        @endif
                    </div>

                    <div class="col-md-7">
                        <h4 class="fw-bold text-dark">{{ $fasilita->nama }}</h4>
                        <hr>
                        <p class="text-secondary" style="font-size: 16px;">{{ $fasilita->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end bg-transparent border-0">
                <a href="{{ route('fasilitas.edit', $fasilita->id) }}" class="btn btn-gradient-gold fw-bold me-2 px-4">Edit</a>
                <form action="{{ route('fasilitas.destroy', $fasilita->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-gradient-dark fw-bold px-4">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-gold {
        background: linear-gradient(135deg, #d4af37, #b8860b);
    }
    .btn-gradient-gold {
        background: linear-gradient(135deg, #d4af37, #b8860b);
        color: #fff;
        border: none;
        border-radius: 10px;
        transition: 0.3s;
    }
    .btn-gradient-gold:hover {
        background: linear-gradient(135deg, #b8860b, #d4af37);
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(212,175,55,0.4);
    }
    .btn-gradient-dark {
        background: linear-gradient(135deg, #555, #333);
        color: #fff;
        border: none;
        border-radius: 10px;
        transition: 0.3s;
    }
    .btn-gradient-dark:hover {
        background: linear-gradient(135deg, #333, #555);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }
</style>
@endsection
