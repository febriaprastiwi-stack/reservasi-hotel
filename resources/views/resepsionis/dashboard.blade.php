@extends('layouts.app')

@section('title', 'Dashboard Resepsionis')

@section('content')
    <div class="row">
        {{-- Statistik --}}
        <div class="col-md-4">
            <div class="card p-3">
                <h6>Reservasi Hari Ini</h6>
                <h4 class="text-primary">{{ $reservasi_hari_ini }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h6>Check-In Hari Ini</h6>
                <h4 class="text-success">{{ $checkin_hari_ini }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h6>Check-Out Hari Ini</h6>
                <h4 class="text-danger">{{ $checkout_hari_ini }}</h4>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- Daftar Reservasi Aktif --}}
        <div class="col-md-12">
            <div class="card p-3">
                <h6>Daftar Reservasi Aktif</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Tamu</th>
                            <th>No Kamar</th>
                            <th>Tanggal Check-In</th>
                            <th>Tanggal Check-Out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservasi_aktif as $r)
                            <tr>
                                <td>{{ $r->customer->name }}</td>
                                <td>{{ $r->room->room_number }}</td>
                                <td>{{ $r->check_in }}</td>
                                <td>{{ $r->check_out }}</td>
                                <td>
                                    @if ($r->status == 'checkin')
                                        <span class="badge bg-success">Check-In</span>
                                    @elseif($r->status == 'checkout')
                                        <span class="badge bg-danger">Check-Out</span>
                                    @else
                                        <span class="badge bg-warning">Reservasi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
