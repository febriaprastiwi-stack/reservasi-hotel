@extends('admin.layouts.app')

@section('title', 'Kelola Kamar')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Daftar Kamar</h2>
        <a href="{{ route('rooms.create') }}" class="btn btn-success mb-3">+ Tambah Kamar</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Jenis Kamar</th>
                    <th>Fasilitas</th>
                    <th>Jumlah Kasur</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $room->nomor_kamar }}</td>
                        <td>{{ $room->jenis_kamar }}</td>
                        <td>{{ $room->fasilitas_kamar }}</td>
                        <td>{{ $room->jumlah_kasur }}</td>
                        <td>
                            @if ($room->gambar_kasur)
                                <img src="{{ asset('storage/' . $room->gambar_kasur) }}" width="80" class="img-thumbnail">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin hapus kamar ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
