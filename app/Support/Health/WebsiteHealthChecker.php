<?php

namespace App\Support\Health;

use App\Models\HealthSignal;
use App\Services\MaintenanceMode as MaintenanceModeService;
use App\Support\Logs\LaravelLogEntry;
use App\Support\Logs\LaravelLogReader;
use App\Support\Queue\DatabaseQueueMonitor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Throwable;

class WebsiteHealthChecker
{
    private const SCHEDULER_HEALTHY_SECONDS = 120;

    private const SCHEDULER_WARNING_SECONDS = 300;

    private const WORKER_STALE_SECONDS = 180;

    public function __construct(
        private readonly ApplicationHttpProbe $http,
        private readonly TlsCertificateProbe $tls,
        private readonly DatabaseConnectivityProbe $database,
        private readonly DatabaseQueueMonitor $queues,
        private readonly LaravelLogReader $logs,
        private readonly MaintenanceModeService $maintenance,
    ) {}

    public function run(): HealthReport
    {
        $checks = [];

        foreach ($this->checks() as $name => $callback) {
            try {
                $checks[] = $callback();
            } catch (Throwable) {
                $checks[] = new HealthCheckResult(
                    $name,
                    $this->label($name),
                    HealthCheckResult::UNKNOWN,
                    'This check could not be completed.',
                );
            }
        }

        return new HealthReport($checks);
    }

    public static function diskStatus(int|float|null $free, int|float|null $total): string
    {
        if ($free === null || $total === null || $total <= 0 || $free < 0) {
            return HealthCheckResult::UNKNOWN;
        }

        $freeBytes = (int) $free;
        $percentFree = ($freeBytes / $total) * 100;

        if ($percentFree < 5 || $freeBytes < 512 * 1024 * 1024) {
            return HealthCheckResult::CRITICAL;
        }

        if ($percentFree < 15 || $freeBytes < 2 * 1024 * 1024 * 1024) {
            return HealthCheckResult::WARNING;
        }

        return HealthCheckResult::HEALTHY;
    }

    /**
     * @return array<string, callable(): HealthCheckResult>
     */
    private function checks(): array
    {
        return [
            'website' => fn (): HealthCheckResult => $this->website(),
            'database' => fn (): HealthCheckResult => $this->databaseCheck(),
            'storage' => fn (): HealthCheckResult => $this->storage(),
            'disk' => fn (): HealthCheckResult => $this->disk(),
            'scheduler' => fn (): HealthCheckResult => $this->scheduler(),
            'queue' => fn (): HealthCheckResult => $this->queue(),
            'ssl' => fn (): HealthCheckResult => $this->ssl(),
            'environment' => fn (): HealthCheckResult => $this->environment(),
            'recent_errors' => fn (): HealthCheckResult => $this->recentErrors(),
        ];
    }

    private function website(): HealthCheckResult
    {
        $result = $this->http->probe();

        if ($result->state === 'invalid') {
            return $this->result('website', HealthCheckResult::CRITICAL, $result->summary);
        }

        if ($result->state === 'failed') {
            return $this->result(
                'website',
                HealthCheckResult::CRITICAL,
                'The website did not respond.',
                $result->milliseconds,
            );
        }

        if ($result->state === 'off_origin') {
            return $this->result(
                'website',
                HealthCheckResult::WARNING,
                'The website redirected away from the application URL.',
                $result->milliseconds,
                ['http_status' => $result->httpStatus],
            );
        }

        $status = $result->httpStatus ?? 0;

        if ($status === 503 && $this->maintenance->enabled()) {
            return $this->result(
                'website',
                HealthCheckResult::WARNING,
                'Maintenance mode is on.',
                $result->milliseconds,
                ['http_status' => 503],
            );
        }

        $checkStatus = match (true) {
            $status >= 200 && $status < 300 => HealthCheckResult::HEALTHY,
            $status >= 300 && $status < 400 => HealthCheckResult::WARNING,
            default => HealthCheckResult::CRITICAL,
        };

        return $this->result(
            'website',
            $checkStatus,
            'The website responded with HTTP '.$status.'.',
            $result->milliseconds,
            ['http_status' => $status],
        );
    }

    private function databaseCheck(): HealthCheckResult
    {
        $ping = $this->database->ping();

        if (! $ping->ok) {
            return $this->result(
                'database',
                HealthCheckResult::CRITICAL,
                'The database did not respond.',
                $ping->milliseconds,
            );
        }

        return $this->result(
            'database',
            HealthCheckResult::HEALTHY,
            'The '.$ping->driver.' database '.$ping->database.' responded.',
            $ping->milliseconds,
            [
                'driver' => $ping->driver,
                'database' => $ping->database,
            ],
        );
    }

    private function storage(): HealthCheckResult
    {
        $locations = [
            'Application storage' => storage_path('framework'),
            'Logs' => storage_path('logs'),
            'Media uploads' => (string) config('filesystems.disks.media.root'),
        ];
        $blocked = [];

        foreach ($locations as $label => $path) {
            if ($path === '' || ! is_dir($path) || ! is_writable($path)) {
                $blocked[] = $label;
            }
        }

        if ($blocked === []) {
            return $this->result(
                'storage',
                HealthCheckResult::HEALTHY,
                'Application storage, logs, and media uploads are writable.',
            );
        }

        $verb = count($blocked) === 1 && $blocked[0] !== 'Logs' ? 'is' : 'are';

        return $this->result(
            'storage',
            HealthCheckResult::CRITICAL,
            implode(', ', $blocked).' '.$verb.' not writable.',
        );
    }

    private function disk(): HealthCheckResult
    {
        $storagePath = storage_path();
        $mediaPath = (string) config('filesystems.disks.media.root');
        $storage = $this->volumeReading('Application storage', $storagePath);
        $readings = [$storage];

        if ($mediaPath !== '' && $this->volumeId($mediaPath) !== null && $this->volumeId($mediaPath) !== $this->volumeId($storagePath)) {
            $readings[] = $this->volumeReading('Media uploads', $mediaPath);
        }

        $statuses = array_map(fn (array $reading): string => $reading['status'], $readings);
        $status = $this->combine($statuses);
        $summary = collect($readings)
            ->map(function (array $reading): string {
                if ($reading['status'] === HealthCheckResult::UNKNOWN) {
                    return $reading['label'].' could not be measured.';
                }

                return $reading['label'].' has '.$this->formatBytes((int) $reading['free_bytes'])
                    .' free of '.$this->formatBytes((int) $reading['total_bytes'])
                    .' ('.$reading['percent_free'].'% free).';
            })
            ->implode(' ');

        if (count($readings) === 1) {
            $summary .= ' Media uploads are on the same volume.';
        }

        return $this->result('disk', $status, $summary, null, [
            'volumes' => array_map(fn (array $reading): array => [
                'label' => $reading['label'],
                'status' => $reading['status'],
                'free_bytes' => $reading['free_bytes'],
                'total_bytes' => $reading['total_bytes'],
                'percent_free' => $reading['percent_free'],
            ], $readings),
        ]);
    }

    private function scheduler(): HealthCheckResult
    {
        $age = $this->signalAge(HealthSignal::SCHEDULER);

        if ($age === null) {
            return $this->result('scheduler', HealthCheckResult::CRITICAL, 'No scheduler signal has been recorded.');
        }

        if ($age <= self::SCHEDULER_HEALTHY_SECONDS) {
            return $this->result('scheduler', HealthCheckResult::HEALTHY, 'The scheduler signal is current.');
        }

        if ($age <= self::SCHEDULER_WARNING_SECONDS) {
            return $this->result('scheduler', HealthCheckResult::WARNING, 'The scheduler signal is older than 2 minutes.');
        }

        return $this->result('scheduler', HealthCheckResult::CRITICAL, 'The scheduler signal is older than 5 minutes.');
    }

    private function queue(): HealthCheckResult
    {
        $driver = (string) config('queue.default');

        if ($driver === 'sync') {
            return $this->result(
                'queue',
                HealthCheckResult::NOT_APPLICABLE,
                'Queue driver is sync. Jobs run inline and no worker is expected.',
                null,
                ['queue_driver' => 'sync'],
            );
        }

        if ($driver !== 'database') {
            return $this->result(
                'queue',
                HealthCheckResult::UNKNOWN,
                'Queue health is available for the database and sync drivers.',
                null,
                ['queue_driver' => $driver],
            );
        }

        try {
            $snapshot = $this->queues->snapshot();
        } catch (Throwable) {
            return $this->result('queue', HealthCheckResult::CRITICAL, 'Queue status could not be read.');
        }

        if (! ($snapshot['jobs_table_exists'] ?? false)) {
            return $this->result('queue', HealthCheckResult::CRITICAL, 'The jobs table is not available.');
        }

        $backlog = HealthCheckResult::HEALTHY;

        if (($snapshot['health'] ?? '') === 'busy' || ($snapshot['failed_jobs_last_day'] ?? 0) > 0) {
            $backlog = HealthCheckResult::WARNING;
        }

        $worker = $this->workerStatus();
        $summary = 'Pending '.number_format((int) ($snapshot['total_pending_jobs'] ?? 0))
            .', reserved '.number_format((int) ($snapshot['total_reserved_jobs'] ?? 0))
            .', failed in the last 24 hours '.number_format((int) ($snapshot['failed_jobs_last_day'] ?? 0)).'. '
            .$this->workerSummary($worker);

        return $this->result('queue', $this->combine([$backlog, $worker]), $summary, null, [
            'queue_driver' => 'database',
        ]);
    }

    private function ssl(): HealthCheckResult
    {
        $origin = ApplicationOrigin::fromConfig();

        if (! $origin->valid || $origin->scheme !== 'https' || $origin->isLocalHost()) {
            return $this->result('ssl', HealthCheckResult::NOT_APPLICABLE, 'SSL is not checked for this application URL.');
        }

        if (! extension_loaded('openssl')) {
            return $this->result('ssl', HealthCheckResult::UNKNOWN, 'The OpenSSL extension is not available.');
        }

        if ($origin->isIpAddress() || $origin->host === null || $origin->port === null) {
            return $this->result('ssl', HealthCheckResult::UNKNOWN, 'A hostname is required for certificate verification.');
        }

        $certificate = $this->tls->probe($origin->host, $origin->port);

        if ($certificate->outcome === 'skipped') {
            return $this->result('ssl', HealthCheckResult::UNKNOWN, 'A hostname is required for certificate verification.');
        }

        if ($certificate->outcome !== 'verified' || $certificate->validTo === null) {
            return $this->result(
                'ssl',
                HealthCheckResult::CRITICAL,
                'Certificate verification failed.',
                $certificate->milliseconds,
            );
        }

        $remaining = $certificate->validTo - time();

        if ($remaining <= 0) {
            return $this->result('ssl', HealthCheckResult::CRITICAL, 'The certificate has expired.', $certificate->milliseconds, [
                'days_remaining' => 0,
            ]);
        }

        $days = $remaining / 86400;
        $daysLabel = (string) max(1, (int) ceil($days));
        $cloudflareNote = ' This is the certificate presented for the application hostname. When the site is behind Cloudflare, it is usually the edge certificate.';

        if ($days <= 3) {
            return $this->result(
                'ssl',
                HealthCheckResult::CRITICAL,
                'The certificate expires in less than 3 days.'.$cloudflareNote,
                $certificate->milliseconds,
                ['days_remaining' => (int) floor($days)],
            );
        }

        if ($days <= 14) {
            return $this->result(
                'ssl',
                HealthCheckResult::WARNING,
                'The certificate expires in '.$daysLabel.' days.'.$cloudflareNote,
                $certificate->milliseconds,
                ['days_remaining' => (int) floor($days)],
            );
        }

        return $this->result(
            'ssl',
            HealthCheckResult::HEALTHY,
            'The certificate is valid for '.$daysLabel.' more days.'.$cloudflareNote,
            $certificate->milliseconds,
            ['days_remaining' => (int) floor($days)],
        );
    }

    private function environment(): HealthCheckResult
    {
        $maintenance = $this->maintenance->enabled() ? 'on' : 'off';
        $details = [
            'laravel' => app()->version(),
            'php' => PHP_VERSION,
            'environment' => app()->environment(),
            'timezone' => (string) config('app.timezone'),
            'cache_store' => (string) config('cache.default'),
            'queue_driver' => (string) config('queue.default'),
            'maintenance' => $maintenance,
        ];
        $summary = 'Laravel '.$details['laravel'].', PHP '.$details['php'].', '.$details['environment'].' environment.';

        if ($maintenance === 'on') {
            $summary .= ' Maintenance mode is on.';
        }

        if (app()->environment('production') && config('app.debug')) {
            return $this->result(
                'environment',
                HealthCheckResult::WARNING,
                'Debug is enabled in production. '.$summary,
                null,
                $details,
            );
        }

        return $this->result('environment', HealthCheckResult::HEALTHY, $summary, null, $details);
    }

    private function recentErrors(): HealthCheckResult
    {
        if (! $this->fileLoggingEnabled()) {
            return $this->result('recent_errors', HealthCheckResult::UNKNOWN, 'File logs are not the active channel.');
        }

        $cutoff = now()->subDay();
        $files = $this->logs->listFiles()
            ->filter(fn (array $file): bool => ($file['date'] ?? '') >= $cutoff->toDateString())
            ->take(2);
        $entries = [];

        foreach ($files as $file) {
            $inspection = $this->logs->inspect(
                fileName: (string) $file['name'],
                levels: ['EMERGENCY', 'ALERT', 'CRITICAL', 'ERROR'],
                perPage: LaravelLogReader::MAX_KEPT_ENTRIES,
            );

            foreach ($inspection['entries'] as $entry) {
                if ($entry instanceof LaravelLogEntry) {
                    $entries[] = $entry;
                }
            }
        }

        $recent = [];
        $lastHour = 0;
        $severeLastHour = false;

        foreach ($entries as $entry) {
            try {
                $recordedAt = Carbon::parse($entry->timestamp);
            } catch (Throwable) {
                continue;
            }

            if ($recordedAt->lt($cutoff)) {
                continue;
            }

            $inLastHour = $recordedAt->greaterThanOrEqualTo(now()->subHour());

            if ($inLastHour) {
                $lastHour++;

                if (in_array($entry->level, ['EMERGENCY', 'ALERT', 'CRITICAL'], true)) {
                    $severeLastHour = true;
                }
            }

            $recent[] = [
                'time' => $recordedAt->timezone((string) config('app.timezone'))->format('M j, Y g:i A'),
                'level' => $entry->level,
                'message' => $this->publicLogMessage($entry->message),
                'sort' => $recordedAt->getTimestamp(),
            ];
        }

        usort($recent, fn (array $left, array $right): int => $right['sort'] <=> $left['sort']);
        $recent = array_map(
            fn (array $entry): array => [
                'time' => $entry['time'],
                'level' => $entry['level'],
                'message' => $entry['message'],
            ],
            array_slice($recent, 0, 5),
        );
        $count = count(array_filter(
            $entries,
            function (LaravelLogEntry $entry) use ($cutoff): bool {
                try {
                    return Carbon::parse($entry->timestamp)->greaterThanOrEqualTo($cutoff);
                } catch (Throwable) {
                    return false;
                }
            },
        ));

        $status = HealthCheckResult::HEALTHY;
        $summary = 'No application errors in the last hour.';

        if ($severeLastHour) {
            $status = HealthCheckResult::CRITICAL;
            $summary = 'A critical application error was recorded in the last hour.';
        } elseif ($lastHour > 0) {
            $status = HealthCheckResult::WARNING;
            $summary = $lastHour.' application '.($lastHour === 1 ? 'error' : 'errors').' in the last hour.';
        }

        if ($count > 0) {
            $summary .= ' '.$count.' in the last 24 hours.';
        }

        return $this->result('recent_errors', $status, $summary, null, [
            'error_count_24h' => $count,
            'recent' => $recent,
        ]);
    }

    private function workerStatus(): string
    {
        $schedulerAge = $this->signalAge(HealthSignal::SCHEDULER);

        if ($schedulerAge === null || $schedulerAge > self::SCHEDULER_WARNING_SECONDS) {
            return HealthCheckResult::UNKNOWN;
        }

        $workerAge = $this->signalAge(HealthSignal::QUEUE_WORKER);

        if ($workerAge === null || $workerAge > self::WORKER_STALE_SECONDS) {
            return HealthCheckResult::WARNING;
        }

        return HealthCheckResult::HEALTHY;
    }

    private function workerSummary(string $status): string
    {
        return match ($status) {
            HealthCheckResult::HEALTHY => 'The queue worker signal is current.',
            HealthCheckResult::WARNING => 'The queue worker signal is stale.',
            default => 'The queue worker was not judged because the scheduler signal is not current.',
        };
    }

    private function signalAge(string $key): ?int
    {
        $signal = HealthSignal::query()->find($key);

        if ($signal === null || $signal->recorded_at === null) {
            return null;
        }

        return max(0, now()->getTimestamp() - $signal->recorded_at->getTimestamp());
    }

    /**
     * @param  list<string>  $statuses
     */
    private function combine(array $statuses): string
    {
        $meaningful = array_values(array_filter(
            $statuses,
            fn (string $status): bool => ! in_array($status, [HealthCheckResult::UNKNOWN, HealthCheckResult::NOT_APPLICABLE], true),
        ));

        if ($meaningful === []) {
            return in_array(HealthCheckResult::UNKNOWN, $statuses, true)
                ? HealthCheckResult::UNKNOWN
                : HealthCheckResult::NOT_APPLICABLE;
        }

        if (in_array(HealthCheckResult::CRITICAL, $meaningful, true)) {
            return HealthCheckResult::CRITICAL;
        }

        if (in_array(HealthCheckResult::WARNING, $meaningful, true)) {
            return HealthCheckResult::WARNING;
        }

        return HealthCheckResult::HEALTHY;
    }

    private function fileLoggingEnabled(): bool
    {
        return $this->channelUsesFiles((string) config('logging.default'), 0);
    }

    private function channelUsesFiles(string $name, int $depth): bool
    {
        if ($name === '' || $depth > 3) {
            return false;
        }

        $driver = (string) config('logging.channels.'.$name.'.driver');

        if (in_array($driver, ['single', 'daily'], true)) {
            return true;
        }

        if ($driver !== 'stack') {
            return false;
        }

        $channels = config('logging.channels.'.$name.'.channels', []);

        if (is_string($channels)) {
            $channels = array_map(trim(...), explode(',', $channels));
        }

        if (! is_array($channels)) {
            return false;
        }

        foreach ($channels as $channel) {
            if ($this->channelUsesFiles((string) $channel, $depth + 1)) {
                return true;
            }
        }

        return false;
    }

    private function publicLogMessage(string $message): string
    {
        $line = preg_split("/\R/", $message)[0] ?? '';
        $line = trim((string) preg_replace('/\s+/', ' ', (string) $line));
        $key = (string) config('app.key');
        $password = (string) config('database.connections.'.config('database.default').'.password');
        $sensitive = $line === ''
            || preg_match('/stack trace|#\d+\s|APP_KEY|DB_PASSWORD/i', $line) === 1
            || ($key !== '' && str_contains($line, $key))
            || (strlen($password) >= 4 && str_contains($line, $password));

        if ($sensitive) {
            return 'An application error was recorded.';
        }

        return Str::limit($line, 160, '…');
    }

    /**
     * @return array{label: string, status: string, free_bytes: int|null, total_bytes: int|null, percent_free: float|null}
     */
    private function volumeReading(string $label, string $path): array
    {
        $free = is_dir($path) ? @disk_free_space($path) : false;
        $total = is_dir($path) ? @disk_total_space($path) : false;
        $status = self::diskStatus(
            $free === false ? null : $free,
            $total === false ? null : $total,
        );

        if ($status === HealthCheckResult::UNKNOWN || $free === false || $total === false) {
            return [
                'label' => $label,
                'status' => HealthCheckResult::UNKNOWN,
                'free_bytes' => null,
                'total_bytes' => null,
                'percent_free' => null,
            ];
        }

        return [
            'label' => $label,
            'status' => $status,
            'free_bytes' => (int) $free,
            'total_bytes' => (int) $total,
            'percent_free' => round(((int) $free / (int) $total) * 100, 1),
        ];
    }

    private function volumeId(string $path): ?string
    {
        if (! is_dir($path)) {
            return null;
        }

        $stat = @stat($path);

        if (! is_array($stat) || ! isset($stat['dev'])) {
            return $path;
        }

        return (string) $stat['dev'];
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 1).' GB';
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1).' MB';
        }

        return number_format($bytes / 1024, 1).' KB';
    }

    /**
     * @param  array<string, mixed>  $details
     */
    private function result(
        string $name,
        string $status,
        string $summary,
        ?int $responseTimeMs = null,
        array $details = [],
    ): HealthCheckResult {
        return new HealthCheckResult($name, $this->label($name), $status, $summary, $responseTimeMs, $details);
    }

    private function label(string $name): string
    {
        return match ($name) {
            'website' => 'Website',
            'database' => 'Database',
            'storage' => 'Storage',
            'disk' => 'Disk space',
            'scheduler' => 'Scheduler',
            'queue' => 'Queue',
            'ssl' => 'SSL certificate',
            'environment' => 'Environment',
            'recent_errors' => 'Recent errors',
            default => 'Check',
        };
    }
}
