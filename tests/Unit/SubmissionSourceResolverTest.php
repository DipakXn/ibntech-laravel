<?php

namespace Tests\Unit;

use App\Models\Ebook;
use App\Models\Page;
use App\Services\Analytics\SubmissionSource;
use App\Services\Analytics\SubmissionSourceResolver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubmissionSourceResolverTest extends TestCase
{
    use RefreshDatabase;

    private SubmissionSourceResolver $sources;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sources = app(SubmissionSourceResolver::class);
    }

    public function test_blank_livewire_and_non_public_urls_stay_unattributed(): void
    {
        foreach ([null, '', '   ', 'https://example.com/livewire/update', '/livewire-abc/update', 'javascript:alert(1)', 'https://example.com/admin/visitor-analytics', 'https://example.com/images/logo.png'] as $url) {
            $source = $this->sources->resolve($url);

            $this->assertSame(SubmissionSource::UNAVAILABLE, $source->kind, (string) $url);
            $this->assertNull($source->key());
        }
    }

    public function test_listing_paths_and_unknown_records_stay_on_the_path(): void
    {
        $listing = $this->sources->resolve('https://example.com/blog/?page=2');
        $missingPage = $this->sources->resolve('/missing-page/');
        $missingDownload = $this->sources->resolve('https://example.com/ebook/missing-guide/download');

        $this->assertSame(SubmissionSource::PATH, $listing->kind);
        $this->assertSame('/blog', $listing->path);
        $this->assertSame('path:/blog', $listing->key());
        $this->assertSame('/missing-page', $missingPage->path);
        $this->assertSame('/ebook/missing-guide/download', $missingDownload->path);
    }

    public function test_a_matching_public_url_resolves_to_the_published_record(): void
    {
        $page = Page::query()->create([
            'title' => 'About us',
            'slug' => 'about-us',
            'template' => 'about',
            'status' => 'published',
        ]);
        $home = Page::query()->create([
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'home',
            'status' => 'published',
        ]);
        $ebook = Ebook::query()->create([
            'title' => 'Guide',
            'slug' => 'guide',
            'template' => 'default',
            'content' => [],
            'status' => 'published',
            'published_at' => now(),
        ]);
        Page::query()->create([
            'title' => 'Draft',
            'slug' => 'draft-page',
            'template' => 'about',
            'status' => 'draft',
        ]);

        $about = $this->sources->resolve('https://evil.example/about-us/?utm=1');
        $root = $this->sources->resolve('https://example.com/');
        $download = $this->sources->resolve('https://example.com/ebook/guide/download');
        $draft = $this->sources->resolve('https://example.com/draft-page');

        $this->assertSame(SubmissionSource::CONTENT, $about->kind);
        $this->assertSame('page', $about->contentType);
        $this->assertSame($page->id, $about->contentId);
        $this->assertSame('/about-us', $about->path);
        $this->assertSame($home->id, $root->contentId);
        $this->assertSame('ebook', $download->contentType);
        $this->assertSame($ebook->id, $download->contentId);
        $this->assertSame(SubmissionSource::PATH, $draft->kind);
        $this->assertSame('/draft-page', $draft->path);
        $this->assertTrue($this->sources->isGatedDownload('ebook_download'));
        $this->assertTrue($this->sources->isGatedDownload('case_study_download'));
        $this->assertFalse($this->sources->isGatedDownload('contact'));
    }
}
