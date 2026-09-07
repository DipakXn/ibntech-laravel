<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\Page;
use App\Models\WhitePaper;
use App\Repositories\CaseStudyRepository;
use App\Repositories\EbookRepository;
use App\Repositories\WhitePaperRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeKnowledgeHubTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_latest_published_case_study_whitepaper_and_ebook_with_details(): void
    {
        Page::query()->create([
            'slug' => 'home',
            'title' => 'Home',
            'template' => 'home',
            'status' => 'published',
        ]);

        $category = Category::query()->create([
            'name' => 'General Content',
            'slug' => 'general-content-category',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $caseStudy = CaseStudy::query()->create([
            'title' => 'AWS RDS Modernization for AI Enterprises',
            'slug' => 'aws-rds-modernization-for-ai-enterprises',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDay(),
            'excerpt' => 'Leading AI-driven software enterprise cloud migration.',
            'featured_image' => 'https://example.com/case-study.jpg',
            'content' => 'Case study content',
        ]);

        $whitePaper = WhitePaper::query()->create([
            'title' => 'CFO Strategic Playbook for Financial Automation',
            'slug' => 'cfo-strategic-playbook-for-financial-automation',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subHours(12),
            'excerpt' => 'Essential strategies for financial officers in 2026.',
            'featured_image' => 'https://example.com/whitepaper.jpg',
            'content' => 'Whitepaper content',
        ]);

        $ebook = Ebook::query()->create([
            'title' => 'The Complete Tax Season Execution Blueprint',
            'slug' => 'the-complete-tax-season-execution-blueprint',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subHours(6),
            'excerpt' => 'Comprehensive playbook for streamlining tax operations.',
            'featured_image' => 'https://example.com/ebook.jpg',
            'content' => 'Ebook content',
        ]);

        $response = $this->get('/');

        $response->assertOk();

        // Verify Knowledge Hub section heading and Resource Library cards
        $response->assertSee('Knowledge');
        $response->assertSee('Hub');
        $response->assertSee('Case Studies');
        $response->assertSee('Whitepapers');
        $response->assertSee('eBooks');
        $response->assertSee('Explore Case Studies →');
        $response->assertSee('Explore Whitepapers →');
        $response->assertSee('Explore eBooks →');
        $response->assertDontSee('Featured Content');
        $response->assertSeeInOrder([
            'Case Studies',
            'AWS RDS Modernization for AI Enterprises',
            'Whitepapers',
            'CFO Strategic Playbook for Financial Automation',
            'eBooks',
            'The Complete Tax Season Execution Blueprint',
        ]);

        // Verify Case Study
        $response->assertSee('AWS RDS Modernization for AI Enterprises');
        $response->assertSee('Leading AI-driven software enterprise cloud migration.');
        $response->assertSee(route('case-studies.show', $caseStudy->slug));
        $response->assertSee('Read Case Study →');
        $response->assertSee('https://example.com/case-study.jpg');

        // Verify Whitepaper
        $response->assertSee('CFO Strategic Playbook for Financial Automation');
        $response->assertSee('Essential strategies for financial officers in 2026.');
        $response->assertSee(route('white-papers.show', $whitePaper->slug));
        $response->assertSee('Read Whitepaper →');
        $response->assertSee('https://example.com/whitepaper.jpg');

        // Verify eBook
        $response->assertSee('The Complete Tax Season Execution Blueprint');
        $response->assertSee('Comprehensive playbook for streamlining tax operations.');
        $response->assertSee(route('ebooks.show', $ebook->slug));
        $response->assertSee('Read eBook →');
        $response->assertSee('https://example.com/ebook.jpg');
    }

    public function test_excludes_draft_items_from_featured_content(): void
    {
        Page::query()->create([
            'slug' => 'home',
            'title' => 'Home',
            'template' => 'home',
            'status' => 'published',
        ]);

        $publishedCaseStudy = CaseStudy::query()->create([
            'title' => 'Published Case Study Title',
            'slug' => 'published-case-study-title',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDay(),
            'content' => 'Published content',
        ]);

        CaseStudy::query()->create([
            'title' => 'Draft Case Study Title',
            'slug' => 'draft-case-study-title',
            'template' => 'default',
            'status' => 'draft',
            'published_at' => now(),
            'content' => 'Draft content',
        ]);

        WhitePaper::query()->create([
            'title' => 'Draft Whitepaper Title',
            'slug' => 'draft-whitepaper-title',
            'template' => 'default',
            'status' => 'draft',
            'published_at' => now(),
            'content' => 'Draft content',
        ]);

        Ebook::query()->create([
            'title' => 'Draft eBook Title',
            'slug' => 'draft-ebook-title',
            'template' => 'default',
            'status' => 'draft',
            'published_at' => now(),
            'content' => 'Draft content',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Published Case Study Title');
        $response->assertSee(route('case-studies.show', $publishedCaseStudy->slug));

        $response->assertDontSee('Draft Case Study Title');
        $response->assertDontSee('Draft Whitepaper Title');
        $response->assertDontSee('Draft eBook Title');
    }

    public function test_displays_only_most_recent_published_item_for_each_content_type(): void
    {
        Page::query()->create([
            'slug' => 'home',
            'title' => 'Home',
            'template' => 'home',
            'status' => 'published',
        ]);

        // Older and newer Case Study
        CaseStudy::query()->create([
            'title' => 'Older Case Study',
            'slug' => 'older-case-study',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Older content',
        ]);
        $latestCaseStudy = CaseStudy::query()->create([
            'title' => 'Latest Case Study',
            'slug' => 'latest-case-study',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDays(1),
            'content' => 'Latest content',
        ]);

        // Older and newer Whitepaper
        WhitePaper::query()->create([
            'title' => 'Older Whitepaper',
            'slug' => 'older-whitepaper',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Older content',
        ]);
        $latestWhitePaper = WhitePaper::query()->create([
            'title' => 'Latest Whitepaper',
            'slug' => 'latest-whitepaper',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDays(1),
            'content' => 'Latest content',
        ]);

        // Older and newer eBook
        Ebook::query()->create([
            'title' => 'Older eBook',
            'slug' => 'older-ebook',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Older content',
        ]);
        $latestEbook = Ebook::query()->create([
            'title' => 'Latest eBook',
            'slug' => 'latest-ebook',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDays(1),
            'content' => 'Latest content',
        ]);

        $response = $this->get('/');

        $response->assertOk();

        // Must see latest items
        $response->assertSee('Latest Case Study');
        $response->assertSee(route('case-studies.show', $latestCaseStudy->slug));
        $response->assertSee('Latest Whitepaper');
        $response->assertSee(route('white-papers.show', $latestWhitePaper->slug));
        $response->assertSee('Latest eBook');
        $response->assertSee(route('ebooks.show', $latestEbook->slug));

        // Must not see older items
        $response->assertDontSee('Older Case Study');
        $response->assertDontSee('Older Whitepaper');
        $response->assertDontSee('Older eBook');
    }

    public function test_repositories_eager_load_media_and_category_without_n_plus_one(): void
    {
        $category = Category::query()->create([
            'name' => 'General Content',
            'slug' => 'general-content-eager',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        CaseStudy::query()->create([
            'title' => 'Case Study Alpha',
            'slug' => 'case-study-alpha',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'content' => 'Content',
        ]);

        WhitePaper::query()->create([
            'title' => 'Whitepaper Alpha',
            'slug' => 'whitepaper-alpha',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'content' => 'Content',
        ]);

        Ebook::query()->create([
            'title' => 'Ebook Alpha',
            'slug' => 'ebook-alpha',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'content' => 'Content',
        ]);

        $cs = app(CaseStudyRepository::class)->latestPublished(1)->first();
        $wp = app(WhitePaperRepository::class)->latestPublished(1)->first();
        $eb = app(EbookRepository::class)->latestPublished(1)->first();

        $this->assertNotNull($cs);
        $this->assertTrue($cs->relationLoaded('category'));
        $this->assertTrue($cs->relationLoaded('media'));

        $this->assertNotNull($wp);
        $this->assertTrue($wp->relationLoaded('category'));
        $this->assertTrue($wp->relationLoaded('media'));

        $this->assertNotNull($eb);
        $this->assertTrue($eb->relationLoaded('category'));
        $this->assertTrue($eb->relationLoaded('media'));
    }
}
