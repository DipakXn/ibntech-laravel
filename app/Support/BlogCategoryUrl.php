<?php

namespace App\Support;

class BlogCategoryUrl
{
    public static function for(string $slug, int $page = 1): string
    {
        $url = $page > 1
            ? route('blog.category.page', ['slug' => $slug, 'page' => $page])
            : route('blog.category', ['slug' => $slug]);

        return PathPageUrl::withTrailingSlash($url);
    }
}
