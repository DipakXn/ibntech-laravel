<?php

namespace App\Models;

use App\Models\Concerns\HasPublishedAt;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Newsletter extends Model implements HasMedia
{
    use HasPublishedAt;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'template',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saved(function (self $newsletter): void {
            Cache::forget("newsletter:{$newsletter->slug}");

            if ($newsletter->wasChanged('slug')) {
                Cache::forget('newsletter:'.$newsletter->getOriginal('slug'));
            }
        });

        static::deleted(function (self $newsletter): void {
            Cache::forget("newsletter:{$newsletter->slug}");
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

    public function publicUrl(): string
    {
        return url('/newsletter/'.$this->slug.'/');
    }
}
