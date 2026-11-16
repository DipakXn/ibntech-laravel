<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

class MaintenanceActionLogger
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function succeeded(string $action, ?User $actor, array $extra = []): void
    {
        Log::info('System maintenance action succeeded.', $this->context($action, $actor, $extra));
    }

    /**
     * @param  array<string, mixed>  $extra
     */
    public function failed(string $message, string $action, ?User $actor, Throwable $exception, array $extra = []): void
    {
        Log::error($message, [
            ...$this->context($action, $actor, $extra),
            'exception' => $exception,
        ]);
    }

    /**
     * @param  array<string, mixed>  $extra
     * @return array<string, mixed>
     */
    private function context(string $action, ?User $actor, array $extra): array
    {
        return [
            ...array_filter([
                'action' => $action,
                'user_id' => $actor?->id,
                'user_email' => $actor?->email,
                'at' => now()->toIso8601String(),
            ], fn (mixed $value): bool => $value !== null),
            ...$extra,
        ];
    }
}
