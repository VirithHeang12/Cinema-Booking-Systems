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
        Schema::create('banners', function (Blueprint $table) {
            $table->id()
                ->comment('Unique identifier for the banner');

            $table->string('image_url')
                ->nullable(false)
                ->comment('URL of the banner image');
                
            $table->string('description')
                ->nullable()
                ->comment('Description of the banner');

            $table->timestamp('display_start_date')
                ->comment('Date and time when the banner should start displaying');

            $table->timestamp('display_end_date')
                ->nullable()
                ->comment('Date and time when the banner should stop displaying');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
