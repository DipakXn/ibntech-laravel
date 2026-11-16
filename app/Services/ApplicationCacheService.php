<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use RuntimeException;

/**
 * Clears application data cached through Laravel's default cache store.
 *
 * Implementation notes:
 * - Calls `cache:clear`, which flushes the default store (`CACHE_STORE`,
 *   `database` in this project) and deletes real-time facade files under
 *   `storage/framework/cache`.
 * - The cache table is dedicated to Laravel's cache store. Sessions use
 *   `sessions`, queue jobs use `jobs`, and CMS rows stay in their own tables.
 * - This service does not clear `cache_locks`, compiled views, route or
 *   configuration cache files, sessions, jobs, or database content.
 * - It does not rebuild any cache.
 */
class ApplicationCacheService
{
    public function clear(): void
    {
        $exitCode = Artisan::call('cache:clear');

        if ($exitCode !== 0) {
            throw new RuntimeException('Application cache could not be cleared.');
        }
    }
}
