<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SeoMeta extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'seo_meta';

    protected $fillable = [
        'metable_id',
        'metable_type',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'focus_keyword',
        'seo_score',

        'og_title',
        'og_description',
        'og_image',
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

        'canonical_url',
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
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'modified_at' => 'datetime',
        'article_tags' => 'array',
        'sitemap_include' => 'boolean',
        'schema_generated' => 'boolean',
        'faq_schema' => 'boolean',
        'reading_time' => 'integer',
        'seo_score' => 'integer',
    ];

    public function metable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->latest('created_at');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('og_image')
            ->useDisk('public')
            ->singleFile();

        $this
            ->addMediaCollection('twitter_image')
            ->useDisk('public')
            ->singleFile();
    }

    public function ogImageUrl(): ?string
    {
        $mediaUrl = $this->getFirstMediaUrl('og_image');

        if (! empty($mediaUrl)) {
            return $mediaUrl;
        }

        return $this->og_image;
    }

    public function twitterImageUrl(): ?string
    {
        $mediaUrl = $this->getFirstMediaUrl('twitter_image');

        if (! empty($mediaUrl)) {
            return $mediaUrl;
        }

        return $this->twitter_image;
    }
}

