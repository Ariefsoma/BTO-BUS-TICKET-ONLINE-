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
    Schema::create('buses', function (Blueprint $table) {
        $table->id('bus_id');
        $table->string('bus_name');
        $table->string('bus_type')->nullable();
        $table->integer('seat_count')->default(40);
        $table->decimal('price_per_seat', 10, 2);
        $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
