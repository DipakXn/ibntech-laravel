<?php

namespace App\Services\Sitemap;

use App\Support\Sitemap\SitemapUrlEntry;

class SitemapXmlRenderer
{
    /**
     * @param  list<array{loc: string, lastmod: ?string}>  $sitemaps
     */
    public function index(array $sitemaps): string
    {
        return view('sitemaps.index', [
            'sitemaps' => $sitemaps,
        ])->render();
    }

    /**
     * @param  list<SitemapUrlEntry>  $entries
     */
    public function urlset(array $entries): string
    {
        return view('sitemaps.urlset', [
            'urls' => array_map(
                fn (SitemapUrlEntry $entry): array => $entry->toViewData(),
                $entries,
            ),
        ])->render();
    }
}
