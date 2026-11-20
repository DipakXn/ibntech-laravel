<?php

namespace App\Support\MediaLibrary;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryCopier
{
    /**
     * @param  array<string, mixed>  $customProperties
     * @param  array<int, string>|null  $acceptedFileTypes
     */
    public function copy(
        Media $source,
        Model&HasMedia $destination,
        string $collection,
        array $customProperties = [],
        ?array $acceptedFileTypes = null,
        ?int $maxKilobytes = null,
    ): Media {
        if (! $destination->exists) {
            throw new InvalidArgumentException('Save the record before choosing a library file.');
        }

        $extension = MediaStoredFileName::sanitizeExtension((string) pathinfo($source->file_name, PATHINFO_EXTENSION));
        $mime = $this->detectedMime($source);
        $bytes = $this->byteSize($source);
        $message = MediaLibraryFileValidator::acceptsForDestination($extension, $mime, $bytes, $acceptedFileTypes, $maxKilobytes);

        if ($message !== null) {
            throw new InvalidArgumentException($message);
        }

        $sourcePath = $source->getPath();

        if (! is_file($sourcePath)) {
            throw new InvalidArgumentException('The selected file is no longer on disk.');
        }

        $disk = (string) config('media-library.disk_name', 'media');
        $directory = MediaPathResolver::forUpload($destination::class, $collection, $destination);
        $fileName = MediaStoredFileName::unique($disk, $directory, (string) $source->file_name);

        $properties = $customProperties;
        $properties[MediaLibraryUsage::COPIED_FROM] = $source->getKey();

        return $destination
            ->addMedia($sourcePath)
            ->preservingOriginal()
            ->usingFileName($fileName)
            ->usingName((string) ($source->name ?: pathinfo($fileName, PATHINFO_FILENAME)))
            ->withCustomProperties($properties)
            ->toMediaCollection($collection, $disk);
    }

    private function byteSize(Media $source): int
    {
        $path = $source->getPath();

        if (is_file($path)) {
            $size = filesize($path);

            if (is_int($size) && $size > 0) {
                return $size;
            }
        }

        return (int) $source->size;
    }

    private function detectedMime(Media $source): string
    {
        $stored = strtolower((string) $source->mime_type);
        $path = $source->getPath();

        if (! is_file($path)) {
            return $stored;
        }

        $detected = mime_content_type($path);

        if (! is_string($detected) || $detected === '' || $detected === 'application/octet-stream') {
            return $stored;
        }

        return strtolower($detected);
    }
}
