@extends('layouts.app')
@section('title', 'Detail Pembayaran')
@section('content')
    <div class="container mt-4">
        <h2>Detail Pembayaran #{{ $payment->id }}</h2>
        <p><strong>Reservasi:</strong> #{{ $payment->reservation_id }}</p>
        <p><strong>Jumlah:</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
        <p><strong>Tanggal:</strong> {{ $payment->payment_date }}</p>
        <p><strong>Metode:</strong> {{ ucfirst($payment->payment_method) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
