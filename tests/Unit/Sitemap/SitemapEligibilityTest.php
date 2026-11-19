<?php

namespace Tests\Unit\Sitemap;

use App\Models\Blog;
use App\Models\LandingPage;
use App\Models\Page;
use App\Models\SeoMeta;
use App\Support\Sitemap\SitemapEligibility;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class SitemapEligibilityTest extends TestCase
{
    public function test_future_editorial_publish_date_is_excluded_and_a_future_page_is_not(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-06-15 12:00:00', 'UTC'));

        $blog = new Blog([
            'status' => 'published',
            'slug' => 'forced-future',
            'published_at' => Carbon::parse('2026-06-15 12:05:00', 'UTC'),
        ]);
        $page = new Page([
            'status' => 'published',
            'slug' => 'future-page',
            'published_at' => Carbon::parse('2026-06-15 12:05:00', 'UTC'),
        ]);

        $this->assertFalse(SitemapEligibility::allows($blog, 'http://localhost/blog/forced-future/'));
        $this->assertTrue(SitemapEligibility::allows($page, 'http://localhost/future-page/'));

        Carbon::setTestNow();
    }

    public function test_draft_content_is_excluded(): void
    {
        $page = new Page(['status' => 'draft', 'slug' => 'draft-page']);

        $this->assertFalse(SitemapEligibility::allows($page, 'http://localhost/draft-page/'));
    }

    public function test_sitemap_include_false_is_excluded(): void
    {
        $page = $this->publishedPage();
        $page->setRelation('seoMeta', new SeoMeta(['sitemap_include' => false]));

        $this->assertFalse(SitemapEligibility::allows($page, 'http://localhost/about-us/'));
    }

    public function test_noindex_is_excluded(): void
    {
        $page = $this->publishedPage();
        $page->setRelation('seoMeta', new SeoMeta(['robots_index' => 'noindex', 'sitemap_include' => true]));

        $this->assertFalse(SitemapEligibility::allows($page, 'http://localhost/about-us/'));
    }

    public function test_custom_robots_noindex_is_excluded(): void
    {
        $page = $this->publishedPage();
        $page->setRelation('seoMeta', new SeoMeta([
            'sitemap_include' => true,
            'custom_meta_robots' => 'noindex, nofollow',
        ]));

        $this->assertFalse(SitemapEligibility::allows($page, 'http://localhost/about-us/'));
    }

    public function test_redirect_url_is_excluded(): void
    {
        $page = $this->publishedPage();
        $page->setRelation('seoMeta', new SeoMeta([
            'sitemap_include' => true,
            'redirect_url' => 'https://www.ibntech.com/new-url/',
        ]));

        $this->assertFalse(SitemapEligibility::allows($page, 'http://localhost/about-us/'));
    }

    public function test_canonical_mismatch_is_excluded(): void
    {
        $page = $this->publishedPage();
        $page->setRelation('seoMeta', new SeoMeta([
            'sitemap_include' => true,
            'canonical_url' => 'http://localhost/somewhere-else/',
        ]));

        $this->assertFalse(SitemapEligibility::allows($page, 'http://localhost/about-us/'));
    }

    public function test_canonical_match_ignores_tracking_query(): void
    {
        $page = $this->publishedPage();
        $page->setRelation('seoMeta', new SeoMeta([
            'sitemap_include' => true,
            'canonical_url' => 'http://localhost/about-us/?utm_source=test',
        ]));

        $this->assertTrue(SitemapEligibility::allows($page, 'http://localhost/about-us/'));
    }

    public function test_canonical_match_ignores_production_scheme_and_host_on_local(): void
    {
        config(['app.url' => 'http://localhost:8000']);

        $page = $this->publishedPage();
        $page->setRelation('seoMeta', new SeoMeta([
            'sitemap_include' => true,
            'canonical_url' => 'https://www.ibntech.com/about-us/',
        ]));

        $this->assertTrue(SitemapEligibility::allows($page, 'http://localhost:8000/about-us/'));
    }

    public function test_canonical_excludes_intentional_cross_host_on_production(): void
    {
        config(['app.url' => 'https://www.ibntech.com']);

        $page = $this->publishedPage();
        $page->setRelation('seoMeta', new SeoMeta([
            'sitemap_include' => true,
            'canonical_url' => 'https://legacy.example.com/about-us/',
        ]));

        $this->assertFalse(SitemapEligibility::allows($page, 'https://www.ibntech.com/about-us/'));
    }

    public function test_thank_you_landing_pages_are_excluded(): void
    {
        $page = new LandingPage([
            'status' => 'published',
            'slug' => 'contact-thank-you',
        ]);

        $this->assertFalse(SitemapEligibility::allows($page, 'http://localhost/lp/contact-thank-you/'));
    }

    public function test_published_page_without_seo_meta_is_included(): void
    {
        $page = $this->publishedPage();
        $page->setRelation('seoMeta', null);

        $this->assertTrue(SitemapEligibility::allows($page, 'http://localhost/about-us/'));
    }

    private function publishedPage(): Page
    {
        return new Page([
            'title' => 'About us',
            'slug' => 'about-us',
            'template' => 'default',
            'status' => 'published',
        ]);
    }
}
