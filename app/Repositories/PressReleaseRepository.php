<?php

namespace App\Repositories;

use App\Models\PressRelease;
use App\Pagination\PathPagePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class PressReleaseRepository
{
    public function paginatePublished(int $perPage = 9, int $page = 1, ?string $path = null): LengthAwarePaginator
    {
        $results = PressRelease::query()
            ->published()
            ->with('seoMeta')
            ->latest()
            ->paginate($perPage, ['*'], 'page', $page);

        if ($path === null) {
            return $results;
        }

        return PathPagePaginator::wrap($results, $path);
    }

    public function findPublishedBySlug(string $slug): ?PressRelease
    {
        return Cache::remember("press-release:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return PressRelease::query()
                ->published()
                ->with('seoMeta')
                ->where('slug', $slug)
                ->first();
        });
    }
}
