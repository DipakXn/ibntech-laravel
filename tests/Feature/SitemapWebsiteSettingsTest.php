<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\WebsiteSettings;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Services\Sitemap\SitemapCacheService;
use App\Services\Sitemap\SitemapSettings;
use App\Services\WebsiteSettingService;
use App\Support\Sitemap\SitemapType;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Livewire\Livewire;
use Tests\Support\UsesIsolatedSqliteSchema;
use Tests\TestCase;

class SitemapWebsiteSettingsTest extends TestCase
{
    use UsesIsolatedSqliteSchema;

    public function test_guests_cannot_access_website_settings(): void
    {
        $this->get('/admin/website-settings')
            ->assertRedirect('/'.Login::ROUTE_PATH);
    }

    public function test_authors_cannot_access_website_settings(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $this->actingAs($author)
            ->get('/admin/website-settings')
            ->assertForbidden();
    }

    public function test_administrator_can_save_sitemap_settings_without_writing_unsafe_robots_rules(): void
    {
        $admin = $this->administrator();
        $this->seedWebsiteSettings([
            'robots_txt' => "User-agent: *\nDisallow: /keep-this\n",
        ]);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_enabled', true)
            ->set('data.sitemap_include_lastmod', false)
            ->set('data.sitemap_include_changefreq', true)
            ->set('data.sitemap_include_priority', true)
            ->set('data.sitemap_add_to_robots', true)
            ->set('data.sitemap_cache_ttl', 120)
            ->set('data.sitemap_custom_urls', [
                [
                    'url' => '/guides/custom/?ref=sitemap',
                    'enabled' => true,
                    'changefreq' => 'monthly',
                    'priority' => '0.3',
                ],
            ])
            ->call('save');

        $settings = WebsiteSetting::query()->first();
        $this->assertTrue((bool) $settings->sitemap_enabled);
        $this->assertFalse((bool) $settings->sitemap_include_lastmod);
        $this->assertTrue((bool) $settings->sitemap_include_changefreq);
        $this->assertTrue((bool) $settings->sitemap_include_priority);
        $this->assertSame(120, (int) $settings->sitemap_cache_ttl);
        $this->assertSame('/guides/custom/?ref=sitemap', $settings->sitemap_custom_urls[0]['url']);
        $this->assertSame("User-agent: *\nDisallow: /keep-this\n", $settings->robots_txt);
        $this->assertFileDoesNotExist(public_path('robots.txt'));

        $robots = $this->get('/robots.txt');
        $robots->assertOk();
        $robots->assertSee("User-agent: *\nDisallow: /keep-this", false);
        $robots->assertSee('Sitemap: http://localhost/sitemap.xml', false);
        $this->assertSame(1, substr_count(strtolower($robots->getContent()), 'sitemap:'));
    }

    public function test_administrator_can_disable_global_sitemap_via_filament(): void
    {
        $this->administrator();
        $this->seedWebsiteSettings();
        $this->createPublishedPage('about-us', 'About us');

        $cache = app(SitemapCacheService::class);
        $this->get('/sitemap.xml')->assertOk();
        Cache::put($cache->indexKey(), '<stale/>', 3600);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_enabled', false)
            ->call('save');

        $settings = WebsiteSetting::query()->first();
        $this->assertFalse((bool) $settings->sitemap_enabled);
        $this->assertFalse(Cache::has($cache->indexKey()));
        $this->get('/sitemap.xml')->assertNotFound();
        $this->get('/sitemap_index.xml')->assertNotFound();
    }

    public function test_administrator_can_disable_and_reenable_pages_sitemap_type(): void
    {
        File::partialMock()->shouldReceive('put')->andReturnTrue();

        $this->administrator();
        $this->seedWebsiteSettings();
        $this->createPublishedPage('about-us', 'About us');

        $types = SitemapType::formState(null);
        $types = $this->setTypeEnabled($types, 'pages', false);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_types', $types)
            ->call('save');

        $this->assertFalse($this->pagesSitemapTypeEnabled());
        $this->get('/sitemap.xml')->assertDontSee('page-sitemap.xml', false);
        $this->get('/page-sitemap.xml')->assertNotFound();

        $types = $this->setTypeEnabled($types, 'pages', true);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_types', $types)
            ->call('save');

        $this->get('/page-sitemap.xml')->assertOk();
        $this->get('/sitemap.xml')->assertSee(url('/page-sitemap.xml'), false);
    }

    public function test_administrator_can_disable_and_reenable_blogs_sitemap_type(): void
    {
        File::partialMock()->shouldReceive('put')->andReturnTrue();

        $this->administrator();
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

        $types = $this->setTypeEnabled(SitemapType::formState(null), 'blogs', false);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_types', $types)
            ->call('save');

        $this->assertFalse($this->blogsSitemapTypeEnabled());
        $this->get('/post-sitemap.xml')->assertNotFound();
        $this->get('/sitemap.xml')->assertDontSee('post-sitemap.xml', false);

        $types = $this->setTypeEnabled($types, 'blogs', true);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_types', $types)
            ->call('save');

        $this->get('/post-sitemap.xml')->assertOk();
    }

    public function test_administrator_can_disable_and_reenable_newsletters_sitemap_type(): void
    {
        File::partialMock()->shouldReceive('put')->andReturnTrue();

        $this->administrator();
        $this->seedWebsiteSettings();
        $newsletter = Newsletter::query()->create([
            'title' => 'Issue',
            'slug' => 'issue-one',
            'template' => 'default',
            'status' => 'published',
        ]);
        $newsletter->seoMeta()->create([
            'sitemap_include' => true,
            'robots_index' => 'index',
        ]);

        $types = $this->setTypeEnabled(SitemapType::formState(null), 'newsletters', false);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_types', $types)
            ->call('save');

        $this->assertFalse($this->newslettersSitemapTypeEnabled());
        $this->get('/newsletter-sitemap.xml')->assertNotFound();

        $types = $this->setTypeEnabled($types, 'newsletters', true);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_types', $types)
            ->call('save');

        $this->get('/newsletter-sitemap.xml')->assertOk();
    }

    public function test_robots_txt_sitemap_directive_follows_sitemap_settings(): void
    {
        $this->administrator();
        $this->seedWebsiteSettings([
            'robots_txt' => "User-agent: *\nDisallow: /keep-this\n",
            'sitemap_enabled' => true,
            'sitemap_add_to_robots' => true,
        ]);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_add_to_robots', true)
            ->call('save');

        $enabled = $this->get('/robots.txt');
        $enabled->assertSee('Sitemap: http://localhost/sitemap.xml', false);
        $enabled->assertSee("User-agent: *\nDisallow: /keep-this", false);
        $this->assertSame(1, substr_count(strtolower($enabled->getContent()), 'sitemap:'));

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_add_to_robots', false)
            ->call('save');

        $directiveOff = $this->get('/robots.txt');
        $directiveOff->assertDontSee('Sitemap:', false);
        $directiveOff->assertSee("User-agent: *\nDisallow: /keep-this", false);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_enabled', false)
            ->set('data.sitemap_add_to_robots', true)
            ->call('save');

        $this->get('/robots.txt')->assertDontSee('Sitemap:', false);
    }

    public function test_sitemap_cache_reflects_settings_changes_after_save(): void
    {
        File::partialMock()->shouldReceive('put')->andReturnTrue();

        $this->administrator();
        $this->seedWebsiteSettings([
            'sitemap_cache_ttl' => 3600,
            'sitemap_include_lastmod' => true,
        ]);
        $this->createPublishedPage('about-us', 'About us');

        $cache = app(SitemapCacheService::class);
        $this->get('/page-sitemap.xml')->assertSee('<lastmod>', false);
        $this->assertTrue(Cache::has($cache->xmlKey(SitemapType::Pages, 1)));

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_include_lastmod', false)
            ->call('save');

        $this->assertFalse(Cache::has($cache->xmlKey(SitemapType::Pages, 1)));
        $this->get('/page-sitemap.xml')->assertDontSee('<lastmod>', false);

        $types = $this->setTypeEnabled(SitemapType::formState(null), 'pages', false);

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_types', $types)
            ->call('save');

        $this->assertFalse(Cache::has($cache->indexKey()));
        $this->get('/page-sitemap.xml')->assertNotFound();

        Livewire::test(WebsiteSettings::class)
            ->set('data.sitemap_enabled', false)
            ->call('save');

        $this->get('/sitemap.xml')->assertNotFound();
    }

    /**
     * @param  array<string, mixed>  $overrides
     */
    private function seedWebsiteSettings(array $overrides = []): WebsiteSetting
    {
        WebsiteSetting::query()->create(array_merge(
            app(WebsiteSettingService::class)->defaultAttributes(),
            $overrides,
        ));
        app(WebsiteSettingService::class)->forget();

        return WebsiteSetting::query()->first();
    }

    private function administrator(): User
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
        $this->actingAs($admin);

        return $admin;
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

    /**
     * @param  list<array<string, mixed>>  $rows
     * @return list<array<string, mixed>>
     */
    private function setTypeEnabled(array $rows, string $key, bool $enabled): array
    {
        foreach ($rows as &$row) {
            if (($row['key'] ?? null) === $key) {
                $row['enabled'] = $enabled;
            }
        }

        return $rows;
    }

    private function pagesSitemapTypeEnabled(): bool
    {
        return (new SitemapSettings(WebsiteSetting::query()->first()))->typeEnabled(SitemapType::Pages);
    }

    private function blogsSitemapTypeEnabled(): bool
    {
        return (new SitemapSettings(WebsiteSetting::query()->first()))->typeEnabled(SitemapType::Blogs);
    }

    private function newslettersSitemapTypeEnabled(): bool
    {
        return (new SitemapSettings(WebsiteSetting::query()->first()))->typeEnabled(SitemapType::Newsletters);
    }
}
