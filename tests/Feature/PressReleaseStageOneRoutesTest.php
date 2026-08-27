<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PressReleaseStageOneRoutesTest extends TestCase
{
    #[Test]
    public function press_release_listing_owns_pressrelease_and_old_plural_routes_are_gone(): void
    {
        $this->assertTrue(Route::has('pressrelease.index'));
        $this->assertTrue(Route::has('pressrelease.page'));
        $this->assertTrue(Route::has('pressrelease.show'));
        $this->assertFalse(Route::has('press-releases.index'));
        $this->assertFalse(Route::has('press-releases.page'));
        $this->assertFalse(Route::has('press-releases.show'));
        $this->assertTrue(Route::has('page.show'));

        $this->assertSame(
            'http://localhost/pressrelease',
            route('pressrelease.index'),
        );
        $this->assertSame(
            'http://localhost/pressrelease/page/2',
            route('pressrelease.page', ['page' => 2]),
        );
        $this->assertSame(
            'http://localhost/pressrelease/ap-ar-automation-key-to-payment-fraud-reduction',
            route('pressrelease.show', ['slug' => 'ap-ar-automation-key-to-payment-fraud-reduction']),
        );
        $this->assertSame(
            'http://localhost/testimonials',
            route('page.show', ['slug' => 'testimonials']),
        );
    }

    #[Test]
    public function write_flag_without_only_is_rejected(): void
    {
        $this->artisan('press-releases:import', ['--write' => true])
            ->expectsOutputToContain('Write mode requires --only or --remaining')
            ->assertFailed();
    }

    #[Test]
    public function write_and_remaining_together_with_only_are_rejected(): void
    {
        $this->artisan('press-releases:import', [
            '--write' => true,
            '--remaining' => true,
            '--only' => 'ap-ar-automation-key-to-payment-fraud-reduction',
        ])
            ->expectsOutputToContain('Use either --only or --remaining, not both.')
            ->assertFailed();
    }

    #[Test]
    public function write_and_dry_run_together_are_rejected(): void
    {
        $this->artisan('press-releases:import', [
            '--write' => true,
            '--dry-run' => true,
            '--only' => 'ap-ar-automation-key-to-payment-fraud-reduction',
        ])
            ->expectsOutputToContain('Use either --dry-run or --write, not both.')
            ->assertFailed();
    }
}
