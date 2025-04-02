<?php

use App\Models\Genre;
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
        Schema::create('movies', function (Blueprint $table) {
            $table->id()
                ->comment('Unique identifier for the movie');

            $table->string('title')
                ->nullable(false)
                ->unique()
                ->comment('Title of the movie');

            $table->text('description')
                ->nullable(false)
                ->comment('Description of the movie');

            $table->timestamp('release_date')
                ->nullable(false)
                ->comment('Release date of the movie');

            $table->integer('duration')
                ->nullable(false)
                ->comment('Duration of the movie in minutes');

            $table->decimal('rating', 3, 1)
                ->check('rating >= 0.0 and rating <= 10.0')
                ->nullable(true)
                ->comment('Rating of the movie');

            $table->string('trailer_url')
                ->unique()
                ->comment('URL of the trailer of the movie');

            $table->string('thumbnail_url')
                ->nullable(false)
                ->unique()
                ->comment('URL of the thumbnail of the movie');

            $table->foreignId('country_id')
                ->nullable()
                ->index()
                ->constrained('countries')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Country where the movie was produced');

            $table->foreignId('classification_id')
                ->nullable()
                ->index()
                ->constrained('classifications')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Classification of the movie');

            $table->foreignId('spoken_language_id')
                ->nullable()
                ->index()
                ->constrained('languages')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('Language of the movie');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
