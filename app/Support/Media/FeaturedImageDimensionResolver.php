<?php

namespace App\Support\Media;

use App\Support\Filesystem\MediaRoot;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FeaturedImageDimensionResolver
{
    /**
     * @return array{width: int, height: int}|null
     */
    public function resolve(object $model, string $collection = 'featured_image', ?string $conversion = null): ?array
    {
        if (method_exists($model, 'getFirstMedia')) {
            $media = $model->getFirstMedia($collection);

            if ($media instanceof Media) {
                $dimensions = $this->fromMedia($media, $conversion);

                if ($dimensions !== null) {
                    return $dimensions;
                }
            }
        }

        $reference = $model->featured_image ?? null;

        if (! filled($reference)) {
            return null;
        }

        return $this->fromReference((string) $reference);
    }

    /**
     * @return array{width: int, height: int}|null
     */
    public function fromMedia(Media $media, ?string $conversion = null): ?array
    {
        $path = $this->mediaPath($media, $conversion);

        if ($path === null) {
            return null;
        }

        return $this->fromAbsolutePath($path);
    }

    /**
     * @return array{width: int, height: int}|null
     */
    public function fromReference(string $reference): ?array
    {
        $reference = trim($reference);

        if ($reference === '') {
            return null;
        }

        if (str_starts_with($reference, 'http://') || str_starts_with($reference, 'https://')) {
            $path = parse_url($reference, PHP_URL_PATH);

            return is_string($path) ? $this->fromPublicPath($path) : null;
        }

        $reference = ltrim($reference, '/');

        if (file_exists(public_path($reference))) {
            return $this->fromAbsolutePath(public_path($reference));
        }

        $mediaDisk = (string) config('media-library.disk_name', 'media');

        if (Storage::disk($mediaDisk)->exists($reference)) {
            return $this->fromAbsolutePath(Storage::disk($mediaDisk)->path($reference));
        }

        return $this->fromPublicPath('/'.$reference);
    }

    /**
     * @return array{width: int, height: int}|null
     */
    public function fromPublicPath(string $path): ?array
    {
        $path = '/'.ltrim($path, '/');
        $uploadsPrefix = rtrim((string) config('filesystems.disks.media.url', '/uploads'), '/');

        if (str_starts_with($path, $uploadsPrefix.'/')) {
            $relative = ltrim(substr($path, strlen($uploadsPrefix)), '/');

            return $this->fromAbsolutePath(MediaRoot::resolve().'/'.$relative);
        }

        if (str_starts_with($path, '/uploads/')) {
            return $this->fromAbsolutePath(MediaRoot::resolve().'/'.ltrim(substr($path, 9), '/'));
        }

        return $this->fromAbsolutePath(public_path(ltrim($path, '/')));
    }

    private function mediaPath(Media $media, ?string $conversion): ?string
    {
        if ($conversion && $media->hasGeneratedConversion($conversion)) {
            $conversionPath = $media->getPath($conversion);

            if (is_file($conversionPath)) {
                return $conversionPath;
            }
        }

        $path = $media->getPath();

        return is_file($path) ? $path : null;
    }

    /**
     * @return array{width: int, height: int}|null
     */
    private function fromAbsolutePath(string $path): ?array
    {
        if (! is_file($path)) {
            return null;
        }

        $info = @getimagesize($path);

        if ($info === false || ! isset($info[0], $info[1]) || $info[0] < 1 || $info[1] < 1) {
            return null;
        }

        return [
            'width' => (int) $info[0],
            'height' => (int) $info[1],
        ];
    }
}
