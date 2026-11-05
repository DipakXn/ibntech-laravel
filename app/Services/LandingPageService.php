<?php

namespace App\Services;

use App\Models\LandingPage;
use App\Repositories\LandingPageRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LandingPageService
{
    public function __construct(
        protected LandingPageRepository $landingPages,
        protected SeoService $seoService
    ) {
    }

    public function paginatePublishedCampaignPages(int $perPage = 9): LengthAwarePaginator
    {
        return $this->landingPages->paginatePublishedCampaignPages($perPage);
    }

    public function getPublishedLandingPageBySlug(string $slug): ?LandingPage
    {
        $landingPage = $this->landingPages->findPublishedBySlug($slug);

        if ($landingPage) {
            $this->seoService->setCurrentForModel($landingPage);
        }

        return $landingPage;
    }
}
