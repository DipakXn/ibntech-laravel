<?php

namespace Tests\Feature;

use App\CmsPreview\CmsPreviewType;
use App\Filament\Auth\Login;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PageView;
use App\Models\PressRelease;
use App\Models\User;
use App\Models\WhitePaper;
use App\Services\CmsPreviewService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicPageViewTrackingTest extends TestCase
{
    use RefreshDatabase;

    private const CHROME = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 ProbeToken9f3a';

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_a_public_page_view_stores_anonymous_metrics_and_reuses_the_visitor_cookie(): void
    {
        Carbon::setTestNow('2026-10-05 12:00:00');

        $page = $this->createPublishedPage();
        $updatedAt = $page->updated_at?->toJSON();

        DB::flushQueryLog();
        DB::enableQueryLog();

        $first = $this->browser()->withHeaders([
            'Referer' => 'https://www.google.com/search?q=ibn+technologies',
            'CF-IPCountry' => 'US',
            'X-Forwarded-For' => '203.0.113.44',
            'X-Tracking-Probe' => 'do-not-store',
        ])->get('/about-us/?email=secret@example.com');

        $queries = collect(DB::getQueryLog())->pluck('query');
        DB::disableQueryLog();

        $first->assertOk();
        $first->assertCookie('ibn_visitor');

        $cookie = $first->getCookie('ibn_visitor');
        $this->assertNotNull($cookie);
        $this->assertTrue(Str::isUuid($cookie->getValue()));
        $this->assertTrue($cookie->isHttpOnly());
        $this->assertSame('lax', strtolower((string) $cookie->getSameSite()));

        $view = PageView::query()->first();
        $this->assertNotNull($view);
        $this->assertSame($cookie->getValue(), $view->visitor_id);
        $this->assertTrue($view->visited_at?->equalTo(now()));
        $this->assertSame('/about-us', $view->path);
        $this->assertSame('page', $view->content_type);
        $this->assertSame($page->id, $view->content_id);
        $this->assertSame('www.google.com', $view->referrer_host);
        $this->assertNull($view->country);
        $this->assertSame('desktop', $view->device);
        $this->assertSame('Chrome', $view->browser);
        $this->assertSame('Windows', $view->operating_system);

        $stored = json_encode($view->getAttributes());
        $this->assertIsString($stored);
        $this->assertStringNotContainsString('secret@example.com', $stored);
        $this->assertStringNotContainsString('203.0.113.44', $stored);
        $this->assertStringNotContainsString('ProbeToken9f3a', $stored);
        $this->assertStringNotContainsString('do-not-store', $stored);
        $this->assertStringNotContainsString('q=ibn', $stored);

        $this->assertSame($updatedAt, $page->fresh()?->updated_at?->toJSON());
        $this->assertCount(1, $queries->filter(fn (string $sql): bool => $this->writesPageView($sql)));
        $this->assertCount(1, $queries->filter(fn (string $sql): bool => str_contains(strtolower($sql), 'select "id"') && str_contains(strtolower($sql), 'from "pages"')));

        $second = $this->browser()->withCookie('ibn_visitor', $cookie->getValue())->get('/about-us/');
        $second->assertOk();

        $this->defaultCookies = [];
        $third = $this->browser()->get('/about-us/');
        $third->assertOk();

        $visitors = PageView::query()->orderBy('id')->pluck('visitor_id');
        $this->assertCount(3, $visitors);
        $this->assertSame($cookie->getValue(), $visitors[0]);
        $this->assertSame($cookie->getValue(), $visitors[1]);
        $this->assertNotSame($cookie->getValue(), $visitors[2]);
        $this->assertTrue(Str::isUuid((string) $visitors[2]));
    }

    public function test_home_and_listing_pages_are_tracked_without_inventing_a_content_id(): void
    {
        Page::query()->create([
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'home',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->browser()->get('/')->assertOk();
        $this->browser()->get('/blog/')->assertOk();

        $home = PageView::query()->where('path', '/')->first();
        $blog = PageView::query()->where('path', '/blog')->first();

        $this->assertNotNull($home);
        $this->assertSame('page', $home->content_type);
        $this->assertSame(Page::query()->where('slug', 'home')->value('id'), $home->content_id);

        $this->assertNotNull($blog);
        $this->assertNull($blog->content_type);
        $this->assertNull($blog->content_id);
        $this->assertSame(2, PageView::query()->count());
    }

    public function test_a_trailing_slash_redirect_is_not_counted_twice(): void
    {
        $this->createPublishedPage();

        $this->browser()->get('/about-us')->assertRedirect();
        $this->assertSame(0, PageView::query()->count());

        $this->browser()->followingRedirects()->get('/about-us')->assertOk();
        $this->assertSame(1, PageView::query()->count());
        $this->assertSame('/about-us', PageView::query()->value('path'));
    }

    public function test_trusted_country_headers_are_stored_when_enabled(): void
    {
        $this->createPublishedPage();
        config(['analytics.trust_country_headers' => true]);

        $this->browser()->withHeaders([
            'CF-IPCountry' => 'XX',
            'CloudFront-Viewer-Country' => 'IN',
        ])->get('/about-us/')->assertOk();

        $this->assertSame('IN', PageView::query()->value('country'));
    }

    #[DataProvider('publishedContent')]
    public function test_published_content_is_recorded_with_its_type_and_id(string $type): void
    {
        $previewType = CmsPreviewType::from($type);
        $record = $this->createRecord($previewType, 'published', 'Tracked '.$previewType->name);

        $this->browser()->get($this->publicPath($previewType, $record))->assertOk();

        $view = PageView::query()->first();
        $this->assertNotNull($view);
        $this->assertSame($previewType->value, $view->content_type);
        $this->assertSame($record->getKey(), $view->content_id);
        $this->assertSame('/'.trim($this->publicPath($previewType, $record), '/'), $view->path);
        $this->assertSame(1, PageView::query()->count());
    }

    public function test_drafts_previews_admin_assets_and_bots_are_not_recorded(): void
    {
        $draft = $this->createRecord(CmsPreviewType::Page, 'draft', 'Hidden About');
        $this->createPublishedPage();
        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);

        $this->browser()->get('/hidden-about/')->assertNotFound();
        $this->browser()->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ])->get('/about-us/')->assertOk();
        $this->browser()->withHeaders(['Sec-Purpose' => 'prefetch'])->get('/about-us/')->assertOk();
        $this->browser()->withHeaders(['Accept' => 'application/json'])->get('/about-us/');
        $this->browser()->withHeaders(['Sec-Fetch-Dest' => 'image'])->get('/about-us/');
        $this->post('/about-us/');
        $this->get('/admin');
        $this->get('/'.Login::ROUTE_PATH);
        $this->actingAs($admin)->get('/admin');
        $this->get('/sitemap.xml');
        $this->get('/robots.txt');
        $this->get('/js/filament/forms/components/slider.js');
        $this->get('/livewire/update');
        $this->get('/case-study/example/download');
        $this->get('/up');
        $this->browser()->get(app(CmsPreviewService::class)->signedUrl($draft))->assertOk();

        $this->assertSame(0, PageView::query()->count());
    }

    public function test_page_view_schema_is_indexed_and_has_no_ip_or_user_agent_column(): void
    {
        $columns = Schema::getColumnListing('page_views');

        $this->assertSame([
            'id',
            'visitor_id',
            'visited_at',
            'path',
            'content_type',
            'content_id',
            'referrer_host',
            'country',
            'device',
            'browser',
            'operating_system',
        ], $columns);
        $this->assertNotContains('ip_address', $columns);
        $this->assertNotContains('user_agent', $columns);

        $indexed = collect(Schema::getIndexes('page_views'))
            ->map(fn (array $index): array => array_values($index['columns']))
            ->all();

        $this->assertContains(['visited_at'], $indexed);
        $this->assertContains(['path'], $indexed);
        $this->assertContains(['content_type', 'content_id'], $indexed);
        $this->assertContains(['visitor_id'], $indexed);
    }

    /**
     * @return array<string, array{0: string}>
     */
    public static function publishedContent(): array
    {
        $cases = [];

        foreach (CmsPreviewType::cases() as $type) {
            $cases[$type->value] = [$type->value];
        }

        return $cases;
    }

    private function browser(): static
    {
        return $this->withHeaders(['User-Agent' => self::CHROME]);
    }

    private function writesPageView(string $sql): bool
    {
        $sql = strtolower($sql);

        return str_contains($sql, 'insert into') && str_contains($sql, 'page_views');
    }

    private function createPublishedPage(): Page
    {
        return Page::query()->create([
            'title' => 'About us',
            'slug' => 'about-us',
            'template' => 'about',
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    private function publicPath(CmsPreviewType $type, Model $record): string
    {
        $slug = (string) $record->getAttribute('slug');

        return match ($type) {
            CmsPreviewType::Page => $slug === 'home' ? '/' : '/'.$slug.'/',
            CmsPreviewType::Blog => '/blog/'.$slug.'/',
            CmsPreviewType::Article => '/article/'.$slug.'/',
            CmsPreviewType::CaseStudy => '/case-study/'.$slug.'/',
            CmsPreviewType::PressRelease => '/pressrelease/'.$slug.'/',
            CmsPreviewType::Ebook => '/ebook/'.$slug.'/',
            CmsPreviewType::WhitePaper => '/whitepapers/'.$slug.'/',
            CmsPreviewType::LandingPage => '/lp/'.$slug.'/',
            CmsPreviewType::Newsletter => '/newsletter/'.$slug.'/',
            CmsPreviewType::Industry => '/industry/'.$slug.'/',
        };
    }

    private function createRecord(CmsPreviewType $type, string $status, string $title): Model
    {
        $attributes = [
            'title' => $title,
            'slug' => Str::slug($title),
            'status' => $status,
            'published_at' => $status === 'published' ? now() : null,
        ];
        $paragraph = [['type' => 'paragraph', 'data' => ['content' => '<p>'.$title.'</p>']]];

        return match ($type) {
            CmsPreviewType::Page => Page::query()->create($attributes + [
                'template' => 'about',
            ]),
            CmsPreviewType::Blog => Blog::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::Article => Article::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::CaseStudy => CaseStudy::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::PressRelease => PressRelease::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::Ebook => Ebook::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::WhitePaper => WhitePaper::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::LandingPage => LandingPage::query()->create($attributes + [
                'template' => 'vapt-audit-services',
            ]),
            CmsPreviewType::Newsletter => Newsletter::query()->create($attributes + [
                'template' => 'vciso-as-a-service',
            ]),
            CmsPreviewType::Industry => Industry::query()->create($attributes + [
                'template' => 'real-estate-and-construction',
            ]),
        };
    }
}
