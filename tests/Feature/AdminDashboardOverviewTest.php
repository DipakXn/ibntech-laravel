<?php

namespace Tests\Feature;

use App\Filament\Pages\VisitorAnalytics;
use App\Filament\Resources\Leads\LeadResource;
use App\Filament\Resources\OldSubmissions\OldSubmissionResource;
use App\Filament\Widgets\AdminQuickActionsWidget;
use App\Filament\Widgets\RecentActivityWidget;
use App\Filament\Widgets\DashboardSubmissionOverviewWidget;
use App\Filament\Widgets\DashboardSubmissionTrendChart;
use App\Filament\Widgets\DashboardVisitorPreviewWidget;
use App\Filament\Widgets\DashboardVisitorTrendChart;
use App\Filament\Widgets\RecentLeadsWidget;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Lead;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PageView;
use App\Models\PressRelease;
use App\Models\User;
use App\Models\WhitePaper;
use App\Services\Analytics\VisitorAnalyticsRange;
use App\Services\Analytics\VisitorAnalyticsService;
use App\Services\Leads\SubmissionOverview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class AdminDashboardOverviewTest extends TestCase
{
    use RefreshDatabase;

    private ?string $originalTimezone = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        if ($this->originalTimezone !== null) {
            date_default_timezone_set($this->originalTimezone);
        }

        parent::tearDown();
    }

    public function test_dashboard_metrics_match_the_submission_and_visitor_modules(): void
    {
        $this->useTimezone('Asia/Kolkata');
        Carbon::setTestNow(Carbon::parse('2026-10-06 10:00:00', 'Asia/Kolkata'));
        $this->seedContent();
        $this->seedSubmissions();
        $this->seedVisitors();

        $counts = app(SubmissionOverview::class)->counts();
        $trend = app(SubmissionOverview::class)->dailyTrend();
        $forms = app(SubmissionOverview::class)->topForms();
        $range = VisitorAnalyticsRange::make(VisitorAnalyticsRange::LAST_30);
        $analytics = app(VisitorAnalyticsService::class);
        $kpis = $analytics->kpis($range);
        $visitorTrend = $analytics->dailyTrend($range);

        $this->assertSame($this->directSubmissionCounts(), $counts);
        $this->assertSame($this->directVisitorCounts(), [
            'total_visitors' => $kpis['total_visitors'],
            'visitors_today' => $kpis['visitors_today'],
            'visitors_this_week' => $kpis['visitors_this_week'],
            'visitors_this_month' => $kpis['visitors_this_month'],
        ]);
        $this->assertSame([
            'total' => 5,
            'today' => 2,
            'this_week' => 3,
            'this_month' => 4,
        ], $counts);
        $this->assertSame(2, $trend['counts'][array_key_last($trend['counts'])]);
        $this->assertSame('Contact Form', $forms[0]['label']);
        $this->assertSame(3, $forms[0]['submissions']);
        $this->assertSame('Homepage Contact', $forms[1]['label']);
        $this->assertSame('Managed SOC', $forms[2]['label']);
        $this->assertSame([
            'total_visitors' => 4,
            'visitors_today' => 1,
            'visitors_this_week' => 2,
            'visitors_this_month' => 3,
        ], [
            'total_visitors' => $kpis['total_visitors'],
            'visitors_today' => $kpis['visitors_today'],
            'visitors_this_week' => $kpis['visitors_this_week'],
            'visitors_this_month' => $kpis['visitors_this_month'],
        ]);

        $admin = User::factory()->create([
            'name' => 'Dipak',
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
        $this->actingAs($admin);

        $this->get('/admin')
            ->assertOk()
            ->assertSeeInOrder([
                'Dipak',
                'IBNTECH CONTROL CENTER',
                'Admin Workspace',
                'Good morning, Dipak!',
                'Tuesday, October 6, 2026',
                'Welcome back to the IBNTECH Control Center.',
                'Submission overview',
            ])
            ->assertDontSee('IBNTECH Admin')
            ->assertDontSee('Powering IBNTECH')
            ->assertDontSee('Live pages, posts, downloads, and case studies')
            ->assertDontSee('Content overview')
            ->assertSeeInOrder([
                'Submission overview',
                'Total Submissions',
                number_format($counts['total']),
                'Today',
                number_format($counts['today']),
                'This Week',
                number_format($counts['this_week']),
                'This Month',
                number_format($counts['this_month']),
                'Submission trend',
                'Top forms',
                'Contact Form',
                'Visitor analytics',
                'View analytics',
                'Total Visitors',
                number_format($kpis['total_visitors']),
                'Visitors Today',
                number_format($kpis['visitors_today']),
                'Visitors This Week',
                number_format($kpis['visitors_this_week']),
                'Visitors This Month',
                number_format($kpis['visitors_this_month']),
                'Publishing performance',
                'Quick actions',
                'Recent activity',
                'Recent submission activity',
            ])
            ->assertSee('/admin/visitor-analytics', false);

        $this->assertSame(url('/admin/visitor-analytics'), VisitorAnalytics::getUrl());

        $submissionChart = (fn () => $this->getData())->call(
            Livewire::test(DashboardSubmissionTrendChart::class)->instance(),
        );
        $this->assertSame($trend['counts'], $submissionChart['datasets'][0]['data']);
        $this->assertSame($trend['labels'], $submissionChart['labels']);

        $visitorChart = (fn () => $this->getData())->call(
            Livewire::test(DashboardVisitorTrendChart::class)->instance(),
        );
        $this->assertSame($visitorTrend['visitors'], $visitorChart['datasets'][0]['data']);
        $this->assertSame($visitorTrend['labels'], $visitorChart['labels']);

        Livewire::test(DashboardSubmissionOverviewWidget::class)
            ->assertSee('Submission overview')
            ->assertSee('Contact Form');

        Livewire::test(DashboardVisitorPreviewWidget::class)
            ->assertSee('View analytics')
            ->assertSee(number_format($kpis['total_visitors']));
    }

    public function test_authors_see_content_without_sales_or_visitor_analytics(): void
    {
        $this->seedContent();
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $this->actingAs($author);

        $this->assertFalse(DashboardVisitorPreviewWidget::canView());
        $this->assertFalse(DashboardVisitorTrendChart::canView());
        $this->assertFalse(DashboardSubmissionOverviewWidget::canView());
        $this->assertFalse(RecentLeadsWidget::canView());
        $this->assertFalse(LeadResource::canViewAny());
        $this->assertFalse(OldSubmissionResource::canViewAny());

        $this->get('/admin/leads')->assertForbidden();
        $this->get('/admin/old-submissions')->assertForbidden();

        Article::query()->where('title', 'Article 1')->update([
            'title' => 'Author Visible Article',
            'created_at' => now()->addMinutes(5),
            'updated_at' => now()->addMinutes(5),
        ]);
        Page::query()->where('title', 'Page 1')->update([
            'title' => 'Hidden Admin Page',
            'created_at' => now()->addMinutes(10),
            'updated_at' => now()->addMinutes(10),
        ]);

        $this->get('/admin')
            ->assertOk()
            ->assertDontSee('Content overview')
            ->assertSee('Publishing performance')
            ->assertDontSee('Submission overview')
            ->assertDontSee('Recent submission activity')
            ->assertDontSee('Review submissions')
            ->assertDontSee('Old Submissions')
            ->assertDontSee('Sales')
            ->assertDontSee('View analytics')
            ->assertDontSee('Total Visitors')
            ->assertSeeInOrder([
                'New blog',
                'New case study',
                'New press release',
                'New eBook',
                'New white paper',
                'New article',
            ])
            ->assertDontSee('Update pages')
            ->assertDontSee('Update industries')
            ->assertDontSee('Update LPs')
            ->assertDontSee('Update newsletters')
            ->assertSee('0 of 40 items live')
            ->assertSee('Author Visible Article')
            ->assertDontSee('Hidden Admin Page');

        $activity = collect((fn () => $this->getViewData()['items'])->call(
            Livewire::test(RecentActivityWidget::class)->instance(),
        ));
        $allowedTypes = ['Blog', 'Case study', 'Press release', 'eBook', 'White paper', 'Article'];

        $this->assertTrue($activity->contains(fn (array $item): bool => $item['title'] === 'Author Visible Article'));
        $this->assertTrue($activity->every(fn (array $item): bool => in_array($item['type'], $allowedTypes, true)));
        $this->assertFalse($activity->contains(fn (array $item): bool => $item['type'] === 'Page'));

        Livewire::test(AdminQuickActionsWidget::class)
            ->assertSee('New article')
            ->assertDontSee('Update pages')
            ->assertDontSee('Review submissions');
    }

    public function test_welcome_header_follows_the_application_timezone(): void
    {
        $admin = User::factory()->create([
            'name' => 'Dipak',
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
        $this->actingAs($admin);

        $this->useTimezone('UTC');
        Carbon::setTestNow(Carbon::parse('2026-10-06 18:30:00', 'UTC'));

        $this->get('/admin')
            ->assertOk()
            ->assertSee('Good evening, Dipak!')
            ->assertSee('Tuesday, October 6, 2026');

        $this->useTimezone('Asia/Kolkata');

        $this->get('/admin')
            ->assertOk()
            ->assertSee('Good evening, Dipak!')
            ->assertSee('Wednesday, October 7, 2026')
            ->assertDontSee('Tuesday, October 6, 2026');

        Carbon::setTestNow(Carbon::parse('2026-10-07 13:15:00', 'Asia/Kolkata'));

        $this->get('/admin')
            ->assertOk()
            ->assertSee('Good afternoon, Dipak!')
            ->assertSee('Wednesday, October 7, 2026');
    }

    /**
     * @return array{total: int, today: int, this_week: int, this_month: int}
     */
    private function directSubmissionCounts(): array
    {
        $now = now()->timezone((string) config('app.timezone'));

        return [
            'total' => Lead::query()->count(),
            'today' => Lead::query()->whereBetween('created_at', [$now->copy()->startOfDay(), $now->copy()->endOfDay()])->count(),
            'this_week' => Lead::query()->whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count(),
            'this_month' => Lead::query()->whereBetween('created_at', [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()])->count(),
        ];
    }

    /**
     * @return array{total_visitors: int, visitors_today: int, visitors_this_week: int, visitors_this_month: int}
     */
    private function directVisitorCounts(): array
    {
        $now = now()->timezone((string) config('app.timezone'));

        $unique = fn ($query): int => (int) $query->distinct()->count('visitor_id');

        return [
            'total_visitors' => $unique(PageView::query()),
            'visitors_today' => $unique(PageView::query()->whereBetween('visited_at', [$now->copy()->startOfDay(), $now->copy()->endOfDay()])),
            'visitors_this_week' => $unique(PageView::query()->whereBetween('visited_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])),
            'visitors_this_month' => $unique(PageView::query()->whereBetween('visited_at', [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()])),
        ];
    }

    private function seedContent(): void
    {
        $this->content(Page::class, 1);
        $this->content(Blog::class, 2, true);
        $this->content(Industry::class, 3);
        $this->content(CaseStudy::class, 4, true);
        $this->content(LandingPage::class, 5);
        $this->content(Newsletter::class, 6);
        $this->content(PressRelease::class, 7, true);
        $this->content(Ebook::class, 8, true);
        $this->content(WhitePaper::class, 9, true);
        $this->content(Article::class, 10, true);

        LandingPage::query()->create([
            'title' => 'Managed SOC',
            'slug' => 'managed-soc',
            'template' => 'default',
            'status' => 'draft',
        ]);
    }

    private function seedSubmissions(): void
    {
        $this->submission('Dash Today One', '2026-10-06 09:00:00', 'contact');
        $this->submission('Dash Today Two', '2026-10-06 09:30:00', 'contact');
        $this->submission('Dash Yesterday', '2026-10-05 15:00:00', 'homepage-contact');
        $this->submission('Dash Landing', '2026-10-01 12:00:00', 'lp-managed-soc');
        $this->submission('Dash Last Month', '2026-09-20 12:00:00', 'contact');
    }

    private function seedVisitors(): void
    {
        $today = (string) Str::uuid();
        $this->pageView($today, '2026-10-06 09:00:00');
        $this->pageView($today, '2026-10-06 11:00:00');
        $this->pageView((string) Str::uuid(), '2026-10-05 12:00:00');
        $this->pageView((string) Str::uuid(), '2026-10-02 12:00:00');
        $this->pageView((string) Str::uuid(), '2026-09-15 12:00:00');
    }

    private function content(string $model, int $count, bool $withContent = false): void
    {
        $name = class_basename($model);

        for ($index = 1; $index <= $count; $index++) {
            $attributes = [
                'title' => $name.' '.$index,
                'slug' => str($name.'-'.$index)->slug()->toString(),
                'template' => 'default',
                'status' => 'draft',
            ];

            if ($withContent) {
                $attributes['content'] = [];
            }

            $model::query()->create($attributes);
        }
    }

    private function submission(string $name, string $createdAt, string $formName): void
    {
        $timestamp = Carbon::parse($createdAt, (string) config('app.timezone'));

        $lead = Lead::query()->create([
            'name' => $name,
            'email' => str($name)->slug().'@example.com',
            'form_name' => $formName,
        ]);

        $lead->forceFill([
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ])->save();
    }

    private function pageView(string $visitorId, string $visitedAt): void
    {
        PageView::query()->create([
            'visitor_id' => $visitorId,
            'visited_at' => Carbon::parse($visitedAt, (string) config('app.timezone')),
            'path' => '/',
        ]);
    }

    private function useTimezone(string $timezone): void
    {
        $this->originalTimezone ??= date_default_timezone_get();
        date_default_timezone_set($timezone);
        config(['app.timezone' => $timezone]);
    }
}
