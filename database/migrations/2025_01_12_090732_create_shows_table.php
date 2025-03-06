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
        Schema::create('shows', function (Blueprint $table) {
            $table->id()
                ->comment('Unique identifier for the show');

            $table->timestamp('show_time')
                ->nullable(false)
                ->comment('Time of the show');

            $table->enum('status', [
                'Scheduled',
                'Showing',
                'Already',
            ])
                ->default('Scheduled')
                ->comment('Status of the show');

            $table->foreignId('movie_subtitle_id')
                ->nullable()
                ->index()
                ->constrained('movie_subtitles')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the movie subtitle');

            $table->foreignId('hall_id')
                ->nullable()
                ->index()
                ->constrained('halls')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the hall');

            $table->foreignId('screen_type_id')
                ->nullable()
                ->index()
                ->constrained('screen_types')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Foreign key to the screen type');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shows');
    }
};
