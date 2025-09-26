@extends('admin.layouts.app')

@section('title', 'Data Kamar')

@section('content')
<div class="content" style="background:#fff; min-height:100vh; padding:50px 0;">
    <div class="container">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-bold" style="color:#b8860b; text-shadow:0 1px 3px rgba(0,0,0,0.1);">
                ✨ Daftar Kamar Hotel
            </h2>
            <a href="{{ route('rooms.create') }}" 
               class="btn rounded-pill fw-bold text-white px-4 shadow tambah-btn">
                <i class="bi bi-plus-circle"></i> Tambah Kamar
            </a>
        </div>

        <!-- Grid Kamar -->
        <div class="row g-4">
            @forelse($rooms as $room)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100"
                     style="background:#fff;">

                    <!-- Gambar -->
                    <div class="position-relative">
                        @if ($room->gambar_kasur)
                            <img src="{{ asset('storage/' . $room->gambar_kasur) }}" 
                                 class="card-img-top" 
                                 style="height:220px; object-fit:cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light text-muted"
                                 style="height:220px;">
                                No Image
                            </div>
                        @endif
                        <span class="badge position-absolute top-0 end-0 m-2 px-3 py-2 shadow-sm harga-badge">
                            Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Body -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold text-dark mb-2">{{ $room->jenis_kamar }}</h5>
                        <p class="text-muted mb-2">No. Kamar: <span class="fw-bold">{{ $room->nomor_kamar }}</span></p>
                        <p class="small text-secondary mb-2">
                            <i class="bi bi-star-fill text-warning"></i> Fasilitas: {{ Str::limit($room->fasilitas_kamar, 50) }}
                        </p>
                        <p class="small text-secondary mb-4">
                            <i class="bi bi-hospital"></i> Kasur: {{ $room->jumlah_kasur }}
                        </p>

                        <!-- Tombol -->
                        <div class="mt-auto d-flex justify-content-between gap-2">
                            <a href="{{ route('rooms.show', $room->id) }}" 
                               class="btn btn-outline-dark btn-sm rounded-pill px-3 detail-btn">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('rooms.edit', $room->id) }}" 
                               class="btn btn-sm rounded-pill px-3 text-white edit-btn">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin hapus kamar ini?')" class="m-0">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm rounded-pill px-3 text-white hapus-btn">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="fs-5 text-muted">Belum ada data kamar tersedia</p>
            </div>
            @endforelse
        </div>

    </div>
</div>

<!-- Custom Style -->
<style>
    /* Tombol Tambah */
    .tambah-btn {
        background: linear-gradient(135deg, #d4af37, #b8860b);
        border: none;
        transition: 0.3s;
    }
    .tambah-btn:hover {
        background: linear-gradient(135deg, #e6c84f, #d4af37);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.4);
    }

    /* Badge Harga */
    .harga-badge {
        background: linear-gradient(135deg,#d4af37,#b8860b);
        color:#fff; 
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Detail Button */
    .detail-btn {
        border-color:#d4af37; 
        color:#b8860b;
        transition: 0.3s;
    }
    .detail-btn:hover {
        background:#d4af37;
        color:#fff;
    }

    /* Edit Button */
    .edit-btn {
        background: linear-gradient(135deg, #d4af37, #b8860b); 
        border:none;
        transition: 0.3s;
    }
    .edit-btn:hover {
        background: linear-gradient(135deg, #e6c84f, #d4af37);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(212, 175, 55, 0.4);
    }

    /* Hapus Button */
    .hapus-btn {
        background:#444; 
        border:none;
        transition: 0.3s;
    }
    .hapus-btn:hover {
        background:#c0392b;
        transform: scale(1.05);
    }
</style>
@endsection
