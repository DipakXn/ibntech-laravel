<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class FeaturedImageDimensionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_article_listing_renders_featured_image_with_width_and_height(): void
    {
        $this->withoutVite();

        $relativePath = 'articles/featured/test-dims/featured.webp';
        $absoluteDir = public_path('uploads/articles/featured/test-dims');
        File::ensureDirectoryExists($absoluteDir);
        UploadedFile::fake()->image('featured.webp', 1200, 630)->move($absoluteDir, 'featured.webp');

        Article::query()->create([
            'title' => 'Outsourced Bookkeeping Services in Texas',
            'slug' => 'outsourced-bookkeeping-services-in-texas',
            'template' => 'default',
            'status' => 'published',
            'content' => 'Article body for dimension test.',
            'featured_image' => $relativePath,
        ]);

        $response = $this->followingRedirects()->get('/article/');

        $response->assertOk();
        $response->assertSee('width="1200"', false);
        $response->assertSee('height="630"', false);
        $response->assertSee('Outsourced Bookkeeping Services in Texas', false);
    }

    public function test_site_navbar_logo_includes_intrinsic_dimensions(): void
    {
        $this->withoutVite();

        if (! is_file(public_path('uploads/web-img/ibn-logo.webp'))) {
            $this->markTestSkipped('ibn-logo.webp is not present in this environment.');
        }

        Page::query()->create([
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'home',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/');

        $response->assertOk();
        $response->assertSee('uploads/web-img/ibn-logo.webp', false);
        $response->assertSee('width="512"', false);
        $response->assertSee('height="182"', false);
    }
}
