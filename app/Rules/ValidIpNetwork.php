<?php

namespace App\Rules;

use App\Models\AnalyticsExcludedIp;
use App\Services\Analytics\IpNetwork;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidIpNetwork implements ValidationRule
{
    public function __construct(
        private readonly int|string|null $ignoreId = null,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('Enter a valid IPv4 address, IPv6 address, or CIDR range.');

            return;
        }

        $normalized = IpNetwork::normalize($value);

        if ($normalized === null) {
            $fail('Enter a valid IPv4 address, IPv6 address, or CIDR range.');

            return;
        }

        $exists = AnalyticsExcludedIp::query()
            ->where('ip_address', $normalized)
            ->when($this->ignoreId !== null, fn ($query) => $query->whereKeyNot($this->ignoreId))
            ->exists();

        if ($exists) {
            $fail('This IP address or range is already excluded.');
        }
    }
}
