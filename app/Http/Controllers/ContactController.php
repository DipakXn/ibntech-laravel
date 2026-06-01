<?php

namespace App\Http\Controllers;

use App\Services\SeoService;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function __construct(protected SeoService $seoService)
    {
    }

    public function show(): Response
    {
        $this->seoService->setCurrent([
            'meta_title' => 'Contact | '.config('app.name'),
            'meta_description' => 'Contact our team to discuss your project.',
            'og_title' => 'Contact',
            'og_description' => 'Contact our team to discuss your project.',
            'canonical_url' => route('contact'),
        ]);

        return response()->view('pages.contact');
    }
}

