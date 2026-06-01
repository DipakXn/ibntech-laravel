<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\SeoMeta;
use App\Services\SeoService;
use Tests\TestCase;

class SeoServiceTest extends TestCase
{
    public function test_it_falls_back_to_featured_image_when_social_overrides_are_missing(): void
    {
        $blog = new Blog([
            'title' => 'Fallback Test',
            'featured_image' => 'https://cdn.example.com/featured.jpg',
        ]);

        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Fallback Test',
        ]));

        $service = new SeoService();
        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame('https://cdn.example.com/featured.jpg', $seo['og_image']);
        $this->assertSame('https://cdn.example.com/featured.jpg', $seo['twitter_image']);
    }

    public function test_it_applies_twitter_then_og_then_featured_image_priority(): void
    {
        $blog = new Blog([
            'title' => 'Priority Test',
            'featured_image' => 'https://cdn.example.com/featured.jpg',
        ]);

        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Priority Test',
            'og_image' => 'https://cdn.example.com/og.jpg',
            'twitter_image' => 'https://cdn.example.com/twitter.jpg',
        ]));

        $service = new SeoService();
        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame('https://cdn.example.com/og.jpg', $seo['og_image']);
        $this->assertSame('https://cdn.example.com/twitter.jpg', $seo['twitter_image']);

        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Priority Test',
            'og_image' => 'https://cdn.example.com/og.jpg',
        ]));

        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame('https://cdn.example.com/og.jpg', $seo['og_image']);
        $this->assertSame('https://cdn.example.com/og.jpg', $seo['twitter_image']);
    }
}
