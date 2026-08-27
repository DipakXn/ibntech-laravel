<?php

namespace App\Services;

use App\Models\PressRelease;
use App\Repositories\PressReleaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PressReleaseService
{
    public function __construct(
        protected PressReleaseRepository $pressReleases,
        protected SeoService $seoService,
    ) {}

    public function paginatePublished(int $page = 1, ?string $path = null, int $perPage = 9): LengthAwarePaginator
    {
        return $this->pressReleases->paginatePublished($perPage, $page, $path);
    }

    public function getPublishedBySlug(string $slug): ?PressRelease
    {
        $pressRelease = $this->pressReleases->findPublishedBySlug($slug);

        if ($pressRelease) {
            $this->seoService->setCurrentForModel($pressRelease);
        }

        return $pressRelease;
    }
}
