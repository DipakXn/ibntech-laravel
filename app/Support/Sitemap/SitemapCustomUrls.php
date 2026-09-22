<?php

namespace App\Support\Sitemap;

use Carbon\Carbon;
use DateTimeInterface;
use Throwable;

class SitemapCustomUrls
{
    /**
     * @param  list<array<string, mixed>>  $rows
     * @return list<array{url: string, enabled: bool, lastmod: ?string, changefreq: ?string, priority: ?string}>
     */
    public static function normalize(array $rows): array
    {
        $normalized = [];

        foreach ($rows as $row) {
            if (! is_array($row)) {
                continue;
            }

            $url = self::sanitizeUrl($row['url'] ?? null);

            if ($url === null) {
                continue;
            }

            $changefreq = is_string($row['changefreq'] ?? null) ? strtolower(trim($row['changefreq'])) : null;

            if ($changefreq === '') {
                $changefreq = null;
            }

            if ($changefreq !== null && ! in_array($changefreq, config('sitemap.changefreq_values', []), true)) {
                $changefreq = null;
            }

            $normalized[] = [
                'url' => $url,
                'enabled' => (bool) ($row['enabled'] ?? true),
                'lastmod' => self::normalizeLastmod($row['lastmod'] ?? null),
                'changefreq' => $changefreq,
                'priority' => SitemapType::normalizePriority($row['priority'] ?? null),
            ];
        }

        return $normalized;
    }

    /**
     * @param  array<string, mixed>  $row
     */
    public static function toEntry(array $row): ?SitemapUrlEntry
    {
        if (! ($row['enabled'] ?? false)) {
            return null;
        }

        $loc = SitemapUrlNormalizer::customLoc((string) ($row['url'] ?? ''));

        if ($loc === null || strlen($loc) > 2048) {
            return null;
        }

        $lastmod = self::parseLastmod($row['lastmod'] ?? null);
        $changefreq = is_string($row['changefreq'] ?? null) ? $row['changefreq'] : null;
        $priority = SitemapType::normalizePriority($row['priority'] ?? null);

        if ($changefreq !== null && ! in_array($changefreq, config('sitemap.changefreq_values', []), true)) {
            $changefreq = null;
        }

        return new SitemapUrlEntry($loc, $lastmod, $changefreq, $priority);
    }

    public static function sanitizeUrl(mixed $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        $value = trim($value);

        if ($value === '' || strlen($value) > 2048) {
            return null;
        }

        if (preg_match('/^(javascript|data|vbscript):/i', $value) === 1) {
            return null;
        }

        if (preg_match('#^https?://#i', $value) === 1) {
            $parts = parse_url($value);

            if (! is_array($parts) || empty($parts['host'])) {
                return null;
            }

            return $value;
        }

        if (str_starts_with($value, '/')) {
            return $value;
        }

        return null;
    }

    public static function normalizeLastmod(mixed $value): ?string
    {
        $parsed = self::parseLastmod($value);

        return $parsed?->format(DateTimeInterface::ATOM);
    }

    public static function parseLastmod(mixed $value): ?DateTimeInterface
    {
        if ($value instanceof DateTimeInterface) {
            return $value;
        }

        if (! is_string($value) || trim($value) === '') {
            return null;
        }

        try {
            return Carbon::parse($value);
        } catch (Throwable) {
            return null;
        }
    }
}
