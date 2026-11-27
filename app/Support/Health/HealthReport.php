<?php

namespace App\Support\Health;

final class HealthReport
{
    /**
     * @param  list<HealthCheckResult>  $checks
     */
    public function __construct(public array $checks) {}

    public function overall(): string
    {
        $statuses = array_map(
            fn (HealthCheckResult $check): string => $check->status,
            $this->checks,
        );

        if (in_array(HealthCheckResult::CRITICAL, $statuses, true)) {
            return HealthCheckResult::CRITICAL;
        }

        if (in_array(HealthCheckResult::WARNING, $statuses, true)) {
            return HealthCheckResult::WARNING;
        }

        return HealthCheckResult::HEALTHY;
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function toStoredArray(): array
    {
        return array_map(
            fn (HealthCheckResult $check): array => $check->toArray(),
            $this->checks,
        );
    }
}
