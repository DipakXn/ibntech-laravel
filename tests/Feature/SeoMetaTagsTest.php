<?php

namespace Tests\Feature;

use App\Services\SeoService;
use Tests\TestCase;

class SeoMetaTagsTest extends TestCase
{
    public function test_vapt_services_layout_renders_open_graph_article_and_twitter_tags(): void
    {
        $this->withoutVite();

        app(SeoService::class)->setCurrent($this->vaptSeoPayload());

        $appHtml = view('layouts.app')->render();
        $landingHtml = view('layouts.landing', ['landingPage' => null])->render();

        foreach ([$appHtml, $landingHtml] as $html) {
            $this->assertVaptMetaTags($html);
        }
    }

    public function test_optional_seo_tags_are_omitted_when_values_are_missing(): void
    {
        $this->withoutVite();

        app(SeoService::class)->setCurrent([
            'meta_title' => 'VAPT Services',
            'meta_description' => 'VAPT description',
            'og_title' => 'VAPT Services',
            'og_description' => 'VAPT description',
            'og_type' => 'website',
            'og_locale' => 'en',
            'canonical_url' => 'http://localhost/vapt-services/',
        ]);

        $html = view('layouts.app')->render();

        $this->assertStringContainsString('<meta property="og:locale" content="en_US">', $html);
        $this->assertStringNotContainsString('property="og:image:width"', $html);
        $this->assertStringNotContainsString('property="og:image:secure_url"', $html);
        $this->assertStringNotContainsString('property="article:publisher"', $html);
        $this->assertStringNotContainsString('property="article:section"', $html);
        $this->assertStringNotContainsString('property="article:tag"', $html);
        $this->assertStringNotContainsString('name="twitter:label1"', $html);
        $this->assertStringNotContainsString('name="twitter:data1"', $html);
        $this->assertStringNotContainsString('name="twitter:image:alt"', $html);
        $this->assertStringNotContainsString('content=""', $this->optionalMetaSubset($html));
    }

    public function test_layouts_render_html_lang_en_us(): void
    {
        $this->withoutVite();

        $appHtml = view('layouts.app')->render();
        $landingHtml = view('layouts.landing', ['landingPage' => null])->render();

        $this->assertStringContainsString('<html lang="en-US">', $appHtml);
        $this->assertStringContainsString('<html lang="en-US">', $landingHtml);
    }

    /**
     * @return array<string, mixed>
     */
    private function vaptSeoPayload(): array
    {
        return [
            'meta_title' => 'VAPT Services and Penetration Testing | India & Global',
            'meta_description' => 'Leading manual and automated full-stack VAPT services.',
            'og_title' => 'VAPT Services and Penetration Testing | India & Global',
            'og_description' => 'Leading manual and automated full-stack VAPT services.',
            'og_type' => 'article',
            'og_site_name' => 'IBN Technologies',
            'og_locale' => 'en',
            'og_image' => 'http://localhost/uploads/pages/vapt-services/vapt-og.jpg',
            'og_image_secure_url' => 'https://localhost/uploads/pages/vapt-services/vapt-og.jpg',
            'og_image_width' => 1200,
            'og_image_height' => 630,
            'og_image_type' => 'image/jpeg',
            'og_image_alt' => 'VAPT Services',
            'og_updated_time' => '2026-08-21T09:30:00+00:00',
            'twitter_card_type' => 'summary_large_image',
            'twitter_title' => 'VAPT Services and Penetration Testing | India & Global',
            'twitter_description' => 'Leading manual and automated full-stack VAPT services.',
            'twitter_image' => 'http://localhost/uploads/pages/vapt-services/vapt-og.jpg',
            'twitter_image_alt' => 'VAPT Services',
            'twitter_creator' => '@ibntech',
            'twitter_site' => '@ibntech',
            'twitter_label1' => 'Est. reading time',
            'twitter_data1' => '12 minutes',
            'canonical_url' => 'http://localhost/vapt-services/',
            'article_publisher' => 'https://www.facebook.com/ibntech',
            'article_author' => 'IBN Technologies',
            'modified_at' => '2026-08-21T09:30:00+00:00',
            'article_section' => 'Cybersecurity',
            'article_tags' => ['VAPT', 'Penetration Testing'],
        ];
    }

    private function assertVaptMetaTags(string $html): void
    {
        $this->assertStringContainsString('<meta property="og:locale" content="en_US">', $html);
        $this->assertStringContainsString('<meta property="og:type" content="article">', $html);
        $this->assertStringContainsString('<meta property="og:title" content="VAPT Services and Penetration Testing | India &amp; Global">', $html);
        $this->assertStringContainsString('<meta property="og:description" content="Leading manual and automated full-stack VAPT services.">', $html);
        $this->assertStringContainsString('<meta property="og:url" content="http://localhost/vapt-services/">', $html);
        $this->assertStringContainsString('<meta property="og:site_name" content="IBN Technologies">', $html);
        $this->assertStringContainsString('<meta property="og:image:secure_url" content="https://localhost/uploads/pages/vapt-services/vapt-og.jpg">', $html);
        $this->assertStringContainsString('<meta property="og:image:width" content="1200">', $html);
        $this->assertStringContainsString('<meta property="og:image:height" content="630">', $html);
        $this->assertStringContainsString('<meta property="og:image:type" content="image/jpeg">', $html);
        $this->assertStringContainsString('<meta property="og:image:alt" content="VAPT Services">', $html);
        $this->assertStringContainsString('<meta property="og:updated_time" content="2026-08-21T09:30:00+00:00">', $html);
        $this->assertStringContainsString('<meta property="article:publisher" content="https://www.facebook.com/ibntech">', $html);
        $this->assertStringContainsString('<meta property="article:author" content="IBN Technologies">', $html);
        $this->assertStringContainsString('<meta property="article:modified_time" content="2026-08-21T09:30:00+00:00">', $html);
        $this->assertStringContainsString('<meta property="article:section" content="Cybersecurity">', $html);
        $this->assertStringContainsString('<meta property="article:tag" content="VAPT">', $html);
        $this->assertStringContainsString('<meta property="article:tag" content="Penetration Testing">', $html);
        $this->assertStringContainsString('<meta name="twitter:card" content="summary_large_image">', $html);
        $this->assertStringContainsString('<meta name="twitter:image:alt" content="VAPT Services">', $html);
        $this->assertStringContainsString('<meta name="twitter:creator" content="@ibntech">', $html);
        $this->assertStringContainsString('<meta name="twitter:site" content="@ibntech">', $html);
        $this->assertStringContainsString('<meta name="twitter:label1" content="Est. reading time">', $html);
        $this->assertStringContainsString('<meta name="twitter:data1" content="12 minutes">', $html);

        $this->assertSame(1, substr_count($html, 'property="og:image:width"'));
        $this->assertSame(1, substr_count($html, 'property="og:image:secure_url"'));
        $this->assertSame(1, substr_count($html, 'property="og:updated_time"'));
        $this->assertSame(1, substr_count($html, 'property="article:publisher"'));
        $this->assertSame(1, substr_count($html, 'property="article:section"'));
        $this->assertSame(2, substr_count($html, 'property="article:tag"'));
        $this->assertSame(1, substr_count($html, 'name="twitter:image:alt"'));
        $this->assertSame(1, substr_count($html, 'name="twitter:label1"'));
        $this->assertSame(1, substr_count($html, 'name="twitter:data1"'));
    }

    private function optionalMetaSubset(string $html): string
    {
        preg_match_all(
            '/<meta[^>]+(?:og:image:(?:secure_url|width|height|type)|article:(?:publisher|section|tag)|twitter:(?:label1|data1|image:alt))[^>]*>/',
            $html,
            $matches,
        );

        return implode("\n", $matches[0] ?? []);
    }
}
