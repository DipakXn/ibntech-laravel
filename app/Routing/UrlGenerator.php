<?php

namespace App\Routing;

use App\Support\PathPageUrl;
use Illuminate\Routing\UrlGenerator as BaseUrlGenerator;

class UrlGenerator extends BaseUrlGenerator
{
    /**
     * Laravel's formatter trims trailing slashes. Put them back for public
     * content URLs so generated hrefs match EnsureTrailingSlash canonicals.
     */
    public function format($root, $path, $route = null)
    {
        $formatted = parent::format($root, $path, $route);

        if (! PathPageUrl::shouldAppendTrailingSlash((string) $path)) {
            return $formatted;
        }

        return str_ends_with($formatted, '/') ? $formatted : $formatted.'/';
    }
}
