<?php

namespace App\Services;

use App\Models\Industry;
use App\Repositories\IndustryRepository;

class IndustryService
{
    public function __construct(
        protected IndustryRepository $industries,
        protected SeoService $seoService
    ) {
    }

    public function getPublishedIndustryBySlug(string $slug): ?Industry
    {
        $industry = $this->industries->findPublishedBySlug($slug);

        if ($industry) {
            $this->seoService->setCurrentForModel($industry);
        }

        return $industry;
    }
}
