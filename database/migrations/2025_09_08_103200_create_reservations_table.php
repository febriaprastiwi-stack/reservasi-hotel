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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_id')->constrained('rooms')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guests');
            $table->enum('status', ['active', 'canceled', 'completed'])->default('active');
            $table->string('payment')->nullable(); 
            $table->decimal('total_price', 12, 2)->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
