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
        Schema::create('hall_seat_types', function (Blueprint $table) {
            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for the hall seat type');

            $table->foreignUuid('hall_id')
                ->nullable()
                ->index()
                ->constrained('halls')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('Foreign key to the hall');

            $table->foreignUuid('hall_type_id')
                ->nullable()
                ->index()
                ->constrained('hall_types')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('Foreign key to the hall type');

            $table->integer('maximun_capacity')
                ->comment('Maximum capacity of the hall seat type');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_seat_types');
    }
};
