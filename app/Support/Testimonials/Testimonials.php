<?php

namespace App\Support\Testimonials;

use App\Models\Testimonial;
use App\Models\TestimonialPlacement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Testimonials
{
    /**
     * Cards for the shared homepage carousel: name, role, quote, rating, and image.
     *
     * @return list<array{name: string, role: string, quote: string, rating: int|null, image: string|null}>
     */
    public static function cards(string $placement): array
    {
        return self::records($placement)
            ->map(fn (Testimonial $testimonial): array => [
                'name' => $testimonial->customer_name,
                'role' => $testimonial->roleLine(),
                'quote' => $testimonial->quote,
                'rating' => $testimonial->rating,
                'image' => $testimonial->clientImageUrl(),
            ])
            ->values()
            ->all();
    }

    /**
     * Quote and citation pairs for page carousels that print a single cite line.
     *
     * @return list<array{quote: string, cite: string}>
     */
    public static function cites(string $placement): array
    {
        return self::records($placement)
            ->map(fn (Testimonial $testimonial): array => [
                'quote' => $testimonial->quote,
                'cite' => $testimonial->citeLine(),
            ])
            ->values()
            ->all();
    }

    /**
     * @return Collection<int, Testimonial>
     */
    private static function records(string $placement): Collection
    {
        if (! TestimonialPlacements::allows($placement)) {
            return collect();
        }

        return TestimonialPlacement::query()
            ->where('placement', $placement)
            ->whereHas('testimonial', fn (Builder $query): Builder => $query->visible())
            ->with(['testimonial.media'])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(fn (TestimonialPlacement $link): ?Testimonial => $link->testimonial)
            ->filter(fn (?Testimonial $testimonial): bool => $testimonial instanceof Testimonial)
            ->values();
    }
}
