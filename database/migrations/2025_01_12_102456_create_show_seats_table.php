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
            $table->id()
                ->comment('Unique identifier for the show seat');

            $table->enum('status', [
                'Available',
                'Booked'
            ])
                ->default('Available')
                ->comment('Status of the show seat');

            $table->foreignId('show_id')
                ->nullable()
                ->index()
                ->constrained('shows')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the show');

            $table->foreignId('seat_id')
                ->nullable()
                ->index()
                ->constrained('seats')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the seat');

            $table->foreignId('booking_id')
                ->nullable()
                ->index()
                ->constrained('bookings')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the booking');

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
