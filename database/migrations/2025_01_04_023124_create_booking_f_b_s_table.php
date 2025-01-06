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
        Schema::create('booking_f_b_s', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('amount', 10, 2);

            $table->foreignId('booking_id')
                ->nullable()
                ->constrained('bookings')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreignId('fb_id')
                ->nullable()
                ->constrained('food_and_beverages')
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
        Schema::dropIfExists('booking_f_b_s');
    }
};
