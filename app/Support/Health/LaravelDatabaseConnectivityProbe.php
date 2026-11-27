<?php

namespace App\Support\Health;

use Illuminate\Support\Facades\DB;
use Throwable;

class LaravelDatabaseConnectivityProbe implements DatabaseConnectivityProbe
{
    public function ping(): DatabasePing
    {
        $started = hrtime(true);

        try {
            $connection = DB::connection();
            $connection->select('select 1 as ok');

            return new DatabasePing(
                true,
                (int) ((hrtime(true) - $started) / 1_000_000),
                $connection->getDriverName(),
                $this->databaseLabel($connection->getDatabaseName()),
            );
        } catch (Throwable) {
            return new DatabasePing(false, (int) ((hrtime(true) - $started) / 1_000_000), null, null);
        }
    }

    private function databaseLabel(?string $database): string
    {
        $database = trim((string) $database);

        if ($database === '' || $database === ':memory:') {
            return $database === '' ? 'configured' : ':memory:';
        }

        if (str_contains($database, '/') || str_contains($database, '\\') || preg_match('/^[A-Za-z]:/', $database) === 1) {
            return basename(str_replace('\\', '/', $database));
        }

        return $database;
    }
}
