<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\MaintenanceMode as MaintenanceModePage;
use App\Filament\Pages\WebsiteSettings;
use App\Models\Page;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Services\MaintenanceMode;
use App\Services\WebsiteSettingService;
use Filament\Actions\Action;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;
use Livewire\Mechanisms\HandleRequests\EndpointResolver;
use Tests\TestCase;

class MaintenanceModeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_guests_cannot_open_maintenance_mode_settings(): void
    {
        $this->get('/admin/maintenance-mode')
            ->assertRedirect('/'.Login::ROUTE_PATH);
    }

    public function test_authors_cannot_open_maintenance_mode_settings(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $this->actingAs($author)
            ->get('/admin/maintenance-mode')
            ->assertForbidden();
    }

    public function test_administrators_can_open_maintenance_mode_settings(): void
    {
        $admin = $this->administrator();

        $this->assertSame('Administration', MaintenanceModePage::getNavigationGroup());
        $this->assertSame('Maintenance Mode', MaintenanceModePage::getNavigationLabel());
        $this->assertSame('maintenance-mode', MaintenanceModePage::getSlug());

        $this->actingAs($admin)
            ->get('/admin/maintenance-mode')
            ->assertOk()
            ->assertSee('Maintenance Mode')
            ->assertSee('Current status')
            ->assertSee('Disabled')
            ->assertSee('Maintenance mode');
    }

    public function test_enabling_maintenance_requires_confirmation_and_persists_through_cache_clears(): void
    {
        $admin = $this->administrator();
        $this->actingAs($admin);

        $component = Livewire::test(MaintenanceModePage::class)
            ->set('data.maintenance_enabled', true)
            ->call('save');

        $action = $component->instance()->getMountedAction();

        $this->assertInstanceOf(Action::class, $action);
        $this->assertTrue($action->isConfirmationRequired());
        $this->assertSame('Enable maintenance mode?', (string) $action->getModalHeading());
        $this->assertFalse(app(MaintenanceMode::class)->enabled());

        $component->call('callMountedAction')
            ->assertNotified('Maintenance mode enabled');

        $this->assertTrue(app(MaintenanceMode::class)->enabled());
        $this->assertTrue((bool) WebsiteSetting::query()->value('maintenance_enabled'));

        $stale = WebsiteSetting::query()->first();
        $stale->maintenance_enabled = false;
        Cache::forever(WebsiteSettingService::CACHE_KEY, $stale);

        $this->assertTrue(app(MaintenanceMode::class)->enabled());

        Cache::flush();

        $this->assertTrue(app(MaintenanceMode::class)->enabled());
        $this->assertTrue((bool) WebsiteSetting::query()->value('maintenance_enabled'));
    }

    public function test_disabling_maintenance_saves_without_confirmation(): void
    {
        $admin = $this->administrator();
        app(MaintenanceMode::class)->set(true, $admin);
        $this->actingAs($admin);

        $component = Livewire::test(MaintenanceModePage::class)
            ->set('data.maintenance_enabled', false)
            ->call('save')
            ->assertNotified('Maintenance mode disabled');

        $this->assertNull($component->instance()->getMountedAction());
        $this->assertFalse(app(MaintenanceMode::class)->enabled());
    }

    public function test_public_visitors_receive_the_standalone_maintenance_page(): void
    {
        app(MaintenanceMode::class)->set(true, $this->administrator());

        $response = $this->get('/');
        $html = $response->getContent();

        $response->assertServiceUnavailable();
        $response->assertHeader('Retry-After', (string) MaintenanceMode::RETRY_AFTER);
        $response->assertHeader('X-Robots-Tag', 'noindex');
        $this->assertStringContainsString('no-store', (string) $response->headers->get('Cache-Control'));
        $this->assertSame(1, substr_count(strtolower($html), '<html'));
        $response->assertSee('<h1>We\'ll Be Back Soon!</h1>', false);
        $response->assertSee('We\'re performing scheduled maintenance to improve your experience. We apologize for the inconvenience and will be back shortly.', false);
        $response->assertSee('uploads/web-img/ibn-logo.webp', false);
        $response->assertSee('#2e2e80', false);
        $response->assertSee('#4caf50', false);
        $response->assertSee('aria-hidden="true"', false);
        $response->assertDontSee('site-ibn-header', false);
        $response->assertDontSee('site-footer', false);
        $response->assertDontSee('<button', false);
    }

    public function test_administrators_can_browse_the_website_and_admin_panel_during_maintenance(): void
    {
        $this->homePage();
        $admin = $this->administrator();
        app(MaintenanceMode::class)->set(true, $admin);

        $this->actingAs($admin)
            ->get('/')
            ->assertOk()
            ->assertSee('site-ibn-header', false)
            ->assertDontSee('We\'ll Be Back Soon!', false);

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/admin/maintenance-mode')
            ->assertOk()
            ->assertSee('Enabled');
    }

    public function test_authors_see_the_maintenance_page_but_can_open_the_admin_panel(): void
    {
        $this->homePage();
        app(MaintenanceMode::class)->set(true, $this->administrator());
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $this->actingAs($author)
            ->get('/')
            ->assertServiceUnavailable()
            ->assertSee('We\'ll Be Back Soon!', false)
            ->assertDontSee('site-ibn-header', false);

        $this->actingAs($author)
            ->get('/admin')
            ->assertOk();
    }

    public function test_authentication_health_and_api_routes_stay_available(): void
    {
        app(MaintenanceMode::class)->set(true, $this->administrator());

        $this->get('/'.Login::ROUTE_PATH)
            ->assertOk()
            ->assertSee('Control Center', false);

        $this->get(route('filament.admin.auth.password-reset.request'))
            ->assertOk();

        $health = $this->get('/up');
        $health->assertRedirect();
        $this->assertStringEndsWith('/up/', (string) $health->headers->get('Location'));
        $health->assertDontSee('We\'ll Be Back Soon!', false);

        $this->followingRedirects()
            ->get('/up')
            ->assertOk()
            ->assertDontSee('We\'ll Be Back Soon!', false);

        $api = $this->get('/api/example');
        $api->assertRedirect();
        $this->assertStringEndsWith('/api/example/', (string) $api->headers->get('Location'));
        $api->assertDontSee('We\'ll Be Back Soon!', false);

        $this->followingRedirects()
            ->get('/api/example')
            ->assertNotFound()
            ->assertDontSee('We\'ll Be Back Soon!', false);
    }

    public function test_guest_livewire_updates_are_blocked_unless_they_come_from_sign_in(): void
    {
        app(MaintenanceMode::class)->set(true, $this->administrator());
        $this->startSession();

        $this->withHeader('X-CSRF-TOKEN', csrf_token())
            ->post(EndpointResolver::updatePath(), [])
            ->assertServiceUnavailable();

        $this->withHeader('X-CSRF-TOKEN', csrf_token())
            ->withHeader('Referer', url('/'.Login::ROUTE_PATH))
            ->post(EndpointResolver::updatePath(), [])
            ->assertNotFound();

        $admin = $this->administrator();

        $this->actingAs($admin)
            ->withHeader('X-CSRF-TOKEN', csrf_token())
            ->post(EndpointResolver::updatePath(), [])
            ->assertNotFound();
    }

    public function test_disabling_maintenance_restores_the_public_site_on_the_next_request(): void
    {
        $this->homePage();
        $admin = $this->administrator();
        $maintenance = app(MaintenanceMode::class);
        $maintenance->set(true, $admin);

        $this->get('/')->assertServiceUnavailable();

        $maintenance->set(false, $admin);

        $this->get('/')
            ->assertOk()
            ->assertSee('site-ibn-header', false)
            ->assertDontSee('We\'ll Be Back Soon!', false);
    }

    public function test_saving_website_settings_does_not_change_maintenance_mode(): void
    {
        $admin = $this->administrator();
        $this->actingAs($admin);

        $settings = WebsiteSetting::query()->create(
            app(WebsiteSettingService::class)->defaultAttributes()
        );
        $settings->maintenance_enabled = true;
        $settings->save();

        Livewire::test(WebsiteSettings::class)
            ->set('data.site_name', 'IBN During Maintenance')
            ->call('save')
            ->assertNotified('Website settings saved');

        $settings->refresh();

        $this->assertTrue($settings->maintenance_enabled);
        $this->assertSame('IBN During Maintenance', $settings->site_name);
        $this->assertTrue(app(MaintenanceMode::class)->enabled());
    }

    private function administrator(): User
    {
        return User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
    }

    private function homePage(): void
    {
        Page::query()->create([
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'home',
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}
