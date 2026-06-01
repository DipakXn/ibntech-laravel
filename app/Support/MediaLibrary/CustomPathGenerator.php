<?php

namespace App\Support\MediaLibrary;

use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    /**
     * Store original media in a WordPress-style year/month directory.
     */
    public function getPath(Media $media): string
    {
        return $this->buildBasePath($media).'/';
    }

    /**
     * Keep conversions grouped by the same year/month bucket in a dedicated
     * subdirectory to avoid cluttering the original media directory.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->buildBasePath($media).'/conversions/';
    }

    /**
     * Keep responsive images in a dedicated year/month subdirectory for
     * predictable paths and simpler housekeeping.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->buildBasePath($media).'/responsive-images/';
    }

    protected function buildBasePath(Media $media): string
    {
        $prefix = trim((string) config('media-library.prefix', 'media'), '/');
        $segments = static::resolveDatePathSegments($this->resolveMediaDate($media));

        if ($prefix !== '') {
            array_unshift($segments, $prefix);
        }

        return implode('/', array_map(
            static fn (string|int $segment): string => trim((string) $segment, '/'),
            $segments,
        ));
    }

    public static function resolveDatePathSegments(Carbon $date): array
    {
        return [
            $date->format('Y'),
            $date->format('m'),
        ];
    }

    protected function resolveMediaDate(Media $media): Carbon
    {
        if ($media->created_at instanceof Carbon) {
            return $media->created_at;
        }

        if (! empty($media->created_at)) {
            return Carbon::parse($media->created_at);
        }

        return now();
    }
}
