<?php

namespace App\Support;

final class FormSubmissionPageUrl
{
    public static function isLivewireEndpoint(?string $url): bool
    {
        if (! is_string($url) || trim($url) === '') {
            return false;
        }

        $path = parse_url($url, PHP_URL_PATH);

        if (! is_string($path) || $path === '') {
            return false;
        }

        $path = '/'.trim($path, '/');

        if ($path === '/livewire' || str_starts_with($path, '/livewire/')) {
            return true;
        }

        return (bool) preg_match('#^/livewire-[a-f0-9]+/(update|upload-file)(/|$)#i', $path);
    }

    public static function resolve(?string $candidate = null): string
    {
        $candidate = is_string($candidate) ? trim($candidate) : '';

        if ($candidate !== '' && ! self::isLivewireEndpoint($candidate)) {
            return $candidate;
        }

        $referer = request()->headers->get('referer');

        if (is_string($referer) && trim($referer) !== '' && ! self::isLivewireEndpoint($referer)) {
            return trim($referer);
        }

        $current = url()->current();

        if (! self::isLivewireEndpoint($current)) {
            return $current;
        }

        return url('/');
    }
}
