<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

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
        return $this->belongsTo(Room::class, 'room_id');
    }
}
