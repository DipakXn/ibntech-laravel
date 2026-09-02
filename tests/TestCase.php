<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Uri;
use Tests\Support\DatabaseSafetyGuard;

abstract class TestCase extends BaseTestCase
{
    public function createApplication()
    {
        DatabaseSafetyGuard::assertProcessEnvironment();

        $app = require Application::inferBasePath().'/bootstrap/app.php';

        $this->traitsUsedByTest = array_flip(class_uses_recursive(static::class));

        DatabaseSafetyGuard::abortIfApplicationConfigCacheWouldLoad($app);

        $app->make(Kernel::class)->bootstrap();

        DatabaseSafetyGuard::abortIfUnsafe($app);

        return $app;
    }

    protected function refreshApplication()
    {
        $this->app = $this->createApplication();

        DatabaseSafetyGuard::abortIfUnsafe($this->app);
    }

    protected function setUpTraits()
    {
        DatabaseSafetyGuard::abortIfUnsafe($this->app);

        return parent::setUpTraits();
    }

    /**
     * Keep the request path exactly as written. Laravel's default helper runs
     * the URI through url() and then trims slashes, which fights public
     * trailing-slash URL generation.
     */
    protected function prepareUrlForRequest($uri)
    {
        $uri = $uri instanceof Uri ? $uri->value() : $uri;

        if (str_starts_with($uri, 'http://') || str_starts_with($uri, 'https://')) {
            return $uri;
        }

        $root = rtrim((string) config('app.url', 'http://localhost'), '/');

        if ($uri === '' || $uri === '/') {
            return $root.'/';
        }

        if (! str_starts_with($uri, '/')) {
            $uri = '/'.$uri;
        }

        return $root.$uri;
    }
}
