<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['customer_id','room_id','check_in','check_out','total_harga','status'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function room() {
        return $this->belongsTo(Rooms::class);
    }

    public function payment() {
        return $this->hasOne(Payments::class);
    }
}
