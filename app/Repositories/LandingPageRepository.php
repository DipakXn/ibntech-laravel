<?php

namespace App\Repositories;

use App\Models\LandingPage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class LandingPageRepository
{
    public function paginatePublishedCampaignPages(int $perPage = 9): LengthAwarePaginator
    {
        return LandingPage::query()
            ->published()
            ->excludingThankYouPages()
            ->with('seoMeta')
            ->latest()
            ->paginate($perPage);
    }

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
