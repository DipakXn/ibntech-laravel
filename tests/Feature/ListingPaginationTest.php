<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\PressRelease;
use App\Models\WhitePaper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ListingPaginationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{0: class-string, 1: string}>
     */
    public static function listings(): array
    {
        return [
            'articles' => [Article::class, 'articles'],
            'case-studies' => [CaseStudy::class, 'case-studies'],
            'ebooks' => [Ebook::class, 'ebooks'],
            'press-releases' => [PressRelease::class, 'pressrelease'],
            'white-papers' => [WhitePaper::class, 'white-papers'],
        ];
    }

    #[DataProvider('listings')]
    public function test_page_two_uses_a_pretty_url(string $modelClass, string $prefix): void
    {
        $this->withoutVite();
        $this->createPublishedItems($modelClass, 10);

        $response = $this->get("/{$prefix}/page/2/");

        $response->assertOk();
        $response->assertSee('rel="canonical"', false);
        $response->assertSee("http://localhost/{$prefix}/page/2/", false);
        $response->assertDontSee('?page=2', false);
        $response->assertSee("href=\"http://localhost/{$prefix}/\"", false);
    }

    #[DataProvider('listings')]
    public function test_legacy_query_page_redirects_to_the_pretty_url(string $modelClass, string $prefix): void
    {
        $this->withoutVite();
        $this->createPublishedItems($modelClass, 10);

        $response = $this->get("/{$prefix}/?page=2");

        $response->assertStatus(301);
        $this->assertSame(
            "http://localhost/{$prefix}/page/2/",
            $response->headers->get('Location')
        );
    }

    #[DataProvider('listings')]
    public function test_query_page_one_and_path_page_one_redirect_to_the_index_url(string $modelClass, string $prefix): void
    {
        $this->withoutVite();
        $this->createPublishedItems($modelClass, 1);

        $queryPageOne = $this->get("/{$prefix}/?page=1");
        $queryPageOne->assertStatus(301);
        $this->assertSame(
            "http://localhost/{$prefix}/",
            $queryPageOne->headers->get('Location')
        );

        $pathPageOne = $this->get("/{$prefix}/page/1/");
        $pathPageOne->assertStatus(301);
        $this->assertSame(
            "http://localhost/{$prefix}/",
            $pathPageOne->headers->get('Location')
        );
    }

    #[DataProvider('listings')]
    public function test_out_of_range_pretty_page_returns_not_found(string $modelClass, string $prefix): void
    {
        $this->withoutVite();
        $this->createPublishedItems($modelClass, 1);

        $this->get("/{$prefix}/page/3/")->assertNotFound();
    }

    /**
     * @param  class-string  $modelClass
     */
    protected function createPublishedItems(string $modelClass, int $count): void
    {
        for ($i = 1; $i <= $count; $i++) {
            $modelClass::query()->create([
                'title' => "Published item {$i}",
                'slug' => "published-item-{$i}",
                'template' => 'default',
                'content' => [],
                'status' => 'published',
            ]);
        }
    }
}
