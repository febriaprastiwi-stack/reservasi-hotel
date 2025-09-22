@extends('admin.layouts.app')

@section('title', 'Detail Kamar')

@section('content')
<div class="content">
<div class="container">
    <h3 class="mb-3">Detail Kamar</h3>

    <div class="card">
        <div class="card-body">
            <h5>{{ $room->jenis_kamar }} (No: {{ $room->nomor_kamar }})</h5>
            <p><strong>Fasilitas:</strong> {{ $room->fasilitas_kamar }}</p>
            <p><strong>Jumlah Kasur:</strong> {{ $room->jumlah_kasur }}</p>
            <p><strong>Harga per Malam:</strong> Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }}</p>
            <p>
                <strong>Gambar:</strong><br>
                @if ($room->gambar_kasur)
                    <img src="{{ asset('storage/' . $room->gambar_kasur) }}" width="200">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </p>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
