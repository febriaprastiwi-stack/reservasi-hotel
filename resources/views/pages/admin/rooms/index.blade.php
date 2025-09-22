@extends('admin.layouts.app')

@section('title', 'Data Kamar')

@section('content')
<div class="content">
<div class="container">
    <h3 class="mb-3">Data Kamar</h3>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">+ Tambah Kamar</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Kamar</th>
                <th>Jenis Kamar</th>
                <th>Fasilitas</th>
                <th>Kasur</th>
                <th>Harga/Malam</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rooms as $room)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $room->nomor_kamar }}</td>
                <td>{{ $room->jenis_kamar }}</td>
                <td>{{ $room->fasilitas_kamar }}</td>
                <td>{{ $room->jumlah_kasur }}</td>
                <td>Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }}</td>
                <td>
                    @if ($room->gambar_kasur)
                        <img src="{{ asset('storage/' . $room->gambar_kasur) }}" width="80">
                    @else
                        <small class="text-muted">No Image</small>
                    @endif
                </td>
                <td>
                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kamar ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada data kamar</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
