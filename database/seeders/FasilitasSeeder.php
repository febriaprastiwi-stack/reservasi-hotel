<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas;

class FasilitasSeeder extends Seeder
{
    /**
     * Jalankan seeder fasilitas.
     */
    public function run(): void
    {
        Fasilitas::factory()->count(30)->create(); 
    }
}
