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
        Schema::create('releases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('original_title');
            $table->char('type');
            $table->integer('release_year')->nullable();
            $table->char('release_season')->nullable();
            $table->char('release_season_slug')->nullable();
            $table->string('production_studio');
            $table->smallInteger('episodes_released')->nullable();
            $table->smallInteger('total_episodes')->nullable();
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->float('rating')->nullable();
            $table->string('slug')->nullable();
            $table->string('votes_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('releases');
    }
};
