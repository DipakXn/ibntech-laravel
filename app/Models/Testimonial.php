<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Throwable;

class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const STATUS_PUBLISHED = 'published';

    public const STATUS_UNPUBLISHED = 'unpublished';

    protected $fillable = [
        'customer_name',
        'designation',
        'company_name',
        'quote',
        'rating',
        'page_id',
        'status',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function servicePage(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function placements(): HasMany
    {
        return $this->hasMany(TestimonialPlacement::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query
            ->where('status', self::STATUS_PUBLISHED)
            ->where('is_active', true);
    }

    public function roleLine(): string
    {
        return $this->joinParts([$this->designation, $this->company_name]);
    }

    public function citeLine(): string
    {
        return $this->joinParts([$this->customer_name, $this->designation, $this->company_name]);
    }

    public function clientImageUrl(): ?string
    {
        $media = $this->getFirstMedia('client_image');

        if (! $media instanceof Media) {
            return null;
        }

        try {
            $exists = Storage::disk($media->disk)->exists($media->getPathRelativeToRoot());
        } catch (Throwable) {
            return null;
        }

        if (! $exists) {
            return null;
        }

        $url = $media->getUrl();

        return $url !== '' ? $url : null;
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('client_image')
            ->useDisk((string) config('media-library.disk_name', 'media'))
            ->singleFile();
    }

    /**
     * @param  list<string|null>  $parts
     */
    private function joinParts(array $parts): string
    {
        $present = [];

        foreach ($parts as $part) {
            $part = trim((string) $part);

            if ($part !== '') {
                $present[] = $part;
            }
        }

        return implode(', ', $present);
    }
}
