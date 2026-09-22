<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->boolean('sitemap_enabled')->default(true)->after('robots_txt');
            $table->boolean('sitemap_include_lastmod')->default(true)->after('sitemap_enabled');
            $table->boolean('sitemap_include_changefreq')->default(false)->after('sitemap_include_lastmod');
            $table->boolean('sitemap_include_priority')->default(false)->after('sitemap_include_changefreq');
            $table->boolean('sitemap_add_to_robots')->default(true)->after('sitemap_include_priority');
            $table->unsignedInteger('sitemap_cache_ttl')->default(3600)->after('sitemap_add_to_robots');
            $table->json('sitemap_types')->nullable()->after('sitemap_cache_ttl');
            $table->json('sitemap_custom_urls')->nullable()->after('sitemap_types');
        });
    }

    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn([
                'sitemap_enabled',
                'sitemap_include_lastmod',
                'sitemap_include_changefreq',
                'sitemap_include_priority',
                'sitemap_add_to_robots',
                'sitemap_cache_ttl',
                'sitemap_types',
                'sitemap_custom_urls',
            ]);
        });
    }
};
