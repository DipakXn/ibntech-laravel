<?php

namespace App\Services;

use App\Models\CaseStudy;
use App\Repositories\CaseStudyRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CaseStudyService
{
    public function __construct(
        protected CaseStudyRepository $caseStudies,
        protected SeoService $seoService,
    ) {}

    public function paginatePublished(int $page = 1, ?string $path = null, int $perPage = 9): LengthAwarePaginator
    {
        return $this->caseStudies->paginatePublished($perPage, $page, $path);
    }

    public function getPublishedBySlug(string $slug): ?CaseStudy
    {
        $caseStudy = $this->caseStudies->findPublishedBySlug($slug);

        if ($caseStudy) {
            $this->seoService->setCurrentForModel($caseStudy);
        }

        return $caseStudy;
    }

    /**
     * @return Collection<int, CaseStudy>
     */
    public function getPublishedByCategorySlug(
        ?string $categorySlug = null,
        ?int $limit = null,
        bool $childOnly = false,
        bool $includeChildren = false
    ): Collection {
        return $this->caseStudies->getPublishedByCategorySlug($categorySlug, $limit, $childOnly, $includeChildren);
    }

    /**
     * @return Collection<int, CaseStudy>
     */
    public function latestPublished(int $limit = 1): Collection
    {
        return $this->caseStudies->latestPublished($limit);
    }
}
