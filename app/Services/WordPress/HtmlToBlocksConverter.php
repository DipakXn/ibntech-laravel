<?php

namespace App\Services\WordPress;

use App\Support\BlockContent;
use App\Support\Html\UnknownElementUnwrapper;
use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;
use Illuminate\Support\Str;

class HtmlToBlocksConverter
{
    /**
     * @var array<int, array<string, mixed>>
     */
    protected array $placeholders = [];

    protected bool $forAdmin = false;

    /**
     * @return array{blocks: array<int, array<string, mixed>>, images: array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>}
     */
    public function convert(string $html, bool $forAdmin = false): array
    {
        $this->forAdmin = $forAdmin;
        $this->placeholders = [];
        $images = [];

        $html = $this->extractShortcodes($html);
        $html = $this->normalizeHtml($html);

        if (trim(strip_tags($html, '<wp-block><img><figure>')) === '' && $this->placeholders === []) {
            return [
                'blocks' => [],
                'images' => [],
            ];
        }

        $dom = $this->loadDom($html);
        $root = $this->root($dom);

        if ($root instanceof DOMElement) {
            $this->cleanDom($root);
        }

        $blocks = $root instanceof DOMElement
            ? $this->convertChildren($root, $images)
            : [];

        if ($blocks === []) {
            $plain = trim(strip_tags($html));

            if ($plain !== '') {
                $blocks[] = $this->paragraphBlock('<p>'.e($plain).'</p>');
            }
        }

        return [
            'blocks' => array_values(array_filter($blocks)),
            'images' => $images,
        ];
    }

    protected function extractShortcodes(string $html): string
    {
        $html = preg_replace_callback(
            '/\[ibn_faq_accordion_\d+\b([^\]]*)\]/i',
            function (array $matches): string {
                $block = $this->faqFromShortcode($matches[1] ?? '');

                return $this->placeholderHtml($block);
            },
            $html,
        ) ?? $html;

        $html = preg_replace_callback(
            '/\[ibn_cta_banner_\d+\b([^\]]*)\]/i',
            function (array $matches): string {
                $block = $this->calloutFromCtaShortcode($matches[1] ?? '');

                return $this->placeholderHtml($block);
            },
            $html,
        ) ?? $html;

        return preg_replace('/\[elementor-template[^\]]*\]/i', '', $html) ?? $html;
    }

    protected function normalizeHtml(string $html): string
    {
        $html = preg_replace('/<!--.*?-->/s', '', $html) ?? $html;
        $html = str_replace(['&nbsp;', "\xC2\xA0"], ' ', $html);
        $html = preg_replace('/<article>\s*<\/article>/i', '', $html) ?? $html;

        return trim($html);
    }

    protected function loadDom(string $html): DOMDocument
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $wrapped = '<div id="wp-import-root">'.$html.'</div>';

        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">'.$wrapped, LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        return $dom;
    }

    protected function root(DOMDocument $dom): ?DOMElement
    {
        $node = (new DOMXPath($dom))->query('//*[@id="wp-import-root"]')->item(0);

        return $node instanceof DOMElement ? $node : null;
    }

    protected function cleanDom(DOMElement $root): void
    {
        if ($this->forAdmin) {
            $this->promoteFormActionsOntoButtons($root);
        }

        $this->stripWordAttributes($root);
        (new UnknownElementUnwrapper($this->forAdmin ? ['button', 'details', 'summary'] : []))
            ->unwrapDocumentRoot($root);
        $this->flattenStructuralWrappers($root);
        $this->removeEmptySpans($root);
        $this->hoistPlaceholders($root);
    }

    protected function stripWordAttributes(DOMElement $root): void
    {
        foreach ($this->descendantElements($root) as $element) {
            $remove = [];

            if ($element->hasAttributes()) {
                foreach (iterator_to_array($element->attributes) as $attribute) {
                    $name = strtolower($attribute->name);

                    if ($name === 'style') {
                        $remove[] = $name;

                        continue;
                    }

                    if (! str_starts_with($name, 'data-')) {
                        continue;
                    }

                    if (strtolower($element->tagName) === 'wp-block' && $name === 'data-i') {
                        continue;
                    }

                    if (
                        $this->forAdmin
                        && strtolower($element->tagName) === 'button'
                        && in_array($name, ['data-url', 'data-href', 'data-target'], true)
                    ) {
                        continue;
                    }

                    $remove[] = $name;
                }
            }

            foreach ($remove as $name) {
                $element->removeAttribute($name);
            }
        }
    }

    protected function flattenStructuralWrappers(DOMElement $root): void
    {
        $guard = 0;

        while ($guard < 50) {
            $guard++;
            $wrapper = null;

            foreach ($this->descendantElements($root) as $element) {
                if (in_array(strtolower($element->tagName), ['div', 'section', 'article'], true)) {
                    $wrapper = $element;
                    break;
                }
            }

            if (! $wrapper instanceof DOMElement || ! $wrapper->parentNode) {
                return;
            }

            while ($wrapper->firstChild instanceof DOMNode) {
                $wrapper->parentNode->insertBefore($wrapper->firstChild, $wrapper);
            }

            $wrapper->parentNode->removeChild($wrapper);
        }
    }

    protected function removeEmptySpans(DOMElement $root): void
    {
        foreach (array_reverse($this->descendantElements($root)) as $element) {
            if (strtolower($element->tagName) !== 'span') {
                continue;
            }

            if (trim($element->textContent) !== '') {
                continue;
            }

            $hasElementChild = false;

            foreach ($element->childNodes as $child) {
                if ($child instanceof DOMElement) {
                    $hasElementChild = true;
                    break;
                }
            }

            if (! $hasElementChild && $element->parentNode) {
                $element->parentNode->removeChild($element);
            }
        }
    }

    protected function hoistPlaceholders(DOMElement $root): void
    {
        $placeholders = [];

        foreach ($root->getElementsByTagName('wp-block') as $element) {
            if ($element instanceof DOMElement) {
                $placeholders[] = $element;
            }
        }

        foreach ($placeholders as $element) {
            if ($element->parentNode === $root || ! $element->parentNode) {
                continue;
            }

            $ancestor = $element;

            while ($ancestor->parentNode instanceof DOMNode && $ancestor->parentNode !== $root) {
                $ancestor = $ancestor->parentNode;
            }

            if ($ancestor->parentNode === $root) {
                $root->insertBefore($element, $ancestor);
            }
        }
    }

    /**
     * @return list<DOMElement>
     */
    protected function descendantElements(DOMElement $root): array
    {
        $elements = [];

        foreach ($root->getElementsByTagName('*') as $node) {
            if ($node instanceof DOMElement && $node !== $root) {
                $elements[] = $node;
            }
        }

        return $elements;
    }

    /**
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $images
     * @return array<int, array<string, mixed>>
     */
    protected function convertChildren(DOMNode $root, array &$images): array
    {
        if ($this->forAdmin) {
            return $this->convertChildrenForAdmin($root, $images);
        }

        $blocks = [];
        $buffer = '';

        foreach ($root->childNodes as $node) {
            if ($this->isIgnorable($node)) {
                continue;
            }

            if ($node instanceof DOMElement && in_array(strtolower($node->tagName), ['ul', 'ol'], true)) {
                $this->flushParagraph($buffer, $blocks);

                foreach ($this->convertListNode($node, $images) as $block) {
                    $blocks[] = $block;
                }

                continue;
            }

            if ($node instanceof DOMElement && strtolower($node->tagName) === 'p') {
                $this->flushParagraph($buffer, $blocks);
                $this->convertInlineImages($node, $images, $blocks);
                $paragraphHtml = $this->nodeHtml($node);
                $this->flushParagraph($paragraphHtml, $blocks);

                continue;
            }

            $block = $this->convertStandaloneNode($node, $images);

            if ($block !== null) {
                $this->flushParagraph($buffer, $blocks);
                $blocks[] = $block;

                continue;
            }

            $buffer .= $this->nodeHtml($node);
        }

        $this->flushParagraph($buffer, $blocks);

        return $blocks;
    }

    /**
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $images
     * @return array<int, array<string, mixed>>
     */
    protected function convertListNode(DOMElement $list, array &$images): array
    {
        if ($this->isHeadingLedList($list)) {
            $blocks = [];

            foreach ($list->childNodes as $item) {
                if (! $item instanceof DOMElement || strtolower($item->tagName) !== 'li') {
                    continue;
                }

                $heading = $this->firstHeading($item);

                if ($heading instanceof DOMElement) {
                    $block = $this->convertStandaloneNode($heading, $images);

                    if ($block !== null) {
                        $blocks[] = $block;
                    }

                    $heading->parentNode?->removeChild($heading);
                }

                $rest = trim($this->innerHtml($item));

                if ($rest !== '') {
                    $this->flushParagraph($rest, $blocks);
                }
            }

            return array_values(array_filter($blocks));
        }

        $html = trim($this->nodeHtml($list));

        return $html !== '' ? [$this->paragraphBlock($html)] : [];
    }

    /**
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $images
     * @param  array<int, array<string, mixed>>  $blocks
     */
    protected function convertInlineImages(DOMElement $node, array &$images, array &$blocks): void
    {
        $imgs = [];

        foreach ($node->getElementsByTagName('img') as $img) {
            if ($img instanceof DOMElement) {
                $imgs[] = $img;
            }
        }

        foreach ($imgs as $img) {
            $block = $this->imageBlockFromNode($img, $images);

            if ($block !== null) {
                $blocks[] = $block;
            }

            $img->parentNode?->removeChild($img);
        }
    }

    protected function isHeadingLedList(DOMElement $list): bool
    {
        $items = [];

        foreach ($list->childNodes as $child) {
            if ($child instanceof DOMElement && strtolower($child->tagName) === 'li') {
                $items[] = $child;
            }
        }

        if ($items === []) {
            return false;
        }

        $headed = 0;

        foreach ($items as $item) {
            if ($this->firstHeading($item) instanceof DOMElement) {
                $headed++;
            }
        }

        return $headed === count($items);
    }

    protected function firstHeading(DOMElement $item): ?DOMElement
    {
        foreach ($item->childNodes as $child) {
            if ($child instanceof DOMElement && in_array(strtolower($child->tagName), $this->headingTags(), true)) {
                return $child;
            }
        }

        $headingSearch = $this->forAdmin
            ? ['h3', 'h2', 'h4', 'h5', 'h6', 'h1']
            : ['h3', 'h2', 'h4', 'h1'];

        foreach ($headingSearch as $tag) {
            $heading = $item->getElementsByTagName($tag)->item(0);

            if ($heading instanceof DOMElement) {
                return $heading;
            }
        }

        return null;
    }

    /**
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $images
     * @return array<string, mixed>|null
     */
    protected function convertStandaloneNode(DOMNode $node, array &$images): ?array
    {
        if (! $node instanceof DOMElement) {
            return null;
        }

        $tag = strtolower($node->tagName);

        if ($tag === 'wp-block') {
            $index = (int) $node->getAttribute('data-i');

            return $this->placeholders[$index] ?? null;
        }

        if (in_array($tag, $this->headingTags(), true)) {
            $text = trim(preg_replace('/\s+/', ' ', $node->textContent) ?? '');

            if ($text === '') {
                return null;
            }

            $level = match ($tag) {
                'h1' => 'h2',
                'h5', 'h6' => 'h4',
                default => $tag,
            };

            return [
                'type' => 'heading',
                'data' => [
                    'level' => $level,
                    'text' => Str::limit($text, 255, ''),
                    'alignment' => 'left',
                ],
            ];
        }

        if ($tag === 'img' || $tag === 'figure') {
            return $this->imageBlockFromNode($node, $images);
        }

        if ($tag === 'table') {
            return $this->tableBlockFromNode($node);
        }

        if ($tag === 'blockquote') {
            $quote = trim($this->innerHtml($node));

            if ($quote === '') {
                return null;
            }

            return [
                'type' => 'quote',
                'data' => [
                    'quote' => strip_tags($quote),
                    'author' => null,
                    'role' => null,
                ],
            ];
        }

        if ($tag === 'pre') {
            return [
                'type' => 'code',
                'data' => [
                    'language' => 'text',
                    'filename' => null,
                    'code' => $node->textContent,
                ],
            ];
        }

        if ($tag === 'iframe') {
            $src = trim($node->getAttribute('src'));

            if ($src === '') {
                return null;
            }

            return [
                'type' => 'embed',
                'data' => [
                    'url' => BlockContent::embedUrl($src) ?: $src,
                    'title' => null,
                    'caption' => null,
                ],
            ];
        }

        return null;
    }

    /**
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $images
     */
    protected function imageBlockFromNode(DOMElement $node, array &$images): ?array
    {
        $img = strtolower($node->tagName) === 'img'
            ? $node
            : ($node->getElementsByTagName('img')->item(0) instanceof DOMElement
                ? $node->getElementsByTagName('img')->item(0)
                : null);

        if (! $img instanceof DOMElement) {
            return null;
        }

        $url = trim($img->getAttribute('src'));

        if ($url === '' || str_starts_with($url, 'data:')) {
            return null;
        }

        $caption = null;

        if (strtolower($node->tagName) === 'figure') {
            $figcaption = $node->getElementsByTagName('figcaption')->item(0);
            $caption = $figcaption ? trim($figcaption->textContent) : null;
        }

        $blockId = (string) Str::uuid();
        $alt = trim($img->getAttribute('alt')) ?: null;

        $images[] = [
            'block_id' => $blockId,
            'url' => $url,
            'alt' => $alt,
            'caption' => $caption,
        ];

        $data = [
            'block_id' => $blockId,
            'alt' => $alt,
            'caption' => $caption,
        ];

        if ($this->forAdmin) {
            $title = trim($img->getAttribute('title')) ?: null;

            if ($data['caption'] === null && $title !== null) {
                $data['caption'] = $title;
            }

            $data['url'] = $url;
        }

        return [
            'type' => 'image',
            'data' => $data,
        ];
    }

    protected function tableBlockFromNode(DOMElement $table): ?array
    {
        $headers = [];
        $rows = [];

        foreach ($table->getElementsByTagName('th') as $th) {
            $headers[] = trim($th->textContent);
        }

        foreach ($table->getElementsByTagName('tr') as $tr) {
            if (! $tr instanceof DOMElement) {
                continue;
            }

            $cells = [];

            foreach ($tr->childNodes as $cell) {
                if ($cell instanceof DOMElement && strtolower($cell->tagName) === 'td') {
                    $cells[] = trim($cell->textContent);
                }
            }

            if ($cells !== []) {
                $rows[] = ['columns' => $cells];
            }
        }

        if ($headers === [] && $rows === []) {
            return null;
        }

        return [
            'type' => 'table',
            'data' => [
                'caption' => null,
                'headers' => $headers,
                'rows' => $rows,
            ],
        ];
    }

    /**
     * @param  array<int, array<string, mixed>>  $blocks
     */
    protected function flushParagraph(string &$buffer, array &$blocks): void
    {
        $html = trim($buffer);
        $buffer = '';

        if ($html === '') {
            return;
        }

        $text = trim(html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8'));

        if ($text === '' && ! preg_match('/<img\b/i', $html)) {
            return;
        }

        if (! preg_match('/<(p|ul|ol|h\d|div|blockquote)\b/i', $html)) {
            $html = '<p>'.$html.'</p>';
        }

        $blocks[] = $this->paragraphBlock($html);
    }

    /**
     * @return array<string, mixed>
     */
    protected function paragraphBlock(string $html): array
    {
        return [
            'type' => 'paragraph',
            'data' => [
                'content' => $html,
            ],
        ];
    }

    /**
     * @param  array<string, mixed>|null  $block
     */
    protected function placeholderHtml(?array $block): string
    {
        if ($block === null) {
            return '';
        }

        $index = count($this->placeholders);
        $this->placeholders[$index] = $block;

        return '<wp-block data-i="'.$index.'"></wp-block>';
    }

    /**
     * @return array<string, mixed>|null
     */
    protected function faqFromShortcode(string $attributes): ?array
    {
        $title = $this->shortcodeAttr($attributes, 'title') ?: 'Frequently Asked Questions';
        $itemsRaw = $this->shortcodeAttr($attributes, 'items');

        if ($itemsRaw === null || $itemsRaw === '') {
            return null;
        }

        $items = [];

        foreach (preg_split('/\s*\|\|\s*/', $itemsRaw) ?: [] as $pair) {
            $parts = array_map('trim', explode('|', $pair, 2));
            $question = $parts[0] ?? '';
            $answer = $parts[1] ?? '';

            if ($question === '' || $answer === '') {
                continue;
            }

            $items[] = [
                'question' => Str::limit($question, 255, ''),
                'answer' => '<p>'.e($answer).'</p>',
            ];
        }

        if ($items === []) {
            return null;
        }

        return [
            'type' => 'faq',
            'data' => [
                'title' => $title,
                'items' => $items,
            ],
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    protected function calloutFromCtaShortcode(string $attributes): ?array
    {
        $title = $this->shortcodeAttr($attributes, 'title');
        $description = $this->shortcodeAttr($attributes, 'description');
        $buttonLabel = $this->shortcodeAttr($attributes, 'btn_text');
        $buttonUrl = $this->shortcodeAttr($attributes, 'btn_link');
        $target = $this->shortcodeAttr($attributes, 'btn_target') ?: '_self';

        if (filled($buttonLabel) && filled($buttonUrl)) {
            return [
                'type' => 'cta',
                'data' => [
                    'heading' => $title ?: 'Learn more',
                    'description' => $description,
                    'button_label' => $buttonLabel,
                    'button_url' => $buttonUrl,
                    'button_target' => $target === '_blank' ? '_blank' : '_self',
                    'icon' => 'comments',
                    'theme' => 'navy',
                ],
            ];
        }

        if (blank($title) && blank($description)) {
            return null;
        }

        return [
            'type' => 'cta',
            'data' => [
                'heading' => $title ?: 'Learn more',
                'description' => $description,
                'button_label' => null,
                'button_url' => null,
                'button_target' => '_self',
                'icon' => 'comments',
                'theme' => 'navy',
            ],
        ];
    }

    protected function shortcodeAttr(string $attributes, string $name): ?string
    {
        if (! preg_match('/'.preg_quote($name, '/').'\s*=\s*"([^"]*)"/i', $attributes, $matches)) {
            return null;
        }

        return trim(html_entity_decode($matches[1], ENT_QUOTES | ENT_HTML5, 'UTF-8')) ?: null;
    }

    protected function isIgnorable(DOMNode $node): bool
    {
        if ($node->nodeType === XML_TEXT_NODE) {
            return trim($node->textContent) === '';
        }

        return $node->nodeType === XML_COMMENT_NODE;
    }

    protected function innerHtml(DOMNode $node): string
    {
        $html = '';

        foreach ($node->childNodes as $child) {
            $html .= $this->nodeHtml($child);
        }

        return $html;
    }

    protected function nodeHtml(DOMNode $node): string
    {
        $html = $node->ownerDocument?->saveHTML($node) ?: '';

        return is_string($html) ? $html : '';
    }

    /**
     * @return list<string>
     */
    protected function headingTags(): array
    {
        return $this->forAdmin
            ? ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']
            : ['h1', 'h2', 'h3', 'h4'];
    }

    /**
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $images
     * @return array<int, array<string, mixed>>
     */
    protected function convertChildrenForAdmin(DOMNode $root, array &$images): array
    {
        $blocks = [];
        $buffer = '';
        $children = iterator_to_array($root->childNodes);

        for ($i = 0; $i < count($children); $i++) {
            $node = $children[$i];

            if ($this->isIgnorable($node)) {
                continue;
            }

            if ($node instanceof DOMElement && in_array(strtolower($node->tagName), ['ul', 'ol'], true)) {
                $this->flushParagraph($buffer, $blocks);

                foreach ($this->convertListNode($node, $images) as $block) {
                    $blocks[] = $block;
                }

                continue;
            }

            if ($node instanceof DOMElement && strtolower($node->tagName) === 'p') {
                $this->flushParagraph($buffer, $blocks);

                foreach ($this->convertParagraphFlow($node, $images) as $block) {
                    $blocks[] = $block;
                }

                continue;
            }

            if ($this->isConvertibleButton($node)) {
                $this->flushParagraph($buffer, $blocks);
                $i = $this->appendGroupedButtons($children, $i, $blocks);

                continue;
            }

            if ($node instanceof DOMElement && strtolower($node->tagName) === 'details') {
                $this->flushParagraph($buffer, $blocks);
                $i = $this->appendGroupedFaq($children, $i, $blocks);

                continue;
            }

            if (
                $node instanceof DOMElement
                && strtolower($node->tagName) !== 'a'
                && $this->containsConvertibleAdminBlock($node)
            ) {
                $this->flushParagraph($buffer, $blocks);

                foreach ($this->convertParagraphFlow($node, $images) as $block) {
                    $blocks[] = $block;
                }

                continue;
            }

            $block = $this->convertStandaloneNode($node, $images);

            if ($block !== null) {
                $this->flushParagraph($buffer, $blocks);
                $blocks[] = $block;

                continue;
            }

            $buffer .= $this->nodeHtml($node);
        }

        $this->flushParagraph($buffer, $blocks);

        return $blocks;
    }

    /**
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $images
     * @return array<int, array<string, mixed>>
     */
    protected function convertParagraphFlow(DOMElement $paragraph, array &$images): array
    {
        $blocks = [];
        $buffer = '';
        $children = iterator_to_array($paragraph->childNodes);

        for ($i = 0; $i < count($children); $i++) {
            $node = $children[$i];

            if ($this->isIgnorable($node)) {
                continue;
            }

            if ($node instanceof DOMElement) {
                $tag = strtolower($node->tagName);

                if (in_array($tag, ['img', 'figure'], true)) {
                    $this->flushParagraph($buffer, $blocks);
                    $block = $this->imageBlockFromNode($node, $images);

                    if ($block !== null) {
                        $blocks[] = $block;
                    }

                    continue;
                }

                if ($this->isConvertibleButton($node)) {
                    $this->flushParagraph($buffer, $blocks);
                    $i = $this->appendGroupedButtons($children, $i, $blocks);

                    continue;
                }

                if ($tag === 'table') {
                    $this->flushParagraph($buffer, $blocks);
                    $block = $this->tableBlockFromNode($node);

                    if ($block !== null) {
                        $blocks[] = $block;
                    }

                    continue;
                }

                if ($tag === 'details') {
                    $this->flushParagraph($buffer, $blocks);
                    $i = $this->appendGroupedFaq($children, $i, $blocks);

                    continue;
                }

                if (in_array($tag, $this->headingTags(), true)) {
                    $this->flushParagraph($buffer, $blocks);
                    $block = $this->convertStandaloneNode($node, $images);

                    if ($block !== null) {
                        $blocks[] = $block;
                    }

                    continue;
                }
            }

            $buffer .= $this->nodeHtml($node);
        }

        $this->flushParagraph($buffer, $blocks);

        return $blocks;
    }

    /**
     * @param  array<int, DOMNode>  $children
     * @param  array<int, array<string, mixed>>  $blocks
     */
    protected function appendGroupedButtons(array $children, int $index, array &$blocks): int
    {
        $items = [];
        $node = $children[$index];

        if ($this->isConvertibleButton($node) && $node instanceof DOMElement) {
            $item = $this->buttonItemFromNode($node);

            if ($item !== null) {
                $items[] = $item;
            }
        }

        $next = $this->nextSignificantIndex($children, $index + 1);

        while ($next !== null && $this->isConvertibleButton($children[$next])) {
            $button = $children[$next];
            $item = $button instanceof DOMElement ? $this->buttonItemFromNode($button) : null;

            if ($item !== null) {
                $items[] = $item;
            }

            $index = $next;
            $next = $this->nextSignificantIndex($children, $index + 1);
        }

        foreach ($this->buttonsBlocksFromItems($items) as $block) {
            $blocks[] = $block;
        }

        return $index;
    }

    /**
     * @param  array<int, DOMNode>  $children
     * @param  array<int, array<string, mixed>>  $blocks
     */
    protected function appendGroupedFaq(array $children, int $index, array &$blocks): int
    {
        $items = [];
        $node = $children[$index];

        if ($node instanceof DOMElement && strtolower($node->tagName) === 'details') {
            $item = $this->faqItemFromDetails($node);

            if ($item !== null) {
                $items[] = $item;
            }
        }

        $next = $this->nextSignificantIndex($children, $index + 1);

        while (
            $next !== null
            && $children[$next] instanceof DOMElement
            && strtolower($children[$next]->tagName) === 'details'
        ) {
            $item = $this->faqItemFromDetails($children[$next]);

            if ($item !== null) {
                $items[] = $item;
            }

            $index = $next;
            $next = $this->nextSignificantIndex($children, $index + 1);
        }

        if ($items !== []) {
            $blocks[] = [
                'type' => 'faq',
                'data' => [
                    'title' => null,
                    'items' => $items,
                ],
            ];
        }

        return $index;
    }

    /**
     * @param  array<int, DOMNode>  $children
     */
    protected function nextSignificantIndex(array $children, int $from): ?int
    {
        for ($i = $from; $i < count($children); $i++) {
            if (! $this->isIgnorable($children[$i])) {
                return $i;
            }
        }

        return null;
    }

    protected function isConvertibleButton(DOMNode $node): bool
    {
        return $node instanceof DOMElement
            && strtolower($node->tagName) === 'button'
            && $this->closestElement($node, 'a') === null
            && $this->buttonItemFromNode($node) !== null;
    }

    /**
     * @return array{label: string, url: string, style: string, target: string}|null
     */
    protected function buttonItemFromNode(DOMElement $button): ?array
    {
        $label = trim(preg_replace('/\s+/', ' ', $button->textContent) ?? '');

        if ($label === '') {
            return null;
        }

        $url = trim($button->getAttribute('formaction'))
            ?: trim($button->getAttribute('data-url'))
            ?: trim($button->getAttribute('data-href'))
            ?: '#';

        $target = trim($button->getAttribute('formtarget') ?: $button->getAttribute('data-target'));

        return [
            'label' => Str::limit($label, 100, ''),
            'url' => $url !== '' ? $url : '#',
            'style' => 'primary',
            'target' => $target === '_blank' ? '_blank' : '_self',
        ];
    }

    /**
     * @param  array<int, array{label: string, url: string, style: string, target: string}>  $items
     * @return array<int, array<string, mixed>>
     */
    protected function buttonsBlocksFromItems(array $items): array
    {
        $items = array_values(array_filter($items));

        if ($items === []) {
            return [];
        }

        $blocks = [];

        foreach (array_chunk($items, 3) as $chunk) {
            $blocks[] = [
                'type' => 'buttons',
                'data' => [
                    'title' => null,
                    'items' => $chunk,
                ],
            ];
        }

        return $blocks;
    }

    /**
     * @return array{question: string, answer: string}|null
     */
    protected function faqItemFromDetails(DOMElement $details): ?array
    {
        $summary = null;

        foreach ($details->childNodes as $child) {
            if ($child instanceof DOMElement && strtolower($child->tagName) === 'summary') {
                $summary = $child;
                break;
            }
        }

        $question = $summary
            ? trim(preg_replace('/\s+/', ' ', $summary->textContent) ?? '')
            : '';

        if ($question === '') {
            return null;
        }

        $answer = '';

        foreach ($details->childNodes as $child) {
            if ($child === $summary) {
                continue;
            }

            $answer .= $this->nodeHtml($child);
        }

        $answer = trim($answer);

        if ($answer === '') {
            return null;
        }

        if (! preg_match('/<(p|ul|ol|div|blockquote)\b/i', $answer)) {
            $answer = '<p>'.$answer.'</p>';
        }

        return [
            'question' => Str::limit($question, 255, ''),
            'answer' => $answer,
        ];
    }

    protected function closestElement(DOMElement $node, string $tag): ?DOMElement
    {
        $parent = $node->parentNode;

        while ($parent instanceof DOMElement) {
            if (strtolower($parent->tagName) === $tag) {
                return $parent;
            }

            $parent = $parent->parentNode;
        }

        return null;
    }

    protected function promoteFormActionsOntoButtons(DOMElement $root): void
    {
        foreach (iterator_to_array($root->getElementsByTagName('button')) as $button) {
            if (! $button instanceof DOMElement) {
                continue;
            }

            if (
                trim($button->getAttribute('formaction')) !== ''
                || trim($button->getAttribute('data-url')) !== ''
                || trim($button->getAttribute('data-href')) !== ''
            ) {
                continue;
            }

            $form = $this->closestElement($button, 'form');
            $action = $form ? trim($form->getAttribute('action')) : '';

            if ($action !== '') {
                $button->setAttribute('data-url', $action);
            }
        }
    }

    protected function containsConvertibleAdminBlock(DOMElement $node): bool
    {
        foreach ($node->getElementsByTagName('button') as $button) {
            if ($button instanceof DOMElement && $this->isConvertibleButton($button)) {
                return true;
            }
        }

        foreach (['details', 'table', 'img', 'figure'] as $tag) {
            if ($node->getElementsByTagName($tag)->length > 0) {
                return true;
            }
        }

        return false;
    }
}
