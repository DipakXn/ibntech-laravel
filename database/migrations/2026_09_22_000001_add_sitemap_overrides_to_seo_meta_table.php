<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seo_meta', function (Blueprint $table) {
            $table->string('sitemap_changefreq')->nullable();
            $table->string('sitemap_priority', 3)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('seo_meta', function (Blueprint $table) {
            $table->dropColumn([
                'sitemap_changefreq',
                'sitemap_priority',
            ]);
        });
    }
};
