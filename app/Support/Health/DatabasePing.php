<?php

namespace App\Support\Health;

final class DatabasePing
{
    public function __construct(
        public readonly bool $ok,
        public readonly ?int $milliseconds,
        public readonly ?string $driver,
        public readonly ?string $database,
    ) {}
}
