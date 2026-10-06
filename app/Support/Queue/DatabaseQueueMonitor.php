<?php

namespace App\Support\Queue;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use InvalidArgumentException;
use RuntimeException;

class DatabaseQueueMonitor
{
    public const FAILED_JOB_LIMIT = 10;

    public const EXCEPTION_PREVIEW_CHARS = 240;

    public const MAX_EXCEPTION_CHARS = 200_000;

    public function __construct(
        private readonly ?int $threshold = null,
        private readonly ?string $connection = null,
        private readonly ?string $monitorQueueName = null,
        private readonly ?string $mediaQueueName = null,
    ) {}

    /**
     * @return array{
     *     jobs_table_exists: bool,
     *     failed_jobs_table_exists: bool,
     *     connection: string,
     *     monitor_queue: string,
     *     media_queue: string,
     *     threshold: int,
     *     health: 'healthy'|'busy'|'unavailable',
     *     monitored_size: int,
     *     pending_over_threshold: bool,
     *     unmonitored_busy: bool,
     *     queues: Collection<int, array<string, mixed>>,
     *     total_queued_jobs: int,
     *     total_pending_jobs: int,
     *     total_delayed_jobs: int,
     *     total_reserved_jobs: int,
     *     failed_jobs: Collection<int, array<string, mixed>>,
     *     failed_jobs_count: int,
     *     failed_jobs_last_day: int
     * }
     */
    public function snapshot(): array
    {
        $jobsTableExists = Schema::hasTable('jobs');
        $failedJobsTableExists = Schema::hasTable('failed_jobs');
        $monitorQueue = $this->monitorQueue();
        $threshold = $this->threshold();

        $queues = $jobsTableExists
            ? $this->queueBacklog($monitorQueue, $this->mediaQueue(), $threshold)
            : collect();

        $monitoredSize = (int) $queues
            ->firstWhere('name', $monitorQueue)['total_jobs'] ?? 0;

        $health = ! $jobsTableExists
            ? 'unavailable'
            : ($monitoredSize >= $threshold ? 'busy' : 'healthy');

        $failedJobs = collect();
        $failedJobsCount = 0;
        $failedJobsLastDay = 0;

        if ($failedJobsTableExists) {
            $failedJobsCount = (int) DB::table('failed_jobs')->count();
            $failedJobsLastDay = (int) DB::table('failed_jobs')
                ->where('failed_at', '>=', now()->subDay())
                ->count();
            $failedJobs = $this->recentFailedJobs();
        }

        return [
            'jobs_table_exists' => $jobsTableExists,
            'failed_jobs_table_exists' => $failedJobsTableExists,
            'connection' => $this->connection(),
            'monitor_queue' => $monitorQueue,
            'media_queue' => $this->mediaQueue(),
            'threshold' => $threshold,
            'health' => $health,
            'monitored_size' => $monitoredSize,
            'pending_over_threshold' => ((int) $queues->sum('pending_jobs')) >= $threshold,
            'unmonitored_busy' => $queues
                ->contains(fn (array $queue): bool => ! $queue['is_monitored'] && $queue['over_threshold']),
            'queues' => $queues,
            'total_queued_jobs' => (int) $queues->sum('total_jobs'),
            'total_pending_jobs' => (int) $queues->sum('pending_jobs'),
            'total_delayed_jobs' => (int) $queues->sum('delayed_jobs'),
            'total_reserved_jobs' => (int) $queues->sum('reserved_jobs'),
            'failed_jobs' => $failedJobs,
            'failed_jobs_count' => $failedJobsCount,
            'failed_jobs_last_day' => $failedJobsLastDay,
        ];
    }

    public function connection(): string
    {
        return $this->connection ?? (string) config('queue.default', 'database');
    }

    public function monitorQueue(): string
    {
        return $this->monitorQueueName
            ?? (string) config('queue.connections.database.queue', 'default');
    }

    public function mediaQueue(): string
    {
        return $this->mediaQueueName
            ?? (string) config('media-library.queue_name', 'media');
    }

    public function threshold(): int
    {
        return $this->threshold ?? (int) env('QUEUE_MONITOR_MAX', 100);
    }

    public function hasFailedJob(string $uuid): bool
    {
        if (! Schema::hasTable('failed_jobs')) {
            return false;
        }

        return DB::table('failed_jobs')->where('uuid', $uuid)->exists();
    }

    public function failedJobException(string $uuid): ?string
    {
        if (! Schema::hasTable('failed_jobs')) {
            return null;
        }

        $exception = DB::table('failed_jobs')->where('uuid', $uuid)->value('exception');

        if (! is_string($exception)) {
            return null;
        }

        if (strlen($exception) <= self::MAX_EXCEPTION_CHARS) {
            return $exception;
        }

        return substr($exception, 0, self::MAX_EXCEPTION_CHARS)."\n\n[Exception truncated after ".number_format(self::MAX_EXCEPTION_CHARS).' characters.]';
    }

    public function retryFailedJob(string $uuid): void
    {
        $uuid = $this->assertFailedJobUuid($uuid);

        if (! $this->hasFailedJob($uuid)) {
            throw new RuntimeException('The failed job could not be found.');
        }

        Artisan::call('queue:retry', ['id' => [$uuid]]);

        if ($this->hasFailedJob($uuid)) {
            throw new RuntimeException('The failed job could not be retried.');
        }
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    private function queueBacklog(string $monitorQueue, string $mediaQueue, int $threshold): Collection
    {
        $now = now()->timestamp;

        $rows = DB::table('jobs')
            ->selectRaw('queue')
            ->selectRaw('COUNT(*) as total_jobs')
            ->selectRaw("SUM(CASE WHEN reserved_at IS NULL AND available_at <= {$now} THEN 1 ELSE 0 END) as pending_jobs")
            ->selectRaw("SUM(CASE WHEN reserved_at IS NULL AND available_at > {$now} THEN 1 ELSE 0 END) as delayed_jobs")
            ->selectRaw('SUM(CASE WHEN reserved_at IS NOT NULL THEN 1 ELSE 0 END) as reserved_jobs')
            ->selectRaw("MIN(CASE WHEN reserved_at IS NULL AND available_at <= {$now} THEN created_at ELSE NULL END) as oldest_pending_at")
            ->groupBy('queue')
            ->get()
            ->keyBy('queue');

        $names = collect([$monitorQueue, $mediaQueue])
            ->merge($rows->keys())
            ->unique()
            ->filter()
            ->values();

        return $names
            ->map(function (string $name) use ($rows, $monitorQueue, $mediaQueue, $threshold): array {
                $row = $rows->get($name);
                $total = (int) ($row?->total_jobs ?? 0);
                $pending = (int) ($row?->pending_jobs ?? 0);
                $delayed = (int) ($row?->delayed_jobs ?? 0);
                $reserved = (int) ($row?->reserved_jobs ?? 0);
                $oldestPendingAt = $row?->oldest_pending_at ?? null;

                return [
                    'name' => $name,
                    'is_monitored' => $name === $monitorQueue,
                    'is_media' => $name === $mediaQueue,
                    'total_jobs' => $total,
                    'pending_jobs' => $pending,
                    'delayed_jobs' => $delayed,
                    'reserved_jobs' => $reserved,
                    'over_threshold' => $total >= $threshold || $pending >= $threshold,
                    'oldest_job' => $oldestPendingAt
                        ? Carbon::createFromTimestamp((int) $oldestPendingAt)->diffForHumans()
                        : null,
                ];
            })
            ->sortBy(function (array $queue) use ($monitorQueue, $mediaQueue): string {
                if ($queue['name'] === $monitorQueue) {
                    return '0-'.$queue['name'];
                }

                if ($queue['name'] === $mediaQueue) {
                    return '1-'.$queue['name'];
                }

                return '2-'.$queue['name'];
            })
            ->values();
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    private function recentFailedJobs(): Collection
    {
        $driver = DB::connection()->getDriverName();
        $displayNameSql = in_array($driver, ['mysql', 'mariadb'], true)
            ? "JSON_UNQUOTE(JSON_EXTRACT(payload, '$.displayName')) as job_name"
            : "json_extract(payload, '$.displayName') as job_name";
        $previewSql = in_array($driver, ['mysql', 'mariadb'], true)
            ? 'LEFT(exception, 300) as exception_preview'
            : 'substr(exception, 1, 300) as exception_preview';

        return DB::table('failed_jobs')
            ->selectRaw('uuid, connection, queue, failed_at, '.$displayNameSql.', '.$previewSql)
            ->orderByDesc('failed_at')
            ->limit(self::FAILED_JOB_LIMIT)
            ->get()
            ->map(function (object $job): array {
                $jobName = trim((string) $job->job_name, " \t\n\r\0\x0B\"");
                $preview = Str::of((string) $job->exception_preview)->before("\n")->trim();

                return [
                    'uuid' => (string) $job->uuid,
                    'connection' => (string) $job->connection,
                    'queue' => (string) $job->queue,
                    'job_name' => $jobName !== '' ? $jobName : 'Unknown job',
                    'exception_preview' => $preview->limit(self::EXCEPTION_PREVIEW_CHARS)->value(),
                    'failed_at' => Carbon::parse($job->failed_at)->diffForHumans(),
                ];
            });
    }

    private function assertFailedJobUuid(string $uuid): string
    {
        $uuid = trim($uuid);

        if (! preg_match('/^[A-Za-z0-9-]{8,64}$/', $uuid)) {
            throw new InvalidArgumentException('Invalid failed job id.');
        }

        return $uuid;
    }
}
