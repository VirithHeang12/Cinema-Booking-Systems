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
        Schema::create('show_seats', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [
                'Available',
                'Booked'
            ])->default('Available');

            $table->foreignId('show_id')
                ->nullable()
                ->constrained('shows')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreignId('seat_id')
                ->nullable()
                ->constrained('seats')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreignId('booking_id')
                ->nullable()
                ->constrained('bookings')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('show_seats');
    }
};
