<?php

namespace Tests\Feature;

use App\Filament\Clusters\CookieManagement\CookieManagementCluster;
use App\Filament\Clusters\CookieManagement\Resources\CookieCategories\CookieCategoryResource;
use App\Models\CookieCategory;
use App\Models\CookieConsentMetric;
use App\Models\CookieConsentSetting;
use App\Models\CookieIntegration;
use App\Models\LandingPage;
use App\Models\Page;
use App\Models\PageView;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Services\CookieConsent\CookieConsentRepository;
use App\Services\CookieConsent\JurisdictionResolver;
use App\Services\WebsiteSettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CookieConsentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_a_first_visit_shows_the_banner_and_does_not_track_or_load_optional_scripts(): void
    {
        $this->createPage();
        $this->storeTrackingIds();

        $response = $this->get('/about-us/');

        $response->assertOk();
        $response->assertSee('We use cookies to improve your experience. Do you accept?', false);
        $response->assertSee('Accept All', false);
        $response->assertSee('Reject All', false);
        $response->assertSee('Preferences', false);
        $response->assertSeeInOrder(['data-cookie-action="settings"', 'data-cookie-action="reject"', 'data-cookie-action="accept"'], false);
        $response->assertSee('Manage Cookies', false);
        $response->assertSee("analytics_storage: 'denied'", false);
        $response->assertSee("ad_storage: 'denied'", false);
        $response->assertSee("ad_user_data: 'denied'", false);
        $response->assertSee("ad_personalization: 'denied'", false);
        $response->assertDontSee('gtm.js', false);
        $response->assertDontSee('gtag/js', false);
        $response->assertDontSee('GTM-TEST123', false);
        $response->assertDontSee('G-TEST12345', false);
        $response->assertCookieMissing('ibn_visitor');
        $this->assertSame(0, PageView::query()->count());
    }

    public function test_production_can_publish_tracking_ids_without_loading_them_before_consent(): void
    {
        $this->createPage();
        $this->storeTrackingIds();
        $this->app['env'] = 'production';
        app(CookieConsentRepository::class)->forget();

        $response = $this->get('/about-us/');

        $response->assertOk();
        $response->assertSee('GTM-TEST123', false);
        $response->assertSee('G-TEST12345', false);
        $response->assertDontSee('gtm.js', false);
        $response->assertDontSee('gtag/js', false);
        $response->assertDontSee('snap.licdn.com', false);
    }

    public function test_analytics_consent_records_a_page_view_and_rejection_does_not(): void
    {
        $this->createPage();

        $allowed = $this->withUnencryptedCookie('ibn_cookie_consent', $this->consentCookie(analytics: true))
            ->withHeaders(['User-Agent' => 'Mozilla/5.0 Chrome/120.0.0.0'])
            ->get('/about-us/');

        $allowed->assertOk();
        $allowed->assertCookie('ibn_visitor');
        $this->assertSame(1, PageView::query()->count());

        $visitor = (string) $allowed->getCookie('ibn_visitor')?->getValue();

        $rejected = $this->withUnencryptedCookie('ibn_cookie_consent', $this->consentCookie(analytics: false))
            ->withCookie('ibn_visitor', $visitor)
            ->withHeaders(['User-Agent' => 'Mozilla/5.0 Chrome/120.0.0.0'])
            ->get('/about-us/');

        $rejected->assertOk();
        $this->assertSame(1, PageView::query()->count());
        $rejected->assertCookieExpired('ibn_visitor');
    }

    public function test_a_policy_version_change_requires_a_new_choice(): void
    {
        $this->createPage();
        $cookie = $this->consentCookie(analytics: true);
        $settings = CookieConsentSetting::query()->firstOrFail();
        $settings->policy_version = '2';
        $settings->save();

        $this->withUnencryptedCookie('ibn_cookie_consent', $cookie)
            ->withHeaders(['User-Agent' => 'Mozilla/5.0 Chrome/120.0.0.0'])
            ->get('/about-us/')
            ->assertOk()
            ->assertCookieMissing('ibn_visitor');

        $this->assertSame(0, PageView::query()->count());
    }

    public function test_consent_metrics_store_actions_only(): void
    {
        $this->post('/cookie-consent', [
            'action' => 'accept_all',
            'visitor' => 'should-not-be-stored',
            'ip' => '203.0.113.10',
        ])->assertOk();

        $this->post('/cookie-consent', ['action' => 'reject_all'])->assertOk();
        $this->post('/cookie-consent', ['action' => 'custom'])->assertOk();
        $this->post('/cookie-consent', ['action' => 'withdrawal'])->assertOk();
        $this->postJson('/cookie-consent', ['action' => 'unknown'])->assertStatus(422);

        $metric = CookieConsentMetric::query()->firstOrFail();
        $stored = json_encode($metric->getAttributes());

        $this->assertSame(1, $metric->accept_all_count);
        $this->assertSame(1, $metric->reject_all_count);
        $this->assertSame(1, $metric->custom_count);
        $this->assertSame(1, $metric->withdrawal_count);
        $this->assertIsString($stored);
        $this->assertStringNotContainsString('should-not-be-stored', $stored);
        $this->assertStringNotContainsString('203.0.113.10', $stored);
    }

    public function test_the_cookie_policy_uses_confirmed_cookies_and_does_not_imply_consent(): void
    {
        Page::query()->create([
            'title' => 'Cookies Policy',
            'slug' => 'cookies-policy',
            'template' => 'cookies-policy',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/cookies-policy/');

        $response->assertOk();
        $response->assertSee('does not count as consent', false);
        $response->assertSee('ibn_cookie_consent', false);
        $response->assertSee('ibn_visitor', false);
        $response->assertDontSee('you consent to the use of cookies', false);
        $response->assertDontSee('Continued use of the Site after changes indicates acceptance', false);
        $response->assertDontSee('Used by Facebook', false);
    }

    public function test_a_landing_page_uses_the_same_consent_barrier(): void
    {
        LandingPage::query()->create([
            'title' => 'VAPT audit',
            'slug' => 'vapt-audit',
            'template' => 'vapt-audit-services',
            'status' => 'published',
            'published_at' => now(),
        ]);
        $this->storeTrackingIds();

        $response = $this->get('/lp/vapt-audit/');

        $response->assertOk();
        $response->assertSee('Manage Cookies', false);
        $response->assertSee("analytics_storage: 'denied'", false);
        $response->assertDontSee('gtm.js', false);
    }

    public function test_necessary_cookies_cannot_be_made_optional(): void
    {
        $category = CookieCategory::query()->where('key', 'necessary')->firstOrFail();
        $category->is_enabled = false;
        $category->is_mandatory = false;
        $category->save();
        $category->refresh();

        $this->assertTrue($category->is_enabled);
        $this->assertTrue($category->is_mandatory);
    }

    public function test_only_administrators_can_open_cookie_management(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $administrator = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);

        $this->actingAs($author)->get('/admin/cookie-management/categories')->assertForbidden();
        $this->actingAs($administrator)->get('/admin/cookie-management/categories')->assertOk();
        $this->actingAs($administrator)->get('/admin/cookie-management/registry')->assertOk();
        $this->actingAs($administrator)->get('/admin/cookie-management/integrations')->assertOk();
        $this->actingAs($administrator)->get('/admin/cookie-management/settings')->assertOk();
        $this->actingAs($administrator)->get('/admin/cookie-management/overview')->assertOk();
        $this->assertTrue(CookieCategoryResource::canViewAny());
        $this->assertSame('Administration', CookieManagementCluster::getNavigationGroup());

        $navigation = collect(filament()->getNavigation());
        $administration = $navigation->first(fn ($group): bool => $group->getLabel() === 'Administration');
        $this->assertNotNull($administration);
        $this->assertContains(
            'Cookie Management',
            collect($administration->getItems())->map(fn ($item): string => (string) $item->getLabel())->all(),
        );
        $this->assertNull($navigation->first(fn ($group): bool => $group->getLabel() === 'Cookie Management'));

        $clusteredComponents = filament()->getClusteredComponents(CookieManagementCluster::class);
        $this->assertCount(5, $clusteredComponents);
        $this->assertSame($clusteredComponents, array_values(array_unique($clusteredComponents)));
    }

    public function test_unknown_countries_stay_on_opt_in(): void
    {
        $resolver = new JurisdictionResolver;

        $this->assertSame('opt_in', $resolver->resolve(null, [
            ['countries' => ['US'], 'mode' => 'notice'],
        ]));
        $this->assertSame('opt_in', $resolver->resolve('XX', []));
        $this->assertSame('notice', $resolver->resolve('US', [
            ['countries' => ['US'], 'mode' => 'notice'],
        ]));
        $this->assertSame('opt_in', $resolver->publicMode());

        $integration = CookieIntegration::query()->where('key', 'gtm')->firstOrFail();
        $this->assertSame(['analytics', 'marketing'], $integration->consent_categories);
        $this->assertSame(['production'], $integration->environments);
    }

    private function createPage(): Page
    {
        return Page::query()->create([
            'title' => 'About us',
            'slug' => 'about-us',
            'template' => 'about',
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    private function storeTrackingIds(): void
    {
        $settings = WebsiteSetting::query()->first() ?? app(WebsiteSettingService::class)->get();
        $settings->forceFill([
            'google_analytics_id' => 'G-TEST12345',
            'google_tag_manager_id' => 'GTM-TEST123',
        ])->save();

        app(CookieConsentRepository::class)->forget();
    }

    private function consentCookie(bool $analytics): string
    {
        $settings = CookieConsentSetting::query()->firstOrFail();

        return json_encode([
            'v' => $settings->policy_version,
            'cv' => (int) $settings->config_version,
            'ts' => time(),
            'necessary' => true,
            'analytics' => $analytics,
            'marketing' => false,
            'functional' => false,
            'action' => $analytics ? 'custom' : 'reject_all',
        ], JSON_THROW_ON_ERROR);
    }
}
