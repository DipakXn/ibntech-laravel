<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\WebsiteSettings;
use App\Models\Page;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Services\ApplicationCacheService;
use App\Services\WebsiteSettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;
use RuntimeException;
use Tests\TestCase;

class WebsiteSettingsCacheTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();

        config(['cache.default' => 'database']);
    }

    public function test_guests_cannot_access_website_settings(): void
    {
        $this->get('/admin/website-settings')
            ->assertRedirect('/'.Login::ROUTE_PATH);
    }

    public function test_authors_cannot_access_website_settings(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $this->actingAs($author)
            ->get('/admin/website-settings')
            ->assertForbidden();
    }

    public function test_clear_cache_requires_confirmation_before_flushing(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Cache::put('confirmation-test-key', 'value', 3600);

        $this->actingAs($admin);

        Livewire::test(WebsiteSettings::class)
            ->call('mountAction', 'clearCache')
            ->assertSet('mountedActions', fn (array $mountedActions): bool => $mountedActions !== []);

        $this->assertSame(1, DB::table('cache')->count());
        $this->assertTrue(Cache::has('confirmation-test-key'));
    }

    public function test_administrator_can_clear_application_cache_without_affecting_other_data(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $settings = WebsiteSetting::query()->create(
            app(WebsiteSettingService::class)->defaultAttributes()
        );

        $page = Page::query()->create([
            'title' => 'About us',
            'slug' => 'about-us',
            'template' => 'default',
            'status' => 'published',
        ]);

        DB::table('sessions')->insert([
            'id' => 'test-session-id',
            'user_id' => $admin->id,
            'payload' => base64_encode('session-payload'),
            'last_activity' => now()->timestamp,
        ]);

        DB::table('jobs')->insert([
            'queue' => 'default',
            'payload' => json_encode(['displayName' => 'TestJob']),
            'attempts' => 0,
            'available_at' => now()->timestamp,
            'created_at' => now()->timestamp,
        ]);

        DB::table('cache_locks')->insert([
            'key' => 'test-cache-lock',
            'owner' => 'test-owner',
            'expiration' => now()->addHour()->timestamp,
        ]);

        Cache::put('isolation-test-key', 'cached-value', 3600);
        Cache::put(WebsiteSettingService::CACHE_KEY, $settings, 3600);

        $this->assertSame(2, DB::table('cache')->count());
        $this->assertSame(1, DB::table('sessions')->count());
        $this->assertSame(1, DB::table('jobs')->count());
        $this->assertSame(1, DB::table('cache_locks')->count());
        $this->assertSame(1, WebsiteSetting::query()->count());
        $this->assertSame(1, Page::query()->count());

        $this->actingAs($admin);

        Livewire::test(WebsiteSettings::class)
            ->call('mountAction', 'clearCache')
            ->call('callMountedAction');

        $this->assertSame(0, DB::table('cache')->count());
        $this->assertSame(1, DB::table('sessions')->count());
        $this->assertSame(1, DB::table('jobs')->count());
        $this->assertSame(1, DB::table('cache_locks')->count());
        $this->assertSame(1, WebsiteSetting::query()->count());
        $this->assertSame(1, Page::query()->count());
        $this->assertSame('About us', Page::query()->value('title'));
        $this->assertSame($settings->id, WebsiteSetting::query()->value('id'));
    }

    public function test_failure_is_logged_and_not_exposed_to_the_user(): void
    {
        Log::shouldReceive('error')
            ->once()
            ->withArgs(function (string $message, array $context): bool {
                return $message === 'Failed to clear application cache.'
                    && isset($context['exception']);
            });

        $this->mock(ApplicationCacheService::class, function ($mock): void {
            $mock->shouldReceive('clear')
                ->once()
                ->andThrow(new RuntimeException('Connection refused: mysql secret-host'));
        });

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        Livewire::test(WebsiteSettings::class)
            ->call('mountAction', 'clearCache')
            ->call('callMountedAction')
            ->assertDontSee('Connection refused: mysql secret-host')
            ->assertDontSee('secret-host');
    }
}
