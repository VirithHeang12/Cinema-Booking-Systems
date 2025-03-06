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
        Schema::create('screen_types', function (Blueprint $table) {
            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for the screen type');

            $table->string('name')
                ->nullable(false)
                ->unique()
                ->comment('Name of the screen type');

            $table->text('description')
                ->nullable(true)
                ->comment('Description of the screen type');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screen_types');
    }
};
