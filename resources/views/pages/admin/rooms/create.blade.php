@extends('admin.layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="content">
<div class="container">
    <h3 class="mb-3">Tambah Kamar</h3>

    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nomor Kamar</label>
            <input type="text" name="nomor_kamar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kamar</label>
            <input type="text" name="jenis_kamar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fasilitas</label>
            <textarea name="fasilitas_kamar" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Jumlah Kasur</label>
            <input type="number" name="jumlah_kasur" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label>Harga per Malam</label>
            <input type="number" name="harga_per_malam" class="form-control" min="0" step="1000" required>
        </div>

        <div class="mb-3">
            <label>Gambar Kasur</label>
            <input type="file" name="gambar_kasur" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
