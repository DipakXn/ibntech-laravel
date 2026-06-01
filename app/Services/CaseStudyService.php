<?php

namespace App\Services;

use App\Models\CaseStudy;
use App\Repositories\CaseStudyRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CaseStudyService
{
    public function __construct(
        protected CaseStudyRepository $caseStudies,
        protected SeoService $seoService,
    ) {
    }

    public function paginatePublished(): LengthAwarePaginator
    {
        return $this->caseStudies->paginatePublished();
    }

    public function getPublishedBySlug(string $slug): ?CaseStudy
    {
        $caseStudy = $this->caseStudies->findPublishedBySlug($slug);

        if ($caseStudy) {
            $this->seoService->setCurrentForModel($caseStudy);
        }

        return $caseStudy;
    }
}
