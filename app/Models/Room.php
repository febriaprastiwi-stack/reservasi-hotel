<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'nomor_kamar',
        'jenis_kamar',
        'fasilitas_kamar',
        'jumlah_kasur',
        'gambar_kasur',
        'harga_per_malam',
        'status',
    ];

    // Contoh: jika ada relasi dengan Reservation
    public function reservations()
    {
        return $this->hasMany(\App\Models\Reservation::class, 'room_id');
    }
}
