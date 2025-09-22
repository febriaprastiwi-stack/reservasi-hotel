@extends('admin.layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')
    <div class="content">
        <div class="container">
            <h3 class="mb-3">Edit Fasilitas</h3>

            <form action="{{ route('fasilitas.update', $fasilita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $fasilita->nama }}" required>
                </div>
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ $fasilita->deskripsi }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Gambar</label>
                    <input type="file" name="image" class="form-control">
                    @if ($fasilita->image)
                        <img src="{{ asset('storage/' . $fasilita->image) }}" width="100" class="mt-2 rounded">
                    @endif
                </div>
                <button class="btn btn-success">Update</button>
                <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    @endsection
