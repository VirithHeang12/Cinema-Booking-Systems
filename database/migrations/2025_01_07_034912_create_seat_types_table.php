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
        Schema::create('seat_types', function (Blueprint $table) {
            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for the seat type');

            $table->string('name')
                ->unique()
                ->nullable(false)
                ->comment('Name of the seat type');

            $table->string('description')
                ->nullable()
                ->comment('Description of the seat type');

            $table->double('price', 8, 2)
                ->comment('Price of the seat type');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_types');
    }
};
