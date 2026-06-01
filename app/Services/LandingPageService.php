<?php

namespace App\Services;

use App\Models\LandingPage;
use App\Repositories\LandingPageRepository;

class LandingPageService
{
    public function __construct(
        protected LandingPageRepository $landingPages,
        protected SeoService $seoService
    ) {
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
