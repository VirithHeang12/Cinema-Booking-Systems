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
        Schema::create('movie_genres', function (Blueprint $table) {
            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for the movie genre');

            $table->foreignUuid('movie_id')
                ->nullable()
                ->index()
                ->constrained('movies')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the movie');

            $table->foreignUuid('genre_id')
                ->nullable()
                ->index()
                ->constrained('genres')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the genre');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_genre');
    }
};
