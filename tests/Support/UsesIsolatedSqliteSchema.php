<?php

namespace Tests\Support;

trait UsesIsolatedSqliteSchema
{
    protected function setUpUsesIsolatedSqliteSchema(): void
    {
        DatabaseSafetyGuard::abortIfUnsafe($this->app);

        $this->artisan('migrate', ['--force' => true]);
    }
}
