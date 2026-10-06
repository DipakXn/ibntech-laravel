<?php

namespace App\Services\Analytics;

use App\Models\AnalyticsExcludedIp;
use Illuminate\Support\Facades\Cache;

final class ExcludedIpMatcher
{
    public const CACHE_KEY = 'analytics.excluded_ip_rules';

    public function excludes(?string $ip): bool
    {
        if ($ip === null || $ip === '') {
            return false;
        }

        foreach ($this->rules() as $rule) {
            if (IpNetwork::contains($rule, $ip)) {
                return true;
            }
        }

        return false;
    }

    public static function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * @return list<string>
     */
    private function rules(): array
    {
        $rules = Cache::remember(self::CACHE_KEY, now()->addMinutes(10), function (): array {
            return AnalyticsExcludedIp::query()
                ->where('is_enabled', true)
                ->orderBy('id')
                ->pluck('ip_address')
                ->all();
        });

        return array_values(array_filter($rules, is_string(...)));
    }
}
