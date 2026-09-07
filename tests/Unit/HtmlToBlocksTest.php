<?php

namespace Tests\Unit;

use App\Filament\Schemas\ContentBuilder;
use App\Services\WordPress\HtmlToBlocksConverter;
use App\Support\BlockContent;
use App\Support\Html\HtmlCodePreview;
use App\Support\Html\HtmlToBlocks;
use App\Support\Html\SafeHtml;
use ReflectionMethod;
use Tests\TestCase;

class HtmlToBlocksTest extends TestCase
{
    public function test_it_converts_supported_html_to_native_blocks(): void
    {
        $html = <<<'HTML'
<h2>VAPT services</h2>
<p>We test applications and networks.</p>
<blockquote>Security first.</blockquote>
<table>
  <thead><tr><th>Type</th><th>Scope</th></tr></thead>
  <tbody><tr><td>Web</td><td>External</td></tr></tbody>
</table>
<iframe src="https://www.youtube.com/watch?v=dQw4w9wgGcQ"></iframe>
HTML;

        $blocks = HtmlToBlocks::convert($html);
        $types = array_column($blocks, 'type');

        $this->assertSame(['heading', 'paragraph', 'quote', 'table', 'embed'], $types);
        $this->assertSame('VAPT services', $blocks[0]['data']['text']);
        $this->assertSame('h2', $blocks[0]['data']['level']);
        $this->assertStringContainsString('We test applications', $blocks[1]['data']['content']);
        $this->assertSame('Security first.', $blocks[2]['data']['quote']);
        $this->assertContains('Type', $blocks[3]['data']['headers']);
        $this->assertSame('https://www.youtube.com/embed/dQw4w9wgGcQ', $blocks[4]['data']['url']);
        $this->assertNotContains(HtmlToBlocks::WORKSPACE_TYPE, $types);
    }

    public function test_it_converts_heading_and_paragraph(): void
    {
        $blocks = HtmlToBlocks::convert('<h1>Top title</h1><h5>Small heading</h5><p>We test applications and networks.</p>');

        $this->assertSame(['heading', 'heading', 'paragraph'], array_column($blocks, 'type'));
        $this->assertSame('h2', $blocks[0]['data']['level']);
        $this->assertSame('Top title', $blocks[0]['data']['text']);
        $this->assertSame('h4', $blocks[1]['data']['level']);
        $this->assertSame('Small heading', $blocks[1]['data']['text']);
        $this->assertStringContainsString('We test applications', $blocks[2]['data']['content']);
    }

    public function test_it_converts_images_to_image_blocks(): void
    {
        $html = '<p>Intro</p><img src="https://www.ibntech.com/wp-content/uploads/2023/01/banner.webp" alt="Banner" title="Hero">';

        $blocks = HtmlToBlocks::convert($html);
        $types = array_column($blocks, 'type');

        $this->assertSame(['paragraph', 'image'], $types);
        $this->assertSame('https://www.ibntech.com/wp-content/uploads/2023/01/banner.webp', $blocks[1]['data']['url']);
        $this->assertSame('Banner', $blocks[1]['data']['alt']);
        $this->assertSame('Hero', $blocks[1]['data']['caption']);
        $this->assertNotEmpty($blocks[1]['data']['block_id']);
    }

    public function test_it_converts_button_elements_to_buttons_blocks(): void
    {
        $html = '<p>Ready?</p><button data-url="/contact/">Talk to us</button>';

        $blocks = HtmlToBlocks::convert($html);

        $this->assertSame(['paragraph', 'buttons'], array_column($blocks, 'type'));
        $this->assertSame('Talk to us', $blocks[1]['data']['items'][0]['label']);
        $this->assertSame('/contact/', $blocks[1]['data']['items'][0]['url']);
        $this->assertSame('primary', $blocks[1]['data']['items'][0]['style']);
        $this->assertSame('_self', $blocks[1]['data']['items'][0]['target']);
    }

    public function test_it_keeps_anchor_tags_as_hyperlinks_not_buttons(): void
    {
        $html = '<p>See the <a href="https://www.ibntech.com/vapt-services/">VAPT services</a> page.</p><a href="/contact/" class="btn">Contact</a><p><a href="/about/"><button>About</button></a></p>';

        $blocks = HtmlToBlocks::convert($html);
        $htmlContent = implode('', array_map(
            fn (array $block): string => (string) ($block['data']['content'] ?? ''),
            $blocks,
        ));

        $this->assertNotContains('buttons', array_column($blocks, 'type'));
        $this->assertContains('paragraph', array_column($blocks, 'type'));
        $this->assertStringContainsString('<a href="https://www.ibntech.com/vapt-services/">VAPT services</a>', $htmlContent);
        $this->assertStringContainsString('/contact/', $htmlContent);
        $this->assertStringContainsString('Contact', $htmlContent);
    }

    public function test_it_keeps_opt_in_scroll_data_attributes_in_converted_html(): void
    {
        $html = '<p><a href="#" data-scroll-target="download-form">Download</a></p>';

        $blocks = HtmlToBlocks::convert($html);
        $htmlContent = implode('', array_map(
            fn (array $block): string => (string) ($block['data']['content'] ?? ''),
            $blocks,
        ));

        $this->assertStringContainsString('data-scroll-target="download-form"', $htmlContent);
    }

    public function test_it_converts_tables_to_table_blocks(): void
    {
        $html = <<<'HTML'
<table>
  <thead><tr><th>Type</th><th>Scope</th></tr></thead>
  <tbody><tr><td>Web</td><td>External</td></tr></tbody>
</table>
HTML;

        $blocks = HtmlToBlocks::convert($html);

        $this->assertSame(['table'], array_column($blocks, 'type'));
        $this->assertSame(['Type', 'Scope'], $blocks[0]['data']['headers']);
        $this->assertSame(['Web', 'External'], $blocks[0]['data']['rows'][0]['columns']);
    }

    public function test_it_converts_faq_markup_to_faq_blocks(): void
    {
        $html = <<<'HTML'
<details>
  <summary>What is VAPT?</summary>
  <p>A security test.</p>
</details>
<details>
  <summary>How long?</summary>
  Two weeks.
</details>
HTML;

        $blocks = HtmlToBlocks::convert($html);

        $this->assertSame(['faq'], array_column($blocks, 'type'));
        $this->assertCount(2, $blocks[0]['data']['items']);
        $this->assertSame('What is VAPT?', $blocks[0]['data']['items'][0]['question']);
        $this->assertStringContainsString('A security test.', $blocks[0]['data']['items'][0]['answer']);
        $this->assertSame('How long?', $blocks[0]['data']['items'][1]['question']);
        $this->assertStringContainsString('Two weeks.', $blocks[0]['data']['items'][1]['answer']);
    }

    public function test_it_converts_mixed_html_in_original_order(): void
    {
        $html = <<<'HTML'
<h2>VAPT services</h2>
<p>We test applications and a <a href="https://www.ibntech.com/">link</a>.</p>
<img src="https://www.ibntech.com/wp-content/uploads/2023/01/banner.webp" alt="Banner">
<button data-url="/contact/">Talk to us</button>
<table>
  <thead><tr><th>Type</th></tr></thead>
  <tbody><tr><td>Web</td></tr></tbody>
</table>
<details>
  <summary>What is VAPT?</summary>
  <p>A security test.</p>
</details>
<p>Closing copy.</p>
HTML;

        $blocks = HtmlToBlocks::convert($html);

        $this->assertSame(
            ['heading', 'paragraph', 'image', 'buttons', 'table', 'faq', 'paragraph'],
            array_column($blocks, 'type'),
        );
        $this->assertSame('VAPT services', $blocks[0]['data']['text']);
        $this->assertStringContainsString('<a href="https://www.ibntech.com/">link</a>', $blocks[1]['data']['content']);
        $this->assertSame('Banner', $blocks[2]['data']['alt']);
        $this->assertSame('Talk to us', $blocks[3]['data']['items'][0]['label']);
        $this->assertSame(['Type'], $blocks[4]['data']['headers']);
        $this->assertSame('What is VAPT?', $blocks[5]['data']['items'][0]['question']);
        $this->assertStringContainsString('Closing copy.', $blocks[6]['data']['content']);
        $this->assertNotContains('buttons', array_column([$blocks[1]], 'type'));
    }

    public function test_wordpress_converter_still_extracts_image_blocks(): void
    {
        $result = (new HtmlToBlocksConverter)->convert(
            '<img src="https://www.ibntech.com/wp-content/uploads/2023/01/banner.webp" alt="Banner">',
        );

        $this->assertSame('image', $result['blocks'][0]['type']);
        $this->assertArrayNotHasKey('url', $result['blocks'][0]['data']);
        $this->assertCount(1, $result['images']);
    }

    public function test_wordpress_converter_does_not_convert_buttons_or_faq_html(): void
    {
        $result = (new HtmlToBlocksConverter)->convert(
            '<p>Click <button data-url="/go">Go</button></p><details><summary>Question</summary><p>Answer</p></details>',
        );

        $types = array_column($result['blocks'], 'type');

        $this->assertNotContains('buttons', $types);
        $this->assertNotContains('faq', $types);
        $this->assertContains('paragraph', $types);
    }

    public function test_it_replaces_a_workspace_while_preserving_surrounding_order(): void
    {
        $items = [
            'before' => [
                'type' => 'paragraph',
                'data' => ['content' => '<p>Before</p>'],
            ],
            'workspace' => [
                'type' => HtmlToBlocks::WORKSPACE_TYPE,
                'data' => ['html' => '<h2>Inserted</h2><p>Body</p>'],
            ],
            'after' => [
                'type' => 'quote',
                'data' => ['quote' => 'Keep me'],
            ],
        ];

        $converted = HtmlToBlocks::convert((string) $items['workspace']['data']['html']);
        $replaced = array_values(HtmlToBlocks::replaceItemWithBlocks($items, 'workspace', $converted));

        $this->assertSame(['paragraph', 'heading', 'paragraph', 'quote'], array_column($replaced, 'type'));
        $this->assertSame('<p>Before</p>', $replaced[0]['data']['content']);
        $this->assertSame('Inserted', $replaced[1]['data']['text']);
        $this->assertSame('Keep me', $replaced[3]['data']['quote']);
        $this->assertNotContains(HtmlToBlocks::WORKSPACE_TYPE, array_column($replaced, 'type'));
    }

    public function test_encode_never_persists_html_code_workspaces(): void
    {
        $encoded = BlockContent::encode([
            [
                'type' => 'paragraph',
                'data' => ['content' => '<p>Before</p>'],
            ],
            [
                'type' => HtmlToBlocks::WORKSPACE_TYPE,
                'data' => ['html' => '<h2>Title</h2><p>After convert</p>'],
            ],
            [
                'type' => 'quote',
                'data' => ['quote' => 'Keep me'],
            ],
        ]);

        $blocks = json_decode((string) $encoded, true);

        $this->assertIsArray($blocks);
        $this->assertNotContains(HtmlToBlocks::WORKSPACE_TYPE, array_column($blocks, 'type'));
        $this->assertSame('paragraph', $blocks[0]['type']);
        $this->assertSame('heading', $blocks[1]['type']);
        $this->assertSame('quote', $blocks[array_key_last($blocks)]['type']);
    }

    public function test_existing_native_block_json_is_unchanged_by_normalize_and_encode(): void
    {
        $original = [
            [
                'type' => 'heading',
                'data' => [
                    'level' => 'h2',
                    'text' => 'Existing heading',
                    'alignment' => 'left',
                ],
            ],
            [
                'type' => 'paragraph',
                'data' => [
                    'content' => '<p>Existing body with a <a href="https://www.ibntech.com/">link</a>.</p>',
                ],
            ],
            [
                'type' => 'cta',
                'data' => [
                    'heading' => 'Talk to us',
                    'description' => 'Book a call.',
                    'button_label' => 'Contact',
                    'button_url' => '/contact/',
                    'button_target' => '_self',
                    'icon' => 'comments',
                    'theme' => 'navy',
                ],
            ],
        ];

        $this->assertSame($original, BlockContent::normalize($original));
        $this->assertSame($original, BlockContent::normalize(json_encode($original)));
        $this->assertSame($original, json_decode((string) BlockContent::encode($original), true));
    }

    public function test_it_strips_unsafe_html_from_conversion_and_preview(): void
    {
        $html = '<p>Safe copy</p><script>alert(1)</script><p><img src="https://www.ibntech.com/a.jpg" onerror="alert(1)"><a href="javascript:alert(1)">click</a></p><iframe src="javascript:alert(1)"></iframe>';

        $preview = SafeHtml::sanitizeForRender($html);
        $encoded = json_encode(HtmlToBlocks::convert($html));

        $this->assertStringContainsString('Safe copy', $preview);
        $this->assertStringNotContainsString('<script', strtolower($preview));
        $this->assertStringNotContainsString('onerror', strtolower($preview));
        $this->assertStringNotContainsString('javascript:', strtolower($preview));

        $this->assertIsString($encoded);
        $this->assertStringContainsString('Safe copy', $encoded);
        $this->assertStringNotContainsString('<script', strtolower($encoded));
        $this->assertStringNotContainsString('onerror', strtolower($encoded));
        $this->assertStringNotContainsString('javascript:', strtolower($encoded));
        $this->assertStringNotContainsString('"type":"embed"', $encoded);
        $this->assertStringNotContainsString(HtmlToBlocks::WORKSPACE_TYPE, $encoded);
    }

    public function test_preview_renders_supported_html_without_executing_unsafe_markup(): void
    {
        $html = <<<'HTML'
<h2>Heading Two</h2>
<p>A paragraph with a <a href="https://www.ibntech.com/">link</a>.</p>
<ul>
  <li>Parent
    <ul><li>Nested bullet</li></ul>
  </li>
</ul>
<ol>
  <li>First
    <ol><li>Nested number</li></ol>
  </li>
</ol>
<blockquote>Quoted copy</blockquote>
<table><tr><th>Col</th></tr><tr><td>Cell</td></tr></table>
<img src="https://www.ibntech.com/banner.webp" alt="Banner">
<script>alert(1)</script>
<p><a href="javascript:alert(1)">bad</a></p>
HTML;

        $preview = (string) HtmlCodePreview::make($html);

        $this->assertStringContainsString('fi-html-code-preview', $preview);
        $this->assertStringContainsString('<h2>Heading Two</h2>', $preview);
        $this->assertStringContainsString('<p>', $preview);
        $this->assertStringContainsString('<ul>', $preview);
        $this->assertStringContainsString('<ol>', $preview);
        $this->assertStringContainsString('Nested bullet', $preview);
        $this->assertStringContainsString('Nested number', $preview);
        $this->assertStringContainsString('<blockquote>', $preview);
        $this->assertStringContainsString('<table>', $preview);
        $this->assertStringContainsString('<img', $preview);
        $this->assertStringContainsString('ibntech.com', $preview);
        $this->assertStringNotContainsString('&lt;h2&gt;', $preview);
        $this->assertStringNotContainsString('<script', strtolower($preview));
        $this->assertStringNotContainsString('javascript:', strtolower($preview));
        $this->assertStringContainsString('fi-html-code-preview--empty', (string) HtmlCodePreview::make(''));
    }

    public function test_it_keeps_nested_lists_inside_paragraph_blocks(): void
    {
        $html = <<<'HTML'
<ul>
  <li>Parent
    <ul><li>Child</li></ul>
  </li>
</ul>
HTML;

        $blocks = HtmlToBlocks::convert($html);

        $this->assertSame(['paragraph'], array_column($blocks, 'type'));
        $this->assertStringContainsString('<ul>', $blocks[0]['data']['content']);
        $this->assertStringContainsString('<li>Child</li>', $blocks[0]['data']['content']);
    }

    public function test_convert_refreshes_builder_state_in_place_without_html_code(): void
    {
        $items = [
            'before' => [
                'type' => 'paragraph',
                'data' => ['content' => '<p>Before</p>'],
            ],
            'workspace' => [
                'type' => HtmlToBlocks::WORKSPACE_TYPE,
                'data' => ['html' => '<h2>Inserted</h2><ul><li>One<ul><li>Nested</li></ul></li></ul>'],
            ],
            'after' => [
                'type' => 'quote',
                'data' => ['quote' => 'Keep me'],
            ],
        ];

        $newKeys = [];
        $refreshed = HtmlToBlocks::convertWorkspaceInState(
            $items,
            'workspace',
            null,
            function () use (&$newKeys): string {
                $key = 'converted-'.count($newKeys);
                $newKeys[] = $key;

                return $key;
            },
        );

        $this->assertArrayNotHasKey('workspace', $refreshed);
        $this->assertArrayHasKey('before', $refreshed);
        $this->assertArrayHasKey('after', $refreshed);
        $this->assertNotContains(HtmlToBlocks::WORKSPACE_TYPE, array_column($refreshed, 'type'));
        $this->assertSame(['paragraph', 'heading', 'paragraph', 'quote'], array_column($refreshed, 'type'));
        $this->assertSame($items['before'], $refreshed['before']);
        $this->assertSame($items['after'], $refreshed['after']);
        $this->assertSame('Inserted', $refreshed[$newKeys[0]]['data']['text']);
        $this->assertStringContainsString('Nested', $refreshed[$newKeys[1]]['data']['content']);
    }

    public function test_saving_without_manual_conversion_still_expands_html_code(): void
    {
        $encoded = BlockContent::encode([
            'keep' => [
                'type' => 'paragraph',
                'data' => ['content' => '<p>Keep</p>'],
            ],
            'workspace' => [
                'type' => HtmlToBlocks::WORKSPACE_TYPE,
                'data' => ['html' => '<h3>Auto converted</h3><p>From save.</p>'],
            ],
        ]);

        $blocks = json_decode((string) $encoded, true);

        $this->assertSame(['paragraph', 'heading', 'paragraph'], array_column($blocks, 'type'));
        $this->assertNotContains(HtmlToBlocks::WORKSPACE_TYPE, array_column($blocks, 'type'));
        $this->assertSame('Auto converted', $blocks[1]['data']['text']);
        $this->assertSame('h3', $blocks[1]['data']['level']);
    }

    public function test_content_builder_exposes_html_code_without_replacing_code(): void
    {
        $method = new ReflectionMethod(ContentBuilder::class, 'blocks');
        $blocks = $method->invoke(null);
        $names = array_map(fn ($block): string => $block->getName(), $blocks);

        $this->assertContains('html_code', $names);
        $this->assertContains('code', $names);
        $this->assertContains('paragraph', $names);
        $this->assertNotContains('additional_css', $names);
        $this->assertNotContains('additional_js', $names);
        $this->assertSame('HTML Code', collect($blocks)->firstWhere(fn ($block) => $block->getName() === 'html_code')?->getLabel());
        $this->assertSame('Code', collect($blocks)->firstWhere(fn ($block) => $block->getName() === 'code')?->getLabel());
    }
}
