<?php

namespace Tests\Support;

use Illuminate\Contracts\Foundation\Application;
use RuntimeException;

final class DatabaseSafetyGuard
{
    /**
     * @var list<string>
     */
    private const UNSAFE_DATABASE_NAMES = [
        'ibntech_laravel_12',
    ];

    /**
     * @var list<string>
     */
    private const UNSAFE_DRIVERS = [
        'mysql',
        'mariadb',
        'pgsql',
        'sqlsrv',
    ];

    public static function isolatedConfigCachePath(): string
    {
        return dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'phpunit-config-cache-disabled.php';
    }

    public static function applicationConfigCachePath(): string
    {
        return dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'config.php';
    }

    public static function assertProcessEnvironment(): void
    {
        self::assertSameValue('APP_ENV', 'testing', self::env('APP_ENV'));
        self::assertSameValue('DB_CONNECTION', 'sqlite', self::env('DB_CONNECTION'));
        self::assertSameValue('DB_DATABASE', ':memory:', self::env('DB_DATABASE'));
        self::assertEmptyValue('DB_URL', self::env('DB_URL'));

        $configuredCache = self::env('APP_CONFIG_CACHE');
        $isolatedCache = self::isolatedConfigCachePath();
        $applicationCache = self::applicationConfigCachePath();

        if (! is_string($configuredCache) || $configuredCache === '') {
            self::fail('APP_CONFIG_CACHE is not set. PHPUnit was stopped to protect the database: tests must not load bootstrap/cache/config.php.');
        }

        $configuredReal = is_file($configuredCache) ? realpath($configuredCache) : false;
        $isolatedReal = is_file($isolatedCache) ? realpath($isolatedCache) : false;
        $applicationReal = is_file($applicationCache) ? realpath($applicationCache) : false;

        if ($configuredReal !== false && $applicationReal !== false && $configuredReal === $applicationReal) {
            self::fail('APP_CONFIG_CACHE points at bootstrap/cache/config.php. PHPUnit was stopped to protect the database: that cache contains the application MySQL configuration.');
        }

        if ($isolatedReal !== false && $applicationReal !== false && $isolatedReal === $applicationReal) {
            self::fail('The PHPUnit config-cache bypass path resolved to bootstrap/cache/config.php. PHPUnit was stopped to protect the database.');
        }

        if (is_file($isolatedCache)) {
            self::fail('The PHPUnit config-cache bypass file exists ('.self::isolatedConfigCachePath().'). PHPUnit was stopped to protect the database: that path must not exist so Laravel cannot load a cached config.');
        }

        if (self::isUnsafeDatabaseName((string) self::env('DB_DATABASE'))) {
            self::fail('DB_DATABASE is "'.self::env('DB_DATABASE').'". PHPUnit was stopped to protect the database: tests cannot use ibntech_laravel_12 or any other application database.');
        }
    }

    public static function abortIfApplicationConfigCacheWouldLoad(Application $app): void
    {
        self::assertProcessEnvironment();

        $cachedPath = $app->getCachedConfigPath();
        $applicationCache = self::applicationConfigCachePath();
        $cachedReal = is_file($cachedPath) ? realpath($cachedPath) : false;
        $applicationReal = is_file($applicationCache) ? realpath($applicationCache) : false;

        if ($cachedReal !== false && $applicationReal !== false && $cachedReal === $applicationReal) {
            self::fail('Laravel would load bootstrap/cache/config.php before the application finishes booting. PHPUnit was stopped to protect the database: that cache contains the application MySQL configuration.');
        }

        if (is_file($cachedPath) && is_file($applicationCache) && realpath($cachedPath) === realpath($applicationCache)) {
            self::fail('Laravel would load the application config cache. PHPUnit was stopped to protect the database.');
        }
    }

    public static function abortIfUnsafe(?Application $app): void
    {
        self::assertProcessEnvironment();

        if (! $app instanceof Application) {
            self::fail('The Laravel application is not available, so the test database cannot be verified. PHPUnit was stopped to protect the database.');
        }

        $cachedPath = $app->getCachedConfigPath();
        $applicationCache = self::applicationConfigCachePath();
        $cachedReal = is_file($cachedPath) ? realpath($cachedPath) : false;
        $applicationReal = is_file($applicationCache) ? realpath($applicationCache) : false;

        if ($cachedReal !== false && $applicationReal !== false && $cachedReal === $applicationReal) {
            self::fail('Laravel resolved the config cache to bootstrap/cache/config.php. PHPUnit was stopped to protect the database: that file contains the application MySQL configuration.');
        }

        if ($app->bound('config_loaded_from_cache') && $app->make('config_loaded_from_cache') === true) {
            if ($cachedReal !== false && $applicationReal !== false && $cachedReal === $applicationReal) {
                self::fail('Laravel loaded bootstrap/cache/config.php. PHPUnit was stopped to protect the database.');
            }

            self::fail('Laravel loaded a cached configuration file. PHPUnit was stopped to protect the database: tests must load config from files plus isolated environment variables, not a config cache.');
        }

        if (! $app->bound('config')) {
            self::fail('Laravel configuration is not bound, so the test database cannot be verified. PHPUnit was stopped to protect the database.');
        }

        $config = $app->make('config');
        $default = (string) $config->get('database.default', '');
        $connection = $config->get('database.connections.'.$default);

        if (! is_array($connection)) {
            self::fail('The resolved database connection "'.$default.'" is missing. PHPUnit was stopped to protect the database.');
        }

        $driver = strtolower((string) ($connection['driver'] ?? ''));
        $database = (string) ($connection['database'] ?? '');
        $url = (string) ($connection['url'] ?? '');

        if (in_array($driver, self::UNSAFE_DRIVERS, true) || $default === 'mysql' || $default === 'mariadb') {
            self::fail('PHPUnit resolved a '.$driver.' connection ('.$default.'). PHPUnit was stopped to protect the database: tests must use isolated SQLite :memory:, not MySQL.');
        }

        if ($driver !== 'sqlite' || $default !== 'sqlite') {
            self::fail('PHPUnit resolved database connection "'.$default.'" (driver: '.$driver.'). PHPUnit was stopped to protect the database: only sqlite :memory: is allowed.');
        }

        if ($database !== ':memory:') {
            self::fail('PHPUnit resolved SQLite database "'.$database.'". PHPUnit was stopped to protect the database: only :memory: is allowed.');
        }

        if ($url !== '') {
            self::fail('PHPUnit resolved a non-empty DB URL. PHPUnit was stopped to protect the database.');
        }

        if (self::isUnsafeDatabaseName($database) || self::isUnsafeDatabaseName($default)) {
            self::fail('PHPUnit resolved an application database. PHPUnit was stopped to protect the database.');
        }

        foreach ($config->get('database.connections', []) as $name => $candidate) {
            if (! is_array($candidate)) {
                continue;
            }

            $candidateDatabase = (string) ($candidate['database'] ?? '');
            $candidateDriver = strtolower((string) ($candidate['driver'] ?? ''));

            if (self::isUnsafeDatabaseName($candidateDatabase)) {
                self::fail('Database connection "'.$name.'" is configured for "'.$candidateDatabase.'". PHPUnit was stopped to protect the database.');
            }

            if ($name === $default && in_array($candidateDriver, self::UNSAFE_DRIVERS, true)) {
                self::fail('The default connection uses driver '.$candidateDriver.'. PHPUnit was stopped to protect the database.');
            }
        }
    }

    private static function isUnsafeDatabaseName(string $name): bool
    {
        $normalized = strtolower(trim($name));

        if ($normalized === '') {
            return false;
        }

        foreach (self::UNSAFE_DATABASE_NAMES as $unsafe) {
            if ($normalized === strtolower($unsafe)) {
                return true;
            }
        }

        return str_contains($normalized, 'ibntech_laravel_12');
    }

    private static function env(string $key): ?string
    {
        if (array_key_exists($key, $_ENV) && is_string($_ENV[$key])) {
            return $_ENV[$key];
        }

        if (array_key_exists($key, $_SERVER) && is_string($_SERVER[$key])) {
            return $_SERVER[$key];
        }

        $value = getenv($key);

        return $value === false ? null : (string) $value;
    }

    private static function assertSameValue(string $key, string $expected, ?string $actual): void
    {
        if ($actual !== $expected) {
            self::fail($key.' is "'.($actual ?? 'null').'", expected "'.$expected.'". PHPUnit was stopped to protect the database.');
        }
    }

    private static function assertEmptyValue(string $key, ?string $actual): void
    {
        if ($actual !== null && $actual !== '') {
            self::fail($key.' is set to "'.$actual.'". PHPUnit was stopped to protect the database: tests cannot inherit an application database URL.');
        }
    }

    private static function fail(string $message): never
    {
        throw new RuntimeException($message);
    }
}
