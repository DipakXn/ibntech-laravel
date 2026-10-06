<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

/**
 * Clears application data cached through Laravel's default cache store.
 *
 * Implementation notes:
 * - The default store is `database`, using the `cache` table on the application's
 *   default database connection (`DB_CACHE_CONNECTION` is unset in this project).
 * - That table is dedicated to Laravel's cache store for this application. Sessions
 *   use the separate `sessions` table, queue jobs use `jobs`, and CMS or settings
 *   data live in their own tables (`pages`, `website_settings`, and so on).
 * - `Cache::flush()` clears all entries in the configured cache store/table. It does
 *   not scope deletion by key prefix; the entire store is emptied.
 * - This service does not clear `cache_locks`, compiled config/routes/views, events,
 *   Filament caches, sessions, jobs, or any other application data.
 */
class ApplicationCacheService
{
    public function clear(): void
    {
        Cache::flush();
    }
}
