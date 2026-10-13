<?php

namespace Tests\Feature;

use App\Http\Middleware\EnsureTrailingSlash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ResourceListingHeroHeadingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{0: string, 1: string, 2: string}>
     */
    public static function listingHeroes(): array
    {
        return [
            'article' => [
                '/article',
                'Articles',
                'Editorial articles, explainers, and insight-led perspectives.',
            ],
            'ebook' => [
                '/ebook',
                'eBooks',
                'Downloadable guides built for migration and delivery teams.',
            ],
            'case-study' => [
                '/case-study',
                'Case Studies',
                'Proof of delivery, not brochure copy.',
            ],
            'whitepapers' => [
                '/whitepapers',
                'White Papers',
                'Research-driven white papers, reports, and strategic resources.',
            ],
            'pressrelease' => [
                '/pressrelease',
                'Press Releases',
                'Official company announcements, launches, and updates.',
            ],
        ];
    }

    #[Test]
    #[DataProvider('listingHeroes')]
    public function listing_hero_uses_eyebrow_h1_and_subtitle_h2(string $path, string $eyebrow, string $subtitle): void
    {
        $this->withoutVite();
        $this->withoutMiddleware(EnsureTrailingSlash::class);

        $response = $this->get($path);
        $response->assertOk();
        $response->assertSee('<h1 class="inner-hero__eyebrow">'.$eyebrow.'</h1>', false);
        $response->assertSee('<h2>'.$subtitle.'</h2>', false);
        $response->assertDontSee('<h1>'.$subtitle.'</h1>', false);
        $this->assertSame(1, substr_count($response->getContent(), '<h1'));
    }
}
