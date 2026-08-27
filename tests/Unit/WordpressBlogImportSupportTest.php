<?php

namespace Tests\Unit;

use App\Services\WordPress\HtmlToBlocksConverter;
use App\Services\WordPress\WordpressXmlReader;
use PHPUnit\Framework\TestCase;

class WordpressBlogImportSupportTest extends TestCase
{
    public function test_it_does_not_corrupt_word_data_ccp_props_into_numeric_tags(): void
    {
        $html = <<<'HTML'
<span data-contrast="none">Intro paragraph about structural design.</span><span data-ccp-props="{&quot;134233117&quot;:false,&quot;134233118&quot;:false}"> </span>
<h2><span data-contrast="none">The Key to Better Structural Design</span></h2>
<ol>
  <li><h3><span data-contrast="none">Accuracy is Non-Negotiable</span></h3></li>
</ol>
<span data-contrast="none">A small error can be catastrophic. <a href="https://www.ibntech.com/civil-engineering-services/">structural design</a>.</span>
[elementor-template id="68043"]
HTML;

        $result = (new HtmlToBlocksConverter)->convert($html);
        $encoded = json_encode($result['blocks']);

        $this->assertIsString($encoded);
        $this->assertStringNotContainsString('span134233117', $encoded);
        $this->assertStringNotContainsString('elementor-template', $encoded);

        $types = array_column($result['blocks'], 'type');
        $this->assertContains('heading', $types);
        $this->assertContains('paragraph', $types);

        $headings = array_values(array_filter(
            $result['blocks'],
            fn (array $block): bool => ($block['type'] ?? '') === 'heading',
        ));
        $this->assertSame('The Key to Better Structural Design', $headings[0]['data']['text']);
        $this->assertSame('Accuracy is Non-Negotiable', $headings[1]['data']['text']);

        $plain = strip_tags(implode(' ', array_map(
            fn (array $block): string => (string) ($block['data']['content'] ?? $block['data']['text'] ?? ''),
            $result['blocks'],
        )));
        $this->assertStringContainsString('catastrophic', $plain);
        $this->assertStringContainsString('civil-engineering-services', json_encode($result['blocks']));
    }

    public function test_it_keeps_cta_and_faq_placeholders_as_root_blocks_inside_word_html(): void
    {
        $html = <<<'HTML'
<span data-ccp-props="{&quot;134233117&quot;:false}"> </span>
<span data-contrast="none">Body copy before the shortcodes.</span>
[ibn_cta_banner_1 title="Need help?" description="Talk to us." btn_text="Get Free Consultation" btn_link="https://www.ibntech.com/free-consultation-for-cybersecurity/" btn_target="_blank"]
[ibn_faq_accordion_7 title="FAQs" items="What is VAPT?|A security test.||How long?|Two weeks."]
HTML;

        $blocks = (new HtmlToBlocksConverter)->convert($html)['blocks'];
        $types = array_column($blocks, 'type');

        $this->assertContains('cta', $types);
        $this->assertContains('faq', $types);
        $this->assertContains('paragraph', $types);

        $cta = collect($blocks)->firstWhere('type', 'cta');
        $this->assertSame('Need help?', $cta['data']['heading']);
        $this->assertSame('Get Free Consultation', $cta['data']['button_label']);
        $this->assertSame('_blank', $cta['data']['button_target']);
    }

    public function test_it_converts_headings_images_and_lists_to_blocks(): void
    {
        $html = <<<'HTML'
<p>Intro text</p>
<h2>Section One</h2>
<img src="https://www.ibntech.com/wp-content/uploads/2023/01/banner.webp" alt="Banner" />
<ul><li>Item A</li></ul>
HTML;

        $result = (new HtmlToBlocksConverter)->convert($html);

        $types = array_column($result['blocks'], 'type');

        $this->assertSame(['paragraph', 'heading', 'image', 'paragraph'], $types);
        $this->assertSame('h2', $result['blocks'][1]['data']['level']);
        $this->assertCount(1, $result['images']);
        $this->assertSame('Banner', $result['images'][0]['alt']);
    }

    public function test_it_converts_images_nested_in_paragraphs_to_image_blocks(): void
    {
        $html = '<p><img src="https://www.ibntech.com/wp-content/uploads/2023/11/logistics-outsourcing-strategies-2.png" alt="Logistics"></p>';

        $result = (new HtmlToBlocksConverter)->convert($html);

        $this->assertSame('image', $result['blocks'][0]['type']);
        $this->assertSame('Logistics', $result['images'][0]['alt']);
    }

    public function test_it_converts_faq_shortcodes(): void
    {
        $html = '[ibn_faq_accordion_7 title="FAQs" items="What is VAPT?|A security test.||How long?|Two weeks."]';

        $result = (new HtmlToBlocksConverter)->convert($html);

        $this->assertSame('faq', $result['blocks'][0]['type']);
        $this->assertCount(2, $result['blocks'][0]['data']['items']);
        $this->assertSame('What is VAPT?', $result['blocks'][0]['data']['items'][0]['question']);
    }

    public function test_it_parses_hierarchical_and_additional_categories_from_xml(): void
    {
        $xml = <<<'XML'
<data>
  <post>
    <id>99</id>
    <Title>Tax Support Guide</Title>
    <rank_math_title/>
    <rank_math_description/>
    <Excerpt/>
    <Content><![CDATA[<p>Hello</p>]]></Content>
    <Date>2024-01-15</Date>
    <Permalink>https://www.ibntech.com/blog/tax-support-guide/</Permalink>
    <ImageURL/>
    <Categories><![CDATA[Finance And Accounting>Tax support|Back Office Services>Finance, Banking &amp; Insurance]]></Categories>
    <Status>publish</Status>
  </post>
</data>
XML;

        $path = tempnam(sys_get_temp_dir(), 'wpxml');
        file_put_contents($path, $xml);

        $posts = iterator_to_array((new WordpressXmlReader)->posts($path));
        unlink($path);

        $this->assertCount(1, $posts);
        $this->assertSame('tax-support-guide', $posts[0]->slug);
        $this->assertSame(['Finance And Accounting', 'Tax support'], $posts[0]->categoryPaths[0]);
        $this->assertSame(['Back Office Services', 'Finance, Banking & Insurance'], $posts[0]->categoryPaths[1]);
        $this->assertNull($posts[0]->featuredImageUrl);
    }
}
