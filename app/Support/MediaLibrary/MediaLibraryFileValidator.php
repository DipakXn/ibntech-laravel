<?php

namespace App\Support\MediaLibrary;

class MediaLibraryFileValidator
{
    public const IMAGE_MAX_KILOBYTES = 4096;

    public const PDF_MAX_KILOBYTES = 10240;

    /**
     * @var array<string, list<string>>
     */
    public const MIME_BY_EXTENSION = [
        'jpg' => ['image/jpeg'],
        'jpeg' => ['image/jpeg'],
        'png' => ['image/png'],
        'gif' => ['image/gif'],
        'webp' => ['image/webp'],
        'pdf' => ['application/pdf', 'application/x-pdf'],
    ];

    public static function rejectionMessage(string $originalName, string $extension, string $mime, int $bytes): ?string
    {
        $extension = MediaStoredFileName::sanitizeExtension($extension);
        $mime = strtolower(trim($mime));

        if ($originalName === '' || str_contains($originalName, "\0")) {
            return 'Choose a file with a normal file name.';
        }

        $allowed = self::MIME_BY_EXTENSION[$extension] ?? null;

        if ($allowed === null) {
            return 'Use a JPG, PNG, GIF, WebP, or PDF file.';
        }

        if (! in_array($mime, $allowed, true)) {
            return 'The file contents do not match the .'.$extension.' extension.';
        }

        $maxKilobytes = self::isPdf($extension) ? self::PDF_MAX_KILOBYTES : self::IMAGE_MAX_KILOBYTES;

        if ($bytes < 1) {
            return 'The file is empty.';
        }

        if ($bytes > ($maxKilobytes * 1024)) {
            $limit = $maxKilobytes >= 1024 ? ($maxKilobytes / 1024).' MB' : $maxKilobytes.' KB';

            return 'The file is larger than '.$limit.'.';
        }

        return null;
    }

    /**
     * @param  array<int, string>|null  $acceptedFileTypes
     */
    public static function acceptsForDestination(string $extension, string $mime, int $bytes, ?array $acceptedFileTypes, ?int $maxKilobytes): ?string
    {
        $base = self::rejectionMessage('library-file.'.$extension, $extension, $mime, $bytes);

        if ($base !== null) {
            return $base;
        }

        if (! self::matchesAcceptedTypes($extension, $mime, $acceptedFileTypes)) {
            return self::isPdf($extension)
                ? 'Choose an image for this field.'
                : 'Choose a PDF for this field.';
        }

        if ($maxKilobytes !== null && $bytes > ($maxKilobytes * 1024)) {
            return 'The file is larger than the limit for this field.';
        }

        return null;
    }

    /**
     * @return list<string>
     */
    public static function acceptedMimeTypes(): array
    {
        return array_values(array_unique(array_merge(...array_values(self::MIME_BY_EXTENSION))));
    }

    /**
     * @param  array<int, string>|null  $acceptedFileTypes
     */
    private static function matchesAcceptedTypes(string $extension, string $mime, ?array $acceptedFileTypes): bool
    {
        if ($acceptedFileTypes === null || $acceptedFileTypes === []) {
            return true;
        }

        $pdf = self::isPdf($extension);
        $image = ! $pdf;

        foreach ($acceptedFileTypes as $type) {
            $type = strtolower($type);

            if ($type === 'image/*' && $image) {
                return true;
            }

            if ($type === $mime) {
                return true;
            }

            if ($pdf && in_array($type, ['application/pdf', 'application/x-pdf', '.pdf'], true)) {
                return true;
            }
        }

        return false;
    }

    private static function isPdf(string $extension): bool
    {
        return $extension === 'pdf';
    }
}
