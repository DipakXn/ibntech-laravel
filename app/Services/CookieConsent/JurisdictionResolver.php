<?php

namespace App\Services\CookieConsent;

/**
 * Resolves a future jurisdiction rule. The public pages always use opt-in so
 * a shared HTML cache cannot grant a looser mode to the wrong country.
 * Unknown and untrusted countries stay on opt-in.
 */
final class JurisdictionResolver
{
    public const OPT_IN = 'opt_in';

    public const NOTICE = 'notice';

    /**
     * @param  list<array{countries?: list<string>, mode?: string}>  $rules
     */
    public function resolve(?string $country, array $rules): string
    {
        $country = strtoupper(trim((string) $country));

        if ($country === '' || preg_match('/^[A-Z]{2}$/', $country) !== 1) {
            return self::OPT_IN;
        }

        foreach ($rules as $rule) {
            if (! is_array($rule)) {
                continue;
            }

            $mode = $rule['mode'] ?? null;
            $countries = array_map(
                fn (mixed $value): string => strtoupper(trim((string) $value)),
                is_array($rule['countries'] ?? null) ? $rule['countries'] : [],
            );

            if (! in_array($mode, [self::OPT_IN, self::NOTICE], true)) {
                continue;
            }

            if (in_array($country, $countries, true)) {
                return $mode;
            }
        }

        return self::OPT_IN;
    }

    /**
     * Mode written into cached public HTML. This stays opt-in until a trusted,
     * non-cached country signal exists.
     */
    public function publicMode(): string
    {
        return self::OPT_IN;
    }
}
