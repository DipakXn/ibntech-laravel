<?php

namespace App\Services\Analytics;

use Carbon\CarbonInterface;

final readonly class PendingPageView
{
    /**
     * @param  array<string, int|string>  $routeParameters
     */
    public function __construct(
        public string $visitorId,
        public CarbonInterface $visitedAt,
        public string $path,
        public ?string $routeName,
        public array $routeParameters,
        public ?string $referrerHost,
        public ?string $country,
        public ?string $device,
        public ?string $browser,
        public ?string $operatingSystem,
    ) {}
}
