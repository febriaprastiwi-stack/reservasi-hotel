@extends('layouts.app')

@section('title', 'Data Reservasi')

@section('content')
<div class="container-fluid" style="margin-left: 0px; padding-top: 80px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📋 Data Reservasi</h2>
        <form action="{{ route('reservations.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" 
                placeholder="Cari reservasi..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($reservations->isEmpty())
        <div class="alert alert-info shadow-sm">
            Anda belum memiliki reservasi. 
            <a href="{{ route('home.rooms.index') }}" class="fw-bold text-decoration-none">Pesan sekarang!</a>
        </div>
    @else
        <!-- Bulk delete form -->
        <form action="{{ route('reservations.bulkDelete') }}" method="POST" id="bulkDeleteForm">
            @csrf
            @method('DELETE')

            <!-- Tombol toggle seleksi -->
            <div class="mb-3 d-flex align-items-center gap-2">
                <button type="button" class="btn btn-secondary btn-sm" id="toggleSelection">
                    <i class="bi bi-check-square"></i> Aktifkan Mode Seleksi
                </button>

                <!-- Aksi Bulk Delete (hidden dulu) -->
                <div class="d-flex align-items-center gap-2 d-none" id="bulkActions">
                    <div>
                        <input type="checkbox" id="checkAll"> <label for="checkAll">Pilih Semua</label>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" id="deleteSelected" disabled
                            data-bs-toggle="modal" data-bs-target="#bulkDeleteModal">
                        <i class="bi bi-trash"></i> Hapus Terpilih
                    </button>
                </div>
            </div>

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-nowrap">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center checkbox-header hidden-col" style="width: 40px;">#</th>
                                    <th>No</th>
                                    <th>Room</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Guests</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Booked At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td class="text-center checkbox-cell hidden-col">
                                            <input type="checkbox" name="ids[]" value="{{ $reservation->id }}" class="checkItem">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $reservation->room->jenis_kamar ?? '-' }}</strong><br>
                                            <small class="text-muted">No: {{ $reservation->room->nomor_kamar ?? '' }}</small>
                                        </td>
                                        <td>{{ $reservation->name }}</td>
                                        <td class="text-truncate" style="max-width: 180px;" title="{{ $reservation->email }}">
                                            {{ $reservation->email }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}</td>
                                        <td class="text-center">{{ $reservation->guests }}</td>
                                        <td>{{ ucfirst($reservation->payment ?? '-') }}</td>
                                        <td class="fw-bold text-success">
                                            Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @if ($reservation->status == 'active')
                                                <span class="badge bg-success px-3 py-2">Active</span>
                                            @elseif ($reservation->status == 'completed')
                                                <span class="badge bg-primary px-3 py-2">Completed</span>
                                            @elseif ($reservation->status == 'canceled')
                                                <span class="badge bg-danger px-3 py-2">Canceled</span>
                                            @else
                                                <span class="badge bg-secondary px-3 py-2">{{ ucfirst($reservation->status) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $reservation->created_at->format('d M Y H:i') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('reservations.show', $reservation->id) }}" 
                                                class="btn btn-info btn-sm shadow-sm" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('reservations.edit', $reservation->id) }}" 
                                                class="btn btn-warning btn-sm shadow-sm" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <!-- Tombol hapus pakai modal -->
                                            <button type="button" class="btn btn-danger btn-sm shadow-sm" 
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reservation->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div class="modal fade" id="deleteModal{{ $reservation->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus reservasi <b>{{ $reservation->name }}</b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Bulk Delete -->
            <div class="modal fade" id="bulkDeleteModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="bulkDeleteMessage">
                            Anda akan menghapus <b>0</b> reservasi.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>

<style>
.hidden-col {
    display: none;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("toggleSelection");
    const bulkActions = document.getElementById("bulkActions");
    const colCheckbox = document.querySelectorAll(".checkbox-header");
    const checkboxCells = document.querySelectorAll(".checkbox-cell");
    const checkItems = document.querySelectorAll(".checkItem");
    const checkAll = document.getElementById("checkAll");
    const deleteBtn = document.getElementById("deleteSelected");
    const bulkDeleteMessage = document.getElementById("bulkDeleteMessage");

    let selectionMode = false;

    toggleBtn.addEventListener("click", function () {
        selectionMode = !selectionMode;

        if (selectionMode) {
    colCheckbox.forEach(el => el.classList.remove("hidden-col"));
    checkboxCells.forEach(el => el.classList.remove("hidden-col"));
    bulkActions.classList.remove("d-none"); // tampilkan

    toggleBtn.innerHTML = `<i class="bi bi-x-circle"></i> Nonaktifkan Mode Seleksi`;
    toggleBtn.classList.remove("btn-secondary");
    toggleBtn.classList.add("btn-outline-danger");
} else {
    colCheckbox.forEach(el => el.classList.add("hidden-col"));
    checkboxCells.forEach(el => el.classList.add("hidden-col"));
    bulkActions.classList.add("d-none"); // sembunyikan

    checkAll.checked = false;
    checkItems.forEach(i => i.checked = false);
    deleteBtn.disabled = true;

    toggleBtn.innerHTML = `<i class="bi bi-check-square"></i> Aktifkan Mode Seleksi`;
    toggleBtn.classList.add("btn-secondary");
    toggleBtn.classList.remove("btn-outline-danger");
}

    });

    checkAll?.addEventListener("change", function () {
        checkItems.forEach(item => item.checked = this.checked);
        updateDeleteButton();
    });

    checkItems.forEach(item => item.addEventListener("change", updateDeleteButton));

    function updateDeleteButton() {
        const selected = Array.from(checkItems).filter(i => i.checked);
        deleteBtn.disabled = selected.length === 0;
        if (bulkDeleteMessage) {
            bulkDeleteMessage.innerHTML = `Anda akan menghapus <b>${selected.length}</b> reservasi.`;
        }
    }
});
</script>
@endsection
