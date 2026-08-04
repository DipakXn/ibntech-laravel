<?php

namespace App\Support\MediaLibrary;

use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    /**
     * @var array<string, string>
     */
    protected static array $resolvedBases = [];

    /**
     * Store original media under a purpose-based directory.
     * Existing legacy layouts continue to resolve correctly until reorganized.
     */
    public function getPath(Media $media): string
    {
        return $this->resolveBasePath($media).'/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->resolveBasePath($media).'/conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->resolveBasePath($media).'/responsive-images/';
    }

    protected function resolveBasePath(Media $media): string
    {
        $cacheKey = implode('|', [
            (string) $media->getKey(),
            (string) $media->disk,
            (string) $media->file_name,
            (string) $media->collection_name,
        ]);

        if (isset(static::$resolvedBases[$cacheKey])) {
            return static::$resolvedBases[$cacheKey];
        }

        $purposePath = MediaPathResolver::forMedia($media);

        if (! $media->exists || blank($media->file_name) || blank($media->disk)) {
            return static::$resolvedBases[$cacheKey] = $purposePath;
        }

        $disk = Storage::disk($media->disk);
        $candidates = $this->legacyBaseCandidates($media, $purposePath);

        foreach ($candidates as $candidate) {
            if ($disk->exists(trim($candidate.'/'.$media->file_name, '/'))) {
                return static::$resolvedBases[$cacheKey] = $candidate;
            }
        }

        return static::$resolvedBases[$cacheKey] = $purposePath;
    }

    /**
     * @return array<int, string>
     */
    protected function legacyBaseCandidates(Media $media, string $purposePath): array
    {
        $datePath = $media->created_at?->format('Y/m');
        $prefix = trim((string) config('media-library.prefix', ''), '/');

        $candidates = [
            $purposePath,
        ];

        if ($datePath) {
            $candidates[] = $prefix !== '' ? "{$prefix}/{$datePath}" : "media/{$datePath}";
            $candidates[] = "media/{$datePath}";
        }

        if ($media->getKey()) {
            $candidates[] = (string) $media->getKey();
        }

        return array_values(array_unique(array_filter($candidates)));
    }
}
