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
        Schema::create('seats', function (Blueprint $table) {
            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for the seat');

            $table->foreignUuid('hall_id')
                ->nullable()
                ->index()
                ->constrained('halls')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('Foreign key to the hall');

            $table->foreignUuid('seat_type_id')
                ->nullable()
                ->index()
                ->constrained('seat_types')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('Foreign key to the seat type');

            $table->char('row', length: 3)
                ->comment('Row of the seat');

            $table->tinyInteger('number')
                ->comment('Number of the seat');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
