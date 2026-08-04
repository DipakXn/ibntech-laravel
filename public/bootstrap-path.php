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
    $host === 'stg.ledgergenie.ai' =>
        '/home/ledgergenie/ledgergenie-staging',

    // Production
    $host === 'ledgergenie.ai' ||
    $host === 'www.ledgergenie.ai' =>
        '/home/ledgergenie/ledgergenie',

    // Fallback
    default =>
        dirname(__DIR__),
};