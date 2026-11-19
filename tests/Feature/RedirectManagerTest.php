<?php

namespace Tests\Feature;

use App\Filament\Resources\Redirects\Pages\CreateRedirect;
use App\Filament\Resources\Redirects\Pages\EditRedirect;
use App\Filament\Resources\Redirects\Pages\ListRedirects;
use App\Models\ContentRedirect;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\User;
use App\Services\SiteRedirects;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Tests\TestCase;

class RedirectManagerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_managed_redirect_preserves_the_query_string_and_can_be_deactivated(): void
    {
        ContentRedirect::query()->create([
            'source_path' => '/promo-old',
            'target_path' => '/contact-us',
            'is_active' => true,
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);

        $this->get('/promo-old/?utm=spring')
            ->assertRedirect('http://localhost/contact-us/?utm=spring');

        ContentRedirect::query()->where('source_path', '/promo-old')->first()->update(['is_active' => false]);

        $this->get('/promo-old/')->assertNotFound();
    }

    public function test_validation_rejects_self_redirects_loops_duplicates_and_legacy_sources(): void
    {
        $redirects = app(SiteRedirects::class);

        ContentRedirect::query()->create([
            'source_path' => '/chain-a',
            'target_path' => '/chain-b',
            'is_active' => true,
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);

        $this->expectValidation(fn () => $redirects->assert('/same', '/same'));
        $this->expectValidation(fn () => $redirects->assert('/chain-b', '/chain-a'));
        $this->expectValidation(fn () => $redirects->assert('/chain-a', '/elsewhere'));
        $this->expectValidation(fn () => $redirects->assert('/contact', '/contact-us'));
    }

    public function test_published_slug_change_is_listed_and_pages_industries_and_landing_pages_redirect(): void
    {
        config([
            'cms.scaffold.views' => resource_path('views'),
            'cms.scaffold.css' => resource_path('css'),
        ]);

        $page = Page::query()->create([
            'title' => 'Offer',
            'slug' => 'old-offer',
            'template' => 'about',
            'status' => 'published',
        ]);
        $page->update(['slug' => 'new-offer']);

        $this->assertDatabaseHas('content_redirects', [
            'source_path' => '/old-offer',
            'target_path' => '/new-offer',
            'origin' => ContentRedirect::ORIGIN_SLUG,
            'is_active' => true,
        ]);
        $this->get('/old-offer/')->assertRedirect('http://localhost/new-offer/');

        $industry = Industry::query()->create([
            'title' => 'Sector',
            'slug' => 'old-sector',
            'template' => 'real-estate-and-construction',
            'status' => 'published',
        ]);
        $industry->update(['slug' => 'new-sector']);
        $this->get('/industry/old-sector/')->assertRedirect('http://localhost/industry/new-sector/');

        $landing = LandingPage::query()->create([
            'title' => 'Campaign',
            'slug' => 'old-campaign',
            'template' => 'vapt-audit-services',
            'status' => 'published',
        ]);
        $landing->update(['slug' => 'new-campaign']);
        $this->get('/lp/old-campaign/')->assertRedirect('http://localhost/lp/new-campaign/');
    }

    public function test_legacy_wordpress_contact_redirect_still_works(): void
    {
        $this->assertDatabaseHas('content_redirects', [
            'source_path' => '/contact',
            'target_path' => '/contact-us',
            'status_code' => ContentRedirect::STATUS_PERMANENT,
            'origin' => ContentRedirect::ORIGIN_LEGACY,
            'is_active' => true,
        ]);
        $this->assertFalse($this->routeFileStillRedirects('/contact'));

        $this->get('/contact/')->assertRedirect('http://localhost/contact-us/');

        $redirect = ContentRedirect::query()->where('source_path', '/contact')->first();
        $redirect->refresh();
        $this->assertSame(1, $redirect->hits);
        $this->assertNotNull($redirect->last_accessed_at);

        $redirect->update(['is_active' => false]);

        $this->get('/contact/')->assertNotFound();
    }

    public function test_permanently_removed_page_is_served_from_the_database(): void
    {
        $this->assertDatabaseHas('content_redirects', [
            'source_path' => '/payroll-processing-old',
            'status_code' => ContentRedirect::STATUS_GONE,
            'origin' => ContentRedirect::ORIGIN_LEGACY,
            'is_active' => true,
        ]);

        $this->get('/payroll-processing-old/')->assertGone();

        ContentRedirect::query()
            ->where('source_path', '/payroll-processing-old')
            ->first()
            ->update(['is_active' => false]);

        $this->get('/payroll-processing-old/')->assertNotFound();
    }

    public function test_administrator_can_create_and_search_a_redirect(): void
    {
        $this->actingAs(User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]));
        Filament::setCurrentPanel('admin');

        Livewire::test(CreateRedirect::class)
            ->assertSee('Add Redirection')
            ->assertSee('Source URLs')
            ->assertSee('Destination URL')
            ->assertSee('Redirection Type')
            ->assertSee('301 Permanent Move')
            ->assertSee('302 Temporary Move')
            ->assertSee('307 Temporary Redirect')
            ->assertSee('410 Content Deleted')
            ->assertSee('451 Content Unavailable for Legal Reasons')
            ->assertSee('Activate')
            ->assertSee('Deactivate')
            ->assertSee('Ignore Case')
            ->assertSee('Contains')
            ->assertSee('Starts With')
            ->assertSee('End With')
            ->assertSee('Regex')
            ->assertSee('Add another')
            ->assertSee('Enter the full source path')
            ->assertSee('Enter a path or a full URL')
            ->fillForm([
                'sources' => [
                    ['source_path' => '/manual-old', 'match_type' => 'exact', 'ignore_case' => false],
                ],
                'target_path' => '/manual-new',
                'status_code' => '301',
                'is_active' => '1',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('content_redirects', [
            'source_path' => '/manual-old',
            'target_path' => '/manual-new',
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);

        Livewire::test(ListRedirects::class)
            ->assertSee('Redirections')
            ->assertSee('Add New')
            ->assertSee('From')
            ->assertSee('To')
            ->assertSee('Type')
            ->assertSee('Hits')
            ->assertSee('Created')
            ->assertSee('Last Accessed')
            ->assertSee('Actions')
            ->assertSee('All (')
            ->assertSee('Active (')
            ->assertSee('Inactive (')
            ->assertSee('Trash (')
            ->searchTable('manual-old')
            ->assertSee('/manual-old')
            ->assertSee('http://localhost/manual-new/');

        $this->get('/manual-old/?ref=ad')->assertRedirect('http://localhost/manual-new/?ref=ad');
    }

    public function test_update_form_can_add_another_source_and_change_the_type(): void
    {
        $this->actingAs(User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]));
        Filament::setCurrentPanel('admin');

        $redirect = ContentRedirect::query()->create([
            'source_path' => '/manual-old',
            'target_path' => '/manual-new',
            'status_code' => ContentRedirect::STATUS_PERMANENT,
            'is_active' => true,
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);

        Livewire::test(EditRedirect::class, ['record' => $redirect->getKey()])
            ->assertSee('Update Redirection')
            ->assertSee('Source URLs')
            ->assertSee('Exact')
            ->assertSee('Add another')
            ->fillForm([
                'sources' => [
                    ['source_path' => '/manual-old', 'match_type' => 'exact', 'ignore_case' => false],
                    ['source_path' => '/manual-older', 'match_type' => 'exact', 'ignore_case' => true],
                ],
                'target_path' => '/manual-new',
                'status_code' => '302',
                'is_active' => '1',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('content_redirects', [
            'source_path' => '/manual-old',
            'target_path' => '/manual-new',
            'status_code' => ContentRedirect::STATUS_TEMPORARY,
            'ignore_case' => false,
        ]);
        $this->assertDatabaseHas('content_redirects', [
            'source_path' => '/manual-older',
            'target_path' => '/manual-new',
            'status_code' => ContentRedirect::STATUS_TEMPORARY,
            'ignore_case' => true,
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);

        $this->get('/manual-old/')->assertStatus(302)->assertRedirect('http://localhost/manual-new/');
        $this->get('/manual-OLDER/')->assertStatus(302)->assertRedirect('http://localhost/manual-new/');
    }

    public function test_case_sensitive_redirect_does_not_match_a_different_capitalization(): void
    {
        ContentRedirect::query()->create([
            'source_path' => '/Case-Exact',
            'target_path' => '/contact-us',
            'status_code' => ContentRedirect::STATUS_PERMANENT,
            'ignore_case' => false,
            'is_active' => true,
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);

        $this->get('/Case-Exact/')->assertRedirect('http://localhost/contact-us/');
        $this->get('/case-exact/')->assertNotFound();
    }

    public function test_legal_removal_returns_451_without_a_destination(): void
    {
        ContentRedirect::query()->create([
            'source_path' => '/removed-for-legal-reasons',
            'target_path' => '',
            'status_code' => ContentRedirect::STATUS_LEGAL,
            'is_active' => true,
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);

        $this->get('/removed-for-legal-reasons/')->assertStatus(451);
    }

    public function test_partial_and_regex_source_matches_apply_to_the_request_path(): void
    {
        ContentRedirect::query()->create([
            'source_path' => 'payroll',
            'target_path' => '/contact-us',
            'match_type' => ContentRedirect::MATCH_CONTAINS,
            'status_code' => ContentRedirect::STATUS_PERMANENT,
            'is_active' => true,
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);
        ContentRedirect::query()->create([
            'source_path' => '/blog',
            'target_path' => '/contact-us',
            'match_type' => ContentRedirect::MATCH_STARTS_WITH,
            'status_code' => ContentRedirect::STATUS_TEMPORARY,
            'is_active' => true,
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);
        ContentRedirect::query()->create([
            'source_path' => 'providers',
            'target_path' => '/contact-us',
            'match_type' => ContentRedirect::MATCH_ENDS_WITH,
            'status_code' => ContentRedirect::STATUS_PERMANENT,
            'is_active' => true,
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);
        ContentRedirect::query()->create([
            'source_path' => '^/legacy-',
            'target_path' => '/contact-us',
            'match_type' => ContentRedirect::MATCH_REGEX,
            'status_code' => ContentRedirect::STATUS_TEMPORARY_STRICT,
            'is_active' => true,
            'origin' => ContentRedirect::ORIGIN_MANUAL,
        ]);

        $this->get('/payroll-tools/')->assertRedirect('http://localhost/contact-us/');
        $this->get('/saved-providers/')->assertRedirect('http://localhost/contact-us/');
        $this->get('/blog/outsourcing-guide/')->assertStatus(302)->assertRedirect('http://localhost/contact-us/');
        $this->get('/legacy-offer/')->assertStatus(307)->assertRedirect('http://localhost/contact-us/');
        $this->get('/plain-public-page/')->assertNotFound();

        $this->expectValidation(fn () => app(SiteRedirects::class)->assert(
            'admin',
            '/contact-us',
            null,
            ContentRedirect::STATUS_PERMANENT,
            ContentRedirect::MATCH_CONTAINS,
        ));
        $this->expectValidation(fn () => app(SiteRedirects::class)->assert(
            '(',
            '/contact-us',
            null,
            ContentRedirect::STATUS_PERMANENT,
            ContentRedirect::MATCH_REGEX,
        ));
    }

    public function test_deleted_newsletter_slug_can_be_reused_without_a_stale_redirect(): void
    {
        config([
            'cms.scaffold.views' => resource_path('views'),
            'cms.scaffold.css' => resource_path('css'),
        ]);

        $first = Newsletter::query()->create([
            'title' => 'Issue',
            'slug' => 'test-newsletter',
            'template' => 'vciso-as-a-service',
            'status' => 'published',
        ]);
        $first->update(['slug' => 'test-newsletter-02']);
        $first->forceDelete();

        Newsletter::query()->create([
            'title' => 'Issue again',
            'slug' => 'test-newsletter',
            'template' => 'vciso-as-a-service',
            'status' => 'published',
        ]);

        $this->get('/newsletter/test-newsletter/')->assertOk();
    }

    private function routeFileStillRedirects(string $path): bool
    {
        foreach (Route::getRoutes() as $route) {
            $uses = $route->getAction('uses') ?? $route->getAction('controller');

            if (! is_string($uses) || ! str_contains($uses, 'RedirectController')) {
                continue;
            }

            if ('/'.ltrim($route->uri(), '/') === $path) {
                return true;
            }
        }

        return false;
    }

    private function expectValidation(\Closure $callback): void
    {
        try {
            $callback();
            $this->fail('The redirect should have been rejected.');
        } catch (ValidationException) {
            $this->assertTrue(true);
        }
    }
}
