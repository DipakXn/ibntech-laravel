<?php

namespace App\Models;

use App\Models\Concerns\HasBlockContent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WhitePaper extends Model implements HasMedia
{
    use HasBlockContent;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'template',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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
            ->useDisk('public')
            ->singleFile();

        $this
            ->addMediaCollection('content_blocks')
            ->useDisk('public');
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

        return Storage::disk('public')->url(ltrim($this->featured_image, '/'));
    }
}
