<?php

namespace App\Services;

use Throwable;

/**
 * Clears configuration, routes, compiled views, and the application cache
 * store, in that order. Stops at the first failure. Does not rebuild caches
 * and does not call optimize:clear.
 */
class AllApplicationCacheService
{
    public function __construct(
        private readonly FrameworkCacheService $frameworkCache,
        private readonly CompiledViewService $compiledViews,
        private readonly ApplicationCacheService $applicationCache,
    ) {}

    public function clear(): void
    {
        $completed = [];

        $steps = [
            ['Configuration cache', fn () => $this->frameworkCache->clearConfig()],
            ['Route cache', fn () => $this->frameworkCache->clearRoutes()],
            ['View cache', fn () => $this->compiledViews->clear()],
            ['Application cache', fn () => $this->applicationCache->clear()],
        ];

        foreach ($steps as [$label, $operation]) {
            try {
                $operation();
            } catch (Throwable $exception) {
                throw new PartialCacheClearException($label, $completed, $exception);
            }

            $completed[] = $label;
        }
    }
}
