<?php

namespace App\Support;

class PathPageUrl
{
    public static function forRoute(string $indexRoute, string $pageRoute, int $page = 1, array $parameters = []): string
    {
        $url = $page > 1
            ? route($pageRoute, array_merge($parameters, ['page' => $page]))
            : route($indexRoute, $parameters);

        return self::withTrailingSlash($url);
    }

    public static function withTrailingSlash(string $url): string
    {
        $fragment = '';
        if (str_contains($url, '#')) {
            [$url, $fragment] = explode('#', $url, 2);
            $fragment = '#'.$fragment;
        }

        $query = '';
        if (str_contains($url, '?')) {
            [$url, $query] = explode('?', $url, 2);
            $query = '?'.$query;
        }

        if ($url === '' || str_ends_with($url, '/')) {
            return $url.$query.$fragment;
        }

        return $url.'/'.$query.$fragment;
    }
}
