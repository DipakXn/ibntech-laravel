<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class LandingPage extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'template',
        'thank_you_slug',
        'status',
    ];

    protected static function booted(): void
    {
        static::saved(function (self $page): void {
            Cache::forget("landing-page:{$page->slug}");

            if ($page->wasChanged('slug')) {
                Cache::forget('landing-page:'.$page->getOriginal('slug'));
            }
        });

        static::deleted(function (self $page): void {
            Cache::forget("landing-page:{$page->slug}");
        });
    }

    public function seoMeta(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'metable');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->latest('created_at');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('featured_image')
            ->useDisk((string) config('media-library.disk_name', 'media'))
            ->singleFile();
    }

    public function featuredImageUrl(): ?string
    {
        return $this->getFirstMediaUrl('featured_image') ?: null;
    }

    public function isThankYouPage(): bool
    {
        return $this->slug === 'thank-you' || str_ends_with($this->slug, '-thank-you');
    }

    protected function thankYouSlug(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value): ?string => $value === '' ? null : $value,
        );
    }

    public function formName(): string
    {
        return 'lp-'.$this->slug;
    }

    public function publicUrl(): string
    {
        return url('/lp/'.$this->slug.'/');
    }

    public function publishedThankYouUrl(): ?string
    {
        if (! is_string($this->thank_you_slug) || $this->thank_you_slug === '') {
            return null;
        }

        $thankYouPage = static::query()
            ->published()
            ->where('slug', $this->thank_you_slug)
            ->first();

        return $thankYouPage?->publicUrl();
    }
}
