<?php

namespace App\Http\Controllers;

use App\Services\PressReleaseService;
use App\Services\SeoService;
use Illuminate\Http\Response;

class PressReleaseController extends Controller
{
    public function __construct(
        protected PressReleaseService $pressReleaseService,
        protected SeoService $seoService,
    ) {
    }

    public function index(): Response
    {
        $pressReleases = $this->pressReleaseService->paginatePublished();

        $this->seoService->setCurrent([
            'meta_title' => 'Press Releases | ' . config('app.name'),
            'meta_description' => 'Company news, announcements, launches, and official statements from the team.',
            'og_title' => 'Press Releases',
            'og_description' => 'Company news, announcements, launches, and official statements from the team.',
            'canonical_url' => route('press-releases.index'),
        ]);

        return response()->view('press-releases.index', compact('pressReleases'));
    }

    public function show(string $slug): Response
    {
        $pressRelease = $this->pressReleaseService->getPublishedBySlug($slug);

        abort_unless($pressRelease, 404);

        return response()->view('press-releases.templates.' . $pressRelease->template, compact('pressRelease'));
    }
}
