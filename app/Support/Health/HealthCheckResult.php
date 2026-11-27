<?php

namespace App\Support\Health;

final class HealthCheckResult
{
    public const HEALTHY = 'healthy';

    public const WARNING = 'warning';

    public const CRITICAL = 'critical';

    public const UNKNOWN = 'unknown';

    public const NOT_APPLICABLE = 'not_applicable';

    /**
     * @var list<string>
     */
    private const DETAIL_KEYS = [
        'http_status',
        'driver',
        'database',
        'free_bytes',
        'total_bytes',
        'percent_free',
        'volumes',
        'error_count_24h',
        'recent',
        'laravel',
        'php',
        'environment',
        'timezone',
        'cache_store',
        'queue_driver',
        'maintenance',
        'days_remaining',
    ];

    /**
     * @param  array<string, mixed>  $details
     */
    public function __construct(
        public string $name,
        public string $label,
        public string $status,
        public string $summary,
        public ?int $responseTimeMs = null,
        public array $details = [],
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $payload = [
            'name' => $this->name,
            'label' => $this->label,
            'status' => $this->status,
            'summary' => $this->summary,
        ];

        if ($this->responseTimeMs !== null) {
            $payload['response_time_ms'] = $this->responseTimeMs;
        }

        foreach (self::DETAIL_KEYS as $key) {
            if (array_key_exists($key, $this->details)) {
                $payload[$key] = $this->details[$key];
            }
        }

        return $payload;
    }
}
