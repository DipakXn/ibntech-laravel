<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageRepository
{
    public function getHomePage(): ?Page
    {
        return Cache::remember('page:home', now()->addMinutes(10), function () {
            return Page::query()
                ->published()
                ->with('seoMeta')
                ->where('slug', 'home')
                ->first();
        });
    }

    public function findPublishedBySlug(string $slug): ?Page
    {
        return Cache::remember("page:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return Page::query()
                ->published()
                ->with('seoMeta')
                ->where('slug', $slug)
                ->first();
        });
    }
}

