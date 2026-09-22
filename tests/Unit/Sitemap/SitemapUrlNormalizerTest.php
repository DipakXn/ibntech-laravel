<?php

namespace Tests\Unit\Sitemap;

use App\Support\Sitemap\SitemapUrlNormalizer;
use Tests\TestCase;

class SitemapUrlNormalizerTest extends TestCase
{
    public function test_cms_urls_match_despite_scheme_host_case_and_trailing_slash(): void
    {
        config(['app.url' => 'https://www.ibntech.com']);

        $this->assertTrue(SitemapUrlNormalizer::cmsUrlsMatch(
            'https://www.ibntech.com/about-us/',
            'HTTPS://WWW.IBNTECH.COM/about-us',
        ));
    }

    public function test_cms_comparison_ignores_query_and_fragment_tracking_variants(): void
    {
        config(['app.url' => 'https://www.ibntech.com']);

        $this->assertTrue(SitemapUrlNormalizer::cmsUrlsMatch(
            'https://www.ibntech.com/blog/hello/',
            'https://www.ibntech.com/blog/hello/?utm_source=newsletter#section',
        ));
    }

    public function test_cms_loc_strips_query_and_fragment(): void
    {
        config(['app.url' => 'https://www.ibntech.com']);

        $this->assertSame(
            'https://www.ibntech.com/blog/hello/',
            SitemapUrlNormalizer::cmsLoc('https://www.ibntech.com/blog/hello/?utm_source=x#top'),
        );
    }

    public function test_custom_loc_preserves_query_string(): void
    {
        config(['app.url' => 'https://www.ibntech.com']);

        $this->assertSame(
            'https://www.ibntech.com/search/?q=outsourcing',
            SitemapUrlNormalizer::customLoc('https://www.ibntech.com/search/?q=outsourcing'),
        );

        $this->assertSame(
            'https://www.ibntech.com/guides/foo/?ref=sitemap',
            SitemapUrlNormalizer::customLoc('/guides/foo/?ref=sitemap'),
        );
    }

    public function test_encoded_path_separators_are_not_decoded(): void
    {
        config(['app.url' => 'https://www.ibntech.com']);

        $this->assertFalse(SitemapUrlNormalizer::cmsUrlsMatch(
            'https://www.ibntech.com/foo/bar/',
            'https://www.ibntech.com/foo%2Fbar/',
        ));

        $this->assertSame(
            'https://www.ibntech.com/foo%2Fbar/',
            SitemapUrlNormalizer::cmsLoc('https://www.ibntech.com/foo%2Fbar'),
        );
    }

    public function test_relative_paths_resolve_against_app_url(): void
    {
        config(['app.url' => 'https://staging.example.test']);

        $this->assertSame(
            'https://staging.example.test/contact-us/',
            SitemapUrlNormalizer::cmsLoc('/contact-us/'),
        );
    }

    public function test_rejects_non_http_schemes(): void
    {
        $this->assertNull(SitemapUrlNormalizer::customLoc('javascript:alert(1)'));
        $this->assertNull(SitemapUrlNormalizer::cmsLoc('data:text/html,hi'));
    }

    public function test_different_paths_do_not_match(): void
    {
        config(['app.url' => 'https://www.ibntech.com']);

        $this->assertFalse(SitemapUrlNormalizer::cmsUrlsMatch(
            'https://www.ibntech.com/about-us/',
            'https://www.ibntech.com/contact-us/',
        ));
    }

    public function test_cms_paths_match_ignores_scheme_and_host(): void
    {
        config(['app.url' => 'http://localhost:8000']);

        $this->assertTrue(SitemapUrlNormalizer::cmsPathsMatch(
            'http://localhost:8000/industry/manufacturing/',
            'https://www.ibntech.com/industry/manufacturing/',
        ));

        $this->assertFalse(SitemapUrlNormalizer::cmsPathsMatch(
            'http://localhost:8000/industry/manufacturing/',
            'https://www.ibntech.com/industry/healthcare-and-pharma/',
        ));
    }

    public function test_canonical_allows_cross_host_on_non_production_app_url(): void
    {
        config(['app.url' => 'http://localhost:8000']);

        $this->assertTrue(SitemapUrlNormalizer::cmsCanonicalMatchesPublicUrl(
            'http://localhost:8000/about-us/',
            'https://www.ibntech.com/about-us/',
        ));
    }

    public function test_canonical_excludes_intentional_cross_host_on_production(): void
    {
        config(['app.url' => 'https://www.ibntech.com']);

        $this->assertFalse(SitemapUrlNormalizer::cmsCanonicalMatchesPublicUrl(
            'https://www.ibntech.com/about-us/',
            'https://legacy.example.com/about-us/',
        ));
    }

    public function test_canonical_includes_same_host_and_path_on_production(): void
    {
        config(['app.url' => 'https://www.ibntech.com']);

        $this->assertTrue(SitemapUrlNormalizer::cmsCanonicalMatchesPublicUrl(
            'https://www.ibntech.com/about-us/',
            'https://www.ibntech.com/about-us/?utm_source=newsletter',
        ));
    }
}
