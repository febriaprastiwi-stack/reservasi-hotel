<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $fillable = ['nomor_kamar', 'tipe_kamar', 'harga', 'status', 'gambar_kasur'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
