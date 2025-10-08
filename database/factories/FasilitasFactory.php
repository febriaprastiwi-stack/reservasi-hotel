<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FasilitasFactory extends Factory
{
    /**
     * Tentukan data default untuk model.
     */
    public function definition(): array
    {
        $namaFasilitas = fake()->randomElement([
            'Kolam Renang',
            'Restoran',
            'WiFi Gratis',
            'Spa & Sauna',
            'Gym & Fitness',
            'Parkir Luas',
            'Ruang Meeting',
            'Bar & Lounge',
            'Layanan Kamar 24 Jam',
            'Laundry Service'
        ]);

        return [
            'nama' => $namaFasilitas,
            'deskripsi' => fake()->sentence(10),
            'image' => 'fasilitas/' . strtolower(str_replace(' ', '_', $namaFasilitas)) . '.jpg',
        ];
    }
}
