<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use RuntimeException;

/**
 * Clears compiled Blade templates through Laravel's view:clear command.
 *
 * The command deletes files in the configured compiled-view directory
 * (`storage/framework/views` by default). It does not flush the application
 * cache store, sessions, queue jobs, or database content.
 */
class CompiledViewService
{
    public function clear(): void
    {
        $exitCode = Artisan::call('view:clear');

        if ($exitCode !== 0) {
            throw new RuntimeException('Compiled views could not be cleared.');
        }
    }
}
