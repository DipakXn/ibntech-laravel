<?php

namespace Tests\Unit;

use App\Services\ApplicationCacheService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RuntimeException;
use Tests\TestCase;

class ApplicationCacheServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['cache.default' => 'database']);
    }

    public function test_it_clears_all_entries_in_the_configured_cache_store(): void
    {
        Cache::put('application-cache-test', 'value', 3600);
        Cache::put('another-cache-test', 'value', 3600);

        $this->assertSame(2, DB::table('cache')->count());

        $storage = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-cache-storage-'.bin2hex(random_bytes(4));
        File::ensureDirectoryExists($storage.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'cache');
        File::put($storage.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'facade-demo.php', '<?php');
        $this->app->useStoragePath($storage);

        app(ApplicationCacheService::class)->clear();

        $this->assertSame(0, DB::table('cache')->count());
        $this->assertFalse(Cache::has('application-cache-test'));
        $this->assertFalse(Cache::has('another-cache-test'));
        $this->assertFileDoesNotExist($storage.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'facade-demo.php');
        $this->assertStringContainsString('Application cache cleared successfully', Artisan::output());
        $this->assertStringNotContainsString('Configuration cache cleared successfully', Artisan::output());
        $this->assertStringNotContainsString('Route cache cleared successfully', Artisan::output());
        $this->assertStringNotContainsString('Compiled views cleared successfully', Artisan::output());

        File::deleteDirectory($storage);
    }

    public function test_it_throws_when_cache_clear_fails(): void
    {
        Artisan::shouldReceive('call')
            ->once()
            ->with('cache:clear')
            ->andReturn(1);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Application cache could not be cleared.');

        app(ApplicationCacheService::class)->clear();
    }
}
