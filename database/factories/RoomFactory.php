<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        $statuses = ['available', 'reserved'];

        return [
            'nomor_kamar'    => $this->faker->unique()->numerify('RM###'),
            'jenis_kamar'    => $this->faker->randomElement(['Standard', 'Deluxe', 'Suite']),
            'fasilitas_kamar'=> $this->faker->sentence(),
            'jumlah_kasur'   => $this->faker->randomElement([1,2,3]),
            'gambar_kasur'   => null,
            'harga_per_malam'=> $this->faker->numberBetween(200000, 2000000),
            'status'         => $this->faker->randomElement($statuses),
        ];
    }
}
