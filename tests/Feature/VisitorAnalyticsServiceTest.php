<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Page;
use App\Models\PageView;
use App\Services\Analytics\VisitorAnalyticsRange;
use App\Services\Analytics\VisitorAnalyticsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;

class VisitorAnalyticsServiceTest extends TestCase
{
    use RefreshDatabase;

    private VisitorAnalyticsService $analytics;

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow('2026-10-07 15:00:00');
        $this->analytics = app(VisitorAnalyticsService::class);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_empty_analytics_are_zero_without_invented_rows(): void
    {
        $range = VisitorAnalyticsRange::make(VisitorAnalyticsRange::LAST_30);

        $kpis = $this->analytics->kpis($range);

        $this->assertSame(0, $kpis['total_visitors']);
        $this->assertSame(0, $kpis['total_page_views']);
        $this->assertSame(0, $kpis['unique_visitors']);
        $this->assertSame(0, $kpis['page_views']);
        $this->assertFalse($this->analytics->dailyTrend($range)['has_data']);
        $this->assertSame([], $this->analytics->topContent($range));
        $this->assertSame(0, $this->analytics->contentPerformance($range, null, 'page_views', 'desc')['total']);
        $this->assertSame([], $this->analytics->referrers($range));
        $this->assertSame([], $this->analytics->countries($range));
        $this->assertSame([], $this->analytics->browsers($range));
        $this->assertSame([], $this->analytics->operatingSystems($range));
        $this->assertSame(
            [
                ['device' => 'desktop', 'label' => 'Desktop', 'page_views' => 0, 'unique_visitors' => 0],
                ['device' => 'mobile', 'label' => 'Mobile', 'page_views' => 0, 'unique_visitors' => 0],
                ['device' => 'tablet', 'label' => 'Tablet', 'page_views' => 0, 'unique_visitors' => 0],
                ['device' => 'unknown', 'label' => 'Unknown', 'page_views' => 0, 'unique_visitors' => 0],
            ],
            $this->analytics->devices($range),
        );
    }

    public function test_kpis_count_unique_visitors_separately_from_page_views(): void
    {
        $today = (string) Str::uuid();
        $yesterday = (string) Str::uuid();
        $earlierThisWeek = (string) Str::uuid();
        $lastMonth = (string) Str::uuid();

        $this->recordView(['visitor_id' => $today, 'visited_at' => '2026-10-07 09:00:00']);
        $this->recordView(['visitor_id' => $today, 'visited_at' => '2026-10-07 11:00:00']);
        $this->recordView(['visitor_id' => $yesterday, 'visited_at' => '2026-10-06 18:00:00']);
        $this->recordView(['visitor_id' => $earlierThisWeek, 'visited_at' => '2026-10-05 12:00:00']);
        $this->recordView(['visitor_id' => $lastMonth, 'visited_at' => '2026-09-20 12:00:00']);

        $kpis = $this->analytics->kpis(VisitorAnalyticsRange::make(VisitorAnalyticsRange::LAST_30));

        $this->assertSame(4, $kpis['total_visitors']);
        $this->assertSame(5, $kpis['total_page_views']);
        $this->assertSame(1, $kpis['visitors_today']);
        $this->assertSame(1, $kpis['visitors_yesterday']);
        $this->assertSame(3, $kpis['visitors_this_week']);
        $this->assertSame(3, $kpis['visitors_this_month']);
        $this->assertSame(4, $kpis['unique_visitors']);
        $this->assertSame(5, $kpis['page_views']);
    }

    public function test_date_filtering_limits_totals_and_daily_aggregation(): void
    {
        $visitor = (string) Str::uuid();
        $other = (string) Str::uuid();

        $this->recordView(['visitor_id' => $visitor, 'visited_at' => '2026-10-07 10:00:00']);
        $this->recordView(['visitor_id' => $visitor, 'visited_at' => '2026-10-07 16:00:00']);
        $this->recordView(['visitor_id' => $other, 'visited_at' => '2026-10-06 10:00:00']);
        $this->recordView(['visitor_id' => (string) Str::uuid(), 'visited_at' => '2026-08-01 10:00:00']);

        $range = VisitorAnalyticsRange::make(VisitorAnalyticsRange::LAST_7);
        $kpis = $this->analytics->kpis($range);
        $trend = $this->analytics->dailyTrend($range);

        $this->assertSame(2, $kpis['unique_visitors']);
        $this->assertSame(3, $kpis['page_views']);
        $this->assertSame(3, $kpis['total_visitors']);
        $this->assertSame(4, $kpis['total_page_views']);
        $this->assertCount(7, $trend['labels']);
        $this->assertSame(2, $trend['page_views'][array_key_last($trend['page_views'])]);
        $this->assertSame(1, $trend['visitors'][array_key_last($trend['visitors'])]);
        $this->assertSame(1, $trend['page_views'][array_key_last($trend['page_views']) - 1]);

        $custom = VisitorAnalyticsRange::make(VisitorAnalyticsRange::CUSTOM, '2026-10-06', '2026-10-06');
        $customKpis = $this->analytics->kpis($custom);

        $this->assertSame(1, $customKpis['unique_visitors']);
        $this->assertSame(1, $customKpis['page_views']);
        $this->assertSame('2026-10-06', $custom->startsAt->toDateString());
        $this->assertSame('2026-10-06', $custom->endsAt->toDateString());
    }

    public function test_content_performance_groups_types_and_orders_top_content(): void
    {
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

        $reader = (string) Str::uuid();
        $this->recordView([
            'visitor_id' => $reader,
            'content_type' => 'page',
            'content_id' => $page->id,
            'visited_at' => '2026-10-05 09:00:00',
        ]);
        $this->recordView([
            'visitor_id' => $reader,
            'content_type' => 'page',
            'content_id' => $page->id,
            'visited_at' => '2026-10-07 09:00:00',
        ]);
        $this->recordView([
            'visitor_id' => (string) Str::uuid(),
            'content_type' => 'blog',
            'content_id' => $blog->id,
            'visited_at' => '2026-10-07 12:00:00',
        ]);
        $this->recordView([
            'visitor_id' => (string) Str::uuid(),
            'content_type' => 'blog',
            'content_id' => $blog->id,
            'visited_at' => '2026-10-06 12:00:00',
        ]);
        $this->recordView([
            'visitor_id' => (string) Str::uuid(),
            'content_type' => 'blog',
            'content_id' => $blog->id,
            'visited_at' => '2026-10-06 13:00:00',
        ]);
        $this->recordView([
            'path' => '/blog/',
            'content_type' => null,
            'content_id' => null,
        ]);
        $this->recordView([
            'content_type' => 'page',
            'content_id' => 99999,
            'visited_at' => '2026-10-04 08:00:00',
        ]);

        $range = VisitorAnalyticsRange::make(VisitorAnalyticsRange::LAST_30);
        $top = $this->analytics->topContent($range);
        $pages = $this->analytics->contentPerformance($range, 'page', 'unique_visitors', 'desc');
        $byLastViewed = $this->analytics->contentPerformance($range, null, 'last_viewed', 'asc');

        $this->assertSame('Launch post', $top[0]['title']);
        $this->assertSame('Blogs', $top[0]['content_label']);
        $this->assertSame(3, $top[0]['page_views']);
        $this->assertSame(3, $top[0]['unique_visitors']);
        $this->assertSame(1, $top[0]['rank']);
        $this->assertSame('About us', $top[1]['title']);
        $this->assertSame(2, $top[1]['page_views']);
        $this->assertSame(1, $top[1]['unique_visitors']);

        $this->assertSame(2, $pages['total']);
        $this->assertEqualsCanonicalizing(
            ['About us', 'Removed record'],
            array_column($pages['rows'], 'title'),
        );
        $about = collect($pages['rows'])->firstWhere('title', 'About us');
        $this->assertSame(2, $about['page_views']);
        $this->assertSame(1, $about['unique_visitors']);

        $this->assertSame('Removed record', $byLastViewed['rows'][0]['title']);
        $this->assertSame('Launch post', $byLastViewed['rows'][array_key_last($byLastViewed['rows'])]['title']);
    }

    public function test_referrers_countries_and_client_fields_use_stored_values_only(): void
    {
        $visitor = (string) Str::uuid();

        $this->recordView([
            'visitor_id' => $visitor,
            'referrer_host' => 'www.google.com',
            'country' => 'US',
            'device' => 'desktop',
            'browser' => 'Chrome',
            'operating_system' => 'Windows',
        ]);
        $this->recordView([
            'visitor_id' => $visitor,
            'referrer_host' => 'www.google.com',
            'country' => 'US',
            'device' => 'desktop',
            'browser' => 'Chrome',
            'operating_system' => 'Windows',
        ]);
        $this->recordView([
            'referrer_host' => 'news.example',
            'country' => 'IN',
            'device' => 'mobile',
            'browser' => 'Safari',
            'operating_system' => 'iOS',
        ]);
        $this->recordView([
            'referrer_host' => null,
            'country' => null,
            'device' => null,
            'browser' => null,
            'operating_system' => null,
        ]);

        $range = VisitorAnalyticsRange::make(VisitorAnalyticsRange::LAST_30);
        $referrers = $this->analytics->referrers($range);
        $countries = $this->analytics->countries($range);
        $devices = collect($this->analytics->devices($range))->keyBy('device');
        $browsers = $this->analytics->browsers($range);
        $systems = $this->analytics->operatingSystems($range);

        $this->assertSame('www.google.com', $referrers[0]['referrer_host']);
        $this->assertSame(2, $referrers[0]['page_views']);
        $this->assertSame(1, $referrers[0]['unique_visitors']);
        $this->assertSame('news.example', $referrers[1]['referrer_host']);
        $this->assertCount(2, $referrers);

        $this->assertSame('US', $countries[0]['country']);
        $this->assertSame(2, $countries[0]['page_views']);
        $this->assertSame(1, $countries[0]['unique_visitors']);
        $this->assertSame('IN', $countries[1]['country']);

        $this->assertSame(2, $devices['desktop']['page_views']);
        $this->assertSame(1, $devices['desktop']['unique_visitors']);
        $this->assertSame(1, $devices['mobile']['page_views']);
        $this->assertSame(0, $devices['tablet']['page_views']);
        $this->assertSame(1, $devices['unknown']['page_views']);

        $this->assertSame('Chrome', $browsers[0]['browser']);
        $this->assertSame(2, $browsers[0]['page_views']);
        $this->assertSame(1, $browsers[0]['unique_visitors']);
        $this->assertSame('Windows', $systems[0]['operating_system']);
        $this->assertSame(2, $systems[0]['page_views']);
    }

    /**
     * @param  array<string, mixed>  $overrides
     */
    private function recordView(array $overrides = []): PageView
    {
        return PageView::query()->create(array_merge([
            'visitor_id' => (string) Str::uuid(),
            'visited_at' => now(),
            'path' => '/about-us',
            'content_type' => null,
            'content_id' => null,
            'referrer_host' => null,
            'country' => null,
            'device' => 'desktop',
            'browser' => 'Chrome',
            'operating_system' => 'Windows',
        ], $overrides));
    }
}
