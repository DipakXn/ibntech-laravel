<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
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
}
