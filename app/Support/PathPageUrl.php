<?php

namespace App\Support;

class PathPageUrl
{
    public static function forRoute(string $indexRoute, string $pageRoute, int $page = 1, array $parameters = []): string
    {
        $url = $page > 1
            ? route($pageRoute, array_merge($parameters, ['page' => $page]))
            : route($indexRoute, $parameters);

        return self::withTrailingSlash($url);
    }

    public static function withTrailingSlash(string $url): string
    {
        $fragment = '';
        if (str_contains($url, '#')) {
            [$url, $fragment] = explode('#', $url, 2);
            $fragment = '#'.$fragment;
        }

        $query = '';
        if (str_contains($url, '?')) {
            [$url, $query] = explode('?', $url, 2);
            $query = '?'.$query;
        }

        if ($url === '' || str_ends_with($url, '/')) {
            return $url.$query.$fragment;
        }

        return $url.'/'.$query.$fragment;
    }

    /**
     * Public content URLs use a trailing slash. Admin, Livewire, assets,
     * signed preview URLs, and signed download endpoints do not.
     */
    public static function shouldAppendTrailingSlash(string $path): bool
    {
        $path = '/'.trim(explode('?', $path, 2)[0], '/');

        if ($path === '/') {
            return false;
        }

        $segments = explode('/', trim($path, '/'));
        $first = strtolower($segments[0] ?? '');

        if (in_array($first, ['admin', 'ibn-tech-cms-login', 'livewire', 'preview', 'telescope', 'horizon', 'vendor'], true)
            || str_starts_with($first, 'livewire-')) {
            // 'livewire-' prefix covers Livewire 4's hashed endpoint (e.g. livewire-4e37d65f/upload-file).
            // Without this guard the trailing slash is baked into the HMAC-signed URL but stripped by
            // request()->url() at validation time, causing a 401 on every temporary file upload.
            return false;
        }

        $last = $segments[array_key_last($segments)] ?? '';

        if ($last !== '' && preg_match('/\.[A-Za-z0-9]{1,10}$/', $last)) {
            return false;
        }

        return strcasecmp($last, 'download') !== 0;
    }
}
