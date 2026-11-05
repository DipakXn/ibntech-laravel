<?php

namespace App\Http\Middleware;

use App\Services\Analytics\PageViewTracker;
use App\Services\CookieConsent\CookieConsentRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPublicPageView
{
    public function __construct(
        private readonly PageViewTracker $tracker,
        private readonly CookieConsentRepository $consent,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $choice = $this->consent->choiceFromRequest($request);

        if (! $choice?->allows('analytics')) {
            $this->forgetVisitor($request, $response);

            return $response;
        }

        $pending = $this->tracker->prepare($request, $response);
        $this->tracker->queue($pending);

        if ($pending !== null) {
            $this->tracker->rememberVisitor($request, $response, $pending);
        }

        return $response;
    }

    private function forgetVisitor(Request $request, Response $response): void
    {
        $name = (string) config('analytics.visitor_cookie');

        if (! $request->cookies->has($name)) {
            return;
        }

        $response->headers->setCookie(cookie(
            $name,
            '',
            -2628000,
            '/',
            null,
            $request->isSecure(),
            true,
            false,
            'lax',
        ));
    }

    public function terminate(Request $request, Response $response): void
    {
        $this->tracker->flush();
    }
}
