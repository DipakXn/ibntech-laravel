<?php

namespace App\Console\Commands;

use App\Models\HealthSignal;
use App\Support\Health\QueueWorkerSignalDispatcher;
use Illuminate\Console\Command;

class SignalSchedulerHeartbeat extends Command
{
    protected $signature = 'health:signal-scheduler';

    protected $description = 'Record that the scheduler is running and queue one worker signal when needed';

    public function handle(QueueWorkerSignalDispatcher $dispatcher): int
    {
        HealthSignal::query()->updateOrCreate(
            ['key' => HealthSignal::SCHEDULER],
            ['recorded_at' => now()],
        );

        $dispatcher->dispatchIfAbsent();

        return self::SUCCESS;
    }
}
