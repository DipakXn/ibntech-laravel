<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\Category;
use App\Support\BlogContactModalCampaign;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BlogContactModalCampaignTest extends TestCase
{
    #[DataProvider('matchingSlugProvider')]
    public function test_resolves_campaign_for_category_slug(string $slug, string $expectedTitle): void
    {
        $category = new Category([
            'name' => ucfirst($slug),
            'slug' => $slug,
            'module' => Category::MODULE_BLOG,
        ]);

        $blog = new Blog(['title' => 'Test post']);
        $blog->setRelation('category', $category);

        $campaign = BlogContactModalCampaign::forBlog($blog);

        $this->assertNotNull($campaign);
        $this->assertSame($slug, $campaign['slug']);
        $this->assertSame($expectedTitle, $campaign['title']);
        $this->assertNotSame('', $campaign['subtitle']);
    }

    /**
     * @return array<string, array{0: string, 1: string}>
     */
    public static function matchingSlugProvider(): array
    {
        return [
            'msoc' => ['msoc', BlogContactModalCampaign::CONTENT_BY_SLUG['msoc']['title']],
            'soc-2' => ['soc-2', BlogContactModalCampaign::CONTENT_BY_SLUG['soc-2']['title']],
            'vapt' => ['vapt', BlogContactModalCampaign::CONTENT_BY_SLUG['vapt']['title']],
        ];
    }

    public function test_child_category_inherits_parent_campaign_by_slug_chain(): void
    {
        $parent = new Category([
            'name' => 'VAPT',
            'slug' => 'vapt',
            'module' => Category::MODULE_BLOG,
        ]);
        $parent->id = 1;

        $child = new Category([
            'name' => 'Web App Testing',
            'slug' => 'web-app-vapt',
            'module' => Category::MODULE_BLOG,
            'parent_id' => 1,
        ]);
        $child->setRelation('parent', $parent);

        $blog = new Blog(['title' => 'Nested category post']);
        $blog->setRelation('category', $child);

        $campaign = BlogContactModalCampaign::forBlog($blog);

        $this->assertSame('vapt', $campaign['slug'] ?? null);
    }

    public function test_msoc_wins_when_multiple_priority_slugs_appear_in_chain(): void
    {
        $msoc = new Category([
            'name' => 'mSOC',
            'slug' => 'msoc',
            'module' => Category::MODULE_BLOG,
        ]);
        $msoc->id = 10;

        $child = new Category([
            'name' => 'Nested',
            'slug' => 'vapt',
            'module' => Category::MODULE_BLOG,
            'parent_id' => 10,
        ]);
        $child->setRelation('parent', $msoc);

        $blog = new Blog(['title' => 'Priority test']);
        $blog->setRelation('category', $child);

        $campaign = BlogContactModalCampaign::forBlog($blog);

        $this->assertSame('msoc', $campaign['slug'] ?? null);
    }

    public function test_returns_null_for_unrelated_category(): void
    {
        $category = new Category([
            'name' => 'Cybersecurity',
            'slug' => 'cybersecurity',
            'module' => Category::MODULE_BLOG,
        ]);

        $blog = new Blog(['title' => 'General post']);
        $blog->setRelation('category', $category);

        $this->assertNull(BlogContactModalCampaign::forBlog($blog));
    }

    public function test_returns_null_when_blog_has_no_category(): void
    {
        $blog = new Blog(['title' => 'Uncategorized']);

        $this->assertNull(BlogContactModalCampaign::forBlog($blog));
    }
}
