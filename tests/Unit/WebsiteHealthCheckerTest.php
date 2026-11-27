<?php

namespace Tests\Unit;

use App\Jobs\RecordQueueWorkerSignal;
use App\Models\HealthSignal;
use App\Models\WebsiteSetting;
use App\Services\MaintenanceMode;
use App\Services\WebsiteSettingService;
use App\Support\Health\ApplicationHttpProbe;
use App\Support\Health\ApplicationHttpResult;
use App\Support\Health\DatabaseConnectivityProbe;
use App\Support\Health\DatabasePing;
use App\Support\Health\HealthCheckResult;
use App\Support\Health\LaravelApplicationHttpProbe;
use App\Support\Health\LaravelDatabaseConnectivityProbe;
use App\Support\Health\OffOriginRedirect;
use App\Support\Health\StreamTlsCertificateProbe;
use App\Support\Health\TlsCertificateProbe;
use App\Support\Health\TlsCertificateResult;
use App\Support\Health\WebsiteHealthChecker;
use App\Support\Health\WebsiteHealthRecorder;
use App\Support\Logs\LaravelLogReader;
use App\Support\Queue\DatabaseQueueMonitor;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Tests\TestCase;

class WebsiteHealthCheckerTest extends TestCase
{
    use RefreshDatabase;

    private string $logDirectory;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'app.url' => 'http://localhost',
            'logging.default' => 'single',
            'database.connections.sqlite.password' => 'db-secret-value',
        ]);

        $this->logDirectory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-health-'.uniqid('', true);
        mkdir($this->logDirectory);
    }

    protected function tearDown(): void
    {
        foreach (glob($this->logDirectory.DIRECTORY_SEPARATOR.'*') ?: [] as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        if (is_dir($this->logDirectory)) {
            rmdir($this->logDirectory);
        }

        parent::tearDown();
    }

    public function test_http_200_is_healthy_and_uses_only_the_application_url(): void
    {
        Http::fake(function ($request) {
            $this->assertSame('http://localhost', $request->url());

            return Http::response('ok', 200);
        });

        $check = $this->check('website', http: new LaravelApplicationHttpProbe);

        $this->assertSame(HealthCheckResult::HEALTHY, $check->status);
        $this->assertSame(200, $check->details['http_status']);
        $this->assertNotNull($check->responseTimeMs);
        Http::assertSentCount(1);
    }

    public function test_http_client_limits_timeouts_redirects_and_keeps_tls_verification(): void
    {
        $options = (new LaravelApplicationHttpProbe)->options();

        $this->assertSame(LaravelApplicationHttpProbe::CONNECT_TIMEOUT_SECONDS, $options['connect_timeout']);
        $this->assertSame(LaravelApplicationHttpProbe::TIMEOUT_SECONDS, $options['timeout']);
        $this->assertSame(2, $options['connect_timeout']);
        $this->assertSame(3, $options['timeout']);
        $this->assertTrue($options['verify']);
        $this->assertFalse($options['http_errors']);
        $this->assertSame(0, LaravelApplicationHttpProbe::RETRIES);
        $this->assertSame(3, $options['allow_redirects']['max']);
        $this->assertSame(['http', 'https'], $options['allow_redirects']['protocols']);
        $this->assertArrayNotHasKey('retries', $options);
    }

    public function test_redirects_to_another_host_are_not_followed(): void
    {
        $probe = new LaravelApplicationHttpProbe;

        $probe->rejectOffOriginRedirect(new Response(302), new Uri('http://localhost/about'));

        $this->expectException(OffOriginRedirect::class);
        $probe->rejectOffOriginRedirect(new Response(302), new Uri('https://evil.example/phish'));
    }

    public function test_an_off_origin_redirect_is_a_warning_without_another_request(): void
    {
        Http::fake(function () {
            throw new OffOriginRedirect(302);
        });

        $result = (new LaravelApplicationHttpProbe)->probe();

        $this->assertSame('off_origin', $result->state);
        $this->assertSame(302, $result->httpStatus);
        $this->assertSame('The website redirected away from the application URL.', $result->summary);
        Http::assertNothingSent();
    }

    public function test_a_url_with_userinfo_is_rejected_without_a_connection(): void
    {
        config(['app.url' => 'http://user:secret-pass@localhost']);
        Http::fake();

        $result = (new LaravelApplicationHttpProbe)->probe();

        $this->assertSame('invalid', $result->state);
        $this->assertStringNotContainsString('secret-pass', $result->summary);
        Http::assertNothingSent();
    }

    public function test_http_503_during_maintenance_is_a_warning(): void
    {
        $settings = WebsiteSetting::query()->create(app(WebsiteSettingService::class)->defaultAttributes());
        $settings->maintenance_enabled = true;
        $settings->save();

        Http::fake(fn () => Http::response('down', 503));

        $check = $this->check('website', http: new LaravelApplicationHttpProbe);

        $this->assertSame(HealthCheckResult::WARNING, $check->status);
        $this->assertSame('Maintenance mode is on.', $check->summary);
    }

    public function test_a_connection_failure_is_critical_and_hides_the_exception(): void
    {
        Http::fake(function () {
            throw new ConnectionException('secret-upstream');
        });

        $check = $this->check('website', http: new LaravelApplicationHttpProbe);

        $this->assertSame(HealthCheckResult::CRITICAL, $check->status);
        $this->assertSame('The website did not respond.', $check->summary);
        $this->assertStringNotContainsString('secret-upstream', $check->summary);
    }

    public function test_database_success_and_failure_use_a_fake_connection(): void
    {
        $success = $this->check('database', database: new LaravelDatabaseConnectivityProbe);
        $this->assertSame(HealthCheckResult::HEALTHY, $success->status);
        $this->assertSame('sqlite', $success->details['driver']);
        $this->assertSame(':memory:', $success->details['database']);
        $this->assertArrayNotHasKey('password', $success->details);

        $failure = $this->check('database', database: new class implements DatabaseConnectivityProbe
        {
            public function ping(): DatabasePing
            {
                return new DatabasePing(false, 15, null, null);
            }
        });

        $this->assertSame(HealthCheckResult::CRITICAL, $failure->status);
        $this->assertSame('The database did not respond.', $failure->summary);
    }

    public function test_sync_queue_is_not_applicable(): void
    {
        config(['queue.default' => 'sync']);

        $queues = $this->createMock(DatabaseQueueMonitor::class);
        $queues->expects($this->never())->method('snapshot');

        $check = $this->check('queue', queues: $queues);

        $this->assertSame(HealthCheckResult::NOT_APPLICABLE, $check->status);
    }

    public function test_database_queue_uses_the_monitor_snapshot(): void
    {
        config(['queue.default' => 'database']);
        HealthSignal::query()->create(['key' => HealthSignal::SCHEDULER, 'recorded_at' => now()]);
        HealthSignal::query()->create(['key' => HealthSignal::QUEUE_WORKER, 'recorded_at' => now()]);

        $queues = $this->createMock(DatabaseQueueMonitor::class);
        $queues->expects($this->once())->method('snapshot')->willReturn([
            'jobs_table_exists' => true,
            'health' => 'busy',
            'failed_jobs_last_day' => 2,
            'total_pending_jobs' => 4,
            'total_reserved_jobs' => 1,
        ]);

        $check = $this->check('queue', queues: $queues);

        $this->assertSame(HealthCheckResult::WARNING, $check->status);
        $this->assertStringContainsString('Pending 4', $check->summary);
        $this->assertStringContainsString('failed in the last 24 hours 2', $check->summary);
    }

    public function test_a_stale_worker_is_a_warning_only_when_the_scheduler_is_current(): void
    {
        config(['queue.default' => 'database']);
        HealthSignal::query()->create(['key' => HealthSignal::SCHEDULER, 'recorded_at' => now()]);
        HealthSignal::query()->create([
            'key' => HealthSignal::QUEUE_WORKER,
            'recorded_at' => now()->subMinutes(4),
        ]);

        $check = $this->check('queue', queues: $this->healthyQueues());

        $this->assertSame(HealthCheckResult::WARNING, $check->status);
        $this->assertStringContainsString('queue worker signal is stale', $check->summary);
    }

    public function test_a_missing_scheduler_does_not_turn_a_healthy_queue_into_a_failure(): void
    {
        config(['queue.default' => 'database']);

        $check = $this->check('queue', queues: $this->healthyQueues());

        $this->assertSame(HealthCheckResult::HEALTHY, $check->status);
        $this->assertStringContainsString('was not judged', $check->summary);
    }

    public function test_scheduler_signal_ages(): void
    {
        $this->assertSame(HealthCheckResult::CRITICAL, $this->check('scheduler')->status);

        HealthSignal::query()->updateOrCreate(
            ['key' => HealthSignal::SCHEDULER],
            ['recorded_at' => now()],
        );
        $this->assertSame(HealthCheckResult::HEALTHY, $this->check('scheduler')->status);

        HealthSignal::query()->updateOrCreate(
            ['key' => HealthSignal::SCHEDULER],
            ['recorded_at' => now()->subSeconds(180)],
        );
        $this->assertSame(HealthCheckResult::WARNING, $this->check('scheduler')->status);

        HealthSignal::query()->updateOrCreate(
            ['key' => HealthSignal::SCHEDULER],
            ['recorded_at' => now()->subMinutes(6)],
        );
        $this->assertSame(HealthCheckResult::CRITICAL, $this->check('scheduler')->status);
    }

    public function test_scheduler_command_does_not_queue_a_second_signal_job(): void
    {
        config(['queue.default' => 'database']);
        DB::table('jobs')->insert([
            'queue' => 'default',
            'payload' => json_encode(['displayName' => RecordQueueWorkerSignal::class]),
            'attempts' => 0,
            'reserved_at' => null,
            'available_at' => now()->timestamp,
            'created_at' => now()->timestamp,
        ]);

        $this->artisan('health:signal-scheduler')->assertSuccessful();

        $this->assertSame(1, DB::table('jobs')->count());
        $this->assertNotNull(HealthSignal::query()->find(HealthSignal::SCHEDULER));
    }

    public function test_signal_job_tries_once_and_does_not_requeue_itself(): void
    {
        config(['queue.default' => 'database']);
        $job = new RecordQueueWorkerSignal;

        $this->assertSame(1, $job->tries);
        $this->assertSame(5, $job->timeout);
        $this->assertTrue($job->failOnTimeout);
        $this->assertFalse(method_exists($job, 'retryUntil'));

        $job->failed(new RuntimeException('nope'));

        $this->assertSame(0, DB::table('jobs')->count());
        $this->assertNull(HealthSignal::query()->find(HealthSignal::QUEUE_WORKER));
    }

    public function test_ssl_is_skipped_for_local_http_and_verifies_a_public_certificate(): void
    {
        $tls = $this->countingTls();
        $check = $this->check('ssl', tls: $tls);

        $this->assertSame(HealthCheckResult::NOT_APPLICABLE, $check->status);
        $this->assertSame(0, $tls->calls);

        config(['app.url' => 'https://www.ibntech.com']);
        $failed = $this->countingTls(new TlsCertificateResult('failed', null, 8));
        $failedCheck = $this->check('ssl', tls: $failed);

        $this->assertSame(1, $failed->calls);
        $this->assertSame(HealthCheckResult::CRITICAL, $failedCheck->status);
        $this->assertSame('Certificate verification failed.', $failedCheck->summary);
    }

    public function test_ssl_context_enables_verification_hostname_and_sni(): void
    {
        $options = (new StreamTlsCertificateProbe)->contextOptions('www.ibntech.com');

        $this->assertTrue($options['ssl']['verify_peer']);
        $this->assertTrue($options['ssl']['verify_peer_name']);
        $this->assertFalse($options['ssl']['allow_self_signed']);
        $this->assertSame('www.ibntech.com', $options['ssl']['peer_name']);
        $this->assertTrue($options['ssl']['SNI_enabled']);
        $this->assertSame('www.ibntech.com', $options['ssl']['SNI_server_name']);
    }

    public function test_ssl_probe_does_not_connect_to_an_ip_address(): void
    {
        $probe = new class extends StreamTlsCertificateProbe
        {
            public int $inspections = 0;

            protected function inspect(string $host, int $port): TlsCertificateResult
            {
                $this->inspections++;

                return new TlsCertificateResult('failed');
            }
        };

        $result = $probe->probe('203.0.113.10', 443);

        $this->assertSame('skipped', $result->outcome);
        $this->assertSame(0, $probe->inspections);
    }

    public function test_debug_in_production_is_a_warning(): void
    {
        $this->app['env'] = 'production';
        config(['app.env' => 'production', 'app.debug' => true]);

        $check = $this->check('environment');

        $this->assertSame(HealthCheckResult::WARNING, $check->status);
        $this->assertStringContainsString('Debug is enabled in production', $check->summary);
        $this->assertStringNotContainsString((string) config('app.key'), (string) json_encode($check->toArray()));
    }

    public function test_one_failed_check_does_not_drop_the_others(): void
    {
        $http = new class implements ApplicationHttpProbe
        {
            public function probe(): ApplicationHttpResult
            {
                throw new RuntimeException('APP_KEY=marker-secret-value #0 /tmp Stack trace');
            }
        };

        $report = $this->checker(http: $http)->run();
        $names = array_map(fn (HealthCheckResult $check): string => $check->name, $report->checks);

        $this->assertEqualsCanonicalizing([
            'website',
            'database',
            'storage',
            'disk',
            'scheduler',
            'queue',
            'ssl',
            'environment',
            'recent_errors',
        ], $names);

        $website = $this->named($report->checks, 'website');
        $this->assertSame(HealthCheckResult::UNKNOWN, $website->status);
        $this->assertSame('This check could not be completed.', $website->summary);
        $this->assertSame(HealthCheckResult::HEALTHY, $this->named($report->checks, 'database')->status);
    }

    public function test_persisted_snapshot_omits_secrets_and_stack_traces(): void
    {
        file_put_contents(
            $this->logDirectory.DIRECTORY_SEPARATOR.'laravel.log',
            '['.now()->format('Y-m-d H:i:s').'] testing.ERROR: APP_KEY=marker-secret-value password=hunter2'."\nStack trace:\n#0 /tmp/app.php(10): fail()\n",
        );

        $run = (new WebsiteHealthRecorder($this->checker()))->record('manual');
        $encoded = json_encode($run?->checks);

        $this->assertIsString($encoded);
        $this->assertStringNotContainsString('marker-secret-value', $encoded);
        $key = (string) config('app.key');
        if ($key !== '') {
            $this->assertStringNotContainsString($key, $encoded);
        }
        $this->assertStringNotContainsString('hunter2', $encoded);
        $this->assertStringNotContainsString('db-secret-value', $encoded);
        $this->assertStringNotContainsString('Stack trace', $encoded);
        $this->assertStringNotContainsString('#0', $encoded);
        $this->assertStringNotContainsString(storage_path(), $encoded);
        $this->assertStringNotContainsString(str_replace('\\', '\\\\', storage_path()), $encoded);
    }

    public function test_disk_thresholds(): void
    {
        $this->assertSame(HealthCheckResult::UNKNOWN, WebsiteHealthChecker::diskStatus(null, 100));
        $this->assertSame(HealthCheckResult::CRITICAL, WebsiteHealthChecker::diskStatus(100, 1000));
        $this->assertSame(
            HealthCheckResult::WARNING,
            WebsiteHealthChecker::diskStatus(1024 * 1024 * 1024, 20 * 1024 * 1024 * 1024),
        );
        $this->assertSame(
            HealthCheckResult::HEALTHY,
            WebsiteHealthChecker::diskStatus(20 * 1024 * 1024 * 1024, 100 * 1024 * 1024 * 1024),
        );
    }

    private function check(string $name, ?ApplicationHttpProbe $http = null, ?TlsCertificateProbe $tls = null, ?DatabaseConnectivityProbe $database = null, ?DatabaseQueueMonitor $queues = null): HealthCheckResult
    {
        return $this->named($this->checker($http, $tls, $database, $queues)->run()->checks, $name);
    }

    /**
     * @param  list<HealthCheckResult>  $checks
     */
    private function named(array $checks, string $name): HealthCheckResult
    {
        foreach ($checks as $check) {
            if ($check->name === $name) {
                return $check;
            }
        }

        $this->fail('Missing '.$name.' check.');
    }

    private function checker(
        ?ApplicationHttpProbe $http = null,
        ?TlsCertificateProbe $tls = null,
        ?DatabaseConnectivityProbe $database = null,
        ?DatabaseQueueMonitor $queues = null,
    ): WebsiteHealthChecker {
        return new WebsiteHealthChecker(
            $http ?? new class implements ApplicationHttpProbe
            {
                public function probe(): ApplicationHttpResult
                {
                    return new ApplicationHttpResult('completed', 200, 5, 'ok');
                }
            },
            $tls ?? $this->countingTls(),
            $database ?? new LaravelDatabaseConnectivityProbe,
            $queues ?? new DatabaseQueueMonitor,
            new LaravelLogReader($this->logDirectory),
            app(MaintenanceMode::class),
        );
    }

    private function countingTls(?TlsCertificateResult $result = null): TlsCertificateProbe
    {
        return new class($result) implements TlsCertificateProbe
        {
            public int $calls = 0;

            public function __construct(private readonly ?TlsCertificateResult $result) {}

            public function probe(string $host, int $port): TlsCertificateResult
            {
                $this->calls++;

                return $this->result ?? new TlsCertificateResult('skipped');
            }
        };
    }

    private function healthyQueues(): DatabaseQueueMonitor
    {
        $queues = $this->createMock(DatabaseQueueMonitor::class);
        $queues->method('snapshot')->willReturn([
            'jobs_table_exists' => true,
            'health' => 'healthy',
            'failed_jobs_last_day' => 0,
            'total_pending_jobs' => 0,
            'total_reserved_jobs' => 0,
        ]);

        return $queues;
    }
}
