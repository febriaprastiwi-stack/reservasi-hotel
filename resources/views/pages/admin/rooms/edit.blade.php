@extends('admin.layouts.app')

@section('title', 'Edit Kamar')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Edit Kamar</h2>
        <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nomor Kamar</label>
                <input type="text" name="nomor_kamar" value="{{ $room->nomor_kamar }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jenis Kamar</label>
                <input type="text" name="jenis_kamar" value="{{ $room->jenis_kamar }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Fasilitas</label>
                <textarea name="fasilitas_kamar" class="form-control">{{ $room->fasilitas_kamar }}</textarea>
            </div>

            <div class="mb-3">
                <label>Jumlah Kasur</label>
                <input type="number" name="jumlah_kasur" value="{{ $room->jumlah_kasur }}" class="form-control"
                    min="1" required>
            </div>

            <div class="mb-3">
                <label>Gambar Kasur</label><br>
                @if ($room->gambar_kasur)
                    <img src="{{ asset('storage/' . $room->gambar_kasur) }}" width="100" class="img-thumbnail mb-2">
                @endif
                <input type="file" name="gambar_kasur" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
