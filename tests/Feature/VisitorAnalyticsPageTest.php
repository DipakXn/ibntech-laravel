<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\VisitorAnalytics;
use App\Filament\Widgets\VisitorTrendChart;
use App\Models\Blog;
use App\Models\Page;
use App\Models\PageView;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class VisitorAnalyticsPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_guests_and_authors_cannot_open_visitor_analytics(): void
    {
        $this->get('/admin/visitor-analytics')->assertRedirect('/'.Login::ROUTE_PATH);

        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $this->actingAs($author);

        $this->assertFalse(VisitorAnalytics::canAccess());
        $this->assertFalse(VisitorTrendChart::canView());
        $this->get('/admin/visitor-analytics')->assertForbidden();

        Livewire::test(VisitorAnalytics::class)->assertForbidden();
    }

    public function test_administrators_see_aggregated_analytics_without_visitor_identifiers(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $page = Page::query()->create([
            'title' => 'About us',
            'slug' => 'about-us',
            'template' => 'about',
            'status' => 'published',
            'published_at' => now(),
        ]);
        $blog = Blog::query()->create([
            'title' => 'Launch post',
            'slug' => 'launch-post',
            'template' => 'default',
            'content' => [],
            'status' => 'published',
            'published_at' => now(),
        ]);
        $visitorId = (string) Str::uuid();

        PageView::query()->create([
            'visitor_id' => $visitorId,
            'visited_at' => now(),
            'path' => '/about-us',
            'content_type' => 'page',
            'content_id' => $page->id,
            'referrer_host' => 'www.google.com',
            'country' => null,
            'device' => 'desktop',
            'browser' => 'Chrome',
            'operating_system' => 'Windows',
        ]);
        PageView::query()->create([
            'visitor_id' => (string) Str::uuid(),
            'visited_at' => now(),
            'path' => '/blog/launch-post',
            'content_type' => 'blog',
            'content_id' => $blog->id,
            'referrer_host' => null,
            'country' => null,
            'device' => 'mobile',
            'browser' => 'Safari',
            'operating_system' => 'iOS',
        ]);

        $this->actingAs($admin);

        $this->assertTrue(VisitorAnalytics::canAccess());
        $this->assertSame('Administration', VisitorAnalytics::getNavigationGroup());
        $this->assertSame('visitor-analytics', VisitorAnalytics::getDefaultSlug());

        $response = $this->get('/admin/visitor-analytics');

        $response->assertOk();
        $response->assertSee('Visitor analytics');
        $response->assertSee('Total Visitors');
        $response->assertSee('Total Page Views');
        $response->assertSee('Unique Visitors');
        $response->assertSee('About us');
        $response->assertSee('Launch post');
        $response->assertSee('www.google.com');
        $response->assertSee('Country data is not available for this date range.');
        $response->assertSee('Desktop');
        $response->assertSee('Chrome');
        $response->assertSee('Windows');
        $response->assertDontSee($visitorId);
        $response->assertDontSee('Mozilla/');
        $response->assertSee('Visitors and page views');

        Livewire::actingAs($admin)
            ->test(VisitorTrendChart::class)
            ->assertOk()
            ->assertSee('Unique Visitors')
            ->assertSee('Page Views');

        $filtered = Livewire::test(VisitorAnalytics::class)
            ->set('contentType', 'blog')
            ->instance();
        $content = (fn () => $this->getViewData()['content']['rows'])->call($filtered);

        $this->assertSame(['Launch post'], array_column($content, 'title'));
    }
}
