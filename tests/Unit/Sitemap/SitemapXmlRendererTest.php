<?php

namespace Tests\Unit\Sitemap;

use App\Services\Sitemap\SitemapXmlRenderer;
use App\Support\Sitemap\SitemapUrlEntry;
use Carbon\Carbon;
use Tests\TestCase;

class SitemapXmlRendererTest extends TestCase
{
    public function test_index_omits_lastmod_when_missing(): void
    {
        $xml = (new SitemapXmlRenderer)->index([
            ['loc' => 'http://localhost/page-sitemap.xml', 'lastmod' => '2026-09-21T10:00:00+00:00'],
            ['loc' => 'http://localhost/post-sitemap.xml', 'lastmod' => null],
        ]);

        $this->assertStringContainsString('<?xml version="1.0" encoding="UTF-8"?>', $xml);
        $this->assertStringContainsString('<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $xml);
        $this->assertStringContainsString('<loc>http://localhost/page-sitemap.xml</loc>', $xml);
        $this->assertStringContainsString('<lastmod>2026-09-21T10:00:00+00:00</lastmod>', $xml);
        $this->assertStringContainsString('<loc>http://localhost/post-sitemap.xml</loc>', $xml);

        $postBlock = $this->xmlBetween($xml, 'http://localhost/post-sitemap.xml', '</sitemap>');
        $this->assertStringNotContainsString('<lastmod>', $postBlock);
    }

    public function test_urlset_escapes_loc_and_omits_optional_elements(): void
    {
        $xml = (new SitemapXmlRenderer)->urlset([
            new SitemapUrlEntry('http://localhost/search/?q=a&b=1'),
            new SitemapUrlEntry(
                'http://localhost/about-us/',
                Carbon::parse('2026-01-02 03:04:05', 'UTC'),
                'weekly',
                '0.8',
            ),
        ]);

        $document = simplexml_load_string($xml);

        $this->assertNotFalse($document);
        $this->assertSame('http://www.sitemaps.org/schemas/sitemap/0.9', $document->getNamespaces()['']);
        $this->assertStringContainsString('<loc>http://localhost/search/?q=a&amp;b=1</loc>', $xml);
        $this->assertStringContainsString('<changefreq>weekly</changefreq>', $xml);
        $this->assertStringContainsString('<priority>0.8</priority>', $xml);

        $firstUrl = $this->xmlBetween($xml, 'http://localhost/search/?q=a&amp;b=1', '</url>');
        $this->assertStringNotContainsString('<lastmod>', $firstUrl);
        $this->assertStringNotContainsString('<changefreq>', $firstUrl);
        $this->assertStringNotContainsString('<priority>', $firstUrl);
    }

    private function xmlBetween(string $xml, string $startNeedle, string $endNeedle): string
    {
        $start = strpos($xml, $startNeedle);
        $this->assertNotFalse($start);
        $end = strpos($xml, $endNeedle, $start);
        $this->assertNotFalse($end);

        return substr($xml, $start, $end - $start);
    }
}
