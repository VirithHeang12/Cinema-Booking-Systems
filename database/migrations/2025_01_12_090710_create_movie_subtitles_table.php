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
        Schema::create('movie_subtitles', function (Blueprint $table) {
            $table->id()
                ->comment('Unique identifier for the movie subtitle');

            $table->foreignId('movie_id')
                ->nullable()
                ->index()
                ->constrained('movies')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the movie');

            $table->foreignId('language_id')
                ->nullable()
                ->index()
                ->constrained('languages')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the language');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_subtitles');
    }
};
