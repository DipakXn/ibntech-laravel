<?php

namespace App\Services\WordPress;

use Illuminate\Support\Str;

class PressReleasePermalink
{
    public static function normalize(?string $permalink): string
    {
        $permalink = trim((string) $permalink);

        if ($permalink === '') {
            return '';
        }

        $parts = parse_url($permalink);
        $host = strtolower((string) ($parts['host'] ?? ''));
        $path = rtrim((string) ($parts['path'] ?? ''), '/');

        if ($host === '' && $path === '') {
            return rtrim($permalink, '/');
        }

        return $host.$path;
    }

    public static function slug(?string $permalink, string $title = ''): string
    {
        $path = (string) parse_url((string) $permalink, PHP_URL_PATH);
        $slug = trim((string) basename(rtrim($path, '/')), '/');

        if ($slug === '' && $title !== '') {
            $slug = Str::slug($title);
        }

        return $slug !== '' ? $slug : 'press-release';
    }

    public static function publicPath(string $slug): string
    {
        return '/pressrelease/'.trim($slug, '/').'/';
    }
}
