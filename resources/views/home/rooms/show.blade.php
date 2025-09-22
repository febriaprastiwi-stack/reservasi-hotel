@extends('home.layouts.app')

@section('title', 'Room Detail')

@section('content')
<div class="container my-5">
    <div class="row">
        {{-- Foto kamar --}}
        <div class="col-md-6">
            @if ($room->gambar_kasur)
                <img src="{{ asset('storage/' . $room->gambar_kasur) }}" 
                     class="img-fluid rounded shadow-sm mb-3" 
                     alt="{{ $room->jenis_kamar }}">
            @else
                <img src="{{ asset('images/no-image.png') }}" 
                     class="img-fluid rounded shadow-sm mb-3" 
                     alt="No Image">
            @endif
        </div>

        {{-- Detail kamar --}}
        <div class="col-md-6">
            <h2 class="mb-3">{{ $room->jenis_kamar }} ({{ $room->nomor_kamar }})</h2>
            
            <p><strong>Beds:</strong> {{ $room->jumlah_kasur }}</p>
            <p><strong>Fasilitas:</strong> {{ $room->fasilitas_kamar }}</p>
            <p class="mb-1"><strong>Fitur:</strong> {{ $room->features }}</p>
            
            {{-- Harga per malam --}}
            @if (!empty($room->harga_per_malam))
                <p><strong>Harga:</strong> Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }} / night</p>
            @endif

            <div class="mt-4 d-flex gap-3">
                {{-- Tombol pesan --}}
                <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}" 
                   class="btn btn-dark px-4">Book Now</a>
                
                {{-- Kembali ke daftar kamar --}}
                <a href="{{ route('home.rooms.index') }}" 
                   class="btn btn-outline-secondary px-4">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
