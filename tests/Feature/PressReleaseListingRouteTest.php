<?php

namespace Tests\Feature;

use App\Http\Middleware\EnsureTrailingSlash;
use App\Models\PressRelease;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PressReleaseListingRouteTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function listing_and_detail_use_pressrelease_paths_and_old_plural_urls_are_not_press_release_pages(): void
    {
        $this->withoutVite();
        $this->withoutMiddleware(EnsureTrailingSlash::class);

        PressRelease::query()->create([
            'title' => 'Pilot One',
            'slug' => 'pilot-one',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>One</p>']]],
            'status' => 'published',
            'published_at' => '2024-01-24 00:00:00',
        ]);
        PressRelease::query()->create([
            'title' => 'Pilot Two',
            'slug' => 'pilot-two',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Two</p>']]],
            'status' => 'published',
            'published_at' => '2024-02-05 00:00:00',
        ]);
        PressRelease::query()->create([
            'title' => 'Manual Four',
            'slug' => 'manual-four',
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Four</p>']]],
            'status' => 'published',
            'published_at' => '2023-08-29 11:44:00',
        ]);

        $listing = $this->get('/pressrelease');
        $listing->assertOk();
        $listing->assertSee('Pilot One');
        $listing->assertSee('Pilot Two');
        $listing->assertSee('Manual Four');
        $listing->assertSee('href="http://localhost/pressrelease/pilot-one', false);
        $listing->assertDontSee('href="http://localhost/press-releases/', false);

        $this->get('/pressrelease/pilot-two')->assertOk()->assertSee('Pilot Two');

        $this->get('/press-releases')->assertNotFound();
        $this->get('/press-releases/pilot-one')->assertNotFound();
    }
}
