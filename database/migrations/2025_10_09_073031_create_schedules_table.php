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
    Schema::create('schedules', function (Blueprint $table) {
        $table->id('schedule_id');
        $table->foreignId('bus_id')->constrained('buses', 'bus_id')->onDelete('cascade');
        $table->foreignId('route_id')->constrained('routes', 'route_id')->onDelete('cascade');
        $table->dateTime('departure_time');
        $table->dateTime('arrival_time');
        $table->integer('available_seats')->default(0);
        $table->enum('status', ['tersedia', 'penuh', 'dibatalkan'])->default('tersedia');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
