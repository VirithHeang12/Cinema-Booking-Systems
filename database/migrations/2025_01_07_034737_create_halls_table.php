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
        Schema::create('halls', function (Blueprint $table) {
            $table->id()
                ->comment('Unique identifier for the hall');

            $table->foreignId('hall_type_id')
                ->nullable()
                ->index()
                ->constrained('hall_types')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the hall type');

            $table->string('name')
                ->unique()
                ->nullable(false)
                ->comment('Name of the hall');

            $table->string('description')
                ->nullable()
                ->comment('Description of the hall');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
