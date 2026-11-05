<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\CloudflareCache;
use App\Filament\Pages\LogViewer;
use App\Filament\Pages\QueueMonitor;
use App\Filament\Pages\WebsiteSettings;
use App\Filament\Resources\Blogs\BlogCategoryResource;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Resources\Leads\LeadResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Users\UserResource;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\LandingPage;
use App\Models\Lead;
use App\Models\Page;
use App\Models\User;
use App\Support\AdminToolbar\AdminToolbar;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminToolbarTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_the_admin_panel_instance_is_the_one_passed_to_can_access_panel(): void
    {
        $panel = Filament::getPanel('admin');

        $this->assertNotNull($panel);
        $this->assertSame('admin', $panel->getId());
        $this->assertTrue($this->administrator()->canAccessPanel($panel));
        $this->assertTrue($this->author()->canAccessPanel($panel));
        $this->assertFalse($this->otherRole()->canAccessPanel($panel));
        $this->assertFalse(AdminToolbar::shouldRender());
    }

    public function test_existing_admin_urls_stay_in_place(): void
    {
        $this->assertSame('http://localhost/admin', Filament::getUrl());
        $this->assertSame('http://localhost/admin/logout', Filament::getLogoutUrl());
        $this->assertSame('http://localhost/admin/profile', Filament::getProfileUrl());
        $this->assertSame('http://localhost/'.Login::ROUTE_PATH, route('filament.admin.auth.login'));

        $this->get('/admin')->assertRedirect('http://localhost/'.Login::ROUTE_PATH);
        $this->get('/admin/login')->assertNotFound();
    }

    public function test_guests_do_not_see_the_toolbar_or_a_private_cache_header(): void
    {
        $this->homePage();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertDontSee('id="admin-toolbar"', false);
        $response->assertDontSee('/admin/profile', false);
        $this->assertSame(
            'max-age=0, must-revalidate, no-cache, no-store, private',
            (string) $response->headers->get('Cache-Control')
        );
    }

    public function test_a_user_who_cannot_access_the_panel_does_not_see_the_toolbar(): void
    {
        $this->homePage();

        $this->actingAs($this->otherRole())
            ->get('/')
            ->assertOk()
            ->assertDontSee('id="admin-toolbar"', false);
    }

    public function test_an_administrator_sees_the_toolbar_edit_link_and_private_cache_header(): void
    {
        $page = $this->homePage();
        $recent = $this->lead();
        $this->lead();
        $old = $this->lead();
        $old->forceFill(['created_at' => now()->subDays(10)])->save();

        DB::flushQueryLog();
        DB::enableQueryLog();

        $response = $this->actingAs($this->administrator())->get('/');

        $response->assertOk();
        $response->assertSee('id="admin-toolbar"', false);
        $response->assertSee('href="'.Filament::getUrl().'"', false);
        $response->assertSee('Edit Page', false);
        $response->assertSee(PageResource::getUrl('edit', ['record' => $page]), false);
        $response->assertSee('Clear Cache', false);
        $response->assertSee('action="'.route('filament.admin.clear-cache').'"', false);
        $response->assertSee('class="admin-toolbar__clear-cache"', false);
        $response->assertSee('class="admin-toolbar__badge">2<', false);
        $response->assertSee('method="POST"', false);
        $response->assertSee('action="'.Filament::getLogoutUrl().'"', false);

        $cacheControl = (string) $response->headers->get('Cache-Control');
        $this->assertStringContainsString('private', $cacheControl);
        $this->assertStringContainsString('no-store', $cacheControl);
        $this->assertStringNotContainsString('public', $cacheControl);

        $submissionQuery = collect(DB::getQueryLog())->first(
            fn (array $query): bool => str_contains($query['query'], 'form_submissions')
        );

        $this->assertNotNull($submissionQuery);
        $this->assertTrue(LeadResource::canViewAny());
        $this->assertContains(now()->subDays(7)->toDateString(), array_map(
            fn (mixed $binding): string => $binding instanceof \DateTimeInterface ? $binding->format('Y-m-d') : (string) $binding,
            $submissionQuery['bindings']
        ));
        $this->assertSame($recent->exists, true);
    }

    public function test_an_author_does_not_see_page_lead_or_administration_links(): void
    {
        $page = $this->page('About', 'about', 'about');
        $author = $this->author();

        DB::flushQueryLog();
        DB::enableQueryLog();

        $response = $this->actingAs($author)->followingRedirects()->get('/about/');

        $response->assertOk();
        $response->assertSee('id="admin-toolbar"', false);
        $response->assertSee('href="'.Filament::getUrl().'"', false);
        $response->assertDontSee('Edit Page', false);
        $response->assertDontSee(PageResource::getUrl('edit', ['record' => $page]), false);
        $response->assertDontSee(PageResource::getUrl('index'), false);
        $response->assertDontSee(LeadResource::getUrl(), false);
        $response->assertDontSee(WebsiteSettings::getUrl(), false);
        $response->assertDontSee(UserResource::getUrl('index'), false);
        $response->assertDontSee(CloudflareCache::getUrl(), false);
        $response->assertDontSee(QueueMonitor::getUrl(), false);
        $response->assertDontSee(LogViewer::getUrl(), false);
        $response->assertDontSee('admin-toolbar__submissions', false);
        $response->assertDontSee('Clear Cache', false);
        $response->assertDontSee(route('filament.admin.clear-cache'), false);
        $response->assertDontSee('/'.Login::ROUTE_PATH, false);

        $sql = collect(DB::getQueryLog())->pluck('query')->implode(' ');
        $this->assertStringNotContainsString('form_submissions', $sql);

        $this->actingAs($author)
            ->get(PageResource::getUrl('edit', ['record' => $page]))
            ->assertForbidden();

        $this->actingAs($this->administrator())->get('/admin')->assertOk();
    }

    public function test_an_administrator_can_clear_the_application_cache_without_leaving_the_page(): void
    {
        $this->page('About', 'about', 'about');
        Cache::put('toolbar-cache-probe', 'kept', 60);

        $this->actingAs($this->administrator())
            ->post(route('filament.admin.clear-cache'), [
                'return' => 'http://localhost/about/',
            ])
            ->assertRedirect('http://localhost/about/');

        $this->assertFalse(Cache::has('toolbar-cache-probe'));
    }

    public function test_clear_cache_rejects_an_off_site_return_and_authors(): void
    {
        Cache::put('toolbar-cache-probe', 'kept', 60);

        $this->actingAs($this->administrator())
            ->post(route('filament.admin.clear-cache'), [
                'return' => 'https://evil.example/phish',
            ])
            ->assertRedirect(url('/'));

        $this->assertFalse(Cache::has('toolbar-cache-probe'));

        Cache::put('toolbar-cache-probe', 'kept', 60);

        $this->actingAs($this->author())
            ->post(route('filament.admin.clear-cache'), [
                'return' => 'http://localhost/about/',
            ])
            ->assertForbidden();

        $this->assertTrue(Cache::has('toolbar-cache-probe'));

        auth()->logout();

        $this->post(route('filament.admin.clear-cache'), [
            'return' => 'http://localhost/about/',
        ])->assertRedirect('http://localhost/'.Login::ROUTE_PATH);
    }

    public function test_an_author_can_edit_a_blog_from_the_toolbar(): void
    {
        $blog = Blog::query()->create([
            'title' => 'Toolbar Blog',
            'slug' => 'toolbar-blog',
            'template' => 'default',
            'content' => [],
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->actingAs($this->author())
            ->followingRedirects()
            ->get('/blog/toolbar-blog/')
            ->assertOk()
            ->assertSee('Edit Blog', false)
            ->assertSee(BlogResource::getUrl('edit', ['record' => $blog]), false);
    }

    public function test_a_blog_category_links_to_the_module_resource(): void
    {
        $category = Category::query()->create([
            'name' => 'Cybersecurity',
            'slug' => 'cybersecurity',
            'module' => Category::MODULE_BLOG,
        ]);

        Blog::query()->create([
            'title' => 'Cybersecurity post',
            'slug' => 'cybersecurity-post',
            'template' => 'default',
            'content' => [],
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $moduleUrl = BlogCategoryResource::getUrl('edit', ['record' => $category]);
        $genericUrl = CategoryResource::getUrl('edit', ['record' => $category]);

        $this->assertNotSame($moduleUrl, $genericUrl);

        $this->actingAs($this->author())
            ->followingRedirects()
            ->get('/blog/category/cybersecurity/')
            ->assertOk()
            ->assertSee('Edit Category', false)
            ->assertSee($moduleUrl, false)
            ->assertDontSee($genericUrl, false);
    }

    public function test_a_case_study_listing_page_offers_manage_without_edit(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            CaseStudy::query()->create([
                'title' => "Toolbar case study {$i}",
                'slug' => "toolbar-case-study-{$i}",
                'template' => 'default',
                'content' => [],
                'status' => 'published',
                'published_at' => now()->subMinutes($i),
            ]);
        }

        $this->actingAs($this->author())
            ->followingRedirects()
            ->get('/case-study/page/2/')
            ->assertOk()
            ->assertSee('Manage Case Studies', false)
            ->assertSee(CaseStudyResource::getUrl('index'), false)
            ->assertDontSee('Edit Case Study', false);
    }

    public function test_a_landing_page_keeps_its_layout_and_shows_the_toolbar_to_an_administrator(): void
    {
        LandingPage::query()->create([
            'title' => 'VAPT Audit Services',
            'slug' => 'vapt-audit-services',
            'template' => 'vapt-audit-services',
            'status' => 'published',
        ]);

        $this->actingAs($this->administrator())
            ->followingRedirects()
            ->get('/lp/vapt-audit-services/')
            ->assertOk()
            ->assertSee('id="admin-toolbar"', false)
            ->assertSee('class="lp-site has-admin-toolbar"', false);
    }

    private function administrator(): User
    {
        return User::factory()->create([
            'name' => 'Toolbar Admin',
            'email' => 'toolbar-admin@example.net',
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
    }

    private function author(): User
    {
        return User::factory()->create([
            'name' => 'Toolbar Author',
            'email' => 'toolbar-author@example.net',
            'role' => User::ROLE_AUTHOR,
        ]);
    }

    private function otherRole(): User
    {
        return User::factory()->create([
            'name' => 'Toolbar Subscriber',
            'email' => 'toolbar-subscriber@example.net',
            'role' => 'subscriber',
        ]);
    }

    private function homePage(): Page
    {
        return $this->page('Home', 'home', 'home');
    }

    private function page(string $title, string $slug, string $template): Page
    {
        return Page::query()->create([
            'title' => $title,
            'slug' => $slug,
            'template' => $template,
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    private function lead(): Lead
    {
        return Lead::query()->create([
            'name' => 'Toolbar Lead',
            'email' => fake()->unique()->safeEmail(),
            'form_name' => 'contact',
            'message' => 'Hello',
            'page_url' => 'http://localhost/',
        ]);
    }
}
