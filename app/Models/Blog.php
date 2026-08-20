<?php

namespace App\Models;

use App\Models\Concerns\HasBlockContent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasBlockContent;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'template',
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

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('featured_image')
            ->useDisk((string) config('media-library.disk_name', 'media'))
            ->withResponsiveImages()
            ->singleFile();

        $this
            ->addMediaCollection('content_blocks')
            ->useDisk((string) config('media-library.disk_name', 'media'))
            ->withResponsiveImages();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('hero')
            ->performOnCollections('featured_image')
            ->format('webp')
            ->fit(Fit::Crop, 1600, 900)
            ->quality(82)
            ->queued()
            ->withResponsiveImages();

        $this
            ->addMediaConversion('thumb')
            ->performOnCollections('featured_image', 'content_blocks')
            ->format('webp')
            ->fit(Fit::Crop, 480, 320)
            ->quality(80)
            ->queued();
    }

    public function featuredImageUrl(?string $conversion = null): ?string
    {
        $media = $this->getFirstMedia('featured_image');

        $mediaUrl = $media
            ? $this->resolveMediaUrl($media, $conversion)
            : null;

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

    protected function resolveMediaUrl(Media $media, ?string $conversion = null): ?string
    {
        $diskName = $conversion
            ? ($media->conversions_disk ?: $media->disk)
            : $media->disk;
        $disk = Storage::disk($diskName);

        if ($conversion) {
            if ($media->hasGeneratedConversion($conversion) && $disk->exists($media->getPathRelativeToRoot($conversion))) {
                return $media->getUrl($conversion);
            }
        } elseif ($disk->exists($media->getPathRelativeToRoot())) {
            return $media->getUrl();
        }

        // Legacy layouts: media/{YYYY}/{MM}/... and Spatie default {id}/...
        $legacyCandidates = array_filter([
            $conversion
                ? "media/{$media->created_at?->format('Y/m')}/conversions/{$media->file_nameWithoutExtension}-{$conversion}.{$media->extension}"
                : "media/{$media->created_at?->format('Y/m')}/{$media->file_name}",
            $this->resolveLegacyMediaRelativePath($media, $conversion),
        ]);

        foreach ($legacyCandidates as $legacyRelativePath) {
            if ($disk->exists($legacyRelativePath)) {
                return $disk->url($legacyRelativePath);
            }
        }

        return null;
    }

    protected function resolveLegacyMediaRelativePath(Media $media, ?string $conversion = null): ?string
    {
        if ($conversion) {
            return "{$media->getKey()}/conversions/{$media->file_nameWithoutExtension}-{$conversion}.{$media->extension}";
        }

        return "{$media->getKey()}/{$media->file_name}";
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->latest('created_at');
    }
}
