<?php

namespace Tests\Feature;

use App\Models\LandingPage;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ImageAltTextTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{slug: string, template: string, title: string}>
     */
    public static function staticPagesWithImages(): array
    {
        return [
            'vapt-services' => [[
                'slug' => 'vapt-services',
                'template' => 'vapt-services',
                'title' => 'VAPT Services',
            ]],
            'about-ibn' => [[
                'slug' => 'about-ibn',
                'template' => 'about-ibn',
                'title' => 'About IBN',
            ]],
            'ap-ar-automation' => [[
                'slug' => 'ap-ar-automation',
                'template' => 'ap-ar-automation',
                'title' => 'AP AR Automation',
            ]],
            'bookkeeping-services' => [[
                'slug' => 'bookkeeping-services',
                'template' => 'bookkeeping-services',
                'title' => 'Bookkeeping Services',
            ]],
            'faq' => [[
                'slug' => 'faq',
                'template' => 'faq',
                'title' => 'FAQ',
            ]],
        ];
    }

    /**
     * @param  array{slug: string, template: string, title: string}  $pageData
     */
    #[DataProvider('staticPagesWithImages')]
    public function test_static_pages_render_images_with_non_empty_alt_text(array $pageData): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => $pageData['title'],
            'slug' => $pageData['slug'],
            'template' => $pageData['template'],
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/'.$pageData['slug'].'/');

        $response->assertOk();
        $this->assertRenderedImagesHaveNonEmptyAlt($response->getContent());
    }

    public function test_vapt_landing_page_renders_images_with_non_empty_alt_text(): void
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
        $this->assertRenderedImagesHaveNonEmptyAlt($response->getContent());
    }

    private function assertRenderedImagesHaveNonEmptyAlt(string $html): void
    {
        if (! preg_match_all('/<img\b[^>]*>/i', $html, $matches)) {
            return;
        }

        foreach ($matches[0] as $tag) {
            $this->assertMatchesRegularExpression(
                '/\balt\s*=/i',
                $tag,
                'Rendered image is missing an alt attribute: '.$tag
            );

            preg_match('/\balt\s*=\s*["\']([^"\']*)["\']/i', $tag, $altMatch);
            $alt = trim($altMatch[1] ?? '');

            $this->assertNotSame(
                '',
                $alt,
                'Rendered image has an empty alt attribute: '.$tag
            );
        }
    }
}
