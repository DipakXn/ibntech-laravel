<?php

namespace Tests\Feature;

use App\Models\AnalyticsExcludedIp;
use App\Models\Blog;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Lead;
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
        $this->assertSame(0, $kpis['enquiries']);
        $this->assertSame(0, $kpis['gated_downloads']);
        $this->assertSame(0, $kpis['unattributed']);
        $this->assertNull($kpis['conversion_rate']);
        $this->assertFalse($this->analytics->dailyTrend($range)['has_data']);
        $this->assertSame([], $this->analytics->topContent($range));
        $this->assertSame([], $this->analytics->topConversions($range));
        $this->assertSame([], $this->analytics->pageTypes($range));
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
        $this->assertSame('/blog', $byLastViewed['rows'][array_key_last($byLastViewed['rows'])]['title']);
        $this->assertSame('Other paths', $byLastViewed['rows'][array_key_last($byLastViewed['rows'])]['content_label']);
    }

    public function test_submissions_join_page_views_without_double_counting_or_invented_sources(): void
    {
        $about = Page::query()->create([
            'title' => 'About us',
            'slug' => 'about-us',
            'template' => 'about',
            'status' => 'published',
            'published_at' => now(),
        ]);
        $pricing = Page::query()->create([
            'title' => 'Pricing',
            'slug' => 'pricing',
            'template' => 'pricing',
            'status' => 'published',
            'published_at' => now(),
        ]);
        $launch = Blog::query()->create([
            'title' => 'Launch post',
            'slug' => 'launch-post',
            'template' => 'default',
            'content' => [],
            'status' => 'published',
            'published_at' => now(),
        ]);
        $second = Blog::query()->create([
            'title' => 'Second post',
            'slug' => 'second-post',
            'template' => 'default',
            'content' => [],
            'status' => 'published',
            'published_at' => now(),
        ]);
        $industry = Industry::query()->create([
            'title' => 'Accounting',
            'slug' => 'accounting',
            'template' => 'accounting',
            'status' => 'published',
            'published_at' => now(),
        ]);
        $landing = LandingPage::query()->create([
            'title' => 'Audit offer',
            'slug' => 'audit-offer',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $reader = (string) Str::uuid();
        $blogReader = (string) Str::uuid();
        $this->recordView(['visitor_id' => $reader, 'path' => '/about-us', 'content_type' => 'page', 'content_id' => $about->id]);
        $this->recordView(['visitor_id' => $blogReader, 'path' => '/blog/launch-post', 'content_type' => 'blog', 'content_id' => $launch->id]);
        $this->recordView(['visitor_id' => $blogReader, 'path' => '/blog/second-post', 'content_type' => 'blog', 'content_id' => $second->id]);
        $this->recordView(['path' => '/blog/', 'content_type' => null, 'content_id' => null]);
        $this->recordView(['path' => '/industry/accounting', 'content_type' => 'industry', 'content_id' => $industry->id]);
        $this->recordView(['path' => '/lp/audit-offer', 'content_type' => 'landing-page', 'content_id' => $landing->id]);

        AnalyticsExcludedIp::query()->create([
            'ip_address' => '198.51.100.20',
            'is_enabled' => true,
        ]);

        $this->submission('contact', 'https://example.com/about-us/?utm=ads');
        $this->submission('ebook_download', 'https://example.com/about-us/');
        $this->submission('case_study_download', 'http://localhost/blog/launch-post');
        $this->submission('contact', 'https://example.com/pricing');
        $this->submission('newsletter_inquiry', 'https://example.com/blog/');
        $this->submission('contact', 'https://example.com/ebook/missing-guide');
        $this->submission('contact', 'https://example.com/industry/accounting/');
        $this->submission('lp-audit-offer', 'https://example.com/lp/audit-offer');
        $this->submission('contact', 'https://example.com/about-us', ['status' => Lead::STATUS_SPAM]);
        $this->submission('contact', 'https://example.com/about-us', ['ip_address' => '198.51.100.20']);
        $historical = $this->submission('contact', null);
        $this->submission('contact', 'https://example.com/livewire/update');
        $this->submission('contact', 'https://example.com/admin/visitor-analytics');
        $this->submission('contact', 'https://example.com/about-us', ['created_at' => '2026-08-01 10:00:00']);

        $this->assertNull($historical->visitor_id);

        $range = VisitorAnalyticsRange::make(VisitorAnalyticsRange::LAST_30);
        $kpis = $this->analytics->kpis($range);
        $types = collect($this->analytics->pageTypes($range))->keyBy('content_type');
        $blogs = collect($this->analytics->contentPerformance($range, 'blog', 'conversions', 'desc')['rows']);
        $about = collect($this->analytics->contentPerformance($range, 'page', 'conversions', 'desc')['rows'])->firstWhere('title', 'About us');
        $pricingRow = collect($this->analytics->contentPerformance($range, 'page', 'title', 'asc')['rows'])->firstWhere('title', 'Pricing');
        $listing = collect($this->analytics->contentPerformance($range, null, 'page_views', 'desc')['rows'])->firstWhere('title', '/blog');
        $missing = collect($this->analytics->contentPerformance($range, null, 'page_views', 'desc')['rows'])->firstWhere('title', '/ebook/missing-guide');
        $rates = $this->analytics->contentPerformance($range, null, 'conversion_rate', 'asc');

        $this->assertSame(9, $kpis['enquiries']);
        $this->assertSame(2, $kpis['gated_downloads']);
        $this->assertSame(3, $kpis['unattributed']);
        $this->assertSame(160.0, $kpis['conversion_rate']);
        $this->assertSame(5, $kpis['unique_visitors']);

        $this->assertSame(1, $about['enquiries']);
        $this->assertSame(1, $about['downloads']);
        $this->assertSame(2, $about['conversions']);
        $this->assertSame(1, $about['unique_visitors']);
        $this->assertSame(200.0, $about['conversion_rate']);
        $this->assertSame('/about-us', $about['path']);

        $this->assertSame(0, $pricingRow['unique_visitors']);
        $this->assertSame(1, $pricingRow['enquiries']);
        $this->assertSame(0, $pricingRow['downloads']);
        $this->assertNull($pricingRow['conversion_rate']);

        $this->assertSame(['Launch post', 'Second post'], $blogs->pluck('title')->all());
        $this->assertSame(1, $blogs->firstWhere('title', 'Launch post')['downloads']);
        $this->assertSame(0, $blogs->firstWhere('title', 'Launch post')['enquiries']);
        $this->assertSame(2, $blogs->sum('unique_visitors'));
        $this->assertSame(1, $types['blog']['unique_visitors']);
        $this->assertSame(2, $types['blog']['page_views']);
        $this->assertSame(1, $types['blog']['downloads']);
        $this->assertSame(0, $types['blog']['enquiries']);
        $this->assertSame(100.0, $types['blog']['conversion_rate']);

        $this->assertSame(1, $types['page']['unique_visitors']);
        $this->assertSame(2, $types['page']['enquiries']);
        $this->assertSame(1, $types['page']['downloads']);
        $this->assertSame(300.0, $types['page']['conversion_rate']);
        $this->assertSame('Industries', $types['industry']['content_label']);
        $this->assertSame(1, $types['industry']['enquiries']);
        $this->assertSame('Landing Pages', $types['landing-page']['content_label']);
        $this->assertSame(1, $types['landing-page']['enquiries']);

        $this->assertSame(1, $listing['page_views']);
        $this->assertSame(1, $listing['enquiries']);
        $this->assertSame('Other paths', $listing['content_label']);
        $this->assertSame(1, $missing['enquiries']);
        $this->assertSame(0, $missing['unique_visitors']);
        $this->assertNull($missing['conversion_rate']);

        $this->assertSame('About us', $this->analytics->topConversions($range)[0]['title']);
        $this->assertSame(2, $this->analytics->topConversions($range)[0]['conversions']);
        $this->assertSame(0.0, $rates['rows'][0]['conversion_rate']);
        $this->assertNull($rates['rows'][array_key_last($rates['rows'])]['conversion_rate']);

        $quietDay = $this->analytics->kpis(VisitorAnalyticsRange::make(VisitorAnalyticsRange::CUSTOM, '2026-10-01', '2026-10-01'));
        $this->assertSame(0, $quietDay['enquiries']);
        $this->assertSame(0, $quietDay['gated_downloads']);
        $this->assertSame(0, $quietDay['unattributed']);
        $this->assertNull($quietDay['conversion_rate']);
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
    private function submission(string $formName, ?string $pageUrl, array $overrides = []): Lead
    {
        $createdAt = $overrides['created_at'] ?? null;
        unset($overrides['created_at']);

        $lead = Lead::query()->create(array_merge([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'form_name' => $formName,
            'status' => Lead::STATUS_NEW,
            'page_url' => $pageUrl,
            'ip_address' => '203.0.113.10',
        ], $overrides));

        if ($createdAt !== null) {
            $lead->forceFill(['created_at' => $createdAt])->save();
        }

        return $lead;
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
