<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogCategoryPaginationTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_page_two_uses_a_pretty_url(): void
    {
        $this->withoutVite();
        $category = $this->createCategoryWithPosts(16);

        $response = $this->get('/blog/category/cybersecurity/page/2/');

        $response->assertOk();
        $response->assertSee('rel="canonical"', false);
        $response->assertSee('http://localhost/blog/category/cybersecurity/page/2/', false);
        $response->assertDontSee('?page=2', false);
        $response->assertSee('href="http://localhost/blog/category/cybersecurity/"', false);
    }

    public function test_legacy_query_page_redirects_to_the_pretty_url(): void
    {
        $this->withoutVite();
        $this->createCategoryWithPosts(16);

        $response = $this->get('/blog/category/cybersecurity/?page=2');

        $response->assertStatus(301);
        $this->assertSame(
            'http://localhost/blog/category/cybersecurity/page/2/',
            $response->headers->get('Location')
        );
    }

    public function test_query_page_one_and_path_page_one_redirect_to_the_category_url(): void
    {
        $this->withoutVite();
        $this->createCategoryWithPosts(1);

        $queryPageOne = $this->get('/blog/category/cybersecurity/?page=1');
        $queryPageOne->assertStatus(301);
        $this->assertSame(
            'http://localhost/blog/category/cybersecurity/',
            $queryPageOne->headers->get('Location')
        );

        $pathPageOne = $this->get('/blog/category/cybersecurity/page/1/');
        $pathPageOne->assertStatus(301);
        $this->assertSame(
            'http://localhost/blog/category/cybersecurity/',
            $pathPageOne->headers->get('Location')
        );
    }

    public function test_out_of_range_pretty_page_returns_not_found(): void
    {
        $this->withoutVite();
        $this->createCategoryWithPosts(1);

        $this->get('/blog/category/cybersecurity/page/3/')->assertNotFound();
    }

    protected function createCategoryWithPosts(int $count): Category
    {
        $category = Category::query()->create([
            'name' => 'Cybersecurity',
            'slug' => 'cybersecurity',
            'module' => Category::MODULE_BLOG,
        ]);

        for ($i = 1; $i <= $count; $i++) {
            Blog::query()->create([
                'title' => "Cybersecurity post {$i}",
                'slug' => "cybersecurity-post-{$i}",
                'template' => 'default',
                'content' => [],
                'category_id' => $category->id,
                'status' => 'published',
                'published_at' => now()->subMinutes($i),
            ]);
        }

        return $category;
    }
}
