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
        Schema::create('hall_types', function (Blueprint $table) {
            $table->id()
                ->comment('Unique identifier for the hall type');

            $table->string('name')
                ->unique()
                ->nullable(false)
                ->comment('Name of the hall type');

            $table->string('description')
                ->nullable()
                ->comment('Description of the hall type');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_types');
    }
};
