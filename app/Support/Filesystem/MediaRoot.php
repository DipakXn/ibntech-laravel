<?php

namespace App\Support\Filesystem;

/**
 * Resolves MEDIA_ROOT to an absolute path without hardcoding server locations.
 *
 * Relative values (e.g. "public/uploads") are resolved from the application base path.
 * Absolute values (Unix or Windows) are used as-is for cPanel document roots.
 */
class MediaRoot
{
    public static function resolve(?string $root = null): string
    {
        $root = $root ?? env('MEDIA_ROOT', 'public/uploads');
        $root = trim((string) $root);

        if ($root === '') {
            return public_path('uploads');
        }

        if (static::isAbsolutePath($root)) {
            return rtrim(str_replace('\\', '/', $root), '/');
        }

        return rtrim(str_replace('\\', '/', base_path($root)), '/');
    }

    public static function isAbsolutePath(string $path): bool
    {
        if (str_starts_with($path, '/') || str_starts_with($path, '\\')) {
            return true;
        }

        // Windows drive letter paths: C:\... or C:/...
        return (bool) preg_match('/^[A-Za-z]:[\\\\\\/]/', $path);
    }
}
