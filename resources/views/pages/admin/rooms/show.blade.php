@extends('admin.layouts.app')

@section('title', 'Detail Kamar')

@section('content')
<div class="content" style="background:#fafafa; min-height:100vh; padding:40px 0;">
    <div class="container">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2"
             style="border-color:#d4af37 !important;">
            <h3 class="fw-bold text-uppercase" style="color:#d4af37;">
                🏨 Detail Kamar
            </h3>
            <a href="{{ route('rooms.index') }}" 
               class="btn btn-outline-dark rounded-pill px-4 fw-bold"
               style="border-color:#d4af37; color:#d4af37;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Card Utama -->
        <div class="card shadow border-0 rounded-4 overflow-hidden">
            <div class="row g-0">

                <!-- Gambar Slide -->
                <div class="col-lg-7">
                    @php
                        $images = [];

                        if ($room->images) {
                            $decoded = json_decode($room->images, true);
                            $images = is_array($decoded) ? $decoded : explode(',', $room->images);
                        }

                        if ($room->gambar_kasur) {
                            array_unshift($images, $room->gambar_kasur);
                        }

                        $images = array_filter(array_map('trim', $images));
                    @endphp

                    @if (!empty($images))
                        <div id="roomCarousel{{ $room->id }}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                            
                            <!-- Titik Carousel -->
                            <div class="carousel-indicators custom-indicators">
                                @foreach ($images as $index => $img)
                                    <button type="button" data-bs-target="#roomCarousel{{ $room->id }}" 
                                            data-bs-slide-to="{{ $index }}" 
                                            class="{{ $index == 0 ? 'active' : '' }}" 
                                            aria-current="{{ $index == 0 ? 'true' : 'false' }}" 
                                            aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>

                            <!-- Isi Carousel -->
                            <div class="carousel-inner" style="height:450px;">
                                @foreach ($images as $index => $img)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $img) }}" 
                                             class="d-block w-100" 
                                             style="object-fit:cover; height:450px;">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Tombol Navigasi -->
                            <button class="carousel-control-prev" type="button" 
                                    data-bs-target="#roomCarousel{{ $room->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
                            </button>
                            <button class="carousel-control-next" type="button" 
                                    data-bs-target="#roomCarousel{{ $room->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
                            </button>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light text-muted" 
                             style="height:450px;">
                            Tidak ada gambar
                        </div>
                    @endif
                </div>

                <!-- Detail Kamar -->
                <div class="col-lg-5 bg-white p-4 d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-2" style="color:#b8860b;">{{ $room->jenis_kamar }}</h4>
                        <p class="text-muted mb-2">No. Kamar: <strong>{{ $room->nomor_kamar }}</strong></p>
                        <p><strong>💰 Harga:</strong> Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }} / malam</p>
                        <p><strong>🛏️ Jumlah Kasur:</strong> {{ $room->jumlah_kasur }}</p>

                        <div class="mt-3">
                            <p class="fw-semibold mb-2"><i class="bi bi-star-fill text-warning"></i> Fasilitas:</p>
                            @foreach (explode(',', $room->fasilitas_kamar) as $fasilitas)
                                <span class="badge bg-light text-dark border border-warning me-1">
                                    {{ trim($fasilitas) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="mt-4">
                        <a href="{{ route('rooms.edit', $room->id) }}" 
                           class="btn text-white fw-bold rounded-pill px-4"
                           style="background:linear-gradient(135deg,#d4af37,#b8860b); border:none;">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Style -->
<style>
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-size: 50%, 50%;
}

/* Titik carousel seperti di halaman tamu */
.custom-indicators [data-bs-target] {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #fafaf9;
    opacity: 0.5;
    transition: all 0.3s ease;
}
.custom-indicators .active {
    background-color: #f1e6c7;
    opacity: 1;
    transform: scale(1.3);
}

/* Posisi indikator sedikit ke bawah gambar */
.custom-indicators {
    bottom: 15px;
}

/* Fasilitas badge */
.badge {
    background: #fff8dc !important;
}

/* Tombol navigasi bundar */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    filter: invert(1);
}
</style>
@endsection
