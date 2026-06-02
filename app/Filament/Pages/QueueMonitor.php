<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QueueMonitor extends Page
{
    protected static ?string $title = 'Queue monitor';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedServerStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Queue monitor';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.queue-monitor';

    protected ?string $subheading = 'Track database queue backlog, failed jobs, and the active monitoring threshold.';

    protected Width|string|null $maxContentWidth = 'full';

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    protected function getViewData(): array
    {
        $jobsTableExists = Schema::hasTable('jobs');
        $failedJobsTableExists = Schema::hasTable('failed_jobs');

        $queues = collect();
        $totalQueuedJobs = 0;
        $totalReservedJobs = 0;
        $totalPendingJobs = 0;

        if ($jobsTableExists) {
            $queues = DB::table('jobs')
                ->selectRaw('queue, COUNT(*) as total_jobs')
                ->selectRaw('SUM(CASE WHEN reserved_at IS NULL THEN 1 ELSE 0 END) as pending_jobs')
                ->selectRaw('SUM(CASE WHEN reserved_at IS NOT NULL THEN 1 ELSE 0 END) as reserved_jobs')
                ->selectRaw('MIN(created_at) as oldest_created_at')
                ->groupBy('queue')
                ->orderBy('queue')
                ->get()
                ->map(function (object $queue): array {
                    $oldestCreatedAt = $queue->oldest_created_at
                        ? Carbon::createFromTimestamp((int) $queue->oldest_created_at)
                        : null;

                    return [
                        'name' => $queue->queue,
                        'total_jobs' => (int) $queue->total_jobs,
                        'pending_jobs' => (int) $queue->pending_jobs,
                        'reserved_jobs' => (int) $queue->reserved_jobs,
                        'oldest_job' => $oldestCreatedAt?->diffForHumans(),
                    ];
                });

            $totalQueuedJobs = (int) $queues->sum('total_jobs');
            $totalReservedJobs = (int) $queues->sum('reserved_jobs');
            $totalPendingJobs = (int) $queues->sum('pending_jobs');
        }

        $failedJobs = collect();
        $failedJobsCount = 0;
        $failedJobsLastDay = 0;

        if ($failedJobsTableExists) {
            $failedJobsCount = DB::table('failed_jobs')->count();
            $failedJobsLastDay = DB::table('failed_jobs')
                ->where('failed_at', '>=', now()->subDay())
                ->count();

            $failedJobs = DB::table('failed_jobs')
                ->select(['uuid', 'connection', 'queue', 'exception', 'failed_at'])
                ->orderByDesc('failed_at')
                ->limit(10)
                ->get()
                ->map(fn (object $job): array => [
                    'uuid' => $job->uuid,
                    'connection' => $job->connection,
                    'queue' => $job->queue,
                    'exception' => $job->exception,
                    'failed_at' => Carbon::parse($job->failed_at)->diffForHumans(),
                ]);
        }

        return [
            'monitorConnection' => env('QUEUE_CONNECTION', config('queue.default', 'database')),
            'monitorQueue' => env('DB_QUEUE', config('queue.connections.database.queue', 'default')),
            'monitorThreshold' => (int) env('QUEUE_MONITOR_MAX', 100),
            'jobsTableExists' => $jobsTableExists,
            'failedJobsTableExists' => $failedJobsTableExists,
            'queues' => $queues,
            'totalQueuedJobs' => $totalQueuedJobs,
            'totalPendingJobs' => $totalPendingJobs,
            'totalReservedJobs' => $totalReservedJobs,
            'failedJobs' => $failedJobs,
            'failedJobsCount' => $failedJobsCount,
            'failedJobsLastDay' => $failedJobsLastDay,
        ];
    }
}
