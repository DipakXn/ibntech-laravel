<?php

namespace Tests\Feature;

use App\Models\LandingPage;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ImageAltMaxLengthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{path: string, type: 'page'|'landing', slug: string, template: string, title: string}>
     */
    public static function publicPagesWithImages(): array
    {
        return [
            'cybersecurity-maturity-assessment-services' => [[
                'path' => '/cybersecurity-maturity-assessment-services/',
                'type' => 'page',
                'slug' => 'cybersecurity-maturity-assessment-services',
                'template' => 'cybersecurity-maturity-assessment-services',
                'title' => 'Cybersecurity Maturity Assessment Services',
            ]],
            'ai-consulting-services' => [[
                'path' => '/ai-consulting-services/',
                'type' => 'page',
                'slug' => 'ai-consulting-services',
                'template' => 'ai-consulting-services',
                'title' => 'AI Consulting Services',
            ]],
            'real-estate-and-construction-engineering-services' => [[
                'path' => '/real-estate-and-construction-engineering-services/',
                'type' => 'page',
                'slug' => 'real-estate-and-construction-engineering-services',
                'template' => 'real-estate-and-construction-engineering-services',
                'title' => 'Real Estate and Construction Engineering Services',
            ]],
            'cloud-managed-services' => [[
                'path' => '/cloud-managed-services/',
                'type' => 'page',
                'slug' => 'cloud-managed-services',
                'template' => 'cloud-managed-services',
                'title' => 'Cloud Managed Services',
            ]],
            'tax-preparation-services-uk' => [[
                'path' => '/tax-preparation-services-uk/',
                'type' => 'page',
                'slug' => 'tax-preparation-services-uk',
                'template' => 'tax-preparation-services-uk',
                'title' => 'Tax Preparation Services UK',
            ]],
            'vapt-audit-services-lp' => [[
                'path' => '/lp/vapt-audit-services/',
                'type' => 'landing',
                'slug' => 'vapt-audit-services',
                'template' => 'vapt-audit-services',
                'title' => 'VAPT Audit Services',
            ]],
            'managed-soc-services-lp' => [[
                'path' => '/lp/managed-soc-services/',
                'type' => 'landing',
                'slug' => 'managed-soc-services',
                'template' => 'managed-soc-services',
                'title' => 'Managed SOC Services',
            ]],
        ];
    }

    /**
     * @param  array{path: string, type: 'page'|'landing', slug: string, template: string, title: string}  $routeData
     */
    #[DataProvider('publicPagesWithImages')]
    public function test_rendered_images_have_alt_text_at_most_100_characters(array $routeData): void
    {
        $this->withoutVite();

        if ($routeData['type'] === 'page') {
            Page::query()->create([
                'title' => $routeData['title'],
                'slug' => $routeData['slug'],
                'template' => $routeData['template'],
                'status' => 'published',
            ]);
        } else {
            LandingPage::query()->create([
                'title' => $routeData['title'],
                'slug' => $routeData['slug'],
                'template' => $routeData['template'],
                'status' => 'published',
            ]);
        }

        $response = $this->followingRedirects()->get($routeData['path']);
        $response->assertOk();

        $violations = $this->findAltLengthViolations($response->getContent());

        $this->assertSame(
            [],
            $violations,
            'Images with alt text over 100 characters: '.json_encode($violations, JSON_PRETTY_PRINT)
        );
    }

    /**
     * @return list<array{src: string, alt: string, length: int}>
     */
    private function findAltLengthViolations(string $html): array
    {
        if (! preg_match_all('/<img\b[^>]*>/i', $html, $matches)) {
            return [];
        }

        $violations = [];

        foreach ($matches[0] as $tag) {
            if (! preg_match('/\bsrc\s*=\s*["\']([^"\']+)["\']/i', $tag, $srcMatch)) {
                continue;
            }

            if (! preg_match('/\balt\s*=\s*["\']([^"\']*)["\']/i', $tag, $altMatch)) {
                continue;
            }

            $alt = html_entity_decode(trim($altMatch[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8');

            if ($alt === '') {
                continue;
            }

            $length = mb_strlen($alt);

            if ($length > 100) {
                $violations[] = [
                    'src' => $srcMatch[1],
                    'alt' => $alt,
                    'length' => $length,
                ];
            }
        }

        return $violations;
    }
}
