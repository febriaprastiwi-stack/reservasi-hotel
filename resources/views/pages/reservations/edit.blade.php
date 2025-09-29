@extends('layouts.app')

@section('title', 'Edit Reservation')

@section('content')
<div class="container-fluid min-vh-100 bg-light" style="padding-top: 80px;">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">✏ Edit Reservation</h2>
        <p class="text-muted">Update your booking details quickly & elegantly</p>
    </div>

    <div class="card shadow-lg border rounded-4 p-5 mx-auto" 
         style="background-color: #ffffff; max-width: 650px;">
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Guests --}}
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark">Guests</label>
                <div class="input-group">
                    <span class="input-group-text bg-white text-secondary border-end-0">
                        <i class="bi bi-people-fill"></i>
                    </span>
                    <input type="number" name="guests" class="form-control border-start-0" 
                           value="{{ old('guests', $reservation->guests) }}" min="1" required>
                </div>
            </div>

            {{-- Payment --}}
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark">Payment Method</label>
                <div class="input-group">
                    <span class="input-group-text bg-white text-secondary border-end-0">
                        <i class="bi bi-credit-card-2-front-fill"></i>
                    </span>
                    <input type="text" name="payment" class="form-control border-start-0" 
                           value="{{ old('payment', $reservation->payment) }}" required>
                </div>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark">Status</label>
                <div class="input-group">
                    <span class="input-group-text bg-white text-secondary border-end-0">
                        <i class="bi bi-info-circle-fill"></i>
                    </span>
                    <select name="status" class="form-select border-start-0" required>
                        <option value="active" {{ $reservation->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="canceled" {{ $reservation->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-between gap-2">
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary fw-bold py-3 px-4">
                    <i class="bi bi-arrow-left-circle me-1"></i> Back
                </a>
                <button type="submit" class="btn btn-warning fw-bold py-3 px-4">
                    <i class="bi bi-save2 me-1"></i> Update Reservation
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

{{-- Styling --}}
<style>
    .form-control, .form-select {
        background-color: #fff !important;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 8px rgba(245, 215, 110, 0.6);
        border-color: #f5d76e;
    }

    .btn-warning {
        background: linear-gradient(90deg, #ffc107, #f5d76e);
        border: none;
        transition: all 0.3s ease-in-out;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(245, 215, 110, 0.6);
    }

    .btn-secondary {
        transition: all 0.3s ease-in-out;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.5);
    }

    .card {
        transform: translateY(20px);
        opacity: 0;
        animation: fadeInUp 0.8s forwards;
    }

    @keyframes fadeInUp {
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>
@endsection