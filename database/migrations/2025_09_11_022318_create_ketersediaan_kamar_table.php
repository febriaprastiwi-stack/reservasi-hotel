<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ketersediaan_kamar', function (Blueprint $table) {
            $table->id();
             $table->string('nomor_kamar')->unique();
            $table->string('type');
            $table->decimal('harga', 12, 2);
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->string('image')->nullable(); // simpan path gambar
            $table->text('fasilitas')->nullable(); // deskripsi fasilitas kamar
            $table->string('view')->nullable(); // pemandangan (misal: garden, sea, city)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketersediaan_kamar');
    }
};
