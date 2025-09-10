@extends('layouts.app')

@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    @if ($userRole == 'admin')
        {{-- Konten khusus untuk Admin --}}
        <p>Anda login sebagai Admin. Anda memiliki akses penuh ke sistem.</p>
        {{-- Tambahkan tabel, grafik, atau konten admin lainnya di sini --}}
    @elseif ($userRole == 'resepsionis')
        {{-- Konten khusus untuk Resepsionis --}}
        <p>Anda login sebagai Resepsionis. Anda memiliki akses untuk mengelola reservasi dan kamar.</p>
        {{-- Tambahkan formulir atau konten resepsionis lainnya di sini --}}
    @endif
@endsection
