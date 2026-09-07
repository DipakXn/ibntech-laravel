<?php

namespace Tests\Unit;

use App\Support\Queue\DatabaseQueueMonitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class DatabaseQueueMonitorTest extends TestCase
{
    use RefreshDatabase;

    public function test_known_lanes_are_present_when_empty(): void
    {
        $snapshot = $this->monitor()->snapshot();

        $this->assertSame(['default', 'media'], $snapshot['queues']->pluck('name')->all());
        $this->assertSame(0, $snapshot['total_queued_jobs']);
        $this->assertSame('healthy', $snapshot['health']);
        $this->assertTrue($snapshot['queues']->firstWhere('name', 'default')['is_monitored']);
        $this->assertTrue($snapshot['queues']->firstWhere('name', 'media')['is_media']);
    }

    public function test_health_uses_monitored_queue_size_against_the_threshold(): void
    {
        $this->insertJob('default');
        $this->insertJob('default');
        $this->insertJob('media');
        $this->insertJob('media');
        $this->insertJob('media');

        $healthy = $this->monitor(threshold: 3)->snapshot();
        $busy = $this->monitor(threshold: 2)->snapshot();

        $this->assertSame('healthy', $healthy['health']);
        $this->assertSame(2, $healthy['monitored_size']);
        $this->assertTrue($healthy['unmonitored_busy']);
        $this->assertSame('busy', $busy['health']);
    }

    public function test_pending_excludes_delayed_and_reserved_jobs(): void
    {
        $now = now()->timestamp;

        $this->insertJob('default', ['available_at' => $now]);
        $this->insertJob('default', ['available_at' => $now + 3600]);
        $this->insertJob('default', ['reserved_at' => $now, 'available_at' => $now]);

        $snapshot = $this->monitor()->snapshot();
        $default = $snapshot['queues']->firstWhere('name', 'default');

        $this->assertSame(3, $default['total_jobs']);
        $this->assertSame(1, $default['pending_jobs']);
        $this->assertSame(1, $default['delayed_jobs']);
        $this->assertSame(1, $default['reserved_jobs']);
        $this->assertSame(1, $snapshot['total_pending_jobs']);
        $this->assertSame(1, $snapshot['total_delayed_jobs']);
        $this->assertSame(1, $snapshot['total_reserved_jobs']);
    }

    public function test_failed_job_list_uses_a_preview_instead_of_the_full_exception(): void
    {
        $uuid = (string) Str::uuid();
        $marker = 'HUGE-TRACE-MARKER-SHOULD-STAY-OUT-OF-THE-LIST';

        $this->insertFailedJob($uuid, exception: "RuntimeException: preview line\n".$marker.str_repeat('x', 5000));

        $snapshot = $this->monitor()->snapshot();
        $failed = $snapshot['failed_jobs']->first();

        $this->assertSame('App\\Jobs\\SendLeadSubmissionNotification', $failed['job_name']);
        $this->assertSame('RuntimeException: preview line', $failed['exception_preview']);
        $this->assertStringNotContainsString($marker, $failed['exception_preview']);
        $this->assertArrayNotHasKey('exception', $failed);
        $this->assertStringContainsString($marker, (string) $this->monitor()->failedJobException($uuid));
    }

    public function test_retry_requeues_a_single_failed_job_by_uuid(): void
    {
        $retryUuid = (string) Str::uuid();
        $keepUuid = (string) Str::uuid();

        $this->insertFailedJob($retryUuid, queue: 'default');
        $this->insertFailedJob($keepUuid, queue: 'media');
        $this->insertJob('media', ['payload' => json_encode(['displayName' => 'KeepMe'])]);

        $this->monitor()->retryFailedJob($retryUuid);

        $this->assertFalse(DB::table('failed_jobs')->where('uuid', $retryUuid)->exists());
        $this->assertTrue(DB::table('failed_jobs')->where('uuid', $keepUuid)->exists());
        $this->assertSame(1, DB::table('jobs')->where('queue', 'default')->count());
        $this->assertSame(1, DB::table('jobs')->where('queue', 'media')->count());
    }

    private function monitor(int $threshold = 100): DatabaseQueueMonitor
    {
        return new DatabaseQueueMonitor(
            threshold: $threshold,
            connection: 'database',
            monitorQueueName: 'default',
            mediaQueueName: 'media',
        );
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
}
