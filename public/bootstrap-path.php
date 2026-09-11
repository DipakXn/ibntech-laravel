<?php

/*
|--------------------------------------------------------------------------
| Laravel Base Path Resolver
|--------------------------------------------------------------------------
|
| This file determines the Laravel application root based on the current
| environment. No changes are required to index.php.
|
*/

$host = $_SERVER['HTTP_HOST'] ?? '';

return match (true) {

    // Local Development
    str_contains($host, 'localhost'),
    str_contains($host, '127.0.0.1') =>
        dirname(__DIR__),

    // Staging
    $host === 'dev.ibntech.com' =>
        '/home/devtech/ibntech-core',

    // Production
    $host === 'ibntech.com' ||
    $host === 'www.ibntech.com' =>
        '/home/ibntech/ibntech-core',

    // Fallback
    default =>
        dirname(__DIR__),
};
