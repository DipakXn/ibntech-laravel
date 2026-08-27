<?php

namespace App\Models;

use App\Models\Concerns\HasAdditionalAssets;
use App\Models\Concerns\HasBlockContent;
use App\Models\Concerns\HasPublishedAt;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PressRelease extends Model implements HasMedia
{
    use HasAdditionalAssets;
    use HasBlockContent {
        HasBlockContent::casts as blockContentCasts;
    }
    use HasPublishedAt;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'template',
        'excerpt',
        'content',
        'additional_css',
        'additional_js',
        'featured_image',
        'category_id',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return array_merge($this->blockContentCasts(), [
            'published_at' => 'datetime',
        ]);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function seoMeta(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'metable');
    }

    public function wordpressImport(): HasOne
    {
        return $this->hasOne(PressReleaseImport::class);
    }

    public function isImportedFromWordPress(): bool
    {
        if ($this->relationLoaded('wordpressImport')) {
            return $this->wordpressImport !== null;
        }

        return $this->wordpressImport()->exists();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('featured_image')
            ->useDisk((string) config('media-library.disk_name', 'media'))
            ->singleFile();

        $this
            ->addMediaCollection('content_blocks')
            ->useDisk((string) config('media-library.disk_name', 'media'));
    }

    public function featuredImageUrl(): ?string
    {
        $mediaUrl = $this->getFirstMediaUrl('featured_image');

        if ($mediaUrl) {
            return $mediaUrl;
        }

        if (! $this->featured_image) {
            return null;
        }

        if (str_starts_with($this->featured_image, 'http://') || str_starts_with($this->featured_image, 'https://')) {
            return $this->featured_image;
        }

        return Storage::disk((string) config('media-library.disk_name', 'media'))->url(ltrim($this->featured_image, '/'));
    }
}
