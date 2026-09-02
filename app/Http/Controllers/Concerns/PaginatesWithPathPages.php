<?php

namespace App\Http\Controllers\Concerns;

use App\Services\SeoService;
use App\Support\PathPageUrl;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * @property SeoService $seoService
 */
trait PaginatesWithPathPages
{
    protected function listingPageOrRedirect(
        Request $request,
        ?int $page,
        string $indexRoute,
        string $pageRoute
    ): int|RedirectResponse {
        if ($request->query->has('page')) {
            return $this->redirectLegacyListingPage($request, $indexRoute, $pageRoute);
        }

        if ($page === 1) {
            return redirect()->to(PathPageUrl::forRoute($indexRoute, $pageRoute), 301);
        }

        return $page ?? 1;
    }

    protected function redirectLegacyListingPage(
        Request $request,
        string $indexRoute,
        string $pageRoute
    ): RedirectResponse {
        $legacyPage = (int) $request->query('page');
        $url = PathPageUrl::forRoute($indexRoute, $pageRoute, $legacyPage > 1 ? $legacyPage : 1);
        $extraQuery = collect($request->query())->except('page')->all();

        if ($extraQuery !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?').http_build_query($extraQuery);
        }

        return redirect()->to($url, 301);
    }

    protected function appendListingQuery(LengthAwarePaginator $paginator, Request $request): void
    {
        $extraQuery = collect($request->query())->except('page')->all();

        if ($extraQuery !== []) {
            $paginator->appends($extraQuery);
        }
    }

    protected function abortIfListingPageOutOfRange(LengthAwarePaginator $paginator): void
    {
        if ($paginator->currentPage() > max($paginator->lastPage(), 1)) {
            abort(404);
        }
    }

    protected function setPathPaginatedSeo(
        LengthAwarePaginator $paginator,
        int $currentPage,
        string $title,
        string $description
    ): void {
        $isPaginated = $currentPage > 1;
        $metaDescription = $isPaginated
            ? 'Page '.$currentPage.' of '.lcfirst($description)
            : $description;

        $this->seoService->setCurrent([
            'meta_title' => $isPaginated
                ? $title.' - Page '.$currentPage.' | '.config('app.name')
                : $title.' | '.config('app.name'),
            'meta_description' => $metaDescription,
            'og_title' => $isPaginated ? $title.' - Page '.$currentPage : $title,
            'og_description' => $metaDescription,
            'canonical_url' => $paginator->url($currentPage),
            'link_prev' => $paginator->previousPageUrl(),
            'link_next' => $paginator->nextPageUrl(),
        ]);
    }
}
