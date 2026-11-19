<?php

namespace Tests\Feature;

use App\Filament\Resources\Industries\Pages\CreateIndustry;
use App\Filament\Resources\LandingPages\Pages\CreateLandingPage;
use App\Filament\Resources\Newsletters\Pages\CreateNewsletter;
use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Pages\Pages\ListPages;
use App\Models\ContentRedirect;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\User;
use App\Services\ContentTemplateScaffold;
use App\Support\ContentTemplates\ContentTemplateKind;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Tests\TestCase;

class ContentTemplateScaffoldTest extends TestCase
{
    use RefreshDatabase;

    private string $root;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        $this->root = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-scaffold-'.bin2hex(random_bytes(4));
        File::ensureDirectoryExists($this->root.DIRECTORY_SEPARATOR.'views');
        File::ensureDirectoryExists($this->root.DIRECTORY_SEPARATOR.'css');
        config([
            'cms.scaffold.views' => $this->root.DIRECTORY_SEPARATOR.'views',
            'cms.scaffold.css' => $this->root.DIRECTORY_SEPARATOR.'css',
        ]);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->root);

        parent::tearDown();
    }

    public function test_it_creates_blade_and_css_once_for_each_module(): void
    {
        $scaffold = app(ContentTemplateScaffold::class);

        foreach (ContentTemplateKind::cases() as $kind) {
            $slug = 'starter-'.$kind->value;
            $result = $scaffold->createMissing($kind, $slug);

            $this->assertTrue($result->bladeCreated);
            $this->assertTrue($result->cssCreated);
            $this->assertFileExists($this->bladePath($kind, $slug));
            $this->assertFileExists($this->cssPath($kind, $slug));
        }

        $newsletter = file_get_contents($this->bladePath(ContentTemplateKind::Newsletter, 'starter-newsletter')) ?: '';
        $this->assertStringContainsString("@extends('layouts.newsletter')", $newsletter);
        $this->assertStringContainsString("@include('newsletters.partials.stage-1')", $newsletter);
        $this->assertStringContainsString('resources/css/newsletters/starter-newsletter.css', $newsletter);

        $landing = file_get_contents($this->bladePath(ContentTemplateKind::LandingPage, 'starter-landing-page')) ?: '';
        $this->assertStringContainsString("@extends('layouts.landing')", $landing);
        $this->assertStringContainsString("@include('landing-pages.partials.campaign')", $landing);
        $this->assertStringNotContainsString("@vite(['resources/css/landing-pages/starter-landing-page.css'])", $landing);
    }

    public function test_existing_files_are_not_overwritten_or_regenerated_or_deleted(): void
    {
        $scaffold = app(ContentTemplateScaffold::class);
        $kind = ContentTemplateKind::Page;
        $scaffold->createMissing($kind, 'keep-me');
        File::put($this->bladePath($kind, 'keep-me'), 'CUSTOM BLADE');
        File::put($this->cssPath($kind, 'keep-me'), 'CUSTOM CSS');

        $again = $scaffold->createMissing($kind, 'keep-me');

        $this->assertFalse($again->bladeCreated);
        $this->assertFalse($again->cssCreated);
        $this->assertSame('CUSTOM BLADE', File::get($this->bladePath($kind, 'keep-me')));
        $this->assertSame('CUSTOM CSS', File::get($this->cssPath($kind, 'keep-me')));

        $page = Page::query()->create([
            'title' => 'Keep',
            'slug' => 'keep-me',
            'template' => 'keep-me',
            'status' => 'draft',
        ]);
        $page->update(['title' => 'Renamed title', 'slug' => 'keep-me-url', 'status' => 'published']);
        $page->delete();

        $this->assertSame('CUSTOM BLADE', File::get($this->bladePath($kind, 'keep-me')));
        $this->assertFileDoesNotExist($this->bladePath($kind, 'keep-me-url'));
    }

    public function test_slug_rules_reject_invalid_reserved_and_unsafe_names(): void
    {
        $scaffold = app(ContentTemplateScaffold::class);

        $this->expectSlugFailure(ContentTemplateKind::Page, 'Blog Post');
        $this->expectSlugFailure(ContentTemplateKind::Page, '../secret');
        $this->expectSlugFailure(ContentTemplateKind::Page, 'foo/bar');
        $this->expectSlugFailure(ContentTemplateKind::Page, 'blog');
        $this->expectSlugFailure(ContentTemplateKind::Page, 'page-sitemap');
        $this->expectSlugFailure(ContentTemplateKind::LandingPage, 'index');
        $this->expectSlugFailure(ContentTemplateKind::Newsletter, 'footer');

        $scaffold->assertSlug(ContentTemplateKind::Industry, 'healthcare');
        $this->assertTrue(true);
    }

    public function test_publishing_requires_blade_and_css(): void
    {
        $scaffold = app(ContentTemplateScaffold::class);

        try {
            $scaffold->assertAssetsExist(ContentTemplateKind::Industry, 'missing-industry');
            $this->fail('Publishing a missing template should be rejected.');
        } catch (ValidationException $exception) {
            $this->assertStringContainsString('Blade file', $exception->errors()['status'][0]);
            $this->assertStringContainsString('CSS file', $exception->errors()['status'][0]);
        }

        $scaffold->createMissing(ContentTemplateKind::Industry, 'missing-industry');
        $scaffold->assertAssetsExist(ContentTemplateKind::Industry, 'missing-industry');
        $this->assertTrue(true);
    }

    public function test_published_slug_changes_redirect_without_loops_or_duplicates(): void
    {
        config([
            'cms.scaffold.views' => resource_path('views'),
            'cms.scaffold.css' => resource_path('css'),
        ]);

        $page = Page::query()->create([
            'title' => 'Redirect Source',
            'slug' => 'redirect-source',
            'template' => 'about',
            'status' => 'published',
        ]);

        $page->update(['slug' => 'redirect-second']);
        $page->update(['slug' => 'redirect-final']);

        $this->assertSame(1, ContentRedirect::query()->where('source_path', '/redirect-source')->count());
        $this->assertSame('/redirect-final', ContentRedirect::query()->where('source_path', '/redirect-source')->value('target_path'));
        $this->assertSame('/redirect-final', ContentRedirect::query()->where('source_path', '/redirect-second')->value('target_path'));

        $this->get('/redirect-source/')->assertRedirect('http://localhost/redirect-final/');
        $this->get('/redirect-second/?utm=1')->assertRedirect('http://localhost/redirect-final/?utm=1');

        $page->update(['slug' => 'redirect-source']);

        $this->get('/redirect-source/')->assertOk();
        $this->assertNull(ContentRedirect::query()->where('source_path', '/redirect-source')->value('target_path'));
        $this->assertSame('/redirect-source', ContentRedirect::query()->where('source_path', '/redirect-final')->value('target_path'));
    }

    public function test_deleted_and_recreated_slug_does_not_keep_stale_redirects(): void
    {
        config([
            'cms.scaffold.views' => resource_path('views'),
            'cms.scaffold.css' => resource_path('css'),
        ]);

        $first = Newsletter::query()->create([
            'title' => 'Test Newsletter',
            'slug' => 'test-newsletter',
            'template' => 'vciso-as-a-service',
            'status' => 'published',
        ]);
        $first->update(['slug' => 'test-newsletter-02']);
        $first->forceDelete();

        $this->assertSame(
            0,
            ContentRedirect::query()->where('source_path', '/newsletter/test-newsletter')->count(),
        );

        Newsletter::query()->create([
            'title' => 'Test Newsletter Again',
            'slug' => 'test-newsletter',
            'template' => 'vciso-as-a-service',
            'status' => 'published',
        ]);

        $this->get('/newsletter/test-newsletter/')->assertOk();
        $this->assertSame(
            0,
            ContentRedirect::query()->where('source_path', '/newsletter/test-newsletter')->count(),
        );
    }

    public function test_draft_slug_changes_do_not_redirect_and_newsletters_do(): void
    {
        config([
            'cms.scaffold.views' => resource_path('views'),
            'cms.scaffold.css' => resource_path('css'),
        ]);

        $draft = Page::query()->create([
            'title' => 'Draft',
            'slug' => 'draft-redirect',
            'template' => 'about',
            'status' => 'draft',
        ]);
        $draft->update(['slug' => 'draft-redirect-next']);

        $this->assertSame(0, ContentRedirect::query()->count());

        $newsletter = Newsletter::query()->create([
            'title' => 'Issue',
            'slug' => 'issue-one',
            'template' => 'vciso-as-a-service',
            'status' => 'published',
        ]);
        $newsletter->update(['slug' => 'issue-two']);

        $this->get('/newsletter/issue-one/')->assertRedirect('http://localhost/newsletter/issue-two/');
    }

    public function test_thank_you_options_are_limited_to_other_published_campaigns(): void
    {
        $current = LandingPage::query()->create([
            'title' => 'Current Campaign',
            'slug' => 'current-campaign',
            'template' => 'vapt-audit-services',
            'status' => 'published',
        ]);
        LandingPage::query()->create([
            'title' => 'Other Campaign',
            'slug' => 'other-campaign',
            'template' => 'vapt-audit-services',
            'status' => 'published',
        ]);
        LandingPage::query()->create([
            'title' => 'Thank You',
            'slug' => 'current-campaign-thank-you',
            'template' => 'thank-you',
            'status' => 'published',
        ]);
        LandingPage::query()->create([
            'title' => 'Draft Campaign',
            'slug' => 'draft-campaign',
            'template' => 'vapt-audit-services',
            'status' => 'draft',
        ]);

        $options = LandingPage::thankYouSelectOptions($current->getKey());

        $this->assertSame(['other-campaign'], array_keys($options));
    }

    public function test_admin_create_generates_files_and_lists_availability(): void
    {
        $this->actingAs($this->administrator());
        Filament::setCurrentPanel('admin');

        Livewire::test(CreatePage::class)
            ->fillForm([
                'title' => 'Scaffold Demo',
                'slug' => 'scaffold-demo',
                'status' => 'draft',
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertNotified();

        $page = Page::query()->where('slug', 'scaffold-demo')->first();
        $this->assertNotNull($page);
        $this->assertSame('scaffold-demo', $page->template);
        $this->assertFileExists($this->bladePath(ContentTemplateKind::Page, 'scaffold-demo'));
        $this->assertFileExists($this->cssPath(ContentTemplateKind::Page, 'scaffold-demo'));

        Page::query()->create([
            'title' => 'Missing Files',
            'slug' => 'missing-files',
            'template' => 'missing-files',
            'status' => 'draft',
        ]);

        Livewire::test(ListPages::class)
            ->assertSee('Available')
            ->assertSee('Missing');

        Livewire::test(EditPage::class, ['record' => $page->getKey()])
            ->assertSee('Available')
            ->assertActionEnabled('preview');

        $missing = Page::query()->where('slug', 'missing-files')->firstOrFail();

        Livewire::test(EditPage::class, ['record' => $missing->getKey()])
            ->assertSee('Missing')
            ->assertActionDisabled('preview')
            ->fillForm(['status' => 'published'])
            ->call('save')
            ->assertHasFormErrors(['status']);

        $this->assertSame('draft', $missing->refresh()->status);
    }

    public function test_filament_create_covers_the_other_three_modules(): void
    {
        $this->actingAs($this->administrator());
        Filament::setCurrentPanel('admin');

        Livewire::test(CreateIndustry::class)
            ->fillForm([
                'title' => 'New Industry',
                'slug' => 'new-industry',
                'status' => 'draft',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        Livewire::test(CreateLandingPage::class)
            ->fillForm([
                'title' => 'New Campaign',
                'slug' => 'new-campaign',
                'status' => 'draft',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        Livewire::test(CreateNewsletter::class)
            ->fillForm([
                'title' => 'New Issue',
                'slug' => 'new-issue',
                'status' => 'draft',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertSame('new-industry', Industry::query()->where('slug', 'new-industry')->value('template'));
        $this->assertSame('new-campaign', LandingPage::query()->where('slug', 'new-campaign')->value('template'));
        $this->assertSame('new-issue', Newsletter::query()->where('slug', 'new-issue')->value('template'));
        $this->assertFileExists($this->bladePath(ContentTemplateKind::Industry, 'new-industry'));
        $this->assertFileExists($this->bladePath(ContentTemplateKind::LandingPage, 'new-campaign'));
        $this->assertFileExists($this->cssPath(ContentTemplateKind::Newsletter, 'new-issue'));
        $this->assertStringContainsString(
            'layouts.newsletter',
            File::get($this->bladePath(ContentTemplateKind::Newsletter, 'new-issue')),
        );
    }

    private function expectSlugFailure(ContentTemplateKind $kind, string $slug): void
    {
        try {
            app(ContentTemplateScaffold::class)->assertSlug($kind, $slug);
            $this->fail("Slug [{$slug}] should have been rejected.");
        } catch (ValidationException) {
            $this->assertTrue(true);
        }
    }

    private function bladePath(ContentTemplateKind $kind, string $slug): string
    {
        return $this->root.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$kind->viewDirectory().DIRECTORY_SEPARATOR.$slug.'.blade.php';
    }

    private function cssPath(ContentTemplateKind $kind, string $slug): string
    {
        return $this->root.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.$kind->cssDirectory().DIRECTORY_SEPARATOR.$slug.'.css';
    }

    private function administrator(): User
    {
        return User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
    }
}
