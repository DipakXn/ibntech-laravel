<?php

namespace App\Services\Analytics;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use InvalidArgumentException;

final readonly class VisitorAnalyticsRange
{
    public const LAST_7 = 'last_7';

    public const LAST_30 = 'last_30';

    public const LAST_90 = 'last_90';

    public const CUSTOM = 'custom';

    public function __construct(
        public CarbonImmutable $startsAt,
        public CarbonImmutable $endsAt,
        public string $preset,
    ) {}

    public static function make(string $preset, ?string $from = null, ?string $to = null, ?CarbonInterface $now = null): self
    {
        $now = CarbonImmutable::parse($now ?? now());
        $preset = in_array($preset, [self::LAST_7, self::LAST_30, self::LAST_90, self::CUSTOM], true)
            ? $preset
            : self::LAST_30;

        if ($preset !== self::CUSTOM) {
            $days = match ($preset) {
                self::LAST_7 => 6,
                self::LAST_90 => 89,
                default => 29,
            };

            return new self($now->startOfDay()->subDays($days), $now->endOfDay(), $preset);
        }

        $start = self::date($from)?->startOfDay();
        $end = self::date($to)?->endOfDay();

        if ($start === null || $end === null) {
            return self::make(self::LAST_30, now: $now);
        }

        if ($start->greaterThan($end)) {
            [$start, $end] = [$end->startOfDay(), $start->endOfDay()];
        }

        return new self($start, $end, self::CUSTOM);
    }

    public function label(): string
    {
        return $this->startsAt->toFormattedDateString().' – '.$this->endsAt->toFormattedDateString();
    }

    private static function date(?string $value): ?CarbonImmutable
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        try {
            return CarbonImmutable::parse($value);
        } catch (InvalidArgumentException) {
            return null;
        }
    }
}
