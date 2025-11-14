@extends('admin.layouts.app')

@section('title', 'Data Kamar')

@section('content')
<div class="content" style="background:#f9f9f9; min-height:100vh; padding:50px 0;">
    <div class="container">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-bold" style="color:#b8860b; text-shadow:0 1px 3px rgba(0,0,0,0.1);">
                🛏 Daftar Kamar Hotel
            </h2>
            <div class="d-flex gap-2">
                <button id="selectModeBtn" class="btn btn-outline-dark rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-check2-square"></i> Mode Seleksi
                </button>
                <form id="bulkDeleteForm" action="{{ route('rooms.bulkDelete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="ids" id="selectedRooms">
                    <button type="button" id="deleteSelectedBtn" 
                            class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm text-white" 
                            style="display:none;">
                        <i class="bi bi-trash3"></i> Hapus Terpilih
                    </button>
                </form>

                <a href="{{ route('rooms.create') }}" 
                   class="btn rounded-pill fw-bold text-white px-4 shadow tambah-btn">
                    <i class="bi bi-plus-circle"></i> Tambah Kamar
                </a>
            </div>
        </div>

        <!-- Grid Kamar -->
        <div class="row g-4">
            @forelse($rooms as $room)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 position-relative room-card">
                    
                    <!-- Checkbox Seleksi -->
                    <input type="checkbox" class="form-check-input position-absolute room-checkbox" 
                           value="{{ $room->id }}" 
                           style="top:15px; right:15px; transform:scale(1.3); display:none; z-index:10;">

                    <!-- Gambar / Carousel -->
                    <div class="position-relative">
                        @php
                            $images = $room->images ? json_decode($room->images, true) : [];
                            if ($room->gambar_kasur) {
                                array_unshift($images, $room->gambar_kasur);
                            }
                        @endphp

                        @if (!empty($images))
                            <div id="carouselRoom{{ $room->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach ($images as $index => $img)
                                        <button type="button" data-bs-target="#carouselRoom{{ $room->id }}" 
                                                data-bs-slide-to="{{ $index }}" 
                                                class="{{ $index == 0 ? 'active' : '' }}" 
                                                aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>

                                <div class="carousel-inner" style="height:220px;">
                                    @foreach ($images as $index => $img)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $img) }}" 
                                                class="d-block w-100" 
                                                style="height:220px; object-fit:cover;">
                                        </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselRoom{{ $room->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselRoom{{ $room->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @elseif ($room->gambar_kasur)
                            <img src="{{ asset('storage/' . $room->gambar_kasur) }}" 
                                 class="card-img-top" 
                                 style="height:220px; object-fit:cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light text-muted"
                                 style="height:220px;">
                                No Image
                            </div>
                        @endif

                        <div class="harga-box position-absolute bottom-0 start-0 m-3 px-3 py-2 shadow">
                            <span class="fw-bold">Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }}</span><br>
                            <small class="text-white-50">/ malam</small>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold text-dark mb-1">{{ $room->jenis_kamar }}</h5>
                        <p class="text-muted small mb-2">No. Kamar: <span class="fw-bold">{{ $room->nomor_kamar }}</span></p>
                        
                        <!-- Fasilitas -->
                        <div class="mb-3">
                            @foreach(explode(',', $room->fasilitas_kamar) as $fasilitas)
                                <span class="badge fasilitas-badge">{{ trim($fasilitas) }}</span>
                            @endforeach
                        </div>

                        <p class="small text-secondary mb-4">
                            <i class="bi bi-hospital"></i> Kasur: {{ $room->jumlah_kasur }}
                        </p>

                        <!-- Tombol -->
                        <div class="mt-auto d-flex justify-content-between gap-2">
                            <a href="{{ route('rooms.show', $room->id) }}" 
                               class="btn btn-detail btn-sm rounded-pill px-3 fw-semibold">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('rooms.edit', $room->id) }}" 
                               class="btn btn-edit btn-sm rounded-pill px-3 fw-semibold">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="delete-form m-0">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-delete btn-sm rounded-pill px-3 fw-semibold delete-btn">
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

<!-- 🔄 Spinner Loading -->
<div id="loadingSpinner">
    <div class="spinner-border text-warning" style="width:3rem; height:3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<!-- Custom Style -->
<style>
.room-card { background:#fff; border:1px solid rgba(212,175,55,0.2); transition:0.3s; }
.room-card:hover { transform:translateY(-5px); box-shadow:0 8px 20px rgba(212,175,55,0.3); }
.tambah-btn { background:linear-gradient(135deg,#d4af37,#b8860b); border:none; }
.tambah-btn:hover { background:linear-gradient(135deg,#e6c84f,#d4af37); transform:translateY(-2px); }
.harga-box { background:rgba(0,0,0,0.6); color:#fff; border-radius:10px; }
.fasilitas-badge { background:#f8f1d4; color:#b8860b; border:1px solid #e6c84f; margin:2px; }

/* 🎨 Tombol Aksi Baru */
.btn-detail {
    background:#fff;
    border:1.5px solid #d4af37;
    color:#b8860b;
    box-shadow:0 2px 5px rgba(212,175,55,0.2);
    transition:all .25s ease;
}
.btn-detail:hover {
    background:#d4af37;
    color:#fff;
    transform:translateY(-2px);
}

.btn-edit {
    background:linear-gradient(135deg,#d4af37,#b8860b);
    color:#fff;
    border:none;
    box-shadow:0 3px 8px rgba(212,175,55,0.3);
    transition:all .25s ease;
}
.btn-edit:hover {
    background:linear-gradient(135deg,#e6c84f,#d4af37);
    transform:translateY(-2px) scale(1.03);
}

.btn-delete {
    background:#2c2c2c;
    color:#fff;
    border:none;
    box-shadow:0 3px 8px rgba(0,0,0,0.3);
    transition:all .25s ease;
}
.btn-delete:hover {
    background:#c0392b;
    box-shadow:0 4px 10px rgba(192,57,43,0.4);
    transform:translateY(-2px) scale(1.03);
}

/* 🔘 Indikator jadi titik */
.carousel-indicators { bottom: 5px; }
.carousel-indicators [data-bs-target] {
    width: 7px; height: 7px; border-radius:50%;
    background-color:#fdfdfb; opacity:0.5; transition:all 0.3s ease;
}
.carousel-indicators .active {
    opacity:1; background-color:#f1eddd;
}

/* 🔄 Spinner Loading */
#loadingSpinner {
    position:fixed; top:0; left:0; right:0; bottom:0;
    background:rgba(255,255,255,0.8);
    display:none; justify-content:center; align-items:center;
    z-index:9999;
}
</style>
@endsection
