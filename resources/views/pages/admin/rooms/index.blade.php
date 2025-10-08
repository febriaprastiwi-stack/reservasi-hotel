@extends('admin.layouts.app')

@section('title', 'Data Kamar')

@section('content')
<div class="content" style="background:#f9f9f9; min-height:100vh; padding:50px 0;">
    <div class="container">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-bold" style="color:#b8860b; text-shadow:0 1px 3px rgba(0,0,0,0.1);">
                🛏 Daftar Kamar Hotel
            </h2>
            <div class="d-flex gap-2">
                <button id="selectModeBtn" class="btn btn-outline-dark rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-check2-square"></i> Mode Seleksi
                </button>
                <form id="bulkDeleteForm" action="{{ route('rooms.bulkDelete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="ids" id="selectedRooms">
                    <button type="button" id="deleteSelectedBtn" 
                            class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm text-white" 
                            style="display:none;">
                        <i class="bi bi-trash3"></i> Hapus Terpilih
                    </button>
                </form>

                <a href="{{ route('rooms.create') }}" 
                   class="btn rounded-pill fw-bold text-white px-4 shadow tambah-btn">
                    <i class="bi bi-plus-circle"></i> Tambah Kamar
                </a>
            </div>
        </div>

        <!-- Grid Kamar -->
        <div class="row g-4">
            @forelse($rooms as $room)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 position-relative room-card">
                    
                    <!-- Checkbox Seleksi -->
                    <input type="checkbox" class="form-check-input position-absolute room-checkbox" 
                           value="{{ $room->id }}" 
                           style="top:15px; right:15px; transform:scale(1.3); display:none; z-index:10;">

                    <!-- Gambar -->
                    <div class="position-relative">
                        @if ($room->gambar_kasur)
                            <img src="{{ asset('storage/' . $room->gambar_kasur) }}" 
                                 class="card-img-top" 
                                 style="height:220px; object-fit:cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light text-muted"
                                 style="height:220px;">
                                No Image
                            </div>
                        @endif
                        <div class="harga-box position-absolute bottom-0 start-0 m-3 px-3 py-2 shadow">
                            <span class="fw-bold">Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }}</span><br>
                            <small class="text-white-50">/ malam</small>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold text-dark mb-1">{{ $room->jenis_kamar }}</h5>
                        <p class="text-muted small mb-2">No. Kamar: <span class="fw-bold">{{ $room->nomor_kamar }}</span></p>
                        
                        <!-- Fasilitas -->
                        <div class="mb-3">
                            @foreach(explode(',', $room->fasilitas_kamar) as $fasilitas)
                                <span class="badge fasilitas-badge">{{ trim($fasilitas) }}</span>
                            @endforeach
                        </div>

                        <p class="small text-secondary mb-4">
                            <i class="bi bi-hospital"></i> Kasur: {{ $room->jumlah_kasur }}
                        </p>

                        <!-- Tombol -->
                        <div class="mt-auto d-flex justify-content-between gap-2">
                            <a href="{{ route('rooms.show', $room->id) }}" 
                               class="btn btn-outline-dark btn-sm rounded-pill px-3 detail-btn">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('rooms.edit', $room->id) }}" 
                               class="btn btn-sm rounded-pill px-3 text-white edit-btn">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="delete-form m-0">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm rounded-pill px-3 text-white hapus-btn delete-btn">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="fs-5 text-muted">Belum ada data kamar tersedia</p>
            </div>
            @endforelse
        </div>

    </div>
</div>

<!-- 🔄 Spinner Loading -->
<div id="loadingSpinner">
    <div class="spinner-border text-warning" style="width:3rem; height:3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectModeBtn = document.getElementById('selectModeBtn');
    const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
    const checkboxes = document.querySelectorAll('.room-checkbox');
    const selectedRoomsInput = document.getElementById('selectedRooms');
    const spinner = document.getElementById('loadingSpinner');
    let selectionMode = false;

    // Mode Seleksi
    selectModeBtn.addEventListener('click', () => {
        selectionMode = !selectionMode;
        checkboxes.forEach(cb => cb.style.display = selectionMode ? 'block' : 'none');
        deleteSelectedBtn.style.display = selectionMode ? 'inline-block' : 'none';
        selectModeBtn.innerHTML = selectionMode 
            ? '<i class="bi bi-x-circle"></i> Batal Seleksi' 
            : '<i class="bi bi-check2-square"></i> Mode Seleksi';
    });

    // Tampilkan spinner
    function showSpinner() {
        spinner.style.display = 'flex';
    }

    // Sembunyikan spinner
    function hideSpinner() {
        spinner.style.display = 'none';
    }

    // Delete terpilih
    deleteSelectedBtn.addEventListener('click', () => {
        const selectedIds = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (selectedIds.length === 0) {
            Swal.fire('Tidak ada kamar yang dipilih', '', 'info');
            return;
        }

        Swal.fire({
            title: 'Hapus Kamar Terpilih?',
            text: 'Semua kamar yang dipilih akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d4af37',
            cancelButtonColor: '#444',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                showSpinner();
                selectedRoomsInput.value = selectedIds.join(',');
                document.getElementById('bulkDeleteForm').submit();
            }
        });
    });

    // Tombol hapus 1 per 1
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.delete-form');
            Swal.fire({
                title: 'Hapus Kamar?',
                text: 'Kamar yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d4af37',
                cancelButtonColor: '#444',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    showSpinner();
                    form.submit();
                }
            });
        });
    });

    // ✅ Notifikasi SweetAlert sukses otomatis setelah redirect
    @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000,
        background: '#fff8dc',
        color: '#444',
        iconColor: '#d4af37'
    });
    @endif
});
</script>
@endpush

<!-- Custom Style -->
<style>
    .room-card { background:#fff; border:1px solid rgba(212,175,55,0.2); transition:0.3s; }
    .room-card:hover { transform:translateY(-5px); box-shadow:0 8px 20px rgba(212,175,55,0.3); }
    .tambah-btn { background:linear-gradient(135deg,#d4af37,#b8860b); border:none; }
    .tambah-btn:hover { background:linear-gradient(135deg,#e6c84f,#d4af37); transform:translateY(-2px); }
    .harga-box { background:rgba(0,0,0,0.6); color:#fff; border-radius:10px; }
    .fasilitas-badge { background:#f8f1d4; color:#b8860b; border:1px solid #e6c84f; margin:2px; }
    .detail-btn { border-color:#d4af37; color:#b8860b; }
    .detail-btn:hover { background:#d4af37; color:#fff; }
    .edit-btn { background:linear-gradient(135deg,#d4af37,#b8860b); border:none; }
    .edit-btn:hover { background:linear-gradient(135deg,#e6c84f,#d4af37); }
    .hapus-btn { background:#444; border:none; }
    .hapus-btn:hover { background:#c0392b; }

    /* 🔄 Spinner Loading */
    #loadingSpinner {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(255,255,255,0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
</style>
@endsection
