<?php

namespace Tests\Unit;

use App\Services\PartialCacheClearException;
use RuntimeException;
use Tests\TestCase;

class PartialCacheClearExceptionTest extends TestCase
{
    public function test_it_names_the_failed_step_when_nothing_finished(): void
    {
        $exception = new PartialCacheClearException(
            'Configuration cache',
            [],
            new RuntimeException('secret-config-path'),
        );

        $this->assertSame(
            'The configuration cache could not be cleared.',
            $exception->publicMessage(),
        );
        $this->assertStringNotContainsString('secret-config-path', $exception->getMessage());
    }

    public function test_it_names_one_completed_step(): void
    {
        $exception = new PartialCacheClearException(
            'Route cache',
            ['Configuration cache'],
            new RuntimeException('secret-route-path'),
        );

        $this->assertSame(
            'The route cache could not be cleared. Configuration cache was already cleared.',
            $exception->publicMessage(),
        );
    }

    public function test_it_names_every_completed_step(): void
    {
        $exception = new PartialCacheClearException(
            'Application cache',
            ['Configuration cache', 'Route cache', 'View cache'],
            new RuntimeException('secret-cache-host'),
        );

        $this->assertSame(
            'The application cache could not be cleared. Configuration cache, route cache, and view cache were already cleared.',
            $exception->publicMessage(),
        );
    }
}
