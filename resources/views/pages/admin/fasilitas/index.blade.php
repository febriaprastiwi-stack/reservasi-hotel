@extends('admin.layouts.app')

@section('title', 'Data Fasilitas')

@section('content')

<div class="content" style="background-color: #f9f9f9; min-height: 100vh; padding:50px 0;">
    <div class="container-fluid">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold" style="color: #b8860b;">
                <i class="bi bi-building-check me-2"></i> Daftar Fasilitas Hotel
            </h3>
            <a href="{{ route('fasilitas.create') }}" class="btn btn-gold fw-bold shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Fasilitas
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Grid Fasilitas -->
        <div class="row">
            @forelse($fasilitas as $item)
                <div class="col-md-3 mb-4">
                    <div class="card card-fasilitas h-100 rounded-4 overflow-hidden position-relative">

                        <!-- Tombol Edit & Hapus -->
                        <div class="action-buttons">
                            <a href="{{ route('fasilitas.edit', $item->id) }}" 
                               class="btn btn-sm btn-edit-icon" 
                               data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST" class="delete-form d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-delete-icon delete-btn" 
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Gambar Fasilitas -->
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

                        <!-- Body -->
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="fw-bold text-dark mb-2">{{ $item->nama }}</h5>
                                <p class="text-muted" style="font-size: 14px;">
                                    {{ Str::limit($item->deskripsi, 60) }}
                                </p>
                            </div>

                            <!-- Tombol Detail -->
                            <div class="mt-2 text-end">
                                <a href="{{ route('fasilitas.show', $item->id) }}" 
                                   class="btn btn-sm btn-outline-gold rounded-pill px-3 fw-semibold">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted mt-5">
                    <p class="fw-bold">Belum ada data fasilitas</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- ===== STYLE ===== -->
<style>
    .card-fasilitas {
        border: 1px solid #eee;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        background: #fff;
    }
    .card-fasilitas:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(212,175,55,0.25);
        border-color: #d4af37;
    }

    .action-buttons {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        gap: 6px;
    }
    .btn-edit-icon, .btn-delete-icon {
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        font-size: 14px;
        transition: 0.3s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    .btn-edit-icon {
        background: linear-gradient(135deg, #d4af37, #b8860b);
        color: #fff;
    }
    .btn-edit-icon:hover {
        background: linear-gradient(135deg, #e6c84f, #d4af37);
        transform: scale(1.1);
    }
    .btn-delete-icon {
        background-color: #444;
        color: #fff;
    }
    .btn-delete-icon:hover {
        background-color: #c0392b;
        transform: scale(1.1);
    }

    .btn-gold {
        background: linear-gradient(135deg, #d4af37, #b8860b);
        border-radius: 25px;
        color: #fff;
        padding: 8px 20px;
        transition: 0.3s;
    }
    .btn-gold:hover {
        background: linear-gradient(135deg, #e6c84f, #d4af37);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(212, 175, 55, 0.4);
    }

    .btn-outline-gold {
        border: 1px solid #d4af37;
        color: #b8860b;
        transition: 0.3s;
        background: transparent;
    }
    .btn-outline-gold:hover {
        background: linear-gradient(135deg, #d4af37, #b8860b);
        color: #fff;
        box-shadow: 0 4px 10px rgba(212,175,55,0.3);
    }

    #success-alert {
        transition: opacity 0.5s ease;
    }
</style>

<!-- ===== SWEETALERT2 ===== -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (el) { return new bootstrap.Tooltip(el) });

    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('.delete-form');
            Swal.fire({
                title: 'Hapus Fasilitas?',
                text: 'Data fasilitas akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d4af37',
                cancelButtonColor: '#444',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                background: '#fff8e7',
                color: '#222',
                customClass: {
                    popup: 'shadow-lg rounded-4',
                    confirmButton: 'fw-bold',
                    cancelButton: 'fw-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    const alertBox = document.getElementById('success-alert');
    if (alertBox) {
        setTimeout(() => {
            alertBox.style.opacity = '0';
            setTimeout(() => alertBox.remove(), 500);
        }, 3000);
    }
});
</script>

@endsection
