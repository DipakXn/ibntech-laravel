<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_name')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('tagline')->nullable();

            $table->string('default_meta_title')->nullable();
            $table->text('default_meta_description')->nullable();
            $table->string('default_meta_keywords')->nullable();
            $table->string('default_locale', 20)->nullable();

            $table->string('og_site_name')->nullable();
            $table->string('og_type', 50)->default('website');
            $table->string('og_locale', 20)->nullable();
            $table->string('og_image_alt')->nullable();

            $table->string('twitter_card_type', 50)->default('summary_large_image');
            $table->string('twitter_site', 100)->nullable();
            $table->string('twitter_creator', 100)->nullable();

            $table->string('robots_index', 20)->default('index');
            $table->string('robots_follow', 20)->default('follow');
            $table->string('robots_max_snippet', 10)->nullable();
            $table->string('robots_max_image_preview', 20)->default('large');
            $table->string('custom_meta_robots')->nullable();
            $table->longText('robots_txt')->nullable();

            $table->string('contact_email')->nullable();
            $table->json('header_phones')->nullable();
            $table->json('offices')->nullable();

            $table->string('social_facebook')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_youtube')->nullable();

            $table->string('google_analytics_id')->nullable();
            $table->string('google_tag_manager_id')->nullable();
            $table->string('google_site_verification')->nullable();
            $table->string('bing_site_verification')->nullable();
            $table->longText('custom_head_code')->nullable();
            $table->longText('custom_body_end_code')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
