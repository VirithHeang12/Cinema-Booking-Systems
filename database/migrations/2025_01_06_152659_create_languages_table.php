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
        Schema::create('languages', function (Blueprint $table) {
            $table->id()
                ->comment('Unique identifier for the language');

            $table->string('name')
                ->nullable(false)
                ->unique()
                ->comment('Name of the language');

            $table->string('code')
                ->nullable(false)
                ->unique()
                ->comment('Code of the language');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
