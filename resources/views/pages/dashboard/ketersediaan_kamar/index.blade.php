@extends('layouts.app')

@section('title', 'Daftar Kamar')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">🏨 Daftar Kamar</h2>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No Kamar</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Fasilitas</th>
                    <th>Pemandangan</th>
                    <th>Gambar</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ketersediaan_kamar as $ketersediaan_kamar)
                    <tr>
                        <td class="text-center fw-bold">{{ $ketersediaan_kamar->nomor_kamar }}</td>
                        <td>{{ $ketersediaan_kamar->type }}</td>
                        <td>Rp {{ number_format($ketersediaan_kamar->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if ($ketersediaan_kamar->status == 'available')
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Terisi</span>
                            @endif
                        </td>
                        <td>{{ $ketersediaan_kamar->fasilitas ?? '-' }}</td>
                        <td>{{ $ketersediaan_kamar->view ?? '-' }}</td>
                        <td class="text-center">
                            @if ($ketersediaan_kamar->image)
                                <img src="{{ asset('storage/' . $ketersediaan_kamar->image) }}"
                                    alt="ketersediaan_kamar Image" class="rounded" width="100">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data kamar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
