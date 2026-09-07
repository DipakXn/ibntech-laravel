<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\QueueMonitor;
use App\Models\Page;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Services\WebsiteSettingService;
use App\Support\Queue\DatabaseQueueMonitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Livewire;
use RuntimeException;
use Tests\TestCase;

class QueueMonitorTest extends TestCase
{
    use RefreshDatabase;

    private string $viewSentinel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();

        $this->app->instance(DatabaseQueueMonitor::class, new DatabaseQueueMonitor(
            threshold: 2,
            connection: 'database',
            monitorQueueName: 'default',
            mediaQueueName: 'media',
        ));

        $this->viewSentinel = storage_path('framework/views/queue-monitor-test-sentinel.php');
        file_put_contents($this->viewSentinel, '<?php // queue-monitor-sentinel');
    }

    protected function tearDown(): void
    {
        if (is_file($this->viewSentinel)) {
            unlink($this->viewSentinel);
        }

        parent::tearDown();
    }

    public function test_guests_cannot_access_the_queue_monitor(): void
    {
        $this->get('/admin/queue-monitor')
            ->assertRedirect('/'.Login::ROUTE_PATH);
    }

    public function test_authors_cannot_access_the_queue_monitor(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $this->actingAs($author)
            ->get('/admin/queue-monitor')
            ->assertForbidden();
    }

    public function test_authors_cannot_execute_queue_monitor_actions(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $uuid = (string) Str::uuid();
        $this->insertFailedJob($uuid);

        Livewire::actingAs($author)
            ->test(QueueMonitor::class)
            ->assertForbidden();

        $this->assertTrue(DB::table('failed_jobs')->where('uuid', $uuid)->exists());
    }

    public function test_administrators_see_backlog_health_and_failed_jobs(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->insertJob('default');
        $this->insertJob('media');
        $this->insertJob('media');
        $this->insertJob('media');

        $uuid = (string) Str::uuid();
        $this->insertFailedJob($uuid, exception: "RuntimeException: preview line\nSTACK-TRACE-SECRET");

        $this->actingAs($admin);

        Livewire::test(QueueMonitor::class)
            ->assertOk()
            ->assertSee('Healthy')
            ->assertSee('Last updated')
            ->assertSee('Refresh')
            ->assertSee('default')
            ->assertSee('media')
            ->assertSee('Monitored')
            ->assertSee('Media conversions')
            ->assertSee('The scheduler only watches')
            ->assertSee('App\\Jobs\\SendLeadSubmissionNotification')
            ->assertSee('RuntimeException: preview line')
            ->assertDontSee('STACK-TRACE-SECRET')
            ->assertDontSee('Retry all')
            ->assertDontSee('Flush')
            ->assertDontSee('Purge');
    }

    public function test_health_is_busy_when_the_monitored_queue_reaches_the_threshold(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->insertJob('default');
        $this->insertJob('default');

        $this->actingAs($admin);

        Livewire::test(QueueMonitor::class)
            ->assertOk()
            ->assertSee('Busy')
            ->assertSee('has reached or exceeded the busy threshold');
    }

    public function test_refresh_updates_the_last_updated_timestamp(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Carbon::setTestNow('2026-09-07 10:00:00');

        $this->actingAs($admin);

        $component = Livewire::test(QueueMonitor::class);
        $first = $component->get('lastUpdatedAt');

        Carbon::setTestNow('2026-09-07 10:00:15');

        $component->callAction('refresh');

        $this->assertNotSame($first, $component->get('lastUpdatedAt'));
        $component->assertSee(
            Carbon::parse($component->get('lastUpdatedAt'))
                ->timezone((string) config('app.timezone'))
                ->format('M j, Y g:i:s A')
        );
    }

    public function test_failed_job_exception_can_be_expanded(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $uuid = (string) Str::uuid();
        $this->insertFailedJob($uuid, exception: "RuntimeException: preview line\nSTACK-TRACE-SECRET");

        $this->actingAs($admin);

        Livewire::test(QueueMonitor::class)
            ->assertDontSee('STACK-TRACE-SECRET')
            ->call('toggleFailedJobException', $uuid)
            ->assertSet('expandedFailedJobUuid', $uuid)
            ->assertSee('STACK-TRACE-SECRET')
            ->call('toggleFailedJobException', $uuid)
            ->assertSet('expandedFailedJobUuid', null)
            ->assertDontSee('STACK-TRACE-SECRET');
    }

    public function test_retry_requires_confirmation_and_does_not_affect_other_data(): void
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
            'queue' => 'media',
            'payload' => json_encode(['displayName' => 'KeepQueuedJob']),
            'attempts' => 0,
            'available_at' => now()->timestamp,
            'created_at' => now()->timestamp,
        ]);

        DB::table('cache')->insert([
            'key' => 'queue-monitor-cache-key',
            'value' => 'cached-value',
            'expiration' => now()->addHour()->timestamp,
        ]);

        DB::table('cache_locks')->insert([
            'key' => 'test-cache-lock',
            'owner' => 'test-owner',
            'expiration' => now()->addHour()->timestamp,
        ]);

        Cache::put('queue-monitor-should-remain', 'yes', 3600);

        $retryUuid = (string) Str::uuid();
        $keepUuid = (string) Str::uuid();
        $this->insertFailedJob($retryUuid, queue: 'default');
        $this->insertFailedJob($keepUuid, queue: 'media');

        $sentinelContents = file_get_contents($this->viewSentinel);
        $sentinelMtime = filemtime($this->viewSentinel);

        $this->actingAs($admin);

        Livewire::test(QueueMonitor::class)
            ->call('mountAction', 'retryFailedJob', ['uuid' => $retryUuid])
            ->assertSet('mountedActions', fn (array $mountedActions): bool => $mountedActions !== []);

        $this->assertTrue(DB::table('failed_jobs')->where('uuid', $retryUuid)->exists());

        Livewire::test(QueueMonitor::class)
            ->call('mountAction', 'retryFailedJob', ['uuid' => $retryUuid])
            ->call('callMountedAction')
            ->assertDontSee('Retry all');

        $this->assertFalse(DB::table('failed_jobs')->where('uuid', $retryUuid)->exists());
        $this->assertTrue(DB::table('failed_jobs')->where('uuid', $keepUuid)->exists());
        $this->assertSame(1, DB::table('jobs')->where('queue', 'default')->count());
        $this->assertSame(1, DB::table('jobs')->where('queue', 'media')->count());
        $this->assertSame('KeepQueuedJob', json_decode((string) DB::table('jobs')->where('queue', 'media')->value('payload'), true)['displayName']);
        $this->assertSame(1, DB::table('cache')->count());
        $this->assertSame('cached-value', DB::table('cache')->where('key', 'queue-monitor-cache-key')->value('value'));
        $this->assertTrue(Cache::has('queue-monitor-should-remain'));
        $this->assertSame(1, DB::table('sessions')->count());
        $this->assertSame('session-payload', base64_decode((string) DB::table('sessions')->value('payload')));
        $this->assertSame(1, DB::table('cache_locks')->count());
        $this->assertSame($settings->id, WebsiteSetting::query()->value('id'));
        $this->assertSame(1, Page::query()->count());
        $this->assertSame('About us', $page->fresh()->title);
        $this->assertSame($sentinelContents, file_get_contents($this->viewSentinel));
        $this->assertSame($sentinelMtime, filemtime($this->viewSentinel));
    }

    public function test_retry_failure_is_logged_and_not_exposed_to_the_user(): void
    {
        Log::shouldReceive('error')
            ->once()
            ->withArgs(function (string $message, array $context): bool {
                return $message === 'Failed to retry a queue job from the Queue Monitor.'
                    && isset($context['exception']);
            });

        $this->mock(DatabaseQueueMonitor::class, function ($mock): void {
            $mock->shouldReceive('snapshot')->andReturn($this->emptySnapshot());
            $mock->shouldReceive('failedJobException')->andReturn(null);
            $mock->shouldReceive('retryFailedJob')
                ->once()
                ->andThrow(new RuntimeException('Connection refused: mysql secret-host'));
        });

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        Livewire::test(QueueMonitor::class)
            ->call('mountAction', 'retryFailedJob', ['uuid' => (string) Str::uuid()])
            ->call('callMountedAction')
            ->assertDontSee('Connection refused: mysql secret-host')
            ->assertDontSee('secret-host');
    }

    /**
     * @param  array<string, mixed>  $overrides
     */
    private function insertJob(string $queue, array $overrides = []): void
    {
        DB::table('jobs')->insert(array_merge([
            'queue' => $queue,
            'payload' => json_encode(['displayName' => 'App\\Jobs\\SendLeadSubmissionNotification']),
            'attempts' => 0,
            'reserved_at' => null,
            'available_at' => now()->timestamp,
            'created_at' => now()->timestamp,
        ], $overrides));
    }

    private function insertFailedJob(string $uuid, string $queue = 'default', ?string $exception = null): void
    {
        DB::table('failed_jobs')->insert([
            'uuid' => $uuid,
            'connection' => 'database',
            'queue' => $queue,
            'payload' => json_encode([
                'uuid' => $uuid,
                'displayName' => 'App\\Jobs\\SendLeadSubmissionNotification',
                'job' => 'Illuminate\\Queue\\CallQueuedHandler@call',
                'data' => [
                    'commandName' => 'App\\Jobs\\SendLeadSubmissionNotification',
                ],
            ]),
            'exception' => $exception ?? "RuntimeException: failed\n#0 /app/Jobs/SendLeadSubmissionNotification.php",
            'failed_at' => now(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function emptySnapshot(): array
    {
        return [
            'jobs_table_exists' => true,
            'failed_jobs_table_exists' => true,
            'connection' => 'database',
            'monitor_queue' => 'default',
            'media_queue' => 'media',
            'threshold' => 2,
            'health' => 'healthy',
            'monitored_size' => 0,
            'pending_over_threshold' => false,
            'unmonitored_busy' => false,
            'queues' => collect(),
            'total_queued_jobs' => 0,
            'total_pending_jobs' => 0,
            'total_delayed_jobs' => 0,
            'total_reserved_jobs' => 0,
            'failed_jobs' => collect(),
            'failed_jobs_count' => 0,
            'failed_jobs_last_day' => 0,
        ];
    }
}
