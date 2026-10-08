<?php

namespace App\Services;

final class CloudflarePurgeResult
{
    public function __construct(
        public bool $successful,
        public string $message,
        public string $action,
        public ?int $httpStatus = null,
        public int $urlCount = 0,
    ) {}

    public static function success(string $message, string $action, ?int $httpStatus = null, int $urlCount = 0): self
    {
        return new self(true, $message, $action, $httpStatus, $urlCount);
    }

    public static function failure(string $message, string $action, ?int $httpStatus = null, int $urlCount = 0): self
    {
        return new self(false, $message, $action, $httpStatus, $urlCount);
    }
}
