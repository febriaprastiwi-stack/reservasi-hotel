@extends('admin.layouts.app')

@section('title', 'Detail Kamar')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Detail Kamar</h2>
        <div class="card">
            <div class="card-body">
                <h5>Nomor Kamar: {{ $room->nomor_kamar }}</h5>
                <p><strong>Jenis Kamar:</strong> {{ $room->jenis_kamar }}</p>
                <p><strong>Fasilitas:</strong> {{ $room->fasilitas_kamar }}</p>
                <p><strong>Jumlah Kasur:</strong> {{ $room->jumlah_kasur }}</p>
                <p>
                    <strong>Gambar:</strong><br>
                    @if ($room->gambar_kasur)
                        <img src="{{ asset('storage/' . $room->gambar_kasur) }}" width="200" class="img-thumbnail">
                    @else
                        <span class="text-muted">Tidak ada gambar</span>
                    @endif
                </p>
            </div>
        </div>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
