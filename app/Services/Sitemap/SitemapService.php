<?php

namespace App\Services\Sitemap;

use App\Services\WebsiteSettingService;
use App\Support\Sitemap\SitemapType;
use App\Support\Sitemap\SitemapUrlEntry;
use DateTimeInterface;
use Illuminate\Support\Facades\Cache;

class SitemapService
{
    public function __construct(
        private readonly WebsiteSettingService $websiteSettings,
        private readonly SitemapCacheService $cache,
        private readonly SitemapXmlRenderer $renderer,
    ) {}

    public function settings(): SitemapSettings
    {
        return new SitemapSettings($this->websiteSettings->get());
    }

    public function cacheTtl(): int
    {
        return $this->settings()->cacheTtl();
    }

    public function indexXml(): ?string
    {
        $settings = $this->settings();

        if (! $settings->enabled()) {
            return null;
        }

        $ttl = $settings->cacheTtl();

        $resolver = function () use ($settings): ?string {
            $sitemaps = [];

            foreach (SitemapType::cases() as $type) {
                if (! $settings->typeEnabled($type)) {
                    continue;
                }

                $entries = $this->entriesFor($type);
                $chunks = $this->chunk($entries);

                foreach ($chunks as $index => $chunk) {
                    $part = $index + 1;
                    $sitemaps[] = [
                        'loc' => url('/'.$type->fileName($part)),
                        'lastmod' => $settings->includeLastmod() ? $this->maxLastmod($chunk) : null,
                    ];
                }
            }

            if ($sitemaps === []) {
                return $this->renderer->index([]);
            }

            return $this->renderer->index($sitemaps);
        };

        if ($ttl <= 0) {
            return $resolver();
        }

        return Cache::remember($this->cache->indexKey(), $ttl, $resolver);
    }

    public function typeXml(SitemapType $type, int $part): ?string
    {
        $settings = $this->settings();

        if (! $settings->enabled() || ! $settings->typeEnabled($type) || $part < 1) {
            return null;
        }

        $ttl = $settings->cacheTtl();

        $resolver = function () use ($type, $part): ?string {
            $entries = $this->entriesFor($type);
            $chunks = $this->chunk($entries);
            $chunk = $chunks[$part - 1] ?? null;

            if (! is_array($chunk) || $chunk === []) {
                return null;
            }

            $partTtl = $this->settings()->cacheTtl();
            Cache::put($this->cache->partsKey($type), count($chunks), $partTtl > 0 ? $partTtl : 3600);

            return $this->renderer->urlset($chunk);
        };

        if ($ttl <= 0) {
            return $resolver();
        }

        $cacheKey = $this->cache->xmlKey($type, $part);
        $cached = Cache::get($cacheKey);

        if (is_string($cached)) {
            return $cached;
        }

        $xml = $resolver();

        if (is_string($xml)) {
            Cache::put($cacheKey, $xml, $ttl);
        }

        return $xml;
    }

    /**
     * @return list<SitemapUrlEntry>
     */
    public function entriesFor(SitemapType $type): array
    {
        $settings = $this->settings();
        $ttl = $settings->cacheTtl();

        $resolver = function () use ($type, $settings): array {
            $collector = new SitemapUrlCollector($settings);

            return $collector->collect($type);
        };

        if ($ttl <= 0) {
            return $resolver();
        }

        return Cache::remember($this->cache->entriesKey($type), $ttl, $resolver);
    }

    /**
     * @param  list<SitemapUrlEntry>  $entries
     * @return list<list<SitemapUrlEntry>>
     */
    private function chunk(array $entries): array
    {
        if ($entries === []) {
            return [];
        }

        $max = max(1, (int) config('sitemap.max_urls_per_file', 50000));

        return array_values(array_chunk($entries, $max));
    }

    /**
     * @param  list<SitemapUrlEntry>  $entries
     */
    private function maxLastmod(array $entries): ?string
    {
        $latest = null;

        foreach ($entries as $entry) {
            if (! $entry->lastmod instanceof DateTimeInterface) {
                continue;
            }

            if ($latest === null || $entry->lastmod > $latest) {
                $latest = $entry->lastmod;
            }
        }

        return $latest?->format('Y-m-d\TH:i:sP');
    }
}
