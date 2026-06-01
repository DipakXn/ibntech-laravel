<?php

namespace App\Http\Controllers;

use App\Services\PageService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function __construct(protected PageService $pageService)
    {
    }

    public function home(): Response
    {
        $page = $this->pageService->getHomePage();

        abort_unless($page, 404);
        abort_unless(View::exists('pages.'.$page->template), 404);

        return response()->view('pages.'.$page->template, compact('page'));
    }

    public function show(string $slug): Response
    {
        $page = $this->pageService->getPublishedPageBySlug($slug);

        abort_unless($page, 404);
        abort_unless(View::exists('pages.'.$page->template), 404);

        return response()->view('pages.'.$page->template, compact('page'));
    }
}
