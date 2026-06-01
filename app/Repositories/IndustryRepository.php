<?php

namespace App\Repositories;

use App\Models\Industry;
use Illuminate\Support\Facades\Cache;

class IndustryRepository
{
    public function findPublishedBySlug(string $slug): ?Industry
    {
        return Cache::remember("industry:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return Industry::query()
                ->published()
                ->with('seoMeta')
                ->where('slug', $slug)
                ->first();
        });
    }
}
