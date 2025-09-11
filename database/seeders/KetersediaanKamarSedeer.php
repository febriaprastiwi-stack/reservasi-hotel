<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KetersediaanKamarSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KetersediaanKamar::create([
            'nomor_kamar' => '101',
            'type' => 'Deluxe',
            'harga' => 750000,
            'status' => 'available',
            'fasilitas' => 'AC, WiFi, TV, Breakfast',
            'view' => 'Sea View',
            'image' => null,
        ]);

        KetersediaanKamar::create([
            'nomor_kamar' => '102',
            'type' => 'Standard',
            'harga' => 500000,
            'status' => 'occupied',
            'fasilitas' => 'AC, WiFi, TV',
            'view' => 'City View',
            'image' => null,
        ]);
    }
}
