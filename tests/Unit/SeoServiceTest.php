<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;
use App\Models\SeoMeta;
use App\Services\SeoService;
use Carbon\Carbon;
use ReflectionMethod;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
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

        $service = new SeoService;
        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame('https://cdn.example.com/featured.jpg', $seo['og_image']);
        $this->assertSame('https://cdn.example.com/featured.jpg', $seo['twitter_image']);
        $this->assertSame('https://cdn.example.com/featured.jpg', $seo['og_image_secure_url']);
        $this->assertNull($seo['og_image_width']);
        $this->assertNull($seo['og_image_height']);
        $this->assertNull($seo['og_image_type']);
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

        $service = new SeoService;
        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame('https://cdn.example.com/og.jpg', $seo['og_image']);
        $this->assertSame('https://cdn.example.com/twitter.jpg', $seo['twitter_image']);
        $this->assertSame('https://cdn.example.com/og.jpg', $seo['og_image_secure_url']);

        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Priority Test',
            'og_image' => 'https://cdn.example.com/og.jpg',
        ]));

        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame('https://cdn.example.com/og.jpg', $seo['og_image']);
        $this->assertSame('https://cdn.example.com/og.jpg', $seo['twitter_image']);
    }

    public function test_it_normalizes_og_locale_en_variants_to_en_us(): void
    {
        $service = new SeoService;

        foreach (['en', 'en-US', 'en_us', 'en_US'] as $locale) {
            $blog = new Blog(['title' => 'Locale Test']);
            $blog->setRelation('seoMeta', new SeoMeta([
                'meta_title' => 'Locale Test',
                'og_locale' => $locale,
            ]));

            $service->setCurrentForModel($blog);

            $this->assertSame('en_US', $service->current()['og_locale'], $locale);
        }
    }

    public function test_it_uses_model_updated_at_for_og_updated_time_and_modified_time_fallback(): void
    {
        $updatedAt = Carbon::parse('2026-03-04 15:30:00');
        $blog = new Blog(['title' => 'Updated Time Test']);
        $blog->updated_at = $updatedAt;
        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Updated Time Test',
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame($updatedAt->toIso8601String(), $seo['og_updated_time']);
        $this->assertSame($updatedAt->toIso8601String(), $seo['modified_at']);
    }

    public function test_it_prefers_seo_modified_at_for_article_modified_time(): void
    {
        $updatedAt = Carbon::parse('2026-03-04 15:30:00');
        $modifiedAt = Carbon::parse('2026-04-01 09:00:00');
        $blog = new Blog(['title' => 'Modified Override']);
        $blog->updated_at = $updatedAt;
        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Modified Override',
            'modified_at' => $modifiedAt,
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame($updatedAt->toIso8601String(), $seo['og_updated_time']);
        $this->assertSame($modifiedAt->toIso8601String(), $seo['modified_at']);
    }

    public function test_it_uses_category_name_when_article_section_is_empty(): void
    {
        $blog = new Blog(['title' => 'Section Test']);
        $blog->setRelation('category', new Category(['name' => 'Cybersecurity']));
        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Section Test',
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame('Cybersecurity', $seo['article_section']);
    }

    public function test_it_normalizes_article_tags_and_copies_og_alt_to_twitter(): void
    {
        $blog = new Blog(['title' => 'Tags Test']);
        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Tags Test',
            'og_image_alt' => 'VAPT hero image',
            'article_tags' => ['VAPT', 'VAPT', ' Penetration Testing ', ''],
            'reading_time' => 12,
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame(['VAPT', 'Penetration Testing'], $seo['article_tags']);
        $this->assertSame('VAPT hero image', $seo['twitter_image_alt']);
        $this->assertSame('Est. reading time', $seo['twitter_label1']);
        $this->assertSame('12 minutes', $seo['twitter_data1']);
    }

    public function test_it_falls_back_to_estimated_read_time_when_seo_reading_time_is_missing(): void
    {
        $blog = new Blog([
            'title' => 'Read Time Test',
            'content' => [
                [
                    'type' => 'paragraph',
                    'data' => ['content' => '<p>'.str_repeat('word ', 440).'</p>'],
                ],
            ],
        ]);
        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Read Time Test',
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame(2, $seo['reading_time']);
        $this->assertSame('Est. reading time', $seo['twitter_label1']);
        $this->assertSame('2 minutes', $seo['twitter_data1']);
    }

    public function test_it_estimates_reading_time_from_page_templates_when_seo_reading_time_is_missing(): void
    {
        $page = new Page([
            'title' => 'VAPT Services',
            'slug' => 'vapt-services',
            'template' => 'vapt-services',
        ]);
        $page->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'VAPT Services',
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($page);
        $seo = $service->current();

        $this->assertNotNull($seo['reading_time']);
        $this->assertGreaterThanOrEqual(1, $seo['reading_time']);
        $this->assertSame('Est. reading time', $seo['twitter_label1']);
        $this->assertSame(
            $seo['reading_time'].' '.($seo['reading_time'] === 1 ? 'minute' : 'minutes'),
            $seo['twitter_data1']
        );
    }

    public function test_it_converts_http_image_urls_to_https_secure_url(): void
    {
        $blog = new Blog([
            'title' => 'Http Image',
            'featured_image' => 'http://cdn.example.com/featured.jpg',
        ]);
        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Http Image',
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($blog);
        $seo = $service->current();

        $this->assertSame('http://cdn.example.com/featured.jpg', $seo['og_image']);
        $this->assertSame('https://cdn.example.com/featured.jpg', $seo['og_image_secure_url']);
    }

    public function test_it_reads_image_dimensions_and_type_from_the_spatie_media_file(): void
    {
        if (! function_exists('imagecreatetruecolor')) {
            $this->markTestSkipped('GD is required to generate a fixture image.');
        }

        $path = sys_get_temp_dir().DIRECTORY_SEPARATOR.'seo-og-fixture-'.uniqid('', true).'.jpg';
        $image = imagecreatetruecolor(1200, 630);
        imagejpeg($image, $path, 90);
        imagedestroy($image);

        $media = new class extends Media
        {
            public string $fixturePath = '';

            public function getPath(string $conversionName = ''): string
            {
                return $this->fixturePath;
            }
        };
        $media->fixturePath = $path;
        $media->mime_type = 'image/jpeg';
        $media->custom_properties = [];

        $service = new SeoService;
        $method = new ReflectionMethod(SeoService::class, 'imageMeta');
        $meta = $method->invoke($service, 'https://cdn.example.com/vapt-og.jpg', $media);

        @unlink($path);

        $this->assertSame(1200, $meta['og_image_width']);
        $this->assertSame(630, $meta['og_image_height']);
        $this->assertSame('image/jpeg', $meta['og_image_type']);
        $this->assertSame('https://cdn.example.com/vapt-og.jpg', $meta['og_image_secure_url']);
    }

    public function test_it_keeps_blog_posting_schema_for_blog_posts(): void
    {
        $blog = new Blog(['title' => 'Schema Blog']);
        $blog->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Schema Blog Headline',
            'article_author' => 'Ada Lovelace',
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($blog);
        $data = json_decode($service->current()['json_ld'], true);

        $this->assertSame('BlogPosting', $data['@type']);
        $this->assertSame('Schema Blog Headline', $data['headline']);
        $this->assertSame('Person', $data['author']['@type']);
        $this->assertSame('Ada Lovelace', $data['author']['name']);
    }

    public function test_it_uses_service_schema_for_service_pages(): void
    {
        $page = new Page([
            'title' => 'VAPT Services',
            'slug' => 'vapt-services',
            'template' => 'vapt-services',
        ]);
        $page->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'VAPT Services',
            'meta_description' => 'Vulnerability assessment and penetration testing.',
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($page);
        $seo = $service->current();
        $data = json_decode($seo['json_ld'], true);

        $this->assertStringNotContainsString('BlogPosting', $seo['json_ld']);
        $this->assertSame('Service', $data['@type']);
        $this->assertSame('VAPT Services', $data['name']);
        $this->assertSame('Vulnerability assessment and penetration testing.', $data['description']);
        $this->assertSame('Organization', $data['provider']['@type']);
        $this->assertNotSame('', $data['provider']['name']);
        $this->assertArrayNotHasKey('headline', $data);
        $this->assertArrayNotHasKey('author', $data);
        $this->assertArrayNotHasKey('mainEntityOfPage', $data);
    }

    public function test_it_uses_web_page_schema_for_non_service_pages(): void
    {
        $page = new Page([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'template' => 'privacy-policy',
        ]);
        $page->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'Privacy Policy',
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($page);
        $data = json_decode($service->current()['json_ld'], true);

        $this->assertSame('WebPage', $data['@type']);
        $this->assertSame('Privacy Policy', $data['name']);
        $this->assertSame('Organization', $data['publisher']['@type']);
        $this->assertArrayNotHasKey('provider', $data);
        $this->assertArrayNotHasKey('headline', $data);
    }

    public function test_it_keeps_a_stored_json_ld_override_on_pages(): void
    {
        $stored = '{"@context":"https://schema.org","@type":"FAQPage"}';
        $page = new Page([
            'title' => 'VAPT Services',
            'slug' => 'vapt-services',
            'template' => 'vapt-services',
        ]);
        $page->setRelation('seoMeta', new SeoMeta([
            'meta_title' => 'VAPT Services',
            'json_ld' => $stored,
        ]));

        $service = new SeoService;
        $service->setCurrentForModel($page);

        $this->assertSame($stored, $service->current()['json_ld']);
    }
}
