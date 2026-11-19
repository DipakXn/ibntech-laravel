<?php

namespace Tests\Feature;

use App\Http\Middleware\EnsureTrailingSlash;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\WhitePaper;
use App\Services\CmsPreviewService;
use App\Services\SiteRedirects;
use App\Support\EditorialPublication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ScheduledPublishingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow();
        $this->withoutVite();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    /**
     * @return array<string, array{0: class-string<Model>, 1: string, 2: string}>
     */
    public static function editorialTypes(): array
    {
        return [
            'blog' => [Blog::class, '/blog/', 'post-sitemap.xml'],
            'article' => [Article::class, '/article/', 'article-sitemap.xml'],
            'case-study' => [CaseStudy::class, '/case-study/', 'case-study-sitemap.xml'],
            'ebook' => [Ebook::class, '/ebook/', 'ebook-sitemap.xml'],
            'white-paper' => [WhitePaper::class, '/whitepapers/', 'white-paper-sitemap.xml'],
            'press-release' => [PressRelease::class, '/pressrelease/', 'press-release-sitemap.xml'],
        ];
    }

    /**
     * @param  class-string<Model>  $modelClass
     */
    #[DataProvider('editorialTypes')]
    public function test_future_publication_stays_offline_until_the_scheduler_runs(string $modelClass, string $index, string $sitemap): void
    {
        $publishAt = now()->addDay()->startOfSecond();
        $slug = 'scheduled-'.trim(str_replace('/', '-', $index), '-');
        $title = 'Scheduled hold '.$slug;

        $record = $modelClass::query()->create([
            'title' => $title,
            'slug' => $slug,
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>'.$title.'</p>']]],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => $publishAt,
        ]);
        $liveTitle = 'Already live '.$slug;
        $modelClass::query()->create([
            'title' => $liveTitle,
            'slug' => $slug.'-live',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>'.$liveTitle.'</p>']]],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => now()->subDay(),
        ]);

        $this->assertSame(EditorialPublication::SCHEDULED, $record->status);
        $this->assertSame($this->storedInstant($publishAt), $this->storedInstant($record->published_at));

        $show = $index.$slug.'/';
        $publicUrl = url($show);

        $this->get($show)->assertNotFound();
        $this->get($index)->assertOk()->assertDontSee($title, false)->assertSee($liveTitle, false);
        $this->get('/'.$sitemap)->assertOk()->assertDontSee($publicUrl, false)->assertSee(url($index.$slug.'-live/'), false);

        $this->artisan('content:publish-scheduled')->assertSuccessful();
        $this->assertSame(EditorialPublication::SCHEDULED, $record->fresh()->status);

        Carbon::setTestNow($publishAt);

        $this->artisan('content:publish-scheduled')->assertSuccessful();

        $record->refresh();
        $this->assertSame(EditorialPublication::PUBLISHED, $record->status);
        $this->assertSame($this->storedInstant($publishAt), $this->storedInstant($record->published_at));

        $this->get($show)->assertOk()->assertSee($title, false);
        $this->get($index)->assertOk()->assertSee($title, false);
        $this->get('/'.$sitemap)->assertOk()->assertSee($publicUrl, false);
    }

    public function test_manual_publish_with_a_current_or_past_date_is_public_without_the_command(): void
    {
        $current = Blog::query()->create([
            'title' => 'Live now marker',
            'slug' => 'live-now-marker',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Live now</p>']]],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => now(),
        ]);
        $past = Blog::query()->create([
            'title' => 'Live past marker',
            'slug' => 'live-past-marker',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Live past</p>']]],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => now()->subHour(),
        ]);

        $this->assertSame(EditorialPublication::PUBLISHED, $current->status);
        $this->assertSame(EditorialPublication::PUBLISHED, $past->status);
        $this->get('/blog/live-now-marker/')->assertOk()->assertSee('Live now marker', false);
        $this->get('/blog/live-past-marker/')->assertOk()->assertSee('Live past marker', false);
    }

    public function test_a_draft_stays_offline_after_the_scheduler_runs(): void
    {
        $past = Blog::query()->create([
            'title' => 'Draft past marker',
            'slug' => 'draft-past-marker',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Draft past</p>']]],
            'status' => EditorialPublication::DRAFT,
            'published_at' => now()->subDay(),
        ]);
        $future = Blog::query()->create([
            'title' => 'Draft future marker',
            'slug' => 'draft-future-marker',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Draft future</p>']]],
            'status' => EditorialPublication::DRAFT,
            'published_at' => now()->addDay(),
        ]);

        Carbon::setTestNow(now()->addDays(2));
        $this->artisan('content:publish-scheduled')->assertSuccessful();

        $this->assertSame(EditorialPublication::DRAFT, $past->fresh()->status);
        $this->assertSame(EditorialPublication::DRAFT, $future->fresh()->status);
        $this->get('/blog/draft-past-marker/')->assertNotFound();
        $this->get('/blog/draft-future-marker/')->assertNotFound();
    }

    public function test_a_published_record_with_an_empty_date_stays_public(): void
    {
        $blog = Blog::query()->create([
            'title' => 'Undated live marker',
            'slug' => 'undated-live-marker',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Undated</p>']]],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => null,
        ]);

        $this->assertSame(EditorialPublication::PUBLISHED, $blog->status);
        $this->assertNull($blog->published_at);
        $this->get('/blog/undated-live-marker/')->assertOk()->assertSee('Undated live marker', false);
    }

    public function test_a_page_with_a_future_publish_date_stays_public(): void
    {
        $page = Page::query()->create([
            'title' => 'Future service page',
            'slug' => 'future-service-page',
            'template' => 'about',
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => now()->addDays(5),
        ]);

        $this->assertSame(EditorialPublication::PUBLISHED, $page->fresh()->status);
        $this->get('/future-service-page/')->assertOk()->assertSee('Future service page', false);
    }

    public function test_comparisons_use_the_application_timezone(): void
    {
        $this->assertSame('UTC', config('app.timezone'));

        Carbon::setTestNow(Carbon::parse('2026-06-15 12:00:00', 'UTC'));

        $waiting = Blog::query()->create([
            'title' => 'Utc waiting marker',
            'slug' => 'utc-waiting-marker',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Waiting</p>']]],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => Carbon::parse('2026-06-15 12:05:00', 'UTC'),
        ]);
        $due = Blog::query()->create([
            'title' => 'Utc due marker',
            'slug' => 'utc-due-marker',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Due</p>']]],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => Carbon::parse('2026-06-15 11:59:00', 'UTC'),
        ]);

        $this->assertSame(EditorialPublication::SCHEDULED, $waiting->status);
        $this->assertTrue($waiting->published_at?->equalTo(Carbon::parse('2026-06-15 12:05:00', 'UTC')));
        $this->assertSame(EditorialPublication::PUBLISHED, $due->status);
        $this->get('/blog/utc-waiting-marker/')->assertNotFound();
        $this->get('/blog/utc-due-marker/')->assertOk();

        Carbon::setTestNow(Carbon::parse('2026-06-15 12:05:00', 'UTC'));
        $this->artisan('content:publish-scheduled')->assertSuccessful();

        $this->assertSame(EditorialPublication::PUBLISHED, $waiting->fresh()->status);
        $this->get('/blog/utc-waiting-marker/')->assertOk()->assertSee('Utc waiting marker', false);
    }

    public function test_signed_preview_renders_scheduled_content(): void
    {
        $blog = Blog::query()->create([
            'title' => 'Preview embargo marker',
            'slug' => 'preview-embargo-marker',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Preview embargo body</p>']]],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => now()->addDay(),
        ]);

        $this->assertSame(EditorialPublication::SCHEDULED, $blog->status);
        $this->get('/blog/preview-embargo-marker/')->assertNotFound();
        $this->get(app(CmsPreviewService::class)->signedUrl($blog))
            ->assertOk()
            ->assertSee('Preview embargo marker', false)
            ->assertSee('Preview embargo body', false);
    }

    public function test_scheduled_downloads_stay_unavailable_until_publication(): void
    {
        $this->withoutMiddleware(EnsureTrailingSlash::class);

        $publishAt = now()->addDay()->startOfSecond();
        $caseStudy = $this->gatedAsset(CaseStudy::class, 'scheduled-case-study', $publishAt);
        $ebook = $this->gatedAsset(Ebook::class, 'scheduled-ebook', $publishAt);

        $caseStudyUrl = URL::temporarySignedRoute('case-studies.download', $publishAt->copy()->addHour(), ['slug' => $caseStudy->slug]);
        $ebookUrl = URL::temporarySignedRoute('ebooks.download', $publishAt->copy()->addHour(), ['slug' => $ebook->slug]);

        $this->get($caseStudyUrl)->assertNotFound();
        $this->get($ebookUrl)->assertNotFound();

        Carbon::setTestNow($publishAt);
        $this->artisan('content:publish-scheduled')->assertSuccessful();

        $this->get(URL::temporarySignedRoute('case-studies.download', now()->addHour(), ['slug' => $caseStudy->slug]))
            ->assertRedirect();
        $this->get(URL::temporarySignedRoute('ebooks.download', now()->addHour(), ['slug' => $ebook->slug]))
            ->assertRedirect();
    }

    public function test_a_scheduled_slug_cannot_be_saved_as_a_redirect_source(): void
    {
        Blog::query()->create([
            'title' => 'Reserved embargo',
            'slug' => 'reserved-embargo',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Reserved</p>']]],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => now()->addDay(),
        ]);

        try {
            app(SiteRedirects::class)->assert('/blog/reserved-embargo', '/elsewhere');
            $this->fail('A scheduled editorial URL should be reserved.');
        } catch (ValidationException $exception) {
            $this->assertStringContainsString('already a live page', $exception->errors()['source_path'][0]);
        }
    }

    public function test_trashed_scheduled_content_is_not_published(): void
    {
        $blog = Blog::query()->create([
            'title' => 'Trashed embargo',
            'slug' => 'trashed-embargo',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Trashed</p>']]],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => now()->addHour(),
        ]);
        $blog->delete();

        Carbon::setTestNow(now()->addHours(2));
        $this->artisan('content:publish-scheduled')->assertSuccessful();

        $trashed = Blog::withTrashed()->findOrFail($blog->id);
        $this->assertTrue($trashed->trashed());
        $this->assertSame(EditorialPublication::SCHEDULED, $trashed->status);
    }

    public function test_the_scheduler_runs_the_publish_command_every_minute(): void
    {
        $this->artisan('schedule:list')
            ->expectsOutputToContain('content:publish-scheduled')
            ->assertSuccessful();
    }

    public function test_existing_future_dates_are_scheduled_without_changing_the_date(): void
    {
        $future = now()->addDays(4)->startOfSecond();
        $past = now()->subDays(4)->startOfSecond();
        $futureValue = $future->format('Y-m-d H:i:s');
        $pastValue = $past->format('Y-m-d H:i:s');

        foreach ([
            'blogs',
            'articles',
            'case_studies',
            'ebooks',
            'white_papers',
            'press_releases',
        ] as $table) {
            $this->insertEditorialRow($table, $table.'-future', EditorialPublication::PUBLISHED, $futureValue);
            $this->insertEditorialRow($table, $table.'-past', EditorialPublication::PUBLISHED, $pastValue);
            $this->insertEditorialRow($table, $table.'-undated', EditorialPublication::PUBLISHED, null);
            $this->insertEditorialRow($table, $table.'-draft', EditorialPublication::DRAFT, $futureValue);
        }

        $migration = require base_path('database/migrations/2026_11_19_140000_schedule_future_editorial_publications.php');
        $migration->up();

        foreach ([
            'blogs',
            'articles',
            'case_studies',
            'ebooks',
            'white_papers',
            'press_releases',
        ] as $table) {
            $scheduled = DB::table($table)->where('slug', $table.'-future')->first();
            $published = DB::table($table)->where('slug', $table.'-past')->first();
            $undated = DB::table($table)->where('slug', $table.'-undated')->first();
            $draft = DB::table($table)->where('slug', $table.'-draft')->first();

            $this->assertSame(EditorialPublication::SCHEDULED, $scheduled->status);
            $this->assertSame($futureValue, $scheduled->published_at);
            $this->assertSame('preserved', $scheduled->content);
            $this->assertSame(EditorialPublication::PUBLISHED, $published->status);
            $this->assertSame($pastValue, $published->published_at);
            $this->assertSame(EditorialPublication::PUBLISHED, $undated->status);
            $this->assertNull($undated->published_at);
            $this->assertSame(EditorialPublication::DRAFT, $draft->status);
            $this->assertSame($futureValue, $draft->published_at);
        }
    }

    private function storedInstant(?Carbon $instant): ?string
    {
        return $instant?->timezone(config('app.timezone'))->format('Y-m-d H:i:s');
    }

    private function insertEditorialRow(string $table, string $slug, string $status, ?string $publishedAt): void
    {
        DB::table($table)->insert([
            'title' => $slug,
            'slug' => $slug,
            'content' => 'preserved',
            'status' => $status,
            'published_at' => $publishedAt,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * @param  class-string<CaseStudy|Ebook>  $modelClass
     */
    private function gatedAsset(string $modelClass, string $slug, Carbon $publishAt): Model
    {
        $record = $modelClass::query()->create([
            'title' => $slug,
            'slug' => $slug,
            'template' => 'default',
            'excerpt' => 'Gated asset',
            'content' => [],
            'status' => EditorialPublication::PUBLISHED,
            'published_at' => $publishAt,
        ]);

        DB::table('media')->insert([
            'uuid' => (string) Str::uuid(),
            'model_type' => $record::class,
            'model_id' => $record->getKey(),
            'mediable_type' => $record::class,
            'mediable_id' => $record->getKey(),
            'collection_name' => 'download_pdf',
            'name' => $slug,
            'file_name' => $slug.'.pdf',
            'disk' => 'media',
            'conversions_disk' => 'media',
            'path' => $slug.'.pdf',
            'mime_type' => 'application/pdf',
            'size' => 120,
            'manipulations' => '[]',
            'custom_properties' => '[]',
            'generated_conversions' => '[]',
            'responsive_images' => '[]',
            'order_column' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $record->fresh();
    }
}
