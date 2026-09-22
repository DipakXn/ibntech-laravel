<?php

namespace Tests\Unit\Sitemap;

use App\Services\Sitemap\SitemapCacheService;
use App\Support\Sitemap\SitemapType;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SitemapCacheServiceTest extends TestCase
{
    public function test_forget_type_clears_that_type_parts_and_the_index(): void
    {
        $cache = new SitemapCacheService;

        Cache::put($cache->indexKey(), '<index/>', 3600);
        Cache::put($cache->entriesKey(SitemapType::Blogs), [], 3600);
        Cache::put($cache->partsKey(SitemapType::Blogs), 3, 3600);
        Cache::put($cache->xmlKey(SitemapType::Blogs, 1), '<urlset/>', 3600);
        Cache::put($cache->xmlKey(SitemapType::Blogs, 2), '<urlset/>', 3600);
        Cache::put($cache->xmlKey(SitemapType::Blogs, 3), '<urlset/>', 3600);
        Cache::put($cache->xmlKey(SitemapType::Pages, 1), '<pages/>', 3600);
        Cache::put($cache->entriesKey(SitemapType::Pages), ['keep'], 3600);

        $cache->forgetType(SitemapType::Blogs);

        $this->assertFalse(Cache::has($cache->indexKey()));
        $this->assertFalse(Cache::has($cache->entriesKey(SitemapType::Blogs)));
        $this->assertFalse(Cache::has($cache->partsKey(SitemapType::Blogs)));
        $this->assertFalse(Cache::has($cache->xmlKey(SitemapType::Blogs, 1)));
        $this->assertFalse(Cache::has($cache->xmlKey(SitemapType::Blogs, 2)));
        $this->assertFalse(Cache::has($cache->xmlKey(SitemapType::Blogs, 3)));
        $this->assertTrue(Cache::has($cache->xmlKey(SitemapType::Pages, 1)));
        $this->assertTrue(Cache::has($cache->entriesKey(SitemapType::Pages)));
    }

    public function test_forget_all_clears_every_sitemap_key(): void
    {
        $cache = new SitemapCacheService;

        Cache::put($cache->indexKey(), '<index/>', 3600);
        Cache::put($cache->xmlKey(SitemapType::Custom, 1), '<custom/>', 3600);

        $cache->forgetAll();

        $this->assertFalse(Cache::has($cache->indexKey()));
        $this->assertFalse(Cache::has($cache->xmlKey(SitemapType::Custom, 1)));
    }
}
