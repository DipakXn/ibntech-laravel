<?php

namespace App\Services\Sitemap;

use App\Support\Sitemap\SitemapType;
use Illuminate\Support\Facades\Cache;

class SitemapCacheService
{
    public function indexKey(): string
    {
        return $this->prefix().':index';
    }

    public function entriesKey(SitemapType $type): string
    {
        return $this->prefix().':entries:'.$type->value;
    }

    public function xmlKey(SitemapType $type, int $part): string
    {
        return $this->prefix().':xml:'.$type->value.':'.$part;
    }

    public function partsKey(SitemapType $type): string
    {
        return $this->prefix().':parts:'.$type->value;
    }

    public function forgetIndex(): void
    {
        Cache::forget($this->indexKey());
    }

    public function forgetType(SitemapType $type): void
    {
        $partCount = max(1, (int) Cache::get($this->partsKey($type), 1));

        for ($part = 1; $part <= $partCount + 5; $part++) {
            Cache::forget($this->xmlKey($type, $part));
        }

        Cache::forget($this->entriesKey($type));
        Cache::forget($this->partsKey($type));
        $this->forgetIndex();
    }

    /**
     * @param  list<SitemapType>  $types
     */
    public function forgetTypes(array $types): void
    {
        foreach ($types as $type) {
            $this->forgetType($type);
        }
    }

    public function forgetAll(): void
    {
        foreach (SitemapType::cases() as $type) {
            $this->forgetType($type);
        }

        $this->forgetIndex();
    }

    private function prefix(): string
    {
        return (string) config('sitemap.cache_prefix', 'sitemap');
    }
}
