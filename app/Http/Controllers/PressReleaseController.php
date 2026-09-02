<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\PaginatesWithPathPages;
use App\Services\PressReleaseService;
use App\Services\SeoService;
use App\Support\PathPageUrl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PressReleaseController extends Controller
{
    use PaginatesWithPathPages;

    public function __construct(
        protected PressReleaseService $pressReleaseService,
        protected SeoService $seoService,
    ) {}

    public function index(Request $request): Response|RedirectResponse
    {
        return $this->showIndex($request, null);
    }

    public function page(Request $request, int $page): Response|RedirectResponse
    {
        return $this->showIndex($request, $page);
    }

    public function show(string $slug): Response
    {
        $pressRelease = $this->pressReleaseService->getPublishedBySlug($slug);

        abort_unless($pressRelease, 404);

        return response()->view('press-releases.templates.'.$pressRelease->template, compact('pressRelease'));
    }

    protected function showIndex(Request $request, ?int $page): Response|RedirectResponse
    {
        $resolved = $this->listingPageOrRedirect(
            $request,
            $page,
            'pressrelease.index',
            'pressrelease.page'
        );

        if ($resolved instanceof RedirectResponse) {
            return $resolved;
        }

        $pressReleases = $this->pressReleaseService->paginatePublished(
            page: $resolved,
            path: rtrim(PathPageUrl::forRoute('pressrelease.index', 'pressrelease.page'), '/')
        );
        $this->appendListingQuery($pressReleases, $request);
        $this->abortIfListingPageOutOfRange($pressReleases);
        $this->setPathPaginatedSeo(
            $pressReleases,
            $resolved,
            'Press Releases',
            'Company news, announcements, launches, and official statements from the team.'
        );

        return response()->view('press-releases.index', compact('pressReleases'));
    }
}
