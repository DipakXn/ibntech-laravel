<?php

namespace App\Support;

class ApplicationUrl
{
    /**
     * Public canonical for the current environment.
     *
     * Same-site stored values keep their path and query, but the origin follows
     * APP_URL. A canonical on any other host is left unchanged.
     */
    public static function canonical(?string $stored): string
    {
        $stored = trim((string) $stored);

        if ($stored === '' || self::isSameSiteUrl($stored)) {
            return self::toApplicationUrl($stored) ?? url()->current();
        }

        return $stored;
    }

    public static function isSameSiteUrl(string $url): bool
    {
        $host = parse_url(trim($url), PHP_URL_HOST);

        return is_string($host) && $host !== '' && self::isSameSiteHost($host);
    }

    public static function isSameSiteHost(string $host): bool
    {
        $host = strtolower($host);

        if (str_starts_with($host, '[') && str_ends_with($host, ']')) {
            $host = substr($host, 1, -1);
        }

        if (in_array($host, ['localhost', '127.0.0.1', '::1', 'ibntech.com', 'www.ibntech.com', 'dev.ibntech.com'], true)) {
            return true;
        }

        if (str_ends_with($host, '.ibntech.com')) {
            return true;
        }

        $appHost = strtolower((string) parse_url((string) config('app.url'), PHP_URL_HOST));

        return $appHost !== '' && $host === $appHost;
    }

    /**
     * Rebuild a same-site URL on the current application origin.
     * Relative paths are resolved with url(). External URLs are returned as given.
     */
    public static function toApplicationUrl(?string $url): ?string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return null;
        }

        if (str_starts_with($url, '/') && ! str_starts_with($url, '//')) {
            return self::appendRequestParts(url($url), null, null);
        }

        $parts = parse_url($url);

        if (! is_array($parts) || empty($parts['host']) || ! self::isSameSiteHost((string) $parts['host'])) {
            return $url;
        }

        $path = (string) ($parts['path'] ?? '/');

        if ($path === '') {
            $path = '/';
        }

        return self::appendRequestParts(
            url($path),
            isset($parts['query']) ? (string) $parts['query'] : null,
            isset($parts['fragment']) ? (string) $parts['fragment'] : null,
        );
    }

    private static function appendRequestParts(string $url, ?string $query, ?string $fragment): string
    {
        if ($query !== null && $query !== '') {
            $url .= (str_contains($url, '?') ? '&' : '?').$query;
        }

        if ($fragment !== null && $fragment !== '') {
            $url .= '#'.$fragment;
        }

        return $url;
    }
}
