<?php

namespace App\Support\Testimonials;

use Illuminate\Support\Str;

class TestimonialPlacements
{
    public const HOME = 'home';

    /**
     * Section keys for Blade templates that are not already in the imported catalog.
     * Add a key here, then read it from the template with Testimonials::cards() or cites().
     *
     * @var list<string>
     */
    public const EXTRA = [];

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $keys = array_values(array_unique([
            ...ImportedTestimonials::placementKeys(),
            ...self::EXTRA,
        ]));

        $options = [];

        foreach ($keys as $key) {
            $options[$key] = self::label($key);
        }

        natcasesort($options);

        $home = [self::HOME => $options[self::HOME] ?? self::label(self::HOME)];
        unset($options[self::HOME]);

        return $home + $options;
    }

    public static function label(string $placement): string
    {
        if ($placement === self::HOME) {
            return 'Homepage and shared carousel';
        }

        return Str::of($placement)->replace('-', ' ')->title()->toString();
    }

    public static function allows(string $placement): bool
    {
        return array_key_exists($placement, self::options());
    }
}
