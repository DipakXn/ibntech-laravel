<?php

namespace Tests\Unit;

use App\Services\ApplicationCacheService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

        app(ApplicationCacheService::class)->clear();

        $this->assertSame(0, DB::table('cache')->count());
        $this->assertFalse(Cache::has('application-cache-test'));
        $this->assertFalse(Cache::has('another-cache-test'));
    }
}
