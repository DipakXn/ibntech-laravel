<?php

namespace App\Repositories;

use App\Models\PressRelease;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class PressReleaseRepository
{
    public function paginatePublished(int $perPage = 9): LengthAwarePaginator
    {
        return PressRelease::query()
            ->published()
            ->with('seoMeta')
            ->latest()
            ->paginate($perPage);
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
