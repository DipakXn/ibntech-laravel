<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use RuntimeException;

/**
 * Deletes framework cache files. These methods never rebuild configuration,
 * routes, or views.
 */
class FrameworkCacheService
{
    public function clearConfig(): void
    {
        $this->call('config:clear', 'Configuration cache could not be cleared.');
    }

    public function clearRoutes(): void
    {
        $this->call('route:clear', 'Route cache could not be cleared.');
    }

    private function call(string $command, string $message): void
    {
        $exitCode = Artisan::call($command);

        if ($exitCode !== 0) {
            throw new RuntimeException($message);
        }
    }
}
