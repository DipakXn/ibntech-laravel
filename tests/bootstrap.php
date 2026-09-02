<?php

declare(strict_types=1);

use Tests\Support\DatabaseSafetyGuard;

$projectRoot = dirname(__DIR__);

$isolatedConfigCache = $projectRoot.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'phpunit-config-cache-disabled.php';
$isolatedRoutesCache = $projectRoot.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'phpunit-routes-cache-disabled.php';
$applicationConfigCache = $projectRoot.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'config.php';

$forceEnv = static function (string $key, string $value): void {
    putenv($key.'='.$value);
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
};

$forceEnv('APP_ENV', 'testing');
$forceEnv('DB_CONNECTION', 'sqlite');
$forceEnv('DB_DATABASE', ':memory:');
$forceEnv('DB_URL', '');
$forceEnv('APP_CONFIG_CACHE', $isolatedConfigCache);
$forceEnv('APP_ROUTES_CACHE', $isolatedRoutesCache);

$fail = static function (string $message): never {
    fwrite(STDERR, $message.PHP_EOL);
    exit(1);
};

if (is_file($isolatedConfigCache)) {
    $fail('PHPUnit was stopped to protect the database: the isolated config-cache bypass file exists and must not. Tests cannot load a Laravel config cache.');
}

if (is_file($applicationConfigCache)) {
    $isolatedReal = is_file($isolatedConfigCache) ? realpath($isolatedConfigCache) : false;
    $applicationReal = realpath($applicationConfigCache);

    if ($isolatedReal !== false && $applicationReal !== false && $isolatedReal === $applicationReal) {
        $fail('PHPUnit was stopped to protect the database: APP_CONFIG_CACHE resolved to bootstrap/cache/config.php, which contains the application MySQL configuration.');
    }
}

$database = $_ENV['DB_DATABASE'] ?? '';

if (is_string($database) && str_contains(strtolower($database), 'ibntech_laravel_12')) {
    $fail('PHPUnit was stopped to protect the database: DB_DATABASE cannot be ibntech_laravel_12.');
}

if (($_ENV['DB_CONNECTION'] ?? '') !== 'sqlite' || ($_ENV['DB_DATABASE'] ?? '') !== ':memory:') {
    $fail('PHPUnit was stopped to protect the database: tests must use sqlite :memory: before Laravel boots.');
}

require $projectRoot.'/vendor/autoload.php';

DatabaseSafetyGuard::assertProcessEnvironment();
