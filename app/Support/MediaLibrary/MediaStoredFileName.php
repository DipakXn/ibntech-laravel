<?php

namespace App\Support\MediaLibrary;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaStoredFileName
{
    public static function unique(string $disk, string $directory, string $originalName): string
    {
        $baseName = self::sanitizeBaseName(pathinfo($originalName, PATHINFO_FILENAME));
        $extension = self::sanitizeExtension(pathinfo($originalName, PATHINFO_EXTENSION));
        $candidate = self::appendExtension($baseName, $extension);
        $sequence = 1;

        while (Storage::disk($disk)->exists(trim($directory.'/'.$candidate, '/'))) {
            $candidate = self::appendExtension(sprintf('%s-%02d', $baseName, $sequence), $extension);
            $sequence++;
        }

        return $candidate;
    }

    public static function sanitizeBaseName(string $baseName): string
    {
        $sanitized = Str::of($baseName)
            ->ascii()
            ->replaceMatches('/[^A-Za-z0-9]+/', '-')
            ->trim('-')
            ->lower()
            ->toString();

        return $sanitized !== '' ? $sanitized : 'file';
    }

    public static function sanitizeExtension(string $extension): string
    {
        return Str::of($extension)
            ->replaceMatches('/[^A-Za-z0-9]+/', '')
            ->lower()
            ->toString();
    }

    public static function appendExtension(string $fileName, string $extension): string
    {
        return $extension !== '' ? "{$fileName}.{$extension}" : $fileName;
    }
}
