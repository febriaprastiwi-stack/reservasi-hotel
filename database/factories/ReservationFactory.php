<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        $status = $this->faker->randomElement(['active','canceled','completed']);
        $checkIn = $this->faker->dateTimeThisYear();
        $checkOut = (clone $checkIn)->modify('+'.rand(1,5).' days');

        // ambil room random
        $room = Room::inRandomOrder()->first() ?? Room::factory()->create();

        $totalPrice = $room->harga_per_malam * rand(1,5);

        return [
            'room_id'   => $room->id,
            'name'      => $this->faker->name(),
            'email'     => $this->faker->safeEmail(),
            'check_in'  => $checkIn,
            'check_out' => $checkOut,
            'guests'    => rand(1,4),
            'status'    => $status,
            'payment'   => $this->faker->randomElement(['cash','credit_card','transfer']),
            'total_price' => $totalPrice,
            'created_at'  => $this->faker->dateTimeThisYear(),
        ];
    }
}
