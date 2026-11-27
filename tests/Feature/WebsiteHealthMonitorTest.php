<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\WebsiteHealth;
use App\Models\HealthCheckRun;
use App\Models\HealthSignal;
use App\Models\User;
use App\Support\Health\ApplicationHttpProbe;
use App\Support\Health\ApplicationHttpResult;
use App\Support\Logs\LaravelLogReader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Livewire;
use RuntimeException;
use Tests\TestCase;

class WebsiteHealthMonitorTest extends TestCase
{
    use RefreshDatabase;

    private string $logDirectory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        Http::fake(fn () => Http::response('ok', 200));

        $this->logDirectory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-health-feature-'.uniqid('', true);
        mkdir($this->logDirectory);
        $this->app->instance(LaravelLogReader::class, new LaravelLogReader($this->logDirectory));
    }

    protected function tearDown(): void
    {
        if (is_dir($this->logDirectory)) {
            rmdir($this->logDirectory);
        }

        parent::tearDown();
    }

    public function test_guests_cannot_access_website_health(): void
    {
        $this->get('/admin/website-health')
            ->assertRedirect('/'.Login::ROUTE_PATH);
    }

    public function test_authors_cannot_access_website_health(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $this->actingAs($author)
            ->get('/admin/website-health')
            ->assertForbidden();

        Livewire::actingAs($author)
            ->test(WebsiteHealth::class)
            ->assertForbidden();
    }

    public function test_administrators_see_the_empty_state(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Livewire::actingAs($admin)
            ->test(WebsiteHealth::class)
            ->assertOk()
            ->assertSee('Not checked yet')
            ->assertSee('Run check')
            ->assertSee('No health checks have been recorded');
    }

    public function test_a_saved_run_renders_status_and_history(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        HealthCheckRun::query()->create([
            'trigger' => 'manual',
            'overall' => 'warning',
            'checks' => [
                [
                    'name' => 'website',
                    'label' => 'Website',
                    'status' => 'healthy',
                    'summary' => 'The website responded with HTTP 200.',
                    'response_time_ms' => 42,
                    'http_status' => 200,
                ],
                [
                    'name' => 'database',
                    'label' => 'Database',
                    'status' => 'warning',
                    'summary' => 'The database was slow.',
                    'response_time_ms' => 800,
                ],
            ],
            'checked_at' => now()->subMinutes(20),
        ]);

        Livewire::actingAs($admin)
            ->test(WebsiteHealth::class)
            ->assertOk()
            ->assertSee('Warning')
            ->assertSee('The website responded with HTTP 200.')
            ->assertSee('Response time 42 ms')
            ->assertSee('The database was slow.')
            ->assertSee('This result is more than 15 minutes old.')
            ->assertSee('Manual')
            ->assertSee('Database');
    }

    public function test_run_check_persists_one_manual_snapshot_without_changing_other_data(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
        Cache::put('health-sentinel', 'keep');
        $uuid = (string) Str::uuid();
        DB::table('failed_jobs')->insert([
            'uuid' => $uuid,
            'connection' => 'database',
            'queue' => 'default',
            'payload' => json_encode(['displayName' => 'KeepMe']),
            'exception' => 'RuntimeException: keep',
            'failed_at' => now(),
        ]);
        DB::table('jobs')->insert([
            'queue' => 'default',
            'payload' => json_encode(['displayName' => 'KeepQueuedJob']),
            'attempts' => 0,
            'reserved_at' => null,
            'available_at' => now()->timestamp,
            'created_at' => now()->timestamp,
        ]);

        Livewire::actingAs($admin)
            ->test(WebsiteHealth::class)
            ->callAction('runCheck')
            ->assertNotified('Health check completed');

        $this->assertSame(1, HealthCheckRun::query()->count());
        $this->assertSame('manual', HealthCheckRun::query()->value('trigger'));
        $this->assertSame('keep', Cache::get('health-sentinel'));
        $this->assertTrue(DB::table('failed_jobs')->where('uuid', $uuid)->exists());
        $this->assertSame(1, DB::table('jobs')->count());
        $this->assertNull(HealthSignal::query()->find(HealthSignal::SNAPSHOT_LOCK));
    }

    public function test_a_fresh_lock_prevents_a_second_manual_snapshot(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
        HealthSignal::query()->create([
            'key' => HealthSignal::SNAPSHOT_LOCK,
            'recorded_at' => now(),
        ]);

        Livewire::actingAs($admin)
            ->test(WebsiteHealth::class)
            ->callAction('runCheck')
            ->assertNotified('A health check is already running');

        $this->assertSame(0, HealthCheckRun::query()->count());
    }

    public function test_a_thrown_check_still_records_the_other_checks(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
        $this->app->instance(ApplicationHttpProbe::class, new class implements ApplicationHttpProbe
        {
            public function probe(): ApplicationHttpResult
            {
                throw new RuntimeException('marker-secret-value #0 /tmp Stack trace');
            }
        });

        Livewire::actingAs($admin)
            ->test(WebsiteHealth::class)
            ->callAction('runCheck')
            ->assertNotified('Health check completed');

        $run = HealthCheckRun::query()->first();
        $this->assertNotNull($run);
        $encoded = json_encode($run->checks);
        $names = array_column($run->checks, 'name');

        $this->assertContains('website', $names);
        $this->assertContains('database', $names);
        $this->assertContains('storage', $names);
        $website = collect($run->checks)->firstWhere('name', 'website');
        $database = collect($run->checks)->firstWhere('name', 'database');
        $this->assertSame('unknown', $website['status']);
        $this->assertSame('healthy', $database['status']);
        $this->assertStringNotContainsString('marker-secret-value', (string) $encoded);
        $this->assertStringNotContainsString('#0', (string) $encoded);
    }
}
