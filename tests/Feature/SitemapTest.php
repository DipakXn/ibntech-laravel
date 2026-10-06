<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\WebsiteSetting;
use App\Services\WebsiteSettingService;
use Tests\Support\UsesIsolatedSqliteSchema;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use UsesIsolatedSqliteSchema;

    public function test_index_is_valid_xml_and_lists_child_sitemaps(): void
    {
        $this->seedWebsiteSettings();
        $this->createPublishedPage('about-us', 'About us');

        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');

        $xml = simplexml_load_string($response->getContent());
        $this->assertNotFalse($xml);
        $this->assertSame('sitemapindex', $xml->getName());
        $this->assertStringContainsString(url('/page-sitemap.xml'), $response->getContent());
        $this->assertStringNotContainsString('newsletter-sitemap.xml', $response->getContent());
        $this->assertStringNotContainsString('custom-sitemap.xml', $response->getContent());
    }

    public function test_sitemap_index_alias_matches_primary_index(): void
    {
        $this->seedWebsiteSettings();

        $index = $this->get('/sitemap.xml');
        $alias = $this->get('/sitemap_index.xml');

        $index->assertOk();
        $alias->assertOk();
        $this->assertSame($index->getContent(), $alias->getContent());
        $alias->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function test_child_sitemap_includes_published_pages_and_excludes_drafts(): void
    {
        $this->seedWebsiteSettings();
        $this->createPublishedPage('about-us', 'About us');
        Page::query()->create([
            'title' => 'Draft only',
            'slug' => 'draft-only',
            'template' => 'default',
            'status' => 'draft',
        ]);

        $response = $this->get('/page-sitemap.xml');

        $response->assertOk();
        $xml = simplexml_load_string($response->getContent());
        $this->assertNotFalse($xml);
        $this->assertSame('urlset', $xml->getName());
        $response->assertSee(url('/about-us/'), false);
        $response->assertDontSee(url('/draft-only/'), false);
        $response->assertSee(url('/blog/'), false);
        $response->assertDontSee(url('/newsletter/'), false);
    }

    public function test_xml_urls_are_not_redirected_to_a_trailing_slash(): void
    {
        $this->seedWebsiteSettings();

        $this->get('/sitemap.xml')->assertOk()->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $this->get('/page-sitemap.xml')->assertOk();
        $this->assertFalse($this->get('/sitemap.xml')->isRedirection());
    }

    public function test_catch_all_does_not_render_html_for_sitemap_urls(): void
    {
        $this->seedWebsiteSettings();

        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $this->assertStringNotContainsString('<html', $response->getContent());
        $this->assertStringContainsString('<sitemapindex', $response->getContent());
    }

    public function test_sitemap_include_false_excludes_the_url(): void
    {
        $this->seedWebsiteSettings();
        $page = $this->createPublishedPage('hidden-page', 'Hidden');
        $page->seoMeta()->create([
            'sitemap_include' => false,
        ]);

        $this->get('/page-sitemap.xml')->assertDontSee(url('/hidden-page/'), false);
    }

    public function test_noindex_and_redirect_urls_are_excluded(): void
    {
        $this->seedWebsiteSettings();

        $noindex = $this->createPublishedPage('noindex-page', 'Noindex');
        $noindex->seoMeta()->create([
            'sitemap_include' => true,
            'robots_index' => 'noindex',
        ]);

        $redirect = $this->createPublishedPage('redirect-page', 'Redirect');
        $redirect->seoMeta()->create([
            'sitemap_include' => true,
            'redirect_url' => 'http://localhost/about-us/',
        ]);

        $response = $this->get('/page-sitemap.xml');
        $response->assertDontSee(url('/noindex-page/'), false);
        $response->assertDontSee(url('/redirect-page/'), false);
    }

    public function test_canonical_mismatch_is_excluded_and_matching_canonical_is_kept(): void
    {
        $this->seedWebsiteSettings();

        $kept = $this->createPublishedPage('about-us', 'About');
        $kept->seoMeta()->create([
            'sitemap_include' => true,
            'canonical_url' => 'http://localhost/about-us/?utm_source=test',
        ]);

        $dropped = $this->createPublishedPage('other-page', 'Other');
        $dropped->seoMeta()->create([
            'sitemap_include' => true,
            'canonical_url' => 'http://localhost/somewhere-else/',
        ]);

        $response = $this->get('/page-sitemap.xml');
        $response->assertSee(url('/about-us/'), false);
        $response->assertDontSee('utm_source=test', false);
        $response->assertDontSee(url('/other-page/'), false);
    }

    public function test_industry_sitemap_includes_pages_with_production_canonical_urls(): void
    {
        $this->seedWebsiteSettings();

        $industry = Industry::query()->create([
            'title' => 'Manufacturing',
            'slug' => 'manufacturing',
            'template' => 'default',
            'status' => 'published',
        ]);
        $industry->seoMeta()->create([
            'sitemap_include' => true,
            'robots_index' => 'index',
            'canonical_url' => 'https://www.ibntech.com/industry/manufacturing/',
        ]);

        $response = $this->get('/industry-sitemap.xml');
        $response->assertOk();
        $response->assertSee(url('/industry/manufacturing/'), false);
        $response->assertDontSee('https://www.ibntech.com/industry/manufacturing/', false);
    }

    public function test_newsletter_sitemap_includes_indexable_newsletters_by_default(): void
    {
        $this->seedWebsiteSettings();

        $included = Newsletter::query()->create([
            'title' => 'Cloud insights',
            'slug' => 'cloud-insights',
            'template' => 'default',
            'status' => 'published',
        ]);
        $included->seoMeta()->create([
            'sitemap_include' => true,
            'robots_index' => 'index',
            'canonical_url' => 'https://www.ibntech.com/newsletter/cloud-insights/',
        ]);

        $excluded = Newsletter::query()->create([
            'title' => 'Hidden issue',
            'slug' => 'hidden-issue',
            'template' => 'default',
            'status' => 'published',
        ]);
        $excluded->seoMeta()->create([
            'sitemap_include' => true,
            'robots_index' => 'noindex',
        ]);

        $response = $this->get('/newsletter-sitemap.xml');
        $response->assertOk();
        $response->assertSee(url('/newsletter/cloud-insights/'), false);
        $response->assertDontSee(url('/newsletter/hidden-issue/'), false);
    }

    public function test_future_published_at_with_published_status_is_included(): void
    {
        $this->seedWebsiteSettings();
        Page::query()->create([
            'title' => 'Scheduled looking',
            'slug' => 'future-page',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->addDays(5),
        ]);

        $this->get('/page-sitemap.xml')->assertSee(url('/future-page/'), false);
    }

    public function test_thank_you_landing_pages_are_excluded(): void
    {
        $this->seedWebsiteSettings();
        LandingPage::query()->create([
            'title' => 'Thanks',
            'slug' => 'demo-thank-you',
            'template' => 'default',
            'status' => 'published',
        ]);
        LandingPage::query()->create([
            'title' => 'Campaign',
            'slug' => 'spring-campaign',
            'template' => 'default',
            'status' => 'published',
        ]);

        $response = $this->get('/lp-sitemap.xml');
        $response->assertOk();
        $response->assertSee(url('/lp/spring-campaign/'), false);
        $response->assertDontSee(url('/lp/demo-thank-you/'), false);
    }

    public function test_blog_and_category_sitemaps_include_published_content(): void
    {
        $this->seedWebsiteSettings();
        $category = Category::query()->create([
            'name' => 'Cloud',
            'slug' => 'cloud',
            'module' => Category::MODULE_BLOG,
        ]);
        Blog::query()->create([
            'title' => 'Cloud post',
            'slug' => 'cloud-post',
            'template' => 'default',
            'content' => 'Hello',
            'status' => 'published',
            'category_id' => $category->id,
        ]);
        Blog::query()->create([
            'title' => 'Draft post',
            'slug' => 'draft-post',
            'template' => 'default',
            'content' => 'Nope',
            'status' => 'draft',
            'category_id' => $category->id,
        ]);

        $posts = $this->get('/post-sitemap.xml');
        $posts->assertOk();
        $posts->assertSee(url('/blog/cloud-post/'), false);
        $posts->assertDontSee(url('/blog/draft-post/'), false);

        $categories = $this->get('/category-sitemap.xml');
        $categories->assertOk();
        $categories->assertSee(url('/blog/category/cloud/'), false);
    }

    public function test_custom_urls_preserve_query_strings_and_skip_invalid_values(): void
    {
        $this->seedWebsiteSettings([
            'sitemap_custom_urls' => [
                [
                    'url' => '/search/?q=outsourcing',
                    'enabled' => true,
                    'priority' => '0.4',
                ],
                [
                    'url' => 'javascript:alert(1)',
                    'enabled' => true,
                ],
                [
                    'url' => '/hidden-custom/',
                    'enabled' => false,
                ],
            ],
        ]);

        $index = $this->get('/sitemap.xml');
        $index->assertSee(url('/custom-sitemap.xml'), false);

        $custom = $this->get('/custom-sitemap.xml');
        $custom->assertOk();
        $custom->assertSee('http://localhost/search/?q=outsourcing', false);
        $custom->assertDontSee('javascript:alert', false);
        $custom->assertDontSee(url('/hidden-custom/'), false);
    }

    public function test_disabled_type_is_omitted_from_the_index_and_returns_404(): void
    {
        $this->seedWebsiteSettings([
            'sitemap_types' => [
                'newsletters' => [
                    'enabled' => false,
                    'changefreq' => 'monthly',
                    'priority' => '0.5',
                ],
            ],
        ]);

        $this->get('/sitemap.xml')->assertDontSee('newsletter-sitemap.xml', false);
        $this->get('/newsletter-sitemap.xml')->assertNotFound();
    }

    public function test_lastmod_changefreq_and_priority_toggles(): void
    {
        $this->seedWebsiteSettings([
            'sitemap_include_lastmod' => false,
            'sitemap_include_changefreq' => true,
            'sitemap_include_priority' => true,
        ]);
        $this->createPublishedPage('about-us', 'About us');

        $response = $this->get('/page-sitemap.xml');
        $response->assertOk();
        $response->assertDontSee('<lastmod>', false);
        $response->assertSee('<changefreq>', false);
        $response->assertSee('<priority>', false);
    }

    public function test_disabled_sitemap_returns_404(): void
    {
        $this->seedWebsiteSettings([
            'sitemap_enabled' => false,
        ]);

        $this->get('/sitemap.xml')->assertNotFound();
        $this->get('/page-sitemap.xml')->assertNotFound();
    }

    public function test_cache_is_invalidated_when_content_changes(): void
    {
        $this->seedWebsiteSettings([
            'sitemap_cache_ttl' => 3600,
        ]);
        $this->createPublishedPage('about-us', 'About us');

        $this->get('/page-sitemap.xml')->assertSee(url('/about-us/'), false);

        $this->createPublishedPage('new-page', 'New page');

        $this->get('/page-sitemap.xml')->assertSee(url('/new-page/'), false);
        $this->get('/sitemap.xml')->assertSee(url('/page-sitemap.xml'), false);
    }

    public function test_robots_txt_uses_the_current_app_url_and_preserves_existing_rules(): void
    {
        $this->seedWebsiteSettings([
            'robots_txt' => "User-agent: *\nDisallow: /secret\nAllow: /\n",
            'sitemap_enabled' => true,
            'sitemap_add_to_robots' => true,
        ]);

        $response = $this->get('/robots.txt');
        $response->assertOk();
        $response->assertSee("User-agent: *\nDisallow: /secret\nAllow: /", false);
        $response->assertSee('Sitemap: http://localhost/sitemap.xml', false);
        $this->assertSame(1, substr_count(strtolower($response->getContent()), 'sitemap:'));
    }

    public function test_urls_follow_configured_app_url_not_a_hardcoded_domain(): void
    {
        $this->seedWebsiteSettings();
        $this->createPublishedPage('about-us', 'About us');

        config(['app.url' => 'https://staging.example.test']);
        $this->app['url']->forceRootUrl('https://staging.example.test');
        $this->app['url']->forceScheme('https');
        app(WebsiteSettingService::class)->forget();

        $index = $this->get('/sitemap.xml');
        $index->assertOk();
        $index->assertSee('https://staging.example.test/page-sitemap.xml', false);
        $index->assertDontSee('http://localhost', false);
        $index->assertDontSee('ibntech.com', false);

        $pages = $this->get('/page-sitemap.xml');
        $pages->assertSee('https://staging.example.test/about-us/', false);
        $pages->assertDontSee('http://localhost', false);

        $robots = $this->get('/robots.txt');
        $robots->assertSee('Sitemap: https://staging.example.test/sitemap.xml', false);
        $robots->assertDontSee('Sitemap: http://localhost/sitemap.xml', false);
    }

    public function test_homepage_appears_once_and_uses_page_override_when_set(): void
    {
        $this->seedWebsiteSettings([
            'sitemap_include_changefreq' => true,
            'sitemap_include_priority' => true,
            'sitemap_types' => [
                'pages' => [
                    'enabled' => true,
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ],
            ],
        ]);

        $home = Page::query()->create([
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'default',
            'status' => 'published',
        ]);

        $withoutOverride = $this->get('/page-sitemap.xml');
        $withoutOverride->assertOk();
        $homeLoc = $this->homepageLoc($withoutOverride->getContent());
        $this->assertStringContainsString('<priority>1.0</priority>', $this->urlBlock($withoutOverride->getContent(), $homeLoc));
        $this->assertStringContainsString('<changefreq>weekly</changefreq>', $this->urlBlock($withoutOverride->getContent(), $homeLoc));

        $home->seoMeta()->create([
            'sitemap_include' => true,
            'sitemap_changefreq' => 'daily',
            'sitemap_priority' => '0.4',
        ]);

        $withOverride = $this->get('/page-sitemap.xml');
        $withOverride->assertOk();
        $homeLoc = $this->homepageLoc($withOverride->getContent());
        $homeBlock = $this->urlBlock($withOverride->getContent(), $homeLoc);
        $this->assertStringContainsString('<changefreq>daily</changefreq>', $homeBlock);
        $this->assertStringContainsString('<priority>0.4</priority>', $homeBlock);
    }

    public function test_page_without_override_uses_pages_sitemap_defaults(): void
    {
        $this->seedWebsiteSettings([
            'sitemap_include_changefreq' => true,
            'sitemap_include_priority' => true,
            'sitemap_types' => [
                'pages' => [
                    'enabled' => true,
                    'changefreq' => 'monthly',
                    'priority' => '0.4',
                ],
            ],
        ]);
        $this->createPublishedPage('about-us', 'About us');

        $block = $this->urlBlock($this->get('/page-sitemap.xml')->getContent(), url('/about-us/'));
        $this->assertStringContainsString('<changefreq>monthly</changefreq>', $block);
        $this->assertStringContainsString('<priority>0.4</priority>', $block);
    }

    public function test_custom_sitemap_excludes_existing_cms_page_urls(): void
    {
        $this->seedWebsiteSettings([
            'sitemap_custom_urls' => [
                [
                    'url' => '/about-us/',
                    'enabled' => true,
                    'changefreq' => 'daily',
                    'priority' => '0.2',
                ],
                [
                    'url' => '/guides/extra/?ref=sitemap',
                    'enabled' => true,
                ],
            ],
        ]);
        $this->createPublishedPage('about-us', 'About us');

        $pages = $this->get('/page-sitemap.xml');
        $pages->assertOk();
        $this->assertSame(1, substr_count($pages->getContent(), '<loc>'.url('/about-us/').'</loc>'));

        $custom = $this->get('/custom-sitemap.xml');
        $custom->assertOk();
        $custom->assertDontSee(url('/about-us/'), false);
        $custom->assertSee('http://localhost/guides/extra/?ref=sitemap', false);
    }

    public function test_sitemap_responses_use_validation_friendly_cache_headers(): void
    {
        $this->seedWebsiteSettings();
        $this->createPublishedPage('about-us', 'About us');

        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $cacheControl = (string) $response->headers->get('Cache-Control');
        $this->assertStringContainsString('no-cache', $cacheControl);
        $this->assertStringContainsString('must-revalidate', $cacheControl);
        $response->assertHeader('Pragma', 'no-cache');
    }

    public function test_blog_category_is_omitted_when_only_noindex_posts_exist(): void
    {
        $this->seedWebsiteSettings();
        $category = Category::query()->create([
            'name' => 'Hidden',
            'slug' => 'hidden-cloud',
            'module' => Category::MODULE_BLOG,
        ]);
        $blog = Blog::query()->create([
            'title' => 'Hidden post',
            'slug' => 'hidden-post',
            'template' => 'default',
            'content' => 'Hello',
            'status' => 'published',
            'category_id' => $category->id,
        ]);
        $blog->seoMeta()->create([
            'sitemap_include' => true,
            'robots_index' => 'noindex',
        ]);

        $this->get('/category-sitemap.xml')->assertDontSee(url('/blog/category/hidden-cloud/'), false);
    }

    /**
     * @dataProvider changefreqProvider
     */
    public function test_per_type_changefreq_is_rendered_when_enabled(string $changefreq): void
    {
        $this->seedWebsiteSettings([
            'sitemap_include_changefreq' => true,
            'sitemap_types' => [
                'pages' => [
                    'enabled' => true,
                    'changefreq' => $changefreq,
                    'priority' => '0.8',
                ],
            ],
        ]);
        $this->createPublishedPage('about-us', 'About us');

        $response = $this->get('/page-sitemap.xml');
        $response->assertOk();
        $response->assertSee('<changefreq>'.$changefreq.'</changefreq>', false);
    }

    /**
     * @return array<string, array{0: string}>
     */
    public static function changefreqProvider(): array
    {
        return [
            'always' => ['always'],
            'daily' => ['daily'],
            'weekly' => ['weekly'],
            'monthly' => ['monthly'],
            'yearly' => ['yearly'],
            'never' => ['never'],
        ];
    }

    /**
     * @dataProvider priorityProvider
     */
    public function test_per_type_priority_is_rendered_when_enabled(string $input, string $expected): void
    {
        $this->seedWebsiteSettings([
            'sitemap_include_priority' => true,
            'sitemap_types' => [
                'pages' => [
                    'enabled' => true,
                    'changefreq' => 'weekly',
                    'priority' => $input,
                ],
            ],
        ]);
        $this->createPublishedPage('about-us', 'About us');

        $response = $this->get('/page-sitemap.xml');
        $response->assertOk();
        $response->assertSee('<priority>'.$expected.'</priority>', false);
    }

    /**
     * @return array<string, array{0: string, 1: string}>
     */
    public static function priorityProvider(): array
    {
        return [
            'minimum' => ['0.0', '0.0'],
            'mid' => ['0.5', '0.5'],
            'maximum' => ['1.0', '1.0'],
        ];
    }

    public function test_custom_url_xml_includes_lastmod_changefreq_and_priority(): void
    {
        $this->seedWebsiteSettings([
            'sitemap_include_lastmod' => true,
            'sitemap_include_changefreq' => true,
            'sitemap_include_priority' => true,
            'sitemap_custom_urls' => [
                [
                    'url' => '/guides/custom/?ref=sitemap',
                    'enabled' => true,
                    'lastmod' => '2026-09-01T10:30:00+00:00',
                    'changefreq' => 'monthly',
                    'priority' => '0.4',
                ],
            ],
        ]);

        $response = $this->get('/custom-sitemap.xml');
        $response->assertOk();
        $response->assertSee('http://localhost/guides/custom/?ref=sitemap', false);
        $response->assertSee('<lastmod>2026-09-01T10:30:00+00:00</lastmod>', false);
        $response->assertSee('<changefreq>monthly</changefreq>', false);
        $response->assertSee('<priority>0.4</priority>', false);
    }

    public function test_every_sitemap_type_splits_at_the_configured_url_limit(): void
    {
        config(['sitemap.max_urls_per_file' => 2]);
        $this->seedWebsiteSettings();

        Blog::query()->create([
            'title' => 'Post one',
            'slug' => 'post-one',
            'template' => 'default',
            'content' => 'One',
            'status' => 'published',
        ]);
        Blog::query()->create([
            'title' => 'Post two',
            'slug' => 'post-two',
            'template' => 'default',
            'content' => 'Two',
            'status' => 'published',
        ]);
        Blog::query()->create([
            'title' => 'Post three',
            'slug' => 'post-three',
            'template' => 'default',
            'content' => 'Three',
            'status' => 'published',
        ]);

        $index = $this->get('/sitemap.xml');
        $index->assertSee(url('/post-sitemap.xml'), false);
        $index->assertSee(url('/post-sitemap2.xml'), false);
        $index->assertDontSee(url('/post-sitemap1.xml'), false);

        $partOne = $this->get('/post-sitemap.xml');
        $partTwo = $this->get('/post-sitemap2.xml');
        $partOne->assertOk();
        $partTwo->assertOk();

        $this->assertCount(2, simplexml_load_string($partOne->getContent())->url);
        $this->assertCount(1, simplexml_load_string($partTwo->getContent())->url);
        $this->get('/post-sitemap3.xml')->assertNotFound();
    }

    /**
     * @param  array<string, mixed>  $overrides
     */
    private function seedWebsiteSettings(array $overrides = []): WebsiteSetting
    {
        $settings = WebsiteSetting::query()->create(array_merge(
            app(WebsiteSettingService::class)->defaultAttributes(),
            $overrides,
        ));

        app(WebsiteSettingService::class)->forget();

        return $settings;
    }

    private function homepageLoc(string $xml): string
    {
        $pattern = '#<loc>('.preg_quote(rtrim(url('/'), '/'), '#').'/?)</loc>#';
        preg_match_all($pattern, $xml, $matches);
        $this->assertCount(1, $matches[1]);

        return $matches[1][0];
    }

    private function urlBlock(string $xml, string $loc): string
    {
        $pattern = '/<url>\s*<loc>'.preg_quote($loc, '/').'<\/loc>.*?<\/url>/s';
        $this->assertSame(1, preg_match($pattern, $xml, $matches));

        return $matches[0];
    }

    private function createPublishedPage(string $slug, string $title): Page
    {
        return Page::query()->create([
            'title' => $title,
            'slug' => $slug,
            'template' => 'default',
            'status' => 'published',
        ]);
    }
}
