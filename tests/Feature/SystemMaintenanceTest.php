<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\SystemMaintenance;
use App\Models\Page;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Services\ApplicationCacheService;
use App\Services\CompiledViewService;
use App\Services\Sitemap\SitemapCacheService;
use App\Services\WebsiteSettingService;
use App\Support\Sitemap\SitemapType;
use Filament\Actions\Action;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use RuntimeException;
use Tests\TestCase;

class SystemMaintenanceTest extends TestCase
{
    use RefreshDatabase;

    private ?string $compiledViewDirectory = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    protected function tearDown(): void
    {
        if (is_string($this->compiledViewDirectory) && is_dir($this->compiledViewDirectory)) {
            File::deleteDirectory($this->compiledViewDirectory);
        }

        parent::tearDown();
    }

    public function test_guests_cannot_access_system_maintenance(): void
    {
        $this->get('/admin/system-maintenance')
            ->assertRedirect('/'.Login::ROUTE_PATH);
    }

    public function test_authors_cannot_access_system_maintenance(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $this->actingAs($author)
            ->get('/admin/system-maintenance')
            ->assertForbidden();
    }

    public function test_administrators_can_open_system_maintenance(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->assertSame('Administration', SystemMaintenance::getNavigationGroup());
        $this->assertSame('System Maintenance', SystemMaintenance::getNavigationLabel());

        $this->actingAs($admin)
            ->get('/admin/system-maintenance')
            ->assertOk()
            ->assertSee('System Maintenance')
            ->assertSee('Clear Sitemap Cache')
            ->assertSee('Removes cached XML sitemaps so they are regenerated on the next request.')
            ->assertSee('Clear Cache')
            ->assertSee('Removes cached application data from the configured cache store.')
            ->assertSee('Clear Compiled Views')
            ->assertSee('Deletes compiled Blade templates so Laravel recompiles them on the next request.');

        $page = Livewire::actingAs($admin)->test(SystemMaintenance::class)->instance();

        $this->assertNull($page->clearSitemapCacheAction()->getIcon());
        $this->assertNull($page->clearCacheAction()->getIcon());
        $this->assertNull($page->clearCompiledViewsAction()->getIcon());
    }

    public function test_clear_sitemap_cache_requires_confirmation_before_forgetting_keys(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $cache = app(SitemapCacheService::class);
        Cache::put($cache->indexKey(), '<stale-index/>', 3600);

        $this->actingAs($admin);

        $component = $this->mountMaintenanceAction('clearSitemapCache');
        $action = $component->instance()->getMountedAction();

        $this->assertInstanceOf(Action::class, $action);
        $this->assertTrue($action->isConfirmationRequired());
        $this->assertSame('Clear sitemap cache?', (string) $action->getModalHeading());
        $this->assertTrue(Cache::has($cache->indexKey()));
    }

    public function test_administrator_can_clear_sitemap_cache_without_flushing_other_cache(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $cache = app(SitemapCacheService::class);
        Cache::put($cache->indexKey(), '<stale-index/>', 3600);
        Cache::put($cache->xmlKey(SitemapType::Pages, 1), '<stale-xml/>', 3600);
        Cache::put('unrelated-cache-key', 'keep-me', 3600);

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearSitemapCache')
            ->call('callMountedAction')
            ->assertNotified('Sitemap cache cleared');

        $this->assertFalse(Cache::has($cache->indexKey()));
        $this->assertFalse(Cache::has($cache->xmlKey(SitemapType::Pages, 1)));
        $this->assertSame('keep-me', Cache::get('unrelated-cache-key'));
    }

    public function test_sitemap_cache_failure_is_logged_and_not_exposed(): void
    {
        Log::shouldReceive('error')
            ->once()
            ->withArgs(function (string $message, array $context): bool {
                return $message === 'Failed to clear sitemap cache.'
                    && isset($context['exception']);
            });

        $this->mock(SitemapCacheService::class, function ($mock): void {
            $mock->shouldReceive('forgetAll')
                ->once()
                ->andThrow(new RuntimeException('sitemap secret-host'));
        });

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearSitemapCache')
            ->call('callMountedAction')
            ->assertNotified('Failed to clear sitemap cache')
            ->assertDontSee('sitemap secret-host');
    }

    public function test_clear_cache_requires_confirmation_before_flushing(): void
    {
        config(['cache.default' => 'database']);

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Cache::put('confirmation-test-key', 'value', 3600);

        $this->actingAs($admin);

        $component = $this->mountMaintenanceAction('clearCache');
        $action = $component->instance()->getMountedAction();

        $this->assertInstanceOf(Action::class, $action);
        $this->assertTrue($action->isConfirmationRequired());
        $this->assertSame('Clear application cache?', (string) $action->getModalHeading());
        $this->assertSame(1, DB::table('cache')->count());
        $this->assertTrue(Cache::has('confirmation-test-key'));
    }

    public function test_administrator_can_clear_application_cache_without_affecting_other_data(): void
    {
        config(['cache.default' => 'database']);

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $settings = WebsiteSetting::query()->create(
            app(WebsiteSettingService::class)->defaultAttributes()
        );

        Page::query()->create([
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

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearCache')
            ->call('callMountedAction')
            ->assertNotified('Application cache cleared');

        $this->assertSame(0, DB::table('cache')->count());
        $this->assertSame(1, DB::table('sessions')->count());
        $this->assertSame(1, DB::table('jobs')->count());
        $this->assertSame(1, DB::table('cache_locks')->count());
        $this->assertSame(1, WebsiteSetting::query()->count());
        $this->assertSame(1, Page::query()->count());
        $this->assertSame('About us', Page::query()->value('title'));
    }

    public function test_application_cache_failure_is_logged_and_not_exposed(): void
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

        $this->mountMaintenanceAction('clearCache')
            ->call('callMountedAction')
            ->assertNotified('Failed to clear cache')
            ->assertDontSee('Connection refused: mysql secret-host')
            ->assertDontSee('secret-host');
    }

    public function test_clear_compiled_views_requires_confirmation_before_deleting_files(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $compiledView = $this->compiledView('pending.php');

        $this->actingAs($admin);

        $component = $this->mountMaintenanceAction('clearCompiledViews');
        $action = $component->instance()->getMountedAction();

        $this->assertInstanceOf(Action::class, $action);
        $this->assertTrue($action->isConfirmationRequired());
        $this->assertSame('Clear compiled views?', (string) $action->getModalHeading());
        $this->assertFileExists($compiledView);
    }

    public function test_administrator_can_clear_compiled_views_with_view_clear(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $compiledView = $this->compiledView('home.php');
        $nestedDirectory = $this->compiledViewDirectory.DIRECTORY_SEPARATOR.'nested';
        File::ensureDirectoryExists($nestedDirectory);
        $nestedView = $nestedDirectory.DIRECTORY_SEPARATOR.'partial.php';
        File::put($nestedView, '<?php echo "nested";');

        Cache::put('compiled-view-neighbor', 'keep-me', 3600);

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearCompiledViews')
            ->call('callMountedAction')
            ->assertNotified('Compiled views cleared');

        $this->assertStringContainsString('Compiled views cleared successfully', Artisan::output());
        $this->assertFileDoesNotExist($compiledView);
        $this->assertFileDoesNotExist($nestedView);
        $this->assertDirectoryDoesNotExist($nestedDirectory);
        $this->assertSame('keep-me', Cache::get('compiled-view-neighbor'));
    }

    public function test_compiled_view_failure_is_logged_and_not_exposed(): void
    {
        Log::shouldReceive('error')
            ->once()
            ->withArgs(function (string $message, array $context): bool {
                return $message === 'Failed to clear compiled views.'
                    && isset($context['exception']);
            });

        $this->mock(CompiledViewService::class, function ($mock): void {
            $mock->shouldReceive('clear')
                ->once()
                ->andThrow(new RuntimeException('View path not found: secret-view-path'));
        });

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearCompiledViews')
            ->call('callMountedAction')
            ->assertNotified('Failed to clear compiled views')
            ->assertDontSee('View path not found: secret-view-path')
            ->assertDontSee('secret-view-path');
    }

    private function mountMaintenanceAction(string $name): Testable
    {
        return Livewire::test(SystemMaintenance::class)
            ->call('mountAction', $name, [], ['schemaComponent' => 'content']);
    }

    private function compiledView(string $filename): string
    {
        if ($this->compiledViewDirectory === null) {
            $this->compiledViewDirectory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-compiled-views-'.bin2hex(random_bytes(4));
            File::ensureDirectoryExists($this->compiledViewDirectory);
            config(['view.compiled' => $this->compiledViewDirectory]);
        }

        $path = $this->compiledViewDirectory.DIRECTORY_SEPARATOR.$filename;
        File::put($path, '<?php echo "compiled";');

        return $path;
    }
}
