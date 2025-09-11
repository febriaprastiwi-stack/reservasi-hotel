<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KetersediaanKamar extends Model
{
    protected $table = 'ketersediaan_kamar';

    protected $fillable = [
        'nomor_kamar',
        'type',
        'harga',
        'status',
        'image',
        'fasilitas',
        'view',
    ];
}
