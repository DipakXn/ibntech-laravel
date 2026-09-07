<?php

namespace Tests\Feature;

use App\CmsPreview\CmsPreviewType;
use App\Filament\Actions\PreviewAction;
use App\Filament\Resources\Blogs\Pages\EditBlog;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\User;
use App\Models\WhitePaper;
use App\Services\CmsPreviewService;
use App\Support\PathPageUrl;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CmsPreviewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{0: string}>
     */
    public static function previewTypes(): array
    {
        $cases = [];

        foreach (CmsPreviewType::cases() as $type) {
            $cases[$type->value] = [$type->value];
        }

        return $cases;
    }

    #[DataProvider('previewTypes')]
    public function test_draft_content_is_not_public_but_is_available_via_signed_preview(string $type): void
    {
        $this->withoutVite();

        $previewType = CmsPreviewType::from($type);
        $record = $this->createRecord($previewType, 'draft', 'Draft '.$previewType->name.' Preview Marker');
        $marker = (string) $record->title;

        $this->get($this->publicPath($previewType, $record))->assertNotFound();

        $response = $this->get($this->signedPreviewUrl($record));

        $response->assertOk();
        $response->assertSee($marker, false);
        $response->assertSee('Preview', false);
        $response->assertSee('noindex, nofollow', false);
        $response->assertHeader('X-Robots-Tag', 'noindex, nofollow');
        $this->assertStringContainsString('no-store', (string) $response->headers->get('Cache-Control'));
    }

    #[DataProvider('previewTypes')]
    public function test_published_content_keeps_working_on_the_public_url_and_can_be_previewed(string $type): void
    {
        $this->withoutVite();

        $previewType = CmsPreviewType::from($type);
        $record = $this->createRecord($previewType, 'published', 'Published '.$previewType->name.' Live Marker');
        $marker = (string) $record->title;

        $public = $this->followingRedirects()->get($this->publicPath($previewType, $record));
        $public->assertOk();
        $public->assertSee($marker, false);
        $public->assertDontSee('cms-preview-banner', false);

        $preview = $this->get($this->signedPreviewUrl($record));
        $preview->assertOk();
        $preview->assertSee($marker, false);
        $preview->assertSee('noindex, nofollow', false);
    }

    #[Test]
    public function test_content_builder_draft_blog_preview_renders_saved_blocks(): void
    {
        $this->withoutVite();

        $blog = $this->createRecord(CmsPreviewType::Blog, 'draft', 'Builder Draft Unique 7f3a');
        $blog->content = [['type' => 'paragraph', 'data' => ['content' => '<p>Builder draft body 7f3a</p>']]];
        $blog->save();

        $this->get('/blog/'.$blog->slug.'/')->assertNotFound();

        $this->get($this->signedPreviewUrl($blog))
            ->assertOk()
            ->assertSee('Builder draft body 7f3a', false);
    }

    #[Test]
    public function test_blade_template_draft_page_preview_renders_the_public_template(): void
    {
        $this->withoutVite();

        $page = $this->createRecord(CmsPreviewType::Page, 'draft', 'Blade Draft Page Unique 9c2d');

        $this->get('/'.$page->slug.'/')->assertNotFound();

        $this->get($this->signedPreviewUrl($page))
            ->assertOk()
            ->assertSee('Blade Draft Page Unique 9c2d', false);
    }

    #[Test]
    public function test_invalid_and_tampered_preview_signatures_are_rejected(): void
    {
        $this->withoutVite();

        $blog = $this->createRecord(CmsPreviewType::Blog, 'draft', 'Signature Blog');
        $url = $this->signedPreviewUrl($blog);

        $this->get(Str::before($url, '?'))->assertNotFound();

        $tampered = preg_replace('/signature=[^&]+/', 'signature=deadbeef', $url) ?? $url;
        $this->get($tampered)->assertNotFound();

        $other = $this->createRecord(CmsPreviewType::Blog, 'draft', 'Other Signature Blog');
        $wrongId = preg_replace('#/preview/blog/\d+#', '/preview/blog/'.$other->getKey(), Str::before($url, '?')).'?'.Str::after($url, '?');
        $this->get($wrongId)->assertNotFound();
    }

    #[Test]
    public function test_expired_preview_urls_are_rejected(): void
    {
        $this->withoutVite();

        $blog = $this->createRecord(CmsPreviewType::Blog, 'draft', 'Expired Blog');
        $url = $this->signedPreviewUrl($blog);

        Carbon::setTestNow(now()->addHours(73));

        try {
            $this->get($url)->assertNotFound();
        } finally {
            Carbon::setTestNow();
        }
    }

    #[Test]
    public function test_preview_urls_are_not_redirected_before_signature_validation(): void
    {
        $this->withoutVite();

        $blog = $this->createRecord(CmsPreviewType::Blog, 'draft', 'Slash Blog');
        $url = $this->signedPreviewUrl($blog);

        $this->assertStringContainsString('/preview/blog/'.$blog->getKey().'?', $url);
        $this->assertStringNotContainsString('/preview/blog/'.$blog->getKey().'/?', $url);
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash('/preview/blog/'.$blog->getKey()));

        $this->get($url)->assertOk();

        $withSlash = Str::replace(
            '/preview/blog/'.$blog->getKey().'?',
            '/preview/blog/'.$blog->getKey().'/?',
            $url,
        );

        $this->get($withSlash)->assertOk();
    }

    #[Test]
    public function test_admin_can_generate_preview_links_and_authors_cannot_for_admin_only_types(): void
    {
        $this->withoutVite();

        $page = $this->createRecord(CmsPreviewType::Page, 'draft', 'Auth Page');
        $blog = $this->createRecord(CmsPreviewType::Blog, 'draft', 'Auth Blog');

        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);

        $this->get(route('filament.admin.content-preview', [
            'type' => 'page',
            'id' => $page->getKey(),
        ]))->assertRedirect();

        $this->actingAs($author)
            ->get(route('filament.admin.content-preview', [
                'type' => 'page',
                'id' => $page->getKey(),
            ]))
            ->assertForbidden();

        $this->actingAs($author)
            ->get(route('filament.admin.content-preview', [
                'type' => 'blog',
                'id' => $blog->getKey(),
            ]))
            ->assertRedirect();

        $adminRedirect = $this->actingAs($admin)
            ->get(route('filament.admin.content-preview', [
                'type' => 'page',
                'id' => $page->getKey(),
            ]));

        $adminRedirect->assertRedirect();
        $location = $adminRedirect->headers->get('Location');
        $this->assertNotNull($location);
        $this->assertStringContainsString('/preview/page/'.$page->getKey(), $location);
        $this->assertStringContainsString('signature=', $location);
    }

    #[Test]
    public function test_filament_preview_action_opens_in_a_new_tab(): void
    {
        $this->withoutVite();

        $blog = $this->createRecord(CmsPreviewType::Blog, 'draft', 'Action Blog');
        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);

        $this->actingAs($admin);
        Filament::setCurrentPanel('admin');

        $action = PreviewAction::make()->record($blog);

        $this->assertTrue($action->shouldOpenUrlInNewTab());
        $this->assertSame(
            route('filament.admin.content-preview', ['type' => 'blog', 'id' => $blog->getKey()]),
            $action->getUrl(),
        );

        Livewire::test(EditBlog::class, ['record' => $blog->getKey()])
            ->assertActionExists('preview')
            ->assertActionHasUrl(
                'preview',
                route('filament.admin.content-preview', ['type' => 'blog', 'id' => $blog->getKey()]),
            )
            ->assertActionShouldOpenUrlInNewTab('preview');

        $page = $this->createRecord(CmsPreviewType::Page, 'draft', 'Action Page');

        Livewire::test(EditPage::class, ['record' => $page->getKey()])
            ->assertActionExists('preview')
            ->assertActionHasUrl(
                'preview',
                route('filament.admin.content-preview', ['type' => 'page', 'id' => $page->getKey()]),
            )
            ->assertActionShouldOpenUrlInNewTab('preview');
    }

    #[Test]
    public function test_preview_generation_rejects_unknown_types_and_missing_records(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);

        $this->actingAs($admin)
            ->get('/admin/content-preview/blog/999999')
            ->assertNotFound();
    }

    protected function signedPreviewUrl(Model $record): string
    {
        return app(CmsPreviewService::class)->signedUrl($record);
    }

    protected function publicPath(CmsPreviewType $type, Model $record): string
    {
        $slug = (string) $record->getAttribute('slug');

        return match ($type) {
            CmsPreviewType::Page => $slug === 'home' ? '/' : '/'.$slug.'/',
            CmsPreviewType::Blog => '/blog/'.$slug.'/',
            CmsPreviewType::Article => '/articles/'.$slug.'/',
            CmsPreviewType::CaseStudy => '/case-studies/'.$slug.'/',
            CmsPreviewType::PressRelease => '/pressrelease/'.$slug.'/',
            CmsPreviewType::Ebook => '/ebooks/'.$slug.'/',
            CmsPreviewType::WhitePaper => '/white-papers/'.$slug.'/',
            CmsPreviewType::LandingPage => '/lp/'.$slug.'/',
            CmsPreviewType::Newsletter => '/newsletter/'.$slug.'/',
            CmsPreviewType::Industry => '/industry/'.$slug.'/',
        };
    }

    protected function createRecord(CmsPreviewType $type, string $status, string $title): Model
    {
        $slug = Str::slug($title);
        $paragraph = [['type' => 'paragraph', 'data' => ['content' => '<p>'.$title.'</p>']]];

        $attributes = [
            'title' => $title,
            'slug' => $slug,
            'status' => $status,
            'published_at' => $status === 'published' ? now() : null,
        ];

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
