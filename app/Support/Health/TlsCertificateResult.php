<?php

namespace App\Support\Health;

final class TlsCertificateResult
{
    public function __construct(
        public readonly string $outcome,
        public readonly ?int $validTo = null,
        public readonly ?int $milliseconds = null,
    ) {}
}
