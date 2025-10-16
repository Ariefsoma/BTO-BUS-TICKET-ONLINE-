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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id('booking_id');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('schedule_id')->constrained('schedules', 'schedule_id')->onDelete('cascade');
        $table->integer('seat_number');
        $table->decimal('total_price', 10, 2);
        $table->enum('status', ['pending', 'dibayar', 'selesai', 'dibatalkan'])->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
