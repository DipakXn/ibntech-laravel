<?php

namespace App\Http\Middleware;

use App\Services\Analytics\PageViewTracker;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPublicPageView
{
    public function __construct(
        private readonly PageViewTracker $tracker,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $pending = $this->tracker->prepare($request, $response);
        $this->tracker->queue($pending);

        if ($pending !== null) {
            $this->tracker->rememberVisitor($request, $response, $pending);
        }

        return $response;
    }

    public function terminate(Request $request, Response $response): void
    {
        $this->tracker->flush();
    }
}
