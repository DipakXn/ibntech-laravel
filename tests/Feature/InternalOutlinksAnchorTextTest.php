<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Page;
use DOMDocument;
use DOMElement;
use DOMXPath;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class InternalOutlinksAnchorTextTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{path: string, slug: string, template: string, title: string}>
     */
    public static function pagesToCheck(): array
    {
        return [
            'home' => [[
                'path' => '/',
                'slug' => 'home',
                'template' => 'home',
                'title' => 'Home',
            ]],
            'legal-bookkeeping-services' => [[
                'path' => '/legal-bookkeeping-services/',
                'slug' => 'legal-bookkeeping-services',
                'template' => 'legal-bookkeeping-services',
                'title' => 'Legal Bookkeeping Services',
            ]],
            'accounting-services-for-small-business' => [[
                'path' => '/accounting-services-for-small-business/',
                'slug' => 'accounting-services-for-small-business',
                'template' => 'accounting-services-for-small-business',
                'title' => 'Accounting Services for Small Business',
            ]],
        ];
    }

    /**
     * @param  array{path: string, slug: string, template: string, title: string}  $pageData
     */
    #[DataProvider('pagesToCheck')]
    public function test_internal_outlinks_have_seo_anchor_text(array $pageData): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => $pageData['title'],
            'slug' => $pageData['slug'],
            'template' => $pageData['template'],
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get($pageData['path']);
        $response->assertOk();

        $offenders = $this->findInternalLinksWithoutSeoAnchorText($response->getContent());

        $this->assertSame(
            [],
            $offenders,
            "Internal links without SEO anchor text on {$pageData['path']}:\n".implode("\n", $offenders)
        );
    }

    /**
     * @param  array{path: string, slug: string, template: string, title: string}  $pageData
     */
    #[DataProvider('pagesToCheck')]
    public function test_internal_outlinks_have_accessible_names(array $pageData): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => $pageData['title'],
            'slug' => $pageData['slug'],
            'template' => $pageData['template'],
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get($pageData['path']);
        $response->assertOk();

        $offenders = $this->findInternalLinksWithoutAccessibleName($response->getContent());

        $this->assertSame(
            [],
            $offenders,
            "Internal links without accessible names on {$pageData['path']}:\n".implode("\n", $offenders)
        );
    }

    public function test_home_knowledge_hub_featured_media_links_have_anchor_text_when_featured_image_is_missing(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'home',
            'status' => 'published',
        ]);

        CaseStudy::query()->create([
            'title' => 'Trust Account Compliance Playbook',
            'slug' => 'trust-account-compliance-playbook',
            'template' => 'default',
            'status' => 'published',
            'published_at' => now()->subDay(),
            'excerpt' => 'A practical guide for legal finance teams.',
            'featured_image' => null,
            'content' => 'Case study content',
        ]);

        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('<span class="sr-only">Trust Account Compliance Playbook</span>', false);

        $offenders = $this->findInternalLinksWithoutSeoAnchorText($response->getContent());

        $this->assertSame([], $offenders);
    }

    public function test_accounting_services_for_small_business_uses_descriptive_service_anchor_text(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Accounting Services for Small Business',
            'slug' => 'accounting-services-for-small-business',
            'template' => 'accounting-services-for-small-business',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/accounting-services-for-small-business/');
        $response->assertOk();

        $expected = [
            'Start a bookkeeping consultation',
            'Start an accounting software consultation',
            'Start an outsourcing consultation',
            'Start an order management consultation',
            'Start a tax consultation',
            'Start a cash flow consultation',
        ];

        $serviceLinks = $this->anchorTextsForHref($response->getContent(), '#contact-us-section');

        $this->assertSame($expected, $serviceLinks);

        $vague = $this->findVagueInternalAnchorText($response->getContent());

        $this->assertSame(
            [],
            $vague,
            "Vague internal anchor text on /accounting-services-for-small-business/:\n".implode("\n", $vague)
        );
    }

    /**
     * @return list<string>
     */
    private function findInternalLinksWithoutSeoAnchorText(string $html): array
    {
        return $this->findOffendingInternalLinks($html, fn (DOMElement $anchor): bool => $this->linkHasSeoAnchorText($anchor));
    }

    /**
     * @return list<string>
     */
    private function findInternalLinksWithoutAccessibleName(string $html): array
    {
        return $this->findOffendingInternalLinks($html, fn (DOMElement $anchor): bool => $this->linkHasAccessibleName($anchor));
    }

    /**
     * @param  callable(DOMElement): bool  $isValid
     * @return list<string>
     */
    private function findOffendingInternalLinks(string $html, callable $isValid): array
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">'.$html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $offenders = [];

        /** @var DOMElement $anchor */
        foreach ($xpath->query('//a[@href]') as $anchor) {
            $href = trim($anchor->getAttribute('href'));
            if ($href === '' || str_starts_with($href, '#') || str_starts_with($href, 'mailto:') || str_starts_with($href, 'tel:') || str_starts_with($href, 'javascript:')) {
                continue;
            }

            if (! $this->isInternalHref($href)) {
                continue;
            }

            if ($isValid($anchor)) {
                continue;
            }

            $snippet = preg_replace('/\s+/u', ' ', $dom->saveHTML($anchor) ?: '') ?? '';
            $offenders[] = $href.' => '.$snippet;
        }

        return $offenders;
    }

    private function isInternalHref(string $href): bool
    {
        return str_starts_with($href, '/')
            || str_starts_with($href, 'http://localhost')
            || str_contains($href, 'ibntech.com');
    }

    private function linkHasSeoAnchorText(DOMElement $anchor): bool
    {
        $text = trim(preg_replace('/\s+/u', ' ', $anchor->textContent ?? '') ?? '');
        if ($text !== '') {
            return true;
        }

        foreach ($anchor->getElementsByTagName('img') as $img) {
            if (trim($img->getAttribute('alt')) !== '') {
                return true;
            }
        }

        return false;
    }

    /**
     * @return list<string>
     */
    private function anchorTextsForHref(string $html, string $href): array
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">'.$html);
        libxml_clear_errors();

        $texts = [];

        /** @var DOMElement $anchor */
        foreach ((new DOMXPath($dom))->query('//a[@href]') as $anchor) {
            if ($anchor->getAttribute('href') !== $href) {
                continue;
            }

            $texts[] = trim(preg_replace('/\s+/u', ' ', $anchor->textContent ?? '') ?? '');
        }

        return $texts;
    }

    /**
     * @return list<string>
     */
    private function findVagueInternalAnchorText(string $html): array
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">'.$html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $offenders = [];

        /** @var DOMElement $anchor */
        foreach ($xpath->query('//a[@href]') as $anchor) {
            $href = trim($anchor->getAttribute('href'));
            if (! $this->isContentInternalHref($href)) {
                continue;
            }

            $text = trim(preg_replace('/\s+/u', ' ', $anchor->textContent ?? '') ?? '');
            if (! $this->isVagueAnchorText($text)) {
                continue;
            }

            $snippet = preg_replace('/\s+/u', ' ', $dom->saveHTML($anchor) ?: '') ?? '';
            $offenders[] = $href.' => '.$snippet;
        }

        return $offenders;
    }

    private function isContentInternalHref(string $href): bool
    {
        if ($href === '' || $href === '#' || str_starts_with($href, 'mailto:') || str_starts_with($href, 'tel:') || str_starts_with($href, 'javascript:')) {
            return false;
        }

        if (str_starts_with($href, '#') && strlen($href) > 1) {
            return true;
        }

        return $this->isInternalHref($href);
    }

    private function isVagueAnchorText(string $text): bool
    {
        $normalized = strtolower(trim(preg_replace('/\s+/u', ' ', $text) ?? ''));
        $normalized = trim($normalized, " \t\n\r\0\x0B.»›→-");

        return in_array($normalized, [
            'click here',
            'read more',
            'learn more',
            'know more',
            'find out more',
            'see more',
            'view more',
            'more info',
            'more information',
            'more details',
            'continue reading',
            'here',
            'this',
            'link',
            'more',
        ], true);
    }

    private function linkHasAccessibleName(DOMElement $anchor): bool
    {
        if ($this->linkHasSeoAnchorText($anchor)) {
            return true;
        }

        if (trim($anchor->getAttribute('aria-label')) !== '') {
            return true;
        }

        if (trim($anchor->getAttribute('title')) !== '') {
            return true;
        }

        return false;
    }
}
