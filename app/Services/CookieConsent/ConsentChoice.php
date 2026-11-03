<?php

namespace App\Services\CookieConsent;

final readonly class ConsentChoice
{
    public function __construct(
        public string $policyVersion,
        public int $configVersion,
        public int $timestamp,
        public bool $necessary,
        public bool $analytics,
        public bool $marketing,
        public bool $functional,
        public string $action,
    ) {}

    public function allows(string $category): bool
    {
        return match ($category) {
            'necessary' => true,
            'analytics' => $this->analytics,
            'marketing' => $this->marketing,
            'functional' => $this->functional,
            default => false,
        };
    }
}
