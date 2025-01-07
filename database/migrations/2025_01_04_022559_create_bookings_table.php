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
            $table->id();
            $table->string('guest_email', 255)->nullable();
            $table->string('qr_code', 255)->unique();
            $table->decimal('total_amount', 10, 2);
            $table->dateTime('booking_date');
            $table->enum('status', [
                'Pending',
                'Confirmed',
                'Cancelled',
                'Completed',
                'Failed',
                'Refunded'
            ])->default('Pending');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreignId('payment_method_id')
                ->nullable()
                ->constrained('payment_methods')
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
        Schema::dropIfExists('bookings');
    }
};
