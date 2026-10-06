<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Anonymous visitor cookie
    |--------------------------------------------------------------------------
    |
    | A random identifier stored in a first-party cookie. It is not derived
    | from an IP address or the Laravel session.
    |
    */

    'visitor_cookie' => 'ibn_visitor',

    'visitor_cookie_minutes' => 60 * 24 * 400,

    /*
    |--------------------------------------------------------------------------
    | Country header
    |--------------------------------------------------------------------------
    |
    | This application has no GeoIP database. Country is stored only when a
    | trusted edge proxy overwrites CF-IPCountry or CloudFront-Viewer-Country.
    | Leave this false until that proxy is in front of the site. Client-supplied
    | country headers are ignored.
    |
    */

    'trust_country_headers' => (bool) env('ANALYTICS_TRUST_COUNTRY_HEADERS', false),

];
