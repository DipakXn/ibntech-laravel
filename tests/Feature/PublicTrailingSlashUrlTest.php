<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\PressRelease;
use App\Support\PathPageUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Mechanisms\HandleRequests\EndpointResolver;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PublicTrailingSlashUrlTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function public_named_routes_include_trailing_slashes(): void
    {
        $this->assertSame('http://localhost/pressrelease/', route('pressrelease.index'));
        $this->assertSame('http://localhost/pressrelease/page/2/', route('pressrelease.page', ['page' => 2]));
        $this->assertSame('http://localhost/pressrelease/pilot-one/', route('pressrelease.show', ['slug' => 'pilot-one']));
        $this->assertSame('http://localhost/case-studies/', route('case-studies.index'));
        $this->assertSame('http://localhost/case-studies/page/2/', route('case-studies.page', ['page' => 2]));
        $this->assertSame('http://localhost/case-studies/cloud-migration/', route('case-studies.show', ['slug' => 'cloud-migration']));
        $this->assertSame('http://localhost/blog/', route('blog.index'));
        $this->assertSame('http://localhost/blog/category/cybersecurity/', route('blog.category', 'cybersecurity'));
        $this->assertSame('http://localhost/blog/a-post/', route('blog.show', 'a-post'));
        $this->assertSame('http://localhost/contact-us/', route('page.show', ['slug' => 'contact-us']));
    }

    #[Test]
    public function download_and_admin_urls_do_not_gain_trailing_slashes(): void
    {
        $this->assertSame(
            'http://localhost/case-studies/cloud-migration/download',
            route('case-studies.download', ['slug' => 'cloud-migration']),
        );
        $this->assertSame('http://localhost/admin/login', url('/admin/login'));
        $this->assertSame('http://localhost/ibn-tech-cms-login', url('/ibn-tech-cms-login'));
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash('/livewire/update'));
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash('/build/app.js'));
    }

    /**
     * Regression test for the Livewire 4 hashed upload endpoint.
     *
     * Livewire 4 uses a dynamic prefix of the form /livewire-{8char-hash}/ rather
     * than the literal /livewire/ prefix. Without the `str_starts_with($first, 'livewire-')`
     * guard in shouldAppendTrailingSlash(), the custom UrlGenerator::format() would
     * append a trailing slash to the HMAC-signed URL. That slash is then stripped by
     * request()->url() at validation time, producing a signature mismatch → 401.
     *
     * This test asserts that:
     *   1. shouldAppendTrailingSlash returns false for all livewire-{hash}/... paths.
     *   2. The generated signed upload URL does NOT contain a trailing slash before '?'.
     */
    #[Test]
    public function livewire_hashed_upload_endpoint_does_not_receive_trailing_slash(): void
    {
        $prefix      = EndpointResolver::prefix();          // e.g. /livewire-4e37d65f
        $uploadPath  = EndpointResolver::uploadPath();      // e.g. /livewire-4e37d65f/upload-file
        $previewPath = EndpointResolver::previewPath();     // e.g. /livewire-4e37d65f/preview-file/{filename}
        $updatePath  = EndpointResolver::updatePath();      // e.g. /livewire-4e37d65f/update
        $scriptPath  = EndpointResolver::scriptPath(false); // e.g. /livewire-4e37d65f/livewire.js

        // All hashed-prefix paths must be exempt from trailing-slash appending.
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash($uploadPath),
            "$uploadPath should NOT receive a trailing slash (would break HMAC signing)");
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash($updatePath),
            "$updatePath should NOT receive a trailing slash");
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash($previewPath),
            "$previewPath should NOT receive a trailing slash");
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash($scriptPath),
            "$scriptPath should NOT receive a trailing slash");

        // The route() helper must not append a slash to the upload route URL.
        $generatedUploadUrl = route('livewire.upload-file');
        $pathBeforeQuery = (string) parse_url($generatedUploadUrl, PHP_URL_PATH);
        $this->assertStringEndsNotWith(
            '/',
            $pathBeforeQuery,
            "route('livewire.upload-file') path must not end with '/' — got: $generatedUploadUrl"
        );
        $this->assertStringEndsWith(
            $uploadPath,
            $pathBeforeQuery,
            "route('livewire.upload-file') path must end with $uploadPath — got: $generatedUploadUrl"
        );


        // Also confirm that a generic livewire- path (not in the exact prefix) is still exempted.
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash('/livewire-abcd1234/upload-file'),
            "Any /livewire-{hash}/... path must be exempt");
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash('/livewire-00000000/update'),
            "Any /livewire-{hash}/... path must be exempt");
    }

    #[Test]
    public function public_page_urls_still_receive_trailing_slashes_after_livewire_fix(): void
    {
        // Normal public-content routes must be unaffected by the livewire- exemption.
        $this->assertTrue(PathPageUrl::shouldAppendTrailingSlash('/contact-us'),
            '/contact-us should still receive a trailing slash');
        $this->assertTrue(PathPageUrl::shouldAppendTrailingSlash('/blog'),
            '/blog should still receive a trailing slash');
        $this->assertTrue(PathPageUrl::shouldAppendTrailingSlash('/case-studies'),
            '/case-studies should still receive a trailing slash');
        $this->assertTrue(PathPageUrl::shouldAppendTrailingSlash('/pressrelease'),
            '/pressrelease should still receive a trailing slash');
        $this->assertTrue(PathPageUrl::shouldAppendTrailingSlash('/industries/healthcare'),
            '/industries/healthcare should still receive a trailing slash');

        // route() helper must still append slashes for all public routes.
        $this->assertStringEndsWith('/', route('pressrelease.index'));
        $this->assertStringEndsWith('/', route('case-studies.index'));
        $this->assertStringEndsWith('/', route('blog.index'));
        $this->assertStringEndsWith('/', route('page.show', ['slug' => 'about-us']));
    }

    #[Test]
    public function unslashed_public_urls_receive_a_single_301(): void
    {
        $this->get('/case-studies')
            ->assertStatus(301)
            ->assertRedirect('http://localhost/case-studies/');

        $this->get('/pressrelease')
            ->assertStatus(301)
            ->assertRedirect('http://localhost/pressrelease/');

        $this->get('/case-studies/page/2')
            ->assertStatus(301)
            ->assertRedirect('http://localhost/case-studies/page/2/');

        $this->get('/contact')
            ->assertStatus(301)
            ->assertRedirect('http://localhost/contact/');

        $this->get('/contact/')
            ->assertStatus(301)
            ->assertRedirect('http://localhost/contact-us/');

        $this->get('/contact/contact-us/')
            ->assertStatus(301)
            ->assertRedirect('http://localhost/contact-us/');
    }

    #[Test]
    public function slashed_listing_pages_render_trailing_slash_hrefs(): void
    {
        $this->withoutVite();

        PressRelease::query()->create([
            'title' => 'Pilot One',
            'slug' => 'pilot-one',
            'template' => 'default',
            'content' => [],
            'status' => 'published',
            'published_at' => now(),
        ]);

        CaseStudy::query()->create([
            'title' => 'Cloud Migration',
            'slug' => 'cloud-migration',
            'template' => 'default',
            'content' => [],
            'status' => 'published',
        ]);

        $pressListing = $this->get('/pressrelease/');
        $pressListing->assertOk();
        $pressListing->assertSee('href="'.route('pressrelease.index').'"', false);
        $pressListing->assertSee('href="'.route('pressrelease.show', 'pilot-one').'"', false);
        $pressListing->assertSee('href="'.route('case-studies.index').'"', false);

        $caseListing = $this->get('/case-studies/');
        $caseListing->assertOk();
        $caseListing->assertSee('href="'.route('case-studies.index').'"', false);
        $caseListing->assertSee('href="'.route('case-studies.show', 'cloud-migration').'"', false);
        $caseListing->assertSee('href="'.route('pressrelease.index').'"', false);

        $this->assertStringEndsWith('/pressrelease/', route('pressrelease.index'));
        $this->assertStringEndsWith('/pressrelease/pilot-one/', route('pressrelease.show', 'pilot-one'));
        $this->assertStringEndsWith('/case-studies/', route('case-studies.index'));
        $this->assertStringEndsWith('/case-studies/cloud-migration/', route('case-studies.show', 'cloud-migration'));

        $blog = $this->get('/blog/');
        $blog->assertOk();
        $blog->assertSee('href="'.route('blog.index').'"', false);
        $blog->assertSee('href="'.route('home').'"', false);
    }
}
