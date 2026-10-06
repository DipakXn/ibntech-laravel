<?php

namespace App\Services\Analytics;

use App\Models\PageView;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class PageViewTracker
{
    private ?PendingPageView $queued = null;

    public function __construct(
        private readonly PublicPageViewGate $gate,
        private readonly AnonymousVisitor $visitors,
        private readonly TrackedContentResolver $content,
        private readonly ExcludedIpMatcher $excludedIps,
    ) {}

    public function queue(?PendingPageView $pending): void
    {
        $this->queued = $pending;
    }

    public function flush(): void
    {
        $pending = $this->queued;
        $this->queued = null;

        if ($pending instanceof PendingPageView) {
            $this->record($pending);
        }
    }

    public function prepare(Request $request, Response $response): ?PendingPageView
    {
        if (! $this->gate->allows($request) || ! $this->responseIsPublicHtml($response)) {
            return null;
        }

        if ($this->excludedIps->excludes(ClientAddress::from($request))) {
            return null;
        }

        $agent = UserAgentSummary::from($request->userAgent());
        $path = $request->getPathInfo();

        return new PendingPageView(
            visitorId: $this->visitors->id($request),
            visitedAt: now(),
            path: $path === '' ? '/' : substr($path, 0, 255),
            routeName: $request->route()?->getName(),
            routeParameters: $this->routeParameters($request),
            referrerHost: ReferrerHost::from($request->headers->get('referer')),
            country: CountryCode::fromRequest($request),
            device: $agent->device,
            browser: $agent->browser,
            operatingSystem: $agent->operatingSystem,
        );
    }

    public function rememberVisitor(Request $request, Response $response, PendingPageView $pending): void
    {
        $response->headers->setCookie($this->visitors->cookie($request, $pending->visitorId));
    }

    public function record(PendingPageView $pending): void
    {
        $content = $this->content->resolve($pending->routeName, $pending->routeParameters);

        PageView::query()->create([
            'visitor_id' => $pending->visitorId,
            'visited_at' => $pending->visitedAt,
            'path' => $pending->path,
            'content_type' => $content['content_type'],
            'content_id' => $content['content_id'],
            'referrer_host' => $pending->referrerHost,
            'country' => $pending->country,
            'device' => $pending->device,
            'browser' => $pending->browser,
            'operating_system' => $pending->operatingSystem,
        ]);
    }

    private function responseIsPublicHtml(Response $response): bool
    {
        if ($response instanceof BinaryFileResponse || $response instanceof StreamedResponse) {
            return false;
        }

        if ($response->getStatusCode() !== 200) {
            return false;
        }

        if (str_contains(strtolower((string) $response->headers->get('Content-Disposition', '')), 'attachment')) {
            return false;
        }

        return str_contains(strtolower((string) $response->headers->get('Content-Type', '')), 'text/html');
    }

    /**
     * @return array<string, int|string>
     */
    private function routeParameters(Request $request): array
    {
        $parameters = [];

        foreach ($request->route()?->parameters() ?? [] as $key => $value) {
            if (is_string($value) || is_int($value)) {
                $parameters[$key] = $value;
            }
        }

        return $parameters;
    }
}
