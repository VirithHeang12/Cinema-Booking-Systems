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
            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for the booking');

            $table->string('guest_email')
                ->nullable()
                ->comment('Email of the guest');

            $table->string('qr_code')
                ->unique()
                ->comment('QR code of the booking');

            $table->decimal('total_amount', 10, 2)
                ->comment('Total amount of the booking');

            $table->timestamp('booking_date')
                ->comment('Date of the booking');

            $table->enum('status', [
                'Pending',
                'Confirmed',
                'Cancelled',
                'Completed',
                'Failed',
                'Refunded'
            ])->default('Pending')
                ->comment('Status of the booking');

            $table->foreignUuid('user_id')
                ->nullable()
                ->index()
                ->constrained('users')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the user');

            $table->foreignUuid('payment_method_id')
                ->nullable()
                ->index()
                ->constrained('payment_methods')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the payment method');

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
