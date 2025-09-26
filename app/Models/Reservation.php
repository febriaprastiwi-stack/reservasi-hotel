<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'email',
        'check_in',
        'check_out',
        'guests',
        'status',
        'payment',
        'total_price',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payment()
    {
        return $this->hasOne(Payments::class);
    }
}
