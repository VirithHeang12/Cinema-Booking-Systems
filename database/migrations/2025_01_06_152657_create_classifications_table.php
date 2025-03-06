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
        Schema::create('classifications', function (Blueprint $table) {
            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for the classification');

            $table->string('name')
                ->nullable(false)
                ->unique()
                ->comment('Name of the classification');

            $table->text('description')
                ->nullable(false)
                ->comment('Description of the classification');
                
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifications');
    }
};
