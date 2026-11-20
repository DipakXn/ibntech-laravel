<?php

namespace App\Support\Testimonials;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ImportedTestimonials
{
    /**
     * @var list<array<string, mixed>>|null
     */
    private static ?array $definitions = null;

    /**
     * @return list<array{
     *     customer_name: string,
     *     designation: string|null,
     *     company_name: string|null,
     *     quote: string,
     *     rating: int|null,
     *     service_slug: string|null,
     *     placements: list<array{placement: string, sort_order: int}>
     * }>
     */
    public static function definitions(): array
    {
        if (self::$definitions !== null) {
            return self::$definitions;
        }

        /** @var list<array<string, mixed>> $definitions */
        $definitions = require database_path('data/testimonials.php');

        return self::$definitions = $definitions;
    }

    /**
     * @return list<string>
     */
    public static function placementKeys(): array
    {
        $keys = [TestimonialPlacements::HOME];

        foreach (self::definitions() as $definition) {
            foreach ($definition['placements'] as $placement) {
                $keys[] = $placement['placement'];
            }
        }

        $keys = array_values(array_unique($keys));
        sort($keys);

        return $keys;
    }

    public static function import(): void
    {
        $now = now();
        $pageIds = DB::table('pages')->pluck('id', 'slug');

        foreach (self::definitions() as $definition) {
            $pending = [];

            foreach ($definition['placements'] as $placement) {
                $alreadyPlaced = self::matchingTestimonials($definition)
                    ->where('testimonial_placements.placement', $placement['placement'])
                    ->where('testimonial_placements.sort_order', $placement['sort_order'])
                    ->exists();

                if (! $alreadyPlaced) {
                    $pending[] = $placement;
                }
            }

            if ($pending === []) {
                continue;
            }

            $candidate = self::matchingTestimonials($definition)
                ->whereNotExists(function ($query) use ($pending): void {
                    $query->selectRaw('1')
                        ->from('testimonial_placements as taken')
                        ->whereColumn('taken.testimonial_id', 'testimonials.id')
                        ->whereIn('taken.placement', array_column($pending, 'placement'));
                })
                ->value('testimonials.id');

            if ($candidate) {
                $id = (int) $candidate;
            } else {
                $serviceSlug = $definition['service_slug'];

                $id = DB::table('testimonials')->insertGetId([
                    'customer_name' => $definition['customer_name'],
                    'designation' => $definition['designation'],
                    'company_name' => $definition['company_name'],
                    'quote' => $definition['quote'],
                    'rating' => $definition['rating'],
                    'page_id' => is_string($serviceSlug) ? ($pageIds[$serviceSlug] ?? null) : null,
                    'status' => 'published',
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            foreach ($pending as $placement) {
                DB::table('testimonial_placements')->insert([
                    'testimonial_id' => $id,
                    'placement' => $placement['placement'],
                    'sort_order' => $placement['sort_order'],
                ]);
            }
        }
    }

    /**
     * @param  array{customer_name: string, designation: string|null, company_name: string|null, quote: string}  $definition
     */
    private static function matchingTestimonials(array $definition): Builder
    {
        return DB::table('testimonials')
            ->leftJoin('testimonial_placements', 'testimonial_placements.testimonial_id', '=', 'testimonials.id')
            ->tap(fn (Builder $query) => self::whereExact($query, 'testimonials.customer_name', $definition['customer_name']))
            ->tap(fn (Builder $query) => self::whereExact($query, 'testimonials.designation', $definition['designation']))
            ->tap(fn (Builder $query) => self::whereExact($query, 'testimonials.company_name', $definition['company_name']))
            ->tap(fn (Builder $query) => self::whereExact($query, 'testimonials.quote', $definition['quote']));
    }

    private static function whereExact(Builder $query, string $column, ?string $value): Builder
    {
        if ($value === null) {
            return $query->whereNull($column);
        }

        if (DB::getDriverName() === 'mysql') {
            return $query->whereRaw($column.' COLLATE utf8mb4_bin = ?', [$value]);
        }

        return $query->where($column, $value);
    }
}
