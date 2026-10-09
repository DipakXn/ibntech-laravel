<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\WhitePaper;
use App\Support\Html\SafeHtml;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class SmoothScrollToSectionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return list<array{type: string, data: array<string, mixed>}>
     */
    protected function scrollDemoBlocks(): array
    {
        return [
            [
                'type' => 'paragraph',
                'data' => [
                    'content' => '<p><a href="#" data-scroll-target="download-form">Download the guide</a></p><p><button type="button" data-scroll-target="contact-section">Talk to us</button></p>',
                ],
            ],
            [
                'type' => 'paragraph',
                'data' => [
                    'content' => '<section data-scroll-anchor="download-form"><p>Download form landmark</p></section><section data-scroll-anchor="contact-section"><p>Contact landmark</p></section>',
                ],
            ],
        ];
    }

    protected function assertRendersOptInScrollMarkup(TestResponse $response): void
    {
        $response->assertOk();
        $response->assertSee('data-scroll-target="download-form"', false);
        $response->assertSee('data-scroll-target="contact-section"', false);
        $response->assertSee('data-scroll-anchor="download-form"', false);
        $response->assertSee('data-scroll-anchor="contact-section"', false);
        $this->assertSame(1, substr_count($response->getContent(), 'data-scroll-anchor="download-form"'));
        $this->assertSame(1, substr_count($response->getContent(), 'data-scroll-anchor="contact-section"'));
        $response->assertDontSee('id="download-form"', false);
        $response->assertDontSee('id="contact-section"', false);
    }

    public function test_safe_html_keeps_scroll_data_attributes_for_content_builder_blocks(): void
    {
        $html = '<a href="#" data-scroll-target="download-form">Download</a><section data-scroll-anchor="download-form">Form</section>';

        $sanitized = SafeHtml::sanitizeForRender($html);

        $this->assertStringContainsString('data-scroll-target="download-form"', $sanitized);
        $this->assertStringContainsString('data-scroll-anchor="download-form"', $sanitized);
    }

    public function test_existing_page_hash_links_are_unchanged(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Invoice Process Automation',
            'slug' => 'invoice-process-automation',
            'template' => 'invoice-process-automation',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/invoice-process-automation/');

        $response->assertOk();
        $response->assertSee('href="#inva-form"', false);
        $response->assertSee('id="inva-form"', false);
        $response->assertDontSee('data-scroll-target="inva-form"', false);
        $response->assertDontSee('data-scroll-anchor="inva-form"', false);
        $this->assertSame(4, substr_count($response->getContent(), 'href="#inva-form"'));
    }

    public function test_existing_industry_hash_links_are_unchanged(): void
    {
        $this->withoutVite();

        Industry::query()->create([
            'title' => 'Real Estate and Construction',
            'slug' => 'real-estate-and-construction',
            'template' => 'real-estate-and-construction',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/industry/real-estate-and-construction/');

        $response->assertOk();
        $response->assertSee('href="#rec-assessment"', false);
        $response->assertDontSee('data-scroll-target="rec-assessment"', false);
    }

    public function test_existing_landing_page_hash_links_are_unchanged(): void
    {
        $this->withoutVite();

        LandingPage::query()->create([
            'title' => 'VAPT Audit Services',
            'slug' => 'vapt-audit-services',
            'template' => 'vapt-audit-services',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/lp/vapt-audit-services/');

        $response->assertOk();
        $response->assertSee('href="#lvas-consult"', false);
        $response->assertDontSee('data-scroll-target="lvas-consult"', false);
    }

    public function test_newsletter_pages_do_not_receive_automatic_scroll_attributes(): void
    {
        $this->withoutVite();

        Newsletter::query()->create([
            'title' => 'vCISO as a Service',
            'slug' => 'vciso-as-a-service',
            'template' => 'vciso-as-a-service',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/newsletter/vciso-as-a-service/');

        $response->assertOk();
        $response->assertDontSee('data-scroll-target=', false);
        $response->assertDontSee('data-scroll-anchor=', false);
    }

    public function test_content_builder_blog_renders_opt_in_scroll_attributes(): void
    {
        $this->withoutVite();

        $category = Category::query()->create([
            'name' => 'General',
            'slug' => 'general-blog',
            'module' => Category::MODULE_BLOG,
        ]);

        Blog::query()->create([
            'title' => 'Scroll Utility Blog',
            'slug' => 'scroll-utility-blog',
            'template' => 'default',
            'content' => $this->scrollDemoBlocks(),
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertRendersOptInScrollMarkup(
            $this->followingRedirects()->get('/blog/scroll-utility-blog/')
        );
    }

    public function test_content_builder_article_renders_opt_in_scroll_attributes(): void
    {
        $this->withoutVite();

        Article::query()->create([
            'title' => 'Scroll Utility Article',
            'slug' => 'scroll-utility-article',
            'template' => 'default',
            'content' => $this->scrollDemoBlocks(),
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertRendersOptInScrollMarkup(
            $this->followingRedirects()->get('/article/scroll-utility-article/')
        );
    }

    public function test_content_builder_case_study_renders_opt_in_scroll_attributes(): void
    {
        $this->withoutVite();

        CaseStudy::query()->create([
            'title' => 'Scroll Utility Case Study',
            'slug' => 'scroll-utility-case-study',
            'template' => 'default',
            'content' => $this->scrollDemoBlocks(),
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertRendersOptInScrollMarkup(
            $this->followingRedirects()->get('/case-study/scroll-utility-case-study/')
        );
    }

    public function test_content_builder_press_release_renders_opt_in_scroll_attributes(): void
    {
        $this->withoutVite();

        PressRelease::query()->create([
            'title' => 'Scroll Utility Press Release',
            'slug' => 'scroll-utility-press-release',
            'template' => 'default',
            'content' => $this->scrollDemoBlocks(),
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertRendersOptInScrollMarkup(
            $this->followingRedirects()->get('/pressrelease/scroll-utility-press-release/')
        );
    }

    public function test_content_builder_ebook_renders_opt_in_scroll_attributes(): void
    {
        $this->withoutVite();

        Ebook::query()->create([
            'title' => 'Scroll Utility Ebook',
            'slug' => 'scroll-utility-ebook',
            'template' => 'default',
            'content' => $this->scrollDemoBlocks(),
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertRendersOptInScrollMarkup(
            $this->followingRedirects()->get('/ebook/scroll-utility-ebook/')
        );
    }

    public function test_content_builder_white_paper_renders_opt_in_scroll_attributes(): void
    {
        $this->withoutVite();

        WhitePaper::query()->create([
            'title' => 'Scroll Utility White Paper',
            'slug' => 'scroll-utility-white-paper',
            'template' => 'default',
            'content' => $this->scrollDemoBlocks(),
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertRendersOptInScrollMarkup(
            $this->followingRedirects()->get('/whitepapers/scroll-utility-white-paper/')
        );
    }
}
