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
            $table->id();
            $table->string('title', length: 255)
                ->nullable(false)
                ->unique();

            $table->text('description')->nullable(false);

            $table->timestamp('release_date')
                ->nullable(false);

            $table->integer('duration')
                ->nullable(false);

            $table->decimal('rating', 3, 1)
                ->check('rating >= 0.0 and rating <= 10.0')
                ->nullable(true);

            $table->string('trailer_url', length: 255)
                ->unique();

            $table->string('thumbnail', length: 255)
                ->nullable(false)
                ->unique();


            $table->foreignId('genre_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null')
                ->onUpdate('cascade');

                $table->foreignId('production_company_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->nullable(false); 
            

            $table->foreignId('country_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreignId('classification_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null')
                ->onUpdate('cascade');

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
