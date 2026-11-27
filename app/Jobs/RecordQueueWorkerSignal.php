<?php

namespace App\Jobs;

use App\Models\HealthSignal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

class RecordQueueWorkerSignal implements ShouldQueue
{
    use Queueable;

    public int $tries = 1;

    public int $timeout = 5;

    public bool $failOnTimeout = true;

    public function handle(): void
    {
        HealthSignal::query()->updateOrCreate(
            ['key' => HealthSignal::QUEUE_WORKER],
            ['recorded_at' => now()],
        );
    }

    public function failed(?Throwable $exception): void
    {
        // A failed attempt must not enqueue another monitoring job.
    }
}
