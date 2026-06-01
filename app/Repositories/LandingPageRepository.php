<?php

namespace App\Repositories;

use App\Models\LandingPage;
use Illuminate\Support\Facades\Cache;

class LandingPageRepository
{
    public function findPublishedBySlug(string $slug): ?LandingPage
    {
        return Cache::remember("landing-page:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return LandingPage::query()
                ->published()
                ->with('seoMeta')
                ->where('slug', $slug)
                ->first();
        });
    }
}
