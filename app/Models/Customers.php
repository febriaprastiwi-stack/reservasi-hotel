<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = ['name', 'no_telp', 'email', 'tipe_kamar', 'tanggal_check_in', 'total_hari', 'pembayaran'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
