<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\SystemMaintenance;
use App\Models\Page;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Services\ApplicationCacheService;
use App\Services\CompiledViewService;
use App\Services\FrameworkCacheService;
use App\Services\Sitemap\SitemapCacheService;
use App\Services\WebsiteSettingService;
use App\Support\Sitemap\SitemapType;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Notifications\NotificationMailbox;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use ReflectionProperty;
use RuntimeException;
use Tests\TestCase;

class SystemMaintenanceTest extends TestCase
{
    use RefreshDatabase;

    private ?string $compiledViewDirectory = null;

    private ?string $storageDirectory = null;

    private ?string $frameworkBootstrapPath = null;

    /**
     * @var array<string, string|false>
     */
    private array $frameworkEnv = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();

        $this->storageDirectory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-maintenance-storage-'.bin2hex(random_bytes(4));
        File::ensureDirectoryExists($this->storageDirectory.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'cache');
        $this->app->useStoragePath($this->storageDirectory);
    }

    protected function tearDown(): void
    {
        if (is_string($this->compiledViewDirectory) && is_dir($this->compiledViewDirectory)) {
            File::deleteDirectory($this->compiledViewDirectory);
        }

        if (is_string($this->storageDirectory) && is_dir($this->storageDirectory)) {
            File::deleteDirectory($this->storageDirectory);
        }

        if (is_string($this->frameworkBootstrapPath) && is_dir($this->frameworkBootstrapPath)) {
            File::deleteDirectory($this->frameworkBootstrapPath);
        }

        $this->restoreFrameworkEnv();

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
            ->assertSee('Cache status')
            ->assertSee('Cache store')
            ->assertSee('Configuration cache')
            ->assertSee('Route cache')
            ->assertSee('Clear Sitemap Cache')
            ->assertSee('Removes cached XML sitemaps so they are regenerated on the next request.')
            ->assertSee('Clear Application Cache')
            ->assertSee('Removes every entry in the configured cache store. Sessions, jobs, and database content stay in place.')
            ->assertSee('Clear View Cache')
            ->assertSee('Deletes compiled Blade templates so Laravel compiles them again on the next request.')
            ->assertSee('Clear Route Cache')
            ->assertSee('Clear Configuration Cache')
            ->assertSee('Clear All Application Cache');

        $page = Livewire::actingAs($admin)->test(SystemMaintenance::class)->instance();

        $this->assertNull($page->clearSitemapCacheAction()->getIcon());
        $this->assertNull($page->clearCacheAction()->getIcon());
        $this->assertNull($page->clearCompiledViewsAction()->getIcon());
        $this->assertNull($page->clearRouteCacheAction()->getIcon());
        $this->assertNull($page->clearConfigurationCacheAction()->getIcon());
        $this->assertNull($page->clearAllApplicationCacheAction()->getIcon());
        $this->assertSame((string) config('cache.default'), $page->cacheStoreName());
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
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Log::shouldReceive('error')
            ->once()
            ->withArgs(function (string $message, array $context) use ($admin): bool {
                return $message === 'Failed to clear sitemap cache.'
                    && isset($context['exception'])
                    && ($context['user_id'] ?? null) === $admin->id;
            });

        $this->mock(SitemapCacheService::class, function ($mock): void {
            $mock->shouldReceive('forgetAll')
                ->once()
                ->andThrow(new RuntimeException('sitemap secret-host'));
        });

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
        $this->assertSame(SystemMaintenance::APPLICATION_CACHE_CONFIRMATION, (string) $action->getModalDescription());
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

        $this->assertStringContainsString('Application cache cleared successfully', Artisan::output());

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
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Log::shouldReceive('error')
            ->once()
            ->withArgs(function (string $message, array $context) use ($admin): bool {
                return $message === 'Failed to clear application cache.'
                    && isset($context['exception'])
                    && ($context['user_id'] ?? null) === $admin->id
                    && ($context['action'] ?? null) === 'clear_application_cache';
            });

        $this->mock(ApplicationCacheService::class, function ($mock): void {
            $mock->shouldReceive('clear')
                ->once()
                ->andThrow(new RuntimeException('Connection refused: mysql secret-host'));
        });

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
        $this->assertSame('Clear view cache?', (string) $action->getModalHeading());
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
            ->assertNotified('View cache cleared');

        $this->assertStringContainsString('Compiled views cleared successfully', Artisan::output());
        $this->assertFileDoesNotExist($compiledView);
        $this->assertFileDoesNotExist($nestedView);
        $this->assertDirectoryDoesNotExist($nestedDirectory);
        $this->assertSame('keep-me', Cache::get('compiled-view-neighbor'));
    }

    public function test_compiled_view_failure_is_logged_and_not_exposed(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Log::shouldReceive('error')
            ->once()
            ->withArgs(function (string $message, array $context) use ($admin): bool {
                return $message === 'Failed to clear view cache.'
                    && isset($context['exception'])
                    && ($context['user_id'] ?? null) === $admin->id
                    && ($context['user_email'] ?? null) === $admin->email;
            });

        $this->mock(CompiledViewService::class, function ($mock): void {
            $mock->shouldReceive('clear')
                ->once()
                ->andThrow(new RuntimeException('View path not found: secret-view-path'));
        });

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearCompiledViews')
            ->call('callMountedAction')
            ->assertNotified('Failed to clear view cache')
            ->assertDontSee('View path not found: secret-view-path')
            ->assertDontSee('secret-view-path');
    }

    public function test_authors_and_inactive_administrators_cannot_mount_cache_actions(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        Livewire::actingAs($author)
            ->test(SystemMaintenance::class)
            ->assertForbidden();

        $inactive = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
            'is_active' => false,
        ]);

        Livewire::actingAs($inactive)
            ->test(SystemMaintenance::class)
            ->assertForbidden();
    }

    public function test_clear_route_cache_requires_confirmation_and_leaves_the_file(): void
    {
        $this->isolateFrameworkCachePaths();
        $routeCache = $this->frameworkCacheFile('routes-v7.php');

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        $component = $this->mountMaintenanceAction('clearRouteCache');
        $action = $component->instance()->getMountedAction();

        $this->assertInstanceOf(Action::class, $action);
        $this->assertTrue($action->isConfirmationRequired());
        $this->assertSame('Clear route cache?', (string) $action->getModalHeading());
        $this->assertFileExists($routeCache);
    }

    public function test_administrator_can_clear_route_cache_without_touching_config_or_application_cache(): void
    {
        $this->isolateFrameworkCachePaths();
        $routeCache = $this->frameworkCacheFile('routes-v7.php');
        $configCache = $this->frameworkCacheFile('config.php');
        Cache::put('route-clear-neighbor', 'keep-me', 3600);

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearRouteCache')
            ->call('callMountedAction')
            ->assertNotified('Route cache cleared');

        $this->assertFileDoesNotExist($routeCache);
        $this->assertFileExists($configCache);
        $this->assertSame('keep-me', Cache::get('route-clear-neighbor'));
        $this->assertStringContainsString('Route cache cleared successfully', Artisan::output());
        $this->assertStringNotContainsString('Configuration cache cleared successfully', Artisan::output());
        $this->assertStringNotContainsString('Application cache cleared successfully', Artisan::output());
    }

    public function test_clear_route_cache_succeeds_when_no_file_exists(): void
    {
        $this->isolateFrameworkCachePaths();

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearRouteCache')
            ->call('callMountedAction')
            ->assertNotified('Route cache cleared');

        $this->assertFileDoesNotExist(app()->getCachedRoutesPath());
    }

    public function test_route_cache_failure_is_logged_and_not_exposed(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Log::shouldReceive('error')
            ->once()
            ->withArgs(function (string $message, array $context) use ($admin): bool {
                return $message === 'Failed to clear route cache.'
                    && ($context['user_id'] ?? null) === $admin->id
                    && isset($context['exception']);
            });

        $this->mock(FrameworkCacheService::class, function ($mock): void {
            $mock->shouldReceive('clearRoutes')
                ->once()
                ->andThrow(new RuntimeException('route secret-path'));
        });

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearRouteCache')
            ->call('callMountedAction')
            ->assertNotified('Failed to clear route cache')
            ->assertDontSee('route secret-path');
    }

    public function test_clear_configuration_cache_requires_confirmation_and_leaves_the_file(): void
    {
        $this->isolateFrameworkCachePaths();
        $configCache = $this->frameworkCacheFile('config.php');

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        $component = $this->mountMaintenanceAction('clearConfigurationCache');
        $action = $component->instance()->getMountedAction();

        $this->assertInstanceOf(Action::class, $action);
        $this->assertTrue($action->isConfirmationRequired());
        $this->assertSame('Clear configuration cache?', (string) $action->getModalHeading());
        $this->assertSame('Cached', $component->instance()->configurationCacheStatus());
        $this->assertFileExists($configCache);
    }

    public function test_administrator_can_clear_configuration_cache_without_touching_routes_or_application_cache(): void
    {
        $this->isolateFrameworkCachePaths();
        $configCache = $this->frameworkCacheFile('config.php');
        $routeCache = $this->frameworkCacheFile('routes-v7.php');
        Cache::put('config-clear-neighbor', 'keep-me', 3600);

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearConfigurationCache')
            ->call('callMountedAction')
            ->assertNotified('Configuration cache cleared');

        $this->assertFileDoesNotExist($configCache);
        $this->assertSame('Not cached', app(SystemMaintenance::class)->configurationCacheStatus());
        $this->assertFileExists($routeCache);
        $this->assertSame('keep-me', Cache::get('config-clear-neighbor'));
        $this->assertStringContainsString('Configuration cache cleared successfully', Artisan::output());
        $this->assertStringNotContainsString('Route cache cleared successfully', Artisan::output());
        $this->assertStringNotContainsString('Application cache cleared successfully', Artisan::output());
    }

    public function test_clear_configuration_cache_succeeds_when_no_file_exists(): void
    {
        $this->isolateFrameworkCachePaths();

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearConfigurationCache')
            ->call('callMountedAction')
            ->assertNotified('Configuration cache cleared');

        $this->assertFileDoesNotExist(app()->getCachedConfigPath());
    }

    public function test_configuration_cache_failure_is_logged_and_not_exposed(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Log::shouldReceive('error')
            ->once()
            ->withArgs(function (string $message, array $context) use ($admin): bool {
                return $message === 'Failed to clear configuration cache.'
                    && ($context['user_id'] ?? null) === $admin->id
                    && isset($context['exception']);
            });

        $this->mock(FrameworkCacheService::class, function ($mock): void {
            $mock->shouldReceive('clearConfig')
                ->once()
                ->andThrow(new RuntimeException('config secret-path'));
        });

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearConfigurationCache')
            ->call('callMountedAction')
            ->assertNotified('Failed to clear configuration cache')
            ->assertDontSee('config secret-path');
    }

    public function test_clear_all_application_cache_clears_each_store_and_does_not_rebuild(): void
    {
        config(['cache.default' => 'database']);
        $this->isolateFrameworkCachePaths();

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $configCache = $this->frameworkCacheFile('config.php');
        $routeCache = $this->frameworkCacheFile('routes-v7.php');
        $compiledView = $this->compiledView('all.php');

        Page::query()->create([
            'title' => 'About us',
            'slug' => 'about-us',
            'template' => 'default',
            'status' => 'published',
        ]);

        DB::table('sessions')->insert([
            'id' => 'clear-all-session',
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
            'key' => 'clear-all-lock',
            'owner' => 'test-owner',
            'expiration' => now()->addHour()->timestamp,
        ]);

        Cache::put('clear-all-key', 'cached-value', 3600);

        $this->actingAs($admin);

        $this->mountMaintenanceAction('clearAllApplicationCache')
            ->call('callMountedAction')
            ->assertNotified('Application, view, route, and configuration caches cleared');

        $this->assertFileDoesNotExist($configCache);
        $this->assertFileDoesNotExist($routeCache);
        $this->assertFileDoesNotExist($compiledView);
        $this->assertSame(0, DB::table('cache')->count());
        $this->assertSame(1, DB::table('sessions')->count());
        $this->assertSame(1, DB::table('jobs')->count());
        $this->assertSame(1, DB::table('cache_locks')->count());
        $this->assertSame(1, Page::query()->count());
        $this->assertStringContainsString('Application cache cleared successfully', Artisan::output());
    }

    public function test_clear_all_application_cache_reports_a_partial_failure(): void
    {
        $this->isolateFrameworkCachePaths();
        $configCache = $this->frameworkCacheFile('config.php');
        $routeCache = $this->frameworkCacheFile('routes-v7.php');
        Cache::put('clear-all-partial', 'keep-me', 3600);

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $framework = \Mockery::mock(FrameworkCacheService::class)->makePartial();
        $framework->shouldReceive('clearRoutes')
            ->once()
            ->andThrow(new RuntimeException('route secret-path'));
        $this->app->instance(FrameworkCacheService::class, $framework);

        Log::shouldReceive('error')
            ->once()
            ->withArgs(function (string $message, array $context) use ($admin): bool {
                return $message === 'Failed to clear all application cache.'
                    && ($context['step'] ?? null) === 'Route cache'
                    && ($context['completed_steps'] ?? null) === ['Configuration cache']
                    && ($context['user_id'] ?? null) === $admin->id
                    && ($context['user_email'] ?? null) === $admin->email
                    && isset($context['exception']);
            });

        $this->actingAs($admin);

        $component = $this->mountMaintenanceAction('clearAllApplicationCache')
            ->call('callMountedAction');

        $this->assertNotificationBody('The route cache could not be cleared. Configuration cache was already cleared.');
        $component->assertDontSee('route secret-path');

        Notification::assertNotified('Failed to clear all application cache');

        $this->assertFileDoesNotExist($configCache);
        $this->assertFileExists($routeCache);
        $this->assertSame('keep-me', Cache::get('clear-all-partial'));
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

    private function isolateFrameworkCachePaths(): void
    {
        $directory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-bootstrap-'.bin2hex(random_bytes(4));
        File::ensureDirectoryExists($directory.DIRECTORY_SEPARATOR.'cache');

        foreach (['APP_CONFIG_CACHE', 'APP_ROUTES_CACHE'] as $key) {
            $value = getenv($key);
            $this->frameworkEnv[$key] = $value === false ? false : (string) $value;
            putenv($key);
            unset($_ENV[$key], $_SERVER[$key]);
        }

        $this->forgetEnvironmentRepository();
        $this->app->useBootstrapPath($directory);
        $this->frameworkBootstrapPath = $directory;
    }

    private function restoreFrameworkEnv(): void
    {
        if ($this->frameworkEnv === []) {
            return;
        }

        foreach ($this->frameworkEnv as $key => $value) {
            if ($value === false) {
                putenv($key);
                unset($_ENV[$key], $_SERVER[$key]);

                continue;
            }

            putenv($key.'='.$value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }

        $this->frameworkEnv = [];
        $this->forgetEnvironmentRepository();
    }

    private function forgetEnvironmentRepository(): void
    {
        $property = new ReflectionProperty(Env::class, 'repository');
        $property->setValue(null, null);
    }

    private function frameworkCacheFile(string $filename): string
    {
        $path = $this->frameworkBootstrapPath.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.$filename;
        File::put($path, '<?php return [];');

        return $path;
    }

    private function assertNotificationBody(string $body): void
    {
        $mailbox = app(NotificationMailbox::class);
        $pending = (new ReflectionProperty($mailbox, 'pendingNotifications'))->getValue($mailbox);
        $bodies = [];

        foreach ($pending as $entry) {
            $notification = unserialize($entry['notification']);

            if (is_array($notification)) {
                $bodies[] = $notification['body'] ?? null;
            }
        }

        $this->assertContains($body, $bodies);
    }
}
