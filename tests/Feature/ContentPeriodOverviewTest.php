<?php

namespace Tests\Feature;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Ebooks\EbookResource;
use App\Filament\Resources\Industries\IndustryResource;
use App\Filament\Resources\LandingPages\LandingPageResource;
use App\Filament\Resources\Newsletters\NewsletterResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
use App\Filament\Widgets\RecordPeriodOverviewWidget;
use App\Models\Blog;
use App\Models\Page;
use App\Models\User;
use App\Services\Overview\PeriodCounts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ContentPeriodOverviewTest extends TestCase
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

    public function test_blog_counts_match_direct_database_counts_in_the_application_timezone(): void
    {
        $this->useTimezone('Asia/Kolkata');
        Carbon::setTestNow(Carbon::parse('2026-10-05 00:30:00', 'Asia/Kolkata'));

        $this->blog('Today', '2026-10-05 00:15:00');
        $this->blog('Yesterday', '2026-10-04 23:30:00');
        $this->blog('Earlier this month', '2026-10-01 12:00:00');
        $this->blog('Last month', '2026-09-30 18:00:00');

        $counts = app(PeriodCounts::class)->forModel(Blog::class);

        $this->assertSame($this->directCounts(Blog::class), $counts);
        $this->assertSame([
            'total' => 4,
            'today' => 1,
            'this_week' => 1,
            'this_month' => 3,
        ], $counts);
    }

    public function test_page_counts_use_one_query_and_match_the_database(): void
    {
        $this->page('Today page', now()->toDateTimeString());
        $this->page('Older page', now()->subMonth()->toDateTimeString());

        DB::flushQueryLog();
        DB::enableQueryLog();

        $counts = app(PeriodCounts::class)->forModel(Page::class);

        $queries = array_values(array_filter(
            DB::getQueryLog(),
            fn (array $query): bool => str_contains(strtolower($query['query']), 'pages'),
        ));

        $this->assertCount(1, $queries);
        $this->assertStringContainsString('count(*)', strtolower($queries[0]['query']));
        $this->assertSame($this->directCounts(Page::class), $counts);
    }

    public function test_content_list_pages_show_overview_cards_above_the_table(): void
    {
        $this->withoutVite();
        $this->useTimezone('Asia/Kolkata');
        Carbon::setTestNow(Carbon::parse('2026-10-05 10:00:00', 'Asia/Kolkata'));

        $this->blog('Overview Today Blog', '2026-10-05 09:15:00');
        $this->blog('Overview Yesterday Blog', '2026-10-04 11:00:00');

        $counts = app(PeriodCounts::class)->forModel(Blog::class);
        $this->assertSame($this->directCounts(Blog::class), $counts);
        $this->assertFalse(RecordPeriodOverviewWidget::isDiscovered());

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
        $this->actingAs($admin);

        $this->get(BlogResource::getUrl('index'))
            ->assertOk()
            ->assertSeeInOrder([
                'Blogs',
                'Blog Overview',
                'Total Blogs',
                number_format($counts['total']),
                'Today',
                number_format($counts['today']),
                'This Week',
                number_format($counts['this_week']),
                'This Month',
                number_format($counts['this_month']),
                'Overview Today Blog',
            ]);

        foreach ($this->emptyModules() as $url => $labels) {
            $this->get($url)
                ->assertOk()
                ->assertSeeInOrder([
                    $labels['heading'],
                    $labels['totalLabel'],
                    '0',
                    'Today',
                    '0',
                    'This Week',
                    '0',
                    'This Month',
                    '0',
                ]);
        }
    }

    /**
     * @param  class-string<Model>  $model
     * @return array{total: int, today: int, this_week: int, this_month: int}
     */
    private function directCounts(string $model): array
    {
        $now = now()->timezone((string) config('app.timezone'));

        return [
            'total' => $model::query()->count(),
            'today' => $model::query()->whereBetween('created_at', [$now->copy()->startOfDay(), $now->copy()->endOfDay()])->count(),
            'this_week' => $model::query()->whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count(),
            'this_month' => $model::query()->whereBetween('created_at', [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()])->count(),
        ];
    }

    private function blog(string $title, string $createdAt): Blog
    {
        $blog = Blog::query()->create([
            'title' => $title,
            'slug' => str($title)->slug()->toString(),
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>'.$title.'</p>']]],
            'status' => 'published',
        ]);

        return $this->stamp($blog, $createdAt);
    }

    private function page(string $title, string $createdAt): Page
    {
        $page = Page::query()->create([
            'title' => $title,
            'slug' => str($title)->slug()->toString(),
            'template' => 'about',
            'status' => 'draft',
        ]);

        return $this->stamp($page, $createdAt);
    }

    /**
     * @template T of Model
     *
     * @param  T  $record
     * @return T
     */
    private function stamp(Model $record, string $createdAt): Model
    {
        $timestamp = Carbon::parse($createdAt, (string) config('app.timezone'));

        $record->forceFill([
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ])->save();

        return $record->refresh();
    }

    /**
     * @return array<string, array{heading: string, totalLabel: string}>
     */
    private function emptyModules(): array
    {
        return [
            PageResource::getUrl('index') => ['heading' => 'Page Overview', 'totalLabel' => 'Total Pages'],
            IndustryResource::getUrl('index') => ['heading' => 'Industry Overview', 'totalLabel' => 'Total Industries'],
            CaseStudyResource::getUrl('index') => ['heading' => 'Case Study Overview', 'totalLabel' => 'Total Case Studies'],
            LandingPageResource::getUrl('index') => ['heading' => 'Landing Page Overview', 'totalLabel' => 'Total Landing Pages'],
            NewsletterResource::getUrl('index') => ['heading' => 'Newsletter Overview', 'totalLabel' => 'Total Newsletters'],
            PressReleaseResource::getUrl('index') => ['heading' => 'Press Release Overview', 'totalLabel' => 'Total Press Releases'],
            EbookResource::getUrl('index') => ['heading' => 'eBook Overview', 'totalLabel' => 'Total eBooks'],
            WhitePaperResource::getUrl('index') => ['heading' => 'White Paper Overview', 'totalLabel' => 'Total White Papers'],
            ArticleResource::getUrl('index') => ['heading' => 'Article Overview', 'totalLabel' => 'Total Articles'],
        ];
    }

    private function useTimezone(string $timezone): void
    {
        $this->originalTimezone ??= date_default_timezone_get();
        date_default_timezone_set($timezone);
        config(['app.timezone' => $timezone]);
    }
}
