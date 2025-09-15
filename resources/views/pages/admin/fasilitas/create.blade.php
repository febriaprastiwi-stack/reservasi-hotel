@extends('admin.layouts.app')

@section('title', 'Tambah Fasilitas')

@section('content')
    <div class="container">
        <h3 class="mb-3">Tambah Fasilitas</h3>

        <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Gambar</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
