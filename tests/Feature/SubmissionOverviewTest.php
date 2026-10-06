<?php

namespace Tests\Feature;

use App\Filament\Resources\Leads\Pages\ListLeads;
use App\Filament\Resources\Leads\Widgets\SubmissionOverviewWidget;
use App\Models\LandingPage;
use App\Models\Lead;
use App\Models\User;
use App\Services\Leads\SubmissionOverview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

class SubmissionOverviewTest extends TestCase
{
    use RefreshDatabase;

    private ?string $originalTimezone = null;

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        if ($this->originalTimezone !== null) {
            date_default_timezone_set($this->originalTimezone);
        }

        parent::tearDown();
    }

    public function test_counts_match_direct_database_counts_in_the_application_timezone(): void
    {
        $this->useTimezone('Asia/Kolkata');
        Carbon::setTestNow(Carbon::parse('2026-10-05 00:30:00', 'Asia/Kolkata'));

        $this->submission('Today', '2026-10-05 00:15:00');
        $this->submission('Yesterday', '2026-10-04 23:30:00');
        $this->submission('Earlier this month', '2026-10-01 12:00:00');
        $this->submission('Last month', '2026-09-30 18:00:00');

        $counts = app(SubmissionOverview::class)->counts();

        $this->assertSame($this->directCounts(), $counts);
        $this->assertSame([
            'total' => 4,
            'today' => 1,
            'this_week' => 1,
            'this_month' => 3,
        ], $counts);
    }

    public function test_overview_uses_a_single_count_query(): void
    {
        $this->submission('One', '2026-10-05 09:00:00');
        $this->submission('Two', '2026-09-01 09:00:00');

        DB::flushQueryLog();
        DB::enableQueryLog();

        app(SubmissionOverview::class)->counts();

        $queries = array_values(array_filter(
            DB::getQueryLog(),
            fn (array $query): bool => str_contains(strtolower($query['query']), 'form_submissions'),
        ));

        $this->assertCount(1, $queries);
        $this->assertStringContainsString('count(*)', strtolower($queries[0]['query']));
        $this->assertStringNotContainsString('select *', strtolower($queries[0]['query']));
    }

    public function test_daily_trend_and_top_forms_use_aggregated_form_submissions(): void
    {
        $this->useTimezone('Asia/Kolkata');
        Carbon::setTestNow(Carbon::parse('2026-10-06 10:00:00', 'Asia/Kolkata'));

        $this->submission('Trend Today', '2026-10-06 09:00:00', 'contact');
        $this->submission('Trend Today Two', '2026-10-06 11:30:00', 'contact');
        $this->submission('Trend Yesterday', '2026-10-05 18:00:00', 'homepage-contact');
        $this->submission('Trend Earlier', '2026-09-20 12:00:00', 'contact');

        $overview = app(SubmissionOverview::class);
        $trend = $overview->dailyTrend();

        $this->assertCount(SubmissionOverview::TREND_DAYS, $trend['labels']);
        $this->assertSame('Oct 6', $trend['labels'][array_key_last($trend['labels'])]);
        $this->assertSame(2, $trend['counts'][array_key_last($trend['counts'])]);
        $this->assertSame(1, $trend['counts'][array_key_last($trend['counts']) - 1]);
        $this->assertTrue($trend['has_data']);
        $this->assertSame($this->directDailyCounts(), $trend['counts']);

        $this->assertSame([
            ['form_name' => 'contact', 'label' => 'Contact Form', 'submissions' => 3],
            ['form_name' => 'homepage-contact', 'label' => 'Homepage Contact', 'submissions' => 1],
        ], $overview->topForms());

        DB::flushQueryLog();
        DB::enableQueryLog();

        $overview->dailyTrend();
        $overview->topForms();

        $queries = array_values(array_filter(
            DB::getQueryLog(),
            fn (array $query): bool => str_contains(strtolower($query['query']), 'form_submissions'),
        ));

        $this->assertCount(2, $queries);

        foreach ($queries as $query) {
            $sql = strtolower($query['query']);
            $this->assertStringContainsString('count(*)', $sql);
            $this->assertStringNotContainsString('select *', $sql);
        }
    }

    public function test_top_forms_label_landing_pages_without_loading_every_page(): void
    {
        LandingPage::query()->create([
            'title' => 'Managed SOC',
            'slug' => 'managed-soc',
            'template' => 'default',
            'status' => 'published',
        ]);
        LandingPage::query()->create([
            'title' => 'Unused Landing Page',
            'slug' => 'unused-landing-page',
            'template' => 'default',
            'status' => 'draft',
        ]);

        $this->submission('Landing Lead', '2026-10-06 09:00:00', 'lp-managed-soc');
        $this->submission('Removed Landing Lead', '2026-10-06 09:05:00', 'lp-retired-offer');

        DB::flushQueryLog();
        DB::enableQueryLog();

        $forms = app(SubmissionOverview::class)->topForms();

        $this->assertSame('Managed SOC', $forms[0]['label']);
        $this->assertSame('Retired Offer', $forms[1]['label']);

        $landingQueries = array_values(array_filter(
            DB::getQueryLog(),
            fn (array $query): bool => str_contains(strtolower($query['query']), 'landing_pages'),
        ));

        $this->assertCount(1, $landingQueries);
        $this->assertStringContainsString('managed-soc', strtolower(implode(' ', array_map('strval', $landingQueries[0]['bindings']))));
        $this->assertStringNotContainsString('unused-landing-page', strtolower(implode(' ', array_map('strval', $landingQueries[0]['bindings']))));
    }

    public function test_empty_submissions_table_reports_zero(): void
    {
        $this->assertSame([
            'total' => 0,
            'today' => 0,
            'this_week' => 0,
            'this_month' => 0,
        ], app(SubmissionOverview::class)->counts());
    }

    public function test_submissions_page_shows_overview_counts_above_the_unchanged_table(): void
    {
        $this->withoutVite();
        $this->useTimezone('Asia/Kolkata');
        Carbon::setTestNow(Carbon::parse('2026-10-05 10:00:00', 'Asia/Kolkata'));

        $today = $this->submission('Overview Today Lead', '2026-10-05 09:15:00');
        $this->submission('Overview Yesterday Lead', '2026-10-04 11:00:00');
        $this->submission('Overview Earlier Month Lead', '2026-10-01 08:00:00');
        $older = $this->submission('Overview Last Month Lead', '2026-09-12 08:00:00');

        $counts = app(SubmissionOverview::class)->counts();
        $this->assertSame($this->directCounts(), $counts);

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
        $this->actingAs($admin);

        $this->get('/admin/leads')
            ->assertOk()
            ->assertDontSee('Submission trend')
            ->assertDontSee('Top forms')
            ->assertDontSee('Content overview')
            ->assertSeeInOrder([
                'Submissions',
                'Submission Overview',
                'Total Submissions',
                number_format($counts['total']),
                'Today',
                number_format($counts['today']),
                'This Week',
                number_format($counts['this_week']),
                'This Month',
                number_format($counts['this_month']),
                'Overview Today Lead',
            ]);

        Livewire::test(SubmissionOverviewWidget::class)
            ->assertOk()
            ->assertSee('Submission Overview')
            ->assertSee('Total Submissions')
            ->assertSee('Today')
            ->assertSee('This Week')
            ->assertSee('This Month')
            ->assertSeeInOrder([
                'Total Submissions',
                number_format($counts['total']),
                'Today',
                number_format($counts['today']),
                'This Week',
                number_format($counts['this_week']),
                'This Month',
                number_format($counts['this_month']),
            ]);

        Livewire::test(ListLeads::class)
            ->assertOk()
            ->assertCanSeeTableRecords([$today, $older])
            ->searchTable('Overview Today Lead')
            ->assertCanSeeTableRecords([$today])
            ->assertCanNotSeeTableRecords([$older]);

        $this->assertSame($counts, app(SubmissionOverview::class)->counts());
    }

    /**
     * @return array{total: int, today: int, this_week: int, this_month: int}
     */
    private function directCounts(): array
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
     * @return list<int>
     */
    private function directDailyCounts(): array
    {
        $now = now()->timezone((string) config('app.timezone'));
        $cursor = $now->copy()->startOfDay()->subDays(SubmissionOverview::TREND_DAYS - 1);
        $end = $now->copy()->startOfDay();
        $counts = [];

        while ($cursor->lessThanOrEqualTo($end)) {
            $counts[] = Lead::query()->whereBetween('created_at', [$cursor->copy()->startOfDay(), $cursor->copy()->endOfDay()])->count();
            $cursor->addDay();
        }

        return $counts;
    }

    private function submission(string $name, string $createdAt, string $formName = 'contact'): Lead
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

        return $lead->refresh();
    }

    private function useTimezone(string $timezone): void
    {
        $this->originalTimezone ??= date_default_timezone_get();
        date_default_timezone_set($timezone);
        config(['app.timezone' => $timezone]);
    }
}
