<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Trust Cloudflare
    |--------------------------------------------------------------------------
    |
    | Production (ibntech.com) is behind Cloudflare. When enabled, only the
    | official Cloudflare ranges below are trusted. A direct connection or any
    | other proxy cannot supply the visitor IP. Never set the proxy list to "*".
    |
    | Ranges were taken from https://www.cloudflare.com/ips-v4 and
    | https://www.cloudflare.com/ips-v6 on 2026-10-05. Replace this list from
    | those URLs when Cloudflare publishes a change.
    |
    */

    'trust_proxies' => filter_var(env('CLOUDFLARE_TRUST_PROXIES', true), FILTER_VALIDATE_BOOL),

    'proxies' => [
        '173.245.48.0/20',
        '103.21.244.0/22',
        '103.22.200.0/22',
        '103.31.4.0/22',
        '141.101.64.0/18',
        '108.162.192.0/18',
        '190.93.240.0/20',
        '188.114.96.0/20',
        '197.234.240.0/22',
        '198.41.128.0/17',
        '162.158.0.0/15',
        '104.16.0.0/13',
        '104.24.0.0/14',
        '172.64.0.0/13',
        '131.0.72.0/22',
        '2400:cb00::/32',
        '2606:4700::/32',
        '2803:f800::/32',
        '2405:b500::/32',
        '2405:8100::/32',
        '2a06:98c0::/29',
        '2c0f:f248::/32',
    ],

];
