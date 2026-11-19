<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\VisitorAnalytics;
use App\Filament\Widgets\VisitorTrendChart;
use App\Models\Blog;
use App\Models\Lead;
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
        Lead::query()->create([
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'form_name' => 'contact',
            'status' => Lead::STATUS_NEW,
            'page_url' => 'https://example.com/about-us/?utm=1',
        ]);
        Lead::query()->create([
            'name' => 'No Source',
            'email' => 'none@example.com',
            'form_name' => 'ebook_download',
            'status' => Lead::STATUS_NEW,
            'page_url' => null,
            'visitor_id' => $visitorId,
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
        $response->assertSee('Enquiries');
        $response->assertSee('Gated Downloads');
        $response->assertSee('Page types');
        $response->assertSee('Top converting pages');
        $response->assertSee('Source unavailable: 1');
        $response->assertSee('Submissions without a usable source page are not assigned to a page');
        $response->assertDontSee($visitorId);

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

        $viewData = (fn () => $this->getViewData())->call($filtered);
        $this->assertSame(1, $viewData['kpis']['enquiries']);
        $this->assertSame(1, $viewData['kpis']['gated_downloads']);
        $this->assertSame(1, $viewData['kpis']['unattributed']);
        $this->assertSame(50.0, $viewData['kpis']['conversion_rate']);
        $this->assertSame('About us', $viewData['topConversions'][0]['title']);
        $this->assertSame(1, $viewData['topConversions'][0]['enquiries']);
        $this->assertSame(0, $viewData['topConversions'][0]['downloads']);
    }
}
