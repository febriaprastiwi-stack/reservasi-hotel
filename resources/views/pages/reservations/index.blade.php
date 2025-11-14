@extends('layouts.app')

@section('title', 'Data Reservasi')

@section('content')
<div class="container-fluid" style="margin-left: 0px; padding-top: 80px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📋 Data Reservasi</h2>
        <form action="{{ route('reservations.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari reservasi..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
    </div>

    @if ($reservations->isEmpty())
        <div class="alert alert-info shadow-sm">
            Anda belum memiliki reservasi. 
            <a href="{{ route('home.rooms.index') }}" class="fw-bold text-decoration-none">Pesan sekarang!</a>
        </div>
    @else
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <button id="toggleSelectMode" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-check2-square"></i> Aktifkan Mode Seleksi
                    </button>
                    <button id="cancelSelect" class="btn btn-outline-secondary btn-sm d-none">Batal</button>
                    <button id="deleteSelected" class="btn btn-danger btn-sm d-none">
                        <i class="bi bi-trash"></i> Hapus Terpilih
                    </button>
                    <div id="loadingSpinner" class="spinner-border text-danger spinner-border-sm ms-2 d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <form id="bulkDeleteForm" action="{{ route('reservations.bulkDelete') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <table class="table table-hover align-middle text-nowrap">
                            <thead class="table-primary">
                                <tr>
                                    <th style="width:40px;" class="d-none select-col">
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th>No</th>
                                    <th>Room</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Guests</th>
                                    <th>Payment</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Booked At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td class="d-none select-col">
                                            <input type="checkbox" name="selected[]" value="{{ $reservation->id }}" class="row-checkbox">
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
                                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info btn-sm shadow-sm" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm shadow-sm" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- SweetAlert & Script --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggleSelectBtn = document.getElementById("toggleSelectMode");
    const cancelSelectBtn = document.getElementById("cancelSelect");
    const deleteSelectedBtn = document.getElementById("deleteSelected");
    const selectAll = document.getElementById("selectAll");
    const checkboxes = document.querySelectorAll(".row-checkbox");
    const selectCols = document.querySelectorAll(".select-col");
    const spinner = document.getElementById("loadingSpinner");
    const form = document.getElementById("bulkDeleteForm");

    // Aktifkan mode seleksi
    toggleSelectBtn.addEventListener("click", () => {
        toggleSelectBtn.classList.add("d-none");
        cancelSelectBtn.classList.remove("d-none");
        deleteSelectedBtn.classList.remove("d-none");
        selectCols.forEach(col => col.classList.remove("d-none"));
    });

    // Batal seleksi
    cancelSelectBtn.addEventListener("click", () => {
        toggleSelectBtn.classList.remove("d-none");
        cancelSelectBtn.classList.add("d-none");
        deleteSelectedBtn.classList.add("d-none");
        selectCols.forEach(col => col.classList.add("d-none"));
        checkboxes.forEach(cb => cb.checked = false);
        selectAll.checked = false;
    });

    // Pilih semua
    selectAll.addEventListener("change", () => {
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
    });

    // Hapus terpilih
    deleteSelectedBtn.addEventListener("click", () => {
        const selected = Array.from(checkboxes).filter(cb => cb.checked);
        if (selected.length === 0) {
            Swal.fire('Oops!', 'Tidak ada reservasi yang dipilih.', 'warning');
            return;
        }

        Swal.fire({
            title: 'Hapus Reservasi Terpilih?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                spinner.classList.remove("d-none");
                form.submit();
            }
        });
    });

    // Hapus satu per satu
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Hapus Reservasi?',
                text: 'Data ini akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/reservations/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    }).then(() => location.reload());
                }
            });
        });
    });

    // Notifikasi sukses
    @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 1800
    });
    @endif
});
</script>
@endpush
@endsection
