<?php

namespace App\Support\Sitemap;

use App\Support\PathPageUrl;

class SitemapUrlNormalizer
{
    /**
     * Compare a CMS public URL with a stored canonical URL.
     *
     * Query strings and fragments are ignored so tracking variants do not
     * exclude a valid page. Encoded path separators (%2F) are kept intact.
     */
    public static function cmsUrlsMatch(string $publicUrl, string $canonicalUrl): bool
    {
        $left = self::comparisonParts($publicUrl, stripQuery: true);
        $right = self::comparisonParts($canonicalUrl, stripQuery: true);

        if ($left === null || $right === null) {
            return false;
        }

        return $left['scheme'] === $right['scheme']
            && $left['host'] === $right['host']
            && $left['port'] === $right['port']
            && $left['path'] === $right['path'];
    }

    /**
     * Whether a stored canonical refers to the same CMS page path as the public URL.
     */
    public static function cmsPathsMatch(string $publicUrl, string $canonicalUrl): bool
    {
        $left = self::comparisonParts($publicUrl, stripQuery: true);
        $right = self::comparisonParts($canonicalUrl, stripQuery: true);

        if ($left === null || $right === null) {
            return false;
        }

        return $left['path'] === $right['path'];
    }

    /**
     * Whether a stored canonical allows the CMS public URL in the sitemap.
     *
     * Paths must match. Cross-host canonicals are allowed on non-production APP_URL
     * hosts (local/staging) so imported production SEO data remains usable. On
     * production, a canonical on a different host excludes the URL.
     */
    public static function cmsCanonicalMatchesPublicUrl(string $publicUrl, string $canonicalUrl): bool
    {
        if (! self::cmsPathsMatch($publicUrl, $canonicalUrl)) {
            return false;
        }

        if (self::cmsUrlsMatch($publicUrl, $canonicalUrl)) {
            return true;
        }

        $publicParts = self::comparisonParts($publicUrl, stripQuery: true);
        $canonicalParts = self::comparisonParts($canonicalUrl, stripQuery: true);
        $appBase = self::applicationBase();

        if ($publicParts === null || $canonicalParts === null) {
            return false;
        }

        if ($canonicalParts['host'] === $publicParts['host']
            && self::hostMatchesApplication($publicParts, $appBase)) {
            return true;
        }

        return self::isNonProductionApplicationHost($appBase['host']);
    }

    /**
     * @param  array{host: string}  $parts
     * @param  array{host: string}  $appBase
     */
    private static function hostMatchesApplication(array $parts, array $appBase): bool
    {
        return $parts['host'] === strtolower($appBase['host']);
    }

    private static function isNonProductionApplicationHost(string $host): bool
    {
        $host = strtolower($host);

        if (in_array($host, ['localhost', '127.0.0.1', '[::1]'], true)) {
            return true;
        }

        if (str_ends_with($host, '.test') || str_ends_with($host, '.localhost') || str_ends_with($host, '.local')) {
            return true;
        }

        return str_contains($host, 'staging');
    }

    /**
     * Build a sitemap <loc> for a CMS-generated URL (no query/fragment).
     */
    public static function cmsLoc(string $url): ?string
    {
        return self::absoluteLoc($url, preserveQuery: false);
    }

    /**
     * Build a sitemap <loc> for an admin custom URL, preserving query strings.
     */
    public static function customLoc(string $url): ?string
    {
        return self::absoluteLoc($url, preserveQuery: true);
    }

    public static function absoluteLoc(string $url, bool $preserveQuery): ?string
    {
        $parts = self::comparisonParts($url, stripQuery: ! $preserveQuery);

        if ($parts === null) {
            return null;
        }

        $loc = $parts['scheme'].'://'.$parts['host'];

        if ($parts['port'] !== null) {
            $loc .= ':'.$parts['port'];
        }

        $loc .= $parts['path'];

        if ($preserveQuery && $parts['query'] !== null && $parts['query'] !== '') {
            $loc .= '?'.$parts['query'];
        }

        return $loc;
    }

    /**
     * @return array{scheme: string, host: string, port: ?int, path: string, query: ?string}|null
     */
    public static function comparisonParts(string $url, bool $stripQuery): ?array
    {
        $url = trim($url);

        if ($url === '') {
            return null;
        }

        if (preg_match('/^(javascript|data|vbscript):/i', $url) === 1) {
            return null;
        }

        $base = self::applicationBase();

        if (str_starts_with($url, '//')) {
            $url = ($base['scheme'] ?? 'https').':'.$url;
        } elseif (str_starts_with($url, '/')) {
            $url = $base['origin'].$url;
        } elseif (! preg_match('#^https?://#i', $url)) {
            $url = $base['origin'].'/'.ltrim($url, '/');
        }

        $parsed = parse_url($url);

        if (! is_array($parsed) || empty($parsed['host'])) {
            return null;
        }

        $scheme = strtolower((string) ($parsed['scheme'] ?? $base['scheme']));

        if (! in_array($scheme, ['http', 'https'], true)) {
            return null;
        }

        $host = strtolower((string) $parsed['host']);
        $port = isset($parsed['port']) ? (int) $parsed['port'] : null;

        if (($scheme === 'http' && $port === 80) || ($scheme === 'https' && $port === 443)) {
            $port = null;
        }

        $path = self::normalizePath((string) ($parsed['path'] ?? '/'));
        $query = $stripQuery ? null : ($parsed['query'] ?? null);

        return [
            'scheme' => $scheme,
            'host' => $host,
            'port' => $port,
            'path' => $path,
            'query' => $query === '' ? null : $query,
        ];
    }

    /**
     * Normalize a URL path without decoding percent-encoded octets.
     * `/foo%2Fbar` stays `/foo%2Fbar` and is not treated as `/foo/bar`.
     */
    public static function normalizePath(string $path): string
    {
        if ($path === '') {
            $path = '/';
        }

        if (! str_starts_with($path, '/')) {
            $path = '/'.$path;
        }

        $path = preg_replace('#/{2,}#', '/', $path) ?? $path;

        if ($path === '/') {
            return '/';
        }

        if (PathPageUrl::shouldAppendTrailingSlash($path)) {
            return str_ends_with($path, '/') ? $path : $path.'/';
        }

        return rtrim($path, '/') ?: '/';
    }

    /**
     * @return array{scheme: string, host: string, origin: string}
     */
    public static function applicationBase(): array
    {
        $appUrl = trim((string) config('app.url', 'http://localhost'));

        if ($appUrl === '') {
            $appUrl = 'http://localhost';
        }

        if (! preg_match('#^https?://#i', $appUrl)) {
            $appUrl = 'http://'.$appUrl;
        }

        $parsed = parse_url($appUrl);
        $scheme = strtolower((string) ($parsed['scheme'] ?? 'http'));
        $host = strtolower((string) ($parsed['host'] ?? 'localhost'));
        $port = isset($parsed['port']) ? ':'.(int) $parsed['port'] : '';

        return [
            'scheme' => $scheme,
            'host' => $host,
            'origin' => $scheme.'://'.$host.$port,
        ];
    }
}
