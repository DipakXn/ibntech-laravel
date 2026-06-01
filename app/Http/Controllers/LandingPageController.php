<?php

namespace App\Http\Controllers;

use App\Services\LandingPageService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class LandingPageController extends Controller
{
    public function __construct(protected LandingPageService $landingPageService)
    {
    }

    public function show(string $slug): Response
    {
        $landingPage = $this->landingPageService->getPublishedLandingPageBySlug($slug);

        abort_unless($landingPage, 404);
        abort_unless(View::exists('landing-pages.'.$landingPage->template), 404);

        return response()->view('landing-pages.'.$landingPage->template, compact('landingPage'));
    }
}
