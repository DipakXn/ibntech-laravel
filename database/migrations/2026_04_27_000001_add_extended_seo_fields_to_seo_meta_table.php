<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seo_meta', function (Blueprint $table) {
            $table->string('meta_keywords')->nullable()->after('meta_description');
            $table->string('focus_keyword')->nullable()->after('meta_keywords');
            $table->integer('seo_score')->nullable()->after('focus_keyword');

            $table->string('og_image_alt')->nullable()->after('og_image');
            $table->string('og_type')->nullable()->after('og_image_alt');
            $table->string('og_site_name')->nullable()->after('og_type');
            $table->string('og_locale')->nullable()->after('og_site_name');

            $table->string('twitter_card_type')->nullable()->after('og_locale');
            $table->string('twitter_title')->nullable()->after('twitter_card_type');
            $table->text('twitter_description')->nullable()->after('twitter_title');
            $table->string('twitter_image')->nullable()->after('twitter_description');
            $table->string('twitter_creator')->nullable()->after('twitter_image');
            $table->string('twitter_site')->nullable()->after('twitter_creator');

            $table->string('robots_index')->nullable()->default('index')->after('canonical_url');
            $table->string('robots_follow')->nullable()->default('follow')->after('robots_index');
            $table->string('robots_max_snippet')->nullable()->after('robots_follow');
            $table->string('robots_max_image_preview')->nullable()->after('robots_max_snippet');
            $table->string('custom_meta_robots')->nullable()->after('robots_max_image_preview');

            $table->string('article_author')->nullable()->after('custom_meta_robots');
            $table->unsignedBigInteger('article_author_id')->nullable()->after('article_author');
            $table->dateTime('published_at')->nullable()->after('article_author_id');
            $table->dateTime('modified_at')->nullable()->after('published_at');
            $table->string('article_section')->nullable()->after('modified_at');
            $table->json('article_tags')->nullable()->after('article_section');
            $table->integer('reading_time')->nullable()->after('article_tags');

            $table->longText('json_ld')->nullable()->after('reading_time');
            $table->boolean('schema_generated')->default(false)->after('json_ld');
            $table->boolean('faq_schema')->default(false)->after('schema_generated');

            $table->boolean('sitemap_include')->default(true)->after('faq_schema');
            $table->string('redirect_url')->nullable()->after('sitemap_include');
            $table->text('custom_head_code')->nullable()->after('redirect_url');
        });
    }

    public function down(): void
    {
        Schema::table('seo_meta', function (Blueprint $table) {
            $table->dropColumn([
                'meta_keywords',
                'focus_keyword',
                'seo_score',
                'og_image_alt',
                'og_type',
                'og_site_name',
                'og_locale',
                'twitter_card_type',
                'twitter_title',
                'twitter_description',
                'twitter_image',
                'twitter_creator',
                'twitter_site',
                'robots_index',
                'robots_follow',
                'robots_max_snippet',
                'robots_max_image_preview',
                'custom_meta_robots',
                'article_author',
                'article_author_id',
                'published_at',
                'modified_at',
                'article_section',
                'article_tags',
                'reading_time',
                'json_ld',
                'schema_generated',
                'faq_schema',
                'sitemap_include',
                'redirect_url',
                'custom_head_code',
            ]);
        });
    }
};
