<?php

namespace App\Services;

use App\Models\CloudflareSetting;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class CloudflareCacheService
{
    public const PURGE_EVERYTHING = 'purge_everything';

    public const CUSTOM_PURGE = 'custom_purge';

    public const API_BASE = 'https://api.cloudflare.com/client/v4';

    public const MAX_URLS = 30;

    private const TIMEOUT_SECONDS = 15;

    private const CONNECT_TIMEOUT_SECONDS = 10;

    public static function purgeEndpoint(string $zoneId): string
    {
        return self::API_BASE.'/zones/'.$zoneId.'/purge_cache';
    }

    public function purgeEverything(?User $actor = null): CloudflarePurgeResult
    {
        return $this->send(
            action: self::PURGE_EVERYTHING,
            payload: ['purge_everything' => true],
            actor: $actor,
        );
    }

    /**
     * @param  list<string>  $urls
     */
    public function purgeUrls(array $urls, ?User $actor = null): CloudflarePurgeResult
    {
        $urls = $this->normalizeUrls($urls);

        if ($urls === []) {
            return $this->fail(
                'Add at least one valid URL before purging.',
                self::CUSTOM_PURGE,
                $actor,
            );
        }

        if (count($urls) > self::MAX_URLS) {
            return $this->fail(
                'Cloudflare accepts at most 30 URLs in one purge request.',
                self::CUSTOM_PURGE,
                $actor,
                count($urls),
            );
        }

        foreach ($urls as $url) {
            if (! $this->isPurgeableUrl($url)) {
                return $this->fail(
                    'One or more URLs are invalid. Use absolute http or https URLs.',
                    self::CUSTOM_PURGE,
                    $actor,
                    count($urls),
                );
            }
        }

        return $this->send(
            action: self::CUSTOM_PURGE,
            payload: ['files' => $urls],
            actor: $actor,
            urlCount: count($urls),
        );
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function send(string $action, array $payload, ?User $actor, int $urlCount = 0): CloudflarePurgeResult
    {
        $credentials = $this->credentials();
        $missing = $this->missingCredentialsMessage($credentials['api_token'], $credentials['zone_id']);

        if ($missing !== null) {
            return $this->fail($missing, $action, $actor, $urlCount);
        }

        $token = $credentials['api_token'];
        $zoneId = strtolower((string) $credentials['zone_id']);

        if (! preg_match('/^[a-f0-9]{32}$/', $zoneId)) {
            return $this->fail(
                'The saved Zone ID is not valid. Cloudflare zone IDs are 32-character hexadecimal values.',
                $action,
                $actor,
                $urlCount,
            );
        }

        if (! is_string($token) || ! preg_match('/^\S+$/', $token)) {
            return $this->fail(
                'The saved API token is not valid. Remove spaces and save it again.',
                $action,
                $actor,
                $urlCount,
            );
        }

        try {
            $response = Http::withToken($token)
                ->acceptJson()
                ->asJson()
                ->timeout(self::TIMEOUT_SECONDS)
                ->connectTimeout(self::CONNECT_TIMEOUT_SECONDS)
                ->post(self::purgeEndpoint($zoneId), $payload);
        } catch (ConnectionException $exception) {
            return $this->fail(
                $this->connectionFailureMessage($exception),
                $action,
                $actor,
                $urlCount,
                failureType: $this->isTimeout($exception) ? 'timeout' : 'connection',
            );
        } catch (Throwable $exception) {
            return $this->fail(
                'Cloudflare could not purge the cache.',
                $action,
                $actor,
                $urlCount,
                failureType: 'unexpected',
                exceptionClass: $exception::class,
            );
        }

        $status = $response->status();
        $body = $response->json();
        $succeeded = $response->successful() && is_array($body) && ($body['success'] ?? false) === true;

        if (! $succeeded) {
            return $this->fail(
                $this->safeCloudflareMessage($body, $status, $token),
                $action,
                $actor,
                $urlCount,
                $status,
            );
        }

        $settings = $credentials['settings'];

        if (! $settings instanceof CloudflareSetting) {
            return $this->fail(
                'Save a Cloudflare API token and Zone ID before purging the cache.',
                $action,
                $actor,
                $urlCount,
            );
        }

        $this->recordSuccess($settings, $action, $urlCount);

        $message = $action === self::CUSTOM_PURGE
            ? 'Cloudflare purged '.$urlCount.' URL'.($urlCount === 1 ? '' : 's').'.'
            : 'Cloudflare purged the entire cache for the configured zone.';

        $result = CloudflarePurgeResult::success($message, $action, $status, $urlCount);
        $this->log($result, $actor);

        return $result;
    }

    /**
     * @return array{api_token: ?string, zone_id: ?string, settings: ?CloudflareSetting}
     */
    private function credentials(): array
    {
        $settings = CloudflareSetting::query()->orderBy('id')->first();

        if (! $settings) {
            return [
                'api_token' => null,
                'zone_id' => null,
                'settings' => null,
            ];
        }

        try {
            $token = $settings->api_token;
        } catch (DecryptException) {
            Log::warning('Cloudflare API token could not be decrypted.', [
                'user_id' => auth()->id(),
            ]);

            $token = null;
        }

        $token = is_string($token) ? trim($token) : null;
        $zoneId = is_string($settings->zone_id) ? trim($settings->zone_id) : null;

        return [
            'api_token' => $token !== '' ? $token : null,
            'zone_id' => $zoneId !== '' ? $zoneId : null,
            'settings' => $settings,
        ];
    }

    private function missingCredentialsMessage(?string $token, ?string $zoneId): ?string
    {
        $missingToken = ! filled($token);
        $missingZone = ! filled($zoneId);

        if ($missingToken && $missingZone) {
            return 'Save a Cloudflare API token and Zone ID before purging the cache.';
        }

        if ($missingToken) {
            return 'Save a Cloudflare API token before purging the cache.';
        }

        if ($missingZone) {
            return 'Save a Cloudflare Zone ID before purging the cache.';
        }

        return null;
    }

    private function recordSuccess(CloudflareSetting $settings, string $action, int $urlCount): void
    {
        $settings->last_purge_type = $action;
        $settings->last_purge_url_count = $action === self::CUSTOM_PURGE ? $urlCount : null;
        $settings->last_purged_at = now();
        $settings->save();
    }

    private function fail(
        string $message,
        string $action,
        ?User $actor,
        int $urlCount = 0,
        ?int $httpStatus = null,
        ?string $failureType = null,
        ?string $exceptionClass = null,
    ): CloudflarePurgeResult {
        $result = CloudflarePurgeResult::failure($this->publicMessage($message), $action, $httpStatus, $urlCount);
        $this->log($result, $actor, $failureType, $exceptionClass);

        return $result;
    }

    private function log(
        CloudflarePurgeResult $result,
        ?User $actor,
        ?string $failureType = null,
        ?string $exceptionClass = null,
    ): void {
        $context = array_filter([
            'action' => $result->action,
            'user_id' => $actor?->id,
            'user_email' => $actor?->email,
            'url_count' => $result->urlCount,
            'success' => $result->successful,
            'http_status' => $result->httpStatus,
            'result_message' => $result->message,
            'failure_type' => $failureType,
            'exception' => $exceptionClass,
            'at' => now()->toIso8601String(),
        ], fn (mixed $value): bool => $value !== null);

        if ($result->successful) {
            Log::info('Cloudflare cache purge succeeded.', $context);

            return;
        }

        Log::warning('Cloudflare cache purge failed.', $context);
    }

    private function connectionFailureMessage(ConnectionException $exception): string
    {
        return $this->isTimeout($exception)
            ? 'The request to Cloudflare timed out. Try again in a moment.'
            : 'Could not connect to Cloudflare. Try again in a moment.';
    }

    private function isTimeout(ConnectionException $exception): bool
    {
        $message = strtolower($exception->getMessage());

        return str_contains($message, 'timed out')
            || str_contains($message, 'timeout')
            || str_contains($message, 'curl error 28');
    }

    private function safeCloudflareMessage(mixed $payload, int $status, string $token): string
    {
        $messages = [];

        if (is_array($payload)) {
            foreach ($payload['errors'] ?? [] as $error) {
                if (is_array($error) && isset($error['message']) && is_string($error['message'])) {
                    $messages[] = $error['message'];
                }
            }
        }

        $combined = trim(implode(' ', $messages));

        if ($combined === '' || $this->containsSensitiveMaterial($combined, $token)) {
            return $this->statusMessage($status);
        }

        return $this->publicMessage($combined, $token);
    }

    private function statusMessage(int $status): string
    {
        return match ($status) {
            401, 403 => 'Cloudflare rejected the API token. Check the token and try again.',
            404 => 'Cloudflare could not find that zone. Check the Zone ID and try again.',
            400 => 'Cloudflare rejected the purge request. Check the Zone ID and URLs, then try again.',
            429 => 'Cloudflare rate-limited the purge request. Wait a moment and try again.',
            default => 'Cloudflare could not purge the cache.',
        };
    }

    private function publicMessage(string $message, string $token = ''): string
    {
        if ($this->containsSensitiveMaterial($message, $token)) {
            return 'Cloudflare could not purge the cache.';
        }

        return $message;
    }

    private function containsSensitiveMaterial(string $message, string $token = ''): bool
    {
        if ($token !== '' && str_contains($message, $token)) {
            return true;
        }

        return preg_match('/bearer\s+\S+/i', $message) === 1
            || preg_match('/authorization\s*[:=]/i', $message) === 1;
    }

    /**
     * @param  list<mixed>  $urls
     * @return list<string>
     */
    private function normalizeUrls(array $urls): array
    {
        $normalized = [];

        foreach ($urls as $url) {
            if (! is_string($url)) {
                continue;
            }

            $url = trim($url);

            if ($url !== '') {
                $normalized[] = $url;
            }
        }

        return array_values($normalized);
    }

    private function isPurgeableUrl(string $url): bool
    {
        if (strlen($url) > 2048 || filter_var($url, FILTER_VALIDATE_URL) === false) {
            return false;
        }

        $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));

        return in_array($scheme, ['http', 'https'], true);
    }
}
