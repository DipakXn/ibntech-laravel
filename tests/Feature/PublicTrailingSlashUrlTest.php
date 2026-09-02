<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\PressRelease;
use App\Support\PathPageUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
