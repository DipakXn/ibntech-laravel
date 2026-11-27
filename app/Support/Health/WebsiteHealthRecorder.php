<?php

namespace App\Support\Health;

use App\Models\HealthCheckRun;
use App\Models\HealthSignal;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class WebsiteHealthRecorder
{
    public const LOCK_SECONDS = 20;

    public const RETENTION_DAYS = 30;

    public function __construct(private readonly WebsiteHealthChecker $checker) {}

    public function record(string $trigger): ?HealthCheckRun
    {
        if (! in_array($trigger, ['scheduled', 'manual'], true)) {
            throw new InvalidArgumentException('Unknown health check trigger.');
        }

        if (! $this->acquireLock()) {
            return null;
        }

        try {
            $report = $this->checker->run();

            return HealthCheckRun::query()->create([
                'trigger' => $trigger,
                'overall' => $report->overall(),
                'checks' => $report->toStoredArray(),
                'checked_at' => now(),
            ]);
        } finally {
            $this->releaseLock();
        }
    }

    public function prune(): void
    {
        HealthCheckRun::query()
            ->where('checked_at', '<', now()->subDays(self::RETENTION_DAYS))
            ->delete();
    }

    private function acquireLock(): bool
    {
        return DB::transaction(function (): bool {
            $existing = HealthSignal::query()
                ->where('key', HealthSignal::SNAPSHOT_LOCK)
                ->lockForUpdate()
                ->first();

            if ($existing?->recorded_at !== null && $existing->recorded_at->gte(now()->subSeconds(self::LOCK_SECONDS))) {
                return false;
            }

            HealthSignal::query()->updateOrCreate(
                ['key' => HealthSignal::SNAPSHOT_LOCK],
                ['recorded_at' => now()],
            );

            return true;
        });
    }

    private function releaseLock(): void
    {
        HealthSignal::query()->where('key', HealthSignal::SNAPSHOT_LOCK)->delete();
    }
}
