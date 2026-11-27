<?php

namespace App\Support\Health;

use App\Jobs\RecordQueueWorkerSignal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QueueWorkerSignalDispatcher
{
    public function dispatchIfAbsent(): bool
    {
        if (config('queue.default') !== 'database' || ! Schema::hasTable('jobs')) {
            return false;
        }

        $waiting = DB::table('jobs')
            ->where('payload', 'like', '%RecordQueueWorkerSignal%')
            ->exists();

        if ($waiting) {
            return false;
        }

        RecordQueueWorkerSignal::dispatch();

        return true;
    }
}
