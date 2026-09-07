<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Repositories\ArticleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookkeepingServicesTexasArticlesTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_latest_three_published_articles(): void
    {
        Page::query()->create([
            'slug' => 'bookkeeping-services-texas',
            'title' => 'Top-Rated Bookkeeping Services in Texas',
            'template' => 'bookkeeping-services-texas',
            'status' => 'published',
        ]);

        $category = Category::query()->create([
            'name' => 'Finance & Accounting',
            'slug' => 'finance-and-accounting-articles',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $article1 = Article::query()->create([
            'title' => 'Outsourced Bookkeeping Services in Texas Market Analysis',
            'slug' => 'outsourced-bookkeeping-services-in-texas-market-analysis',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(3),
            'content' => 'Content of article 1',
        ]);

        $article2 = Article::query()->create([
            'title' => 'Tax Filing Guide for Growing Texas Small Businesses',
            'slug' => 'tax-filing-guide-texas-businesses',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'content' => 'Content of article 2',
        ]);

        $article3 = Article::query()->create([
            'title' => 'Finance and Accounting Competitive Advantage in 2026',
            'slug' => 'finance-accounting-competitive-advantage-2026',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDay(),
            'content' => 'Content of article 3',
        ]);

        $response = $this->get('/bookkeeping-services-texas/');

        $response->assertOk();
        $response->assertSee('Recent Articles');
        $response->assertSee('Outsourced Bookkeeping Services in Texas Market Analysis');
        $response->assertSee(route('articles.show', $article1->slug));
        $response->assertSee('Tax Filing Guide for Growing Texas Small Businesses');
        $response->assertSee(route('articles.show', $article2->slug));
        $response->assertSee('Finance and Accounting Competitive Advantage in 2026');
        $response->assertSee(route('articles.show', $article3->slug));
        $response->assertSee('Article');
    }

    public function test_excludes_draft_articles(): void
    {
        Page::query()->create([
            'slug' => 'bookkeeping-services-texas',
            'title' => 'Top-Rated Bookkeeping Services in Texas',
            'template' => 'bookkeeping-services-texas',
            'status' => 'published',
        ]);

        $publishedArticle = Article::query()->create([
            'title' => 'Published Texas Article',
            'slug' => 'published-texas-article',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDay(),
            'content' => 'Published content',
        ]);

        Article::query()->create([
            'title' => 'Draft Texas Article',
            'slug' => 'draft-texas-article',
            'template' => 'default',
            'status' => 'draft',
            'published_at' => now(),
            'content' => 'Draft content',
        ]);

        $response = $this->get('/bookkeeping-services-texas/');

        $response->assertOk();
        $response->assertSee('Published Texas Article');
        $response->assertSee(route('articles.show', $publishedArticle->slug));
        $response->assertDontSee('Draft Texas Article');
    }

    public function test_enforces_limit_of_three_in_latest_order(): void
    {
        Page::query()->create([
            'slug' => 'bookkeeping-services-texas',
            'title' => 'Top-Rated Bookkeeping Services in Texas',
            'template' => 'bookkeeping-services-texas',
            'status' => 'published',
        ]);

        $oldest = Article::query()->create([
            'title' => 'Article One (Oldest)',
            'slug' => 'article-one-oldest',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Oldest content',
        ]);

        $articleTwo = Article::query()->create([
            'title' => 'Article Two',
            'slug' => 'article-two',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'content' => 'Article two content',
        ]);

        $articleThree = Article::query()->create([
            'title' => 'Article Three',
            'slug' => 'article-three',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'content' => 'Article three content',
        ]);

        $latest = Article::query()->create([
            'title' => 'Article Four (Latest)',
            'slug' => 'article-four-latest',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subHour(),
            'content' => 'Latest content',
        ]);

        $response = $this->get('/bookkeeping-services-texas/');

        $response->assertOk();
        $response->assertSee('Article Four (Latest)');
        $response->assertSee(route('articles.show', $latest->slug));
        $response->assertSee('Article Three');
        $response->assertSee(route('articles.show', $articleThree->slug));
        $response->assertSee('Article Two');
        $response->assertSee(route('articles.show', $articleTwo->slug));

        // Limit of 3 must exclude the 4th (oldest)
        $response->assertDontSee('Article One (Oldest)');
        $response->assertDontSee(route('articles.show', $oldest->slug));
    }

    public function test_recent_articles_section_is_placed_above_testimonials_section(): void
    {
        Page::query()->create([
            'slug' => 'bookkeeping-services-texas',
            'title' => 'Top-Rated Bookkeeping Services in Texas',
            'template' => 'bookkeeping-services-texas',
            'status' => 'published',
        ]);

        Article::query()->create([
            'title' => 'Strategic Bookkeeping for Texas Enterprises',
            'slug' => 'strategic-bookkeeping-texas-enterprises',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now(),
            'content' => 'Strategic bookkeeping content',
        ]);

        $response = $this->get('/bookkeeping-services-texas/');

        $response->assertOk();

        $content = $response->getContent();
        $articlesPos = strpos($content, 'id="bktx-articles-title"');
        $testimonialsPos = strpos($content, 'id="bktx-testimonials-title"');

        $this->assertNotFalse($articlesPos, 'Recent Articles section heading must exist');
        $this->assertNotFalse($testimonialsPos, 'Testimonials section heading must exist');
        $this->assertLessThan(
            $testimonialsPos,
            $articlesPos,
            'Recent Articles section must appear ABOVE the Testimonials section'
        );
    }

    public function test_articles_section_is_omitted_when_no_published_articles_exist(): void
    {
        Page::query()->create([
            'slug' => 'bookkeeping-services-texas',
            'title' => 'Top-Rated Bookkeeping Services in Texas',
            'template' => 'bookkeeping-services-texas',
            'status' => 'published',
        ]);

        $response = $this->get('/bookkeeping-services-texas/');

        $response->assertOk();
        $response->assertDontSee('id="bktx-articles-title"', false);
    }

    public function test_article_repository_latest_published_eager_loads_relations_without_n_plus_one(): void
    {
        $category = Category::query()->create([
            'name' => 'Accounting',
            'slug' => 'accounting-articles',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        Article::query()->create([
            'title' => 'Article Alpha',
            'slug' => 'article-alpha',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'content' => 'Alpha content',
        ]);

        Article::query()->create([
            'title' => 'Article Beta',
            'slug' => 'article-beta',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'content' => 'Beta content',
        ]);

        $repository = app(ArticleRepository::class);
        $articles = $repository->latestPublished(3);

        $this->assertCount(2, $articles);
        foreach ($articles as $article) {
            $this->assertTrue($article->relationLoaded('category'), 'category relation must be eager-loaded');
            $this->assertTrue($article->relationLoaded('media'), 'media relation must be eager-loaded');
        }
    }
}
