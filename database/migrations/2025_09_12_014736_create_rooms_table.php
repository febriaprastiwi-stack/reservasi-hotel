<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar')->unique();
            $table->string('jenis_kamar');
            $table->text('fasilitas_kamar')->nullable();
            $table->unsignedInteger('jumlah_kasur')->default(1);
            $table->string('gambar_kasur')->nullable();
            $table->decimal('harga_per_malam', 12, 2)->default(0);
            $table->string('status')->default('available')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
