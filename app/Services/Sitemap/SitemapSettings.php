<?php

namespace App\Services\Sitemap;

use App\Models\WebsiteSetting;
use App\Support\Sitemap\SitemapType;
use App\Support\Sitemap\SitemapUrlEntry;

class SitemapSettings
{
    public function __construct(private readonly WebsiteSetting $settings) {}

    public function enabled(): bool
    {
        return (bool) ($this->settings->sitemap_enabled ?? true);
    }

    public function includeLastmod(): bool
    {
        return (bool) ($this->settings->sitemap_include_lastmod ?? true);
    }

    public function includeChangefreq(): bool
    {
        return (bool) ($this->settings->sitemap_include_changefreq ?? false);
    }

    public function includePriority(): bool
    {
        return (bool) ($this->settings->sitemap_include_priority ?? false);
    }

    public function addToRobots(): bool
    {
        return (bool) ($this->settings->sitemap_add_to_robots ?? true);
    }

    public function cacheTtl(): int
    {
        $ttl = (int) ($this->settings->sitemap_cache_ttl ?? 3600);

        return max(0, $ttl);
    }

    public function typeEnabled(SitemapType $type): bool
    {
        return (bool) $this->typeOption($type, 'enabled');
    }

    public function typeChangefreq(SitemapType $type): ?string
    {
        $value = $this->typeOption($type, 'changefreq');

        return is_string($value) && $value !== '' ? $value : null;
    }

    public function typePriority(SitemapType $type): ?string
    {
        $value = $this->typeOption($type, 'priority');

        return SitemapType::normalizePriority($value);
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function customUrls(): array
    {
        $rows = $this->settings->sitemap_custom_urls;

        return is_array($rows) ? $rows : [];
    }

    public function applyToggles(SitemapUrlEntry $entry, SitemapType $type): SitemapUrlEntry
    {
        $changefreq = $this->includeChangefreq()
            ? ($entry->changefreq ?: $this->typeChangefreq($type))
            : null;
        $priority = $this->includePriority()
            ? ($entry->priority ?: $this->typePriority($type))
            : null;

        return new SitemapUrlEntry(
            loc: $entry->loc,
            lastmod: $this->includeLastmod() ? $entry->lastmod : null,
            changefreq: $changefreq,
            priority: $priority,
        );
    }

    private function typeOption(SitemapType $type, string $key): mixed
    {
        $stored = $this->settings->sitemap_types;
        $override = is_array($stored) && is_array($stored[$type->value] ?? null)
            ? $stored[$type->value]
            : [];

        if (array_key_exists($key, $override)) {
            return $override[$key];
        }

        return $type->defaults()[$key] ?? null;
    }
}
