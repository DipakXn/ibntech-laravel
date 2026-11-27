<?php

namespace App\Support\Health;

final class ApplicationHttpResult
{
    public function __construct(
        public readonly string $state,
        public readonly ?int $httpStatus,
        public readonly ?int $milliseconds,
        public readonly string $summary,
    ) {}
}
