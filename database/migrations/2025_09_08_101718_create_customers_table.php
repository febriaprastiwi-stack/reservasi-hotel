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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('no_telp', 16)->nullable();
            $table->string('email', 128)->unique();
            $table->string('tipe_kamar', 64);
            $table->DATE('tanggal_check_in');
            $table->INT('total_hari');
            $table->string('pembayaran', 64);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
