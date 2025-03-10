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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id()
                ->comment('Unique identifier for the payment method');

            $table->string('name')
                ->unique()
                ->nullable(false)
                ->comment('Name of the payment method');

            $table->text('description')
                ->nullable()
                ->comment('Description of the payment method');

            $table->boolean('is_active')
                ->default(true)
                ->comment('Indicates if the payment method is active');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
