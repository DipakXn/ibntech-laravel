<?php

namespace App\Support\Health;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Throwable;

class LaravelApplicationHttpProbe implements ApplicationHttpProbe
{
    public const CONNECT_TIMEOUT_SECONDS = 2;

    public const TIMEOUT_SECONDS = 3;

    public const MAX_REDIRECTS = 3;

    public const RETRIES = 0;

    /**
     * @return array<string, mixed>
     */
    public function options(): array
    {
        return [
            'connect_timeout' => self::CONNECT_TIMEOUT_SECONDS,
            'timeout' => self::TIMEOUT_SECONDS,
            'http_errors' => false,
            'verify' => true,
            'allow_redirects' => [
                'max' => self::MAX_REDIRECTS,
                'strict' => true,
                'referer' => false,
                'protocols' => ['http', 'https'],
                'on_redirect' => function (RequestInterface $request, ResponseInterface $response, UriInterface $uri): void {
                    $this->rejectOffOriginRedirect($response, $uri);
                },
            ],
        ];
    }

    public function probe(): ApplicationHttpResult
    {
        $origin = ApplicationOrigin::fromConfig();

        if (! $origin->valid || $origin->url === null) {
            return new ApplicationHttpResult(
                'invalid',
                null,
                null,
                $origin->reason ?? 'The application URL is not valid.',
            );
        }

        $started = hrtime(true);

        try {
            $response = Http::withOptions($this->options())->get($origin->url);

            return new ApplicationHttpResult(
                'completed',
                $response->status(),
                $this->elapsed($started),
                'The website responded.',
            );
        } catch (Throwable $exception) {
            $redirect = $this->offOriginRedirect($exception);

            if ($redirect instanceof OffOriginRedirect) {
                return new ApplicationHttpResult(
                    'off_origin',
                    $redirect->httpStatus,
                    $this->elapsed($started),
                    'The website redirected away from the application URL.',
                );
            }

            return new ApplicationHttpResult(
                'failed',
                null,
                $this->elapsed($started),
                'The website did not respond.',
            );
        }
    }

    public function rejectOffOriginRedirect(ResponseInterface $response, UriInterface $uri): void
    {
        $origin = ApplicationOrigin::fromConfig();

        if (! $origin->isSameOrigin((string) $uri)) {
            throw new OffOriginRedirect($response->getStatusCode());
        }
    }

    private function offOriginRedirect(Throwable $exception): ?OffOriginRedirect
    {
        $current = $exception;

        while ($current !== null) {
            if ($current instanceof OffOriginRedirect) {
                return $current;
            }

            if ($current instanceof ConnectionException && $current->getPrevious() instanceof OffOriginRedirect) {
                return $current->getPrevious();
            }

            $current = $current->getPrevious();
        }

        return null;
    }

    private function elapsed(int $started): int
    {
        return (int) ((hrtime(true) - $started) / 1_000_000);
    }
}
