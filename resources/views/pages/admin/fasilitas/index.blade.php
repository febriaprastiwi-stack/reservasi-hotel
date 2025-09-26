@extends('admin.layouts.app')

@section('title', 'Data Fasilitas')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Data Fasilitas</h3>
            <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">Tambah Fasilitas</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse($fasilitas as $item)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        {{-- Gambar fasilitas --}}
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $item->nama }}" 
                                 style="height: 180px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" 
                                 class="card-img-top" 
                                 alt="No Image" 
                                 style="height: 180px; object-fit: cover;">
                        @endif

                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                            <p class="card-text text-muted" style="font-size: 14px;">
                                {{ Str::limit($item->deskripsi, 60) }}
                            </p>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('fasilitas.edit', $item->id) }}" class="btn btn-sm btn-dark w-50 me-1">Edit</a>
                            <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST" class="w-50 ms-1">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100"
                                    onclick="return confirm('Yakin hapus fasilitas ini?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Belum ada data fasilitas</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection