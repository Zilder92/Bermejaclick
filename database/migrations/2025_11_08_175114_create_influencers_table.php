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
        Schema::create('influencers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('nickname')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('specialty')->nullable(); // Comida, Turismo, Moda, Lifestyle, etc.
            $table->json('social_media')->nullable(); // Instagram, TikTok, YouTube, Facebook
            $table->integer('instagram_followers')->default(0);
            $table->integer('tiktok_followers')->default(0);
            $table->integer('youtube_subscribers')->default(0);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->default('Barrancabermeja');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('views_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('influencers');
    }
};
