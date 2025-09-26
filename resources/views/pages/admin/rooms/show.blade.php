@extends('admin.layouts.app')

@section('title', 'Detail Kamar')

@section('content')
<div class="content" style="background: #fdfdfd; min-height: 100vh; padding: 40px 0;">
    <div class="container">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2"
             style="border-color: #d4af37 !important;">
            <h3 class="fw-bold" style="color: #d4af37;">
                🛏️ Detail Kamar
            </h3>
            <a href="{{ route('rooms.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold"
               style="border-color: #d4af37; color: #d4af37;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Card Detail -->
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden"
             style="background: #ffffff; color: #333;">
            <div class="row g-0">

                <!-- Gambar Kamar -->
                <div class="col-md-6">
                    @if ($room->gambar_kasur)
                        <img src="{{ asset('storage/' . $room->gambar_kasur) }}" 
                             alt="{{ $room->jenis_kamar }}" 
                             class="img-fluid h-100 w-100"
                             style="object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 bg-light text-muted">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- Info Detail -->
                <div class="col-md-6 d-flex align-items-center">
                    <div class="card-body p-4">
                        <h2 class="fw-bold mb-3" style="color: #d4af37;">{{ $room->jenis_kamar }}</h2>
                        <h5 class="text-dark mb-3">No. Kamar: 
                            <span class="fw-bold">{{ $room->nomor_kamar }}</span>
                        </h5>

                        <p class="mb-2"><i class="bi bi-tv" style="color:#d4af37;"></i> <strong>Fasilitas:</strong> {{ $room->fasilitas_kamar }}</p>
                        <p class="mb-2"><i class="bi bi-hospital" style="color:#d4af37;"></i> <strong>Jumlah Kasur:</strong> {{ $room->jumlah_kasur }}</p>
                        <p class="mb-4 fs-5 fw-bold" style="color:#28a745;">
                            <i class="bi bi-cash-stack"></i> Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }} / Malam
                        </p>

                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('rooms.edit', $room->id) }}" 
                               class="btn rounded-pill px-4 fw-bold text-white"
                               style="background: #d4af37; border:none;">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin hapus kamar ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
