<?php

namespace App\Support\Html;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;

class UnknownElementUnwrapper
{
    /**
     * Tags that Filament/Symfony safe sanitization already allows, plus importer placeholders.
     *
     * @var list<string>
     */
    protected const ALLOWED_TAGS = [
        'a', 'b', 'blockquote', 'br', 'code', 'em', 'figcaption', 'figure', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'hr', 'i', 'iframe', 'img', 'li', 'ol', 'p', 'pre', 'span', 'strong', 'table', 'tbody', 'td', 'tfoot',
        'th', 'thead', 'tr', 'u', 'ul', 'wp-block',
    ];

    /**
     * @param  list<string>  $extraAllowedTags
     */
    public function __construct(
        protected array $extraAllowedTags = [],
    ) {}

    public function unwrap(string $html): string
    {
        $html = trim($html);

        if ($html === '') {
            return '';
        }

        $dom = $this->loadDom($html);
        $root = $this->root($dom);

        if (! $root instanceof DOMElement) {
            return $html;
        }

        $this->unwrapUnknownDescendants($root);

        return $this->innerHtml($root);
    }

    public function unwrapDocumentRoot(DOMElement $root): void
    {
        $this->unwrapUnknownDescendants($root);
    }

    public function shouldUnwrap(DOMElement $element): bool
    {
        $tag = strtolower($element->tagName);

        if (in_array($tag, [...self::ALLOWED_TAGS, ...$this->extraAllowedTags], true)) {
            return false;
        }

        return true;
    }

    protected function unwrapUnknownDescendants(DOMElement $root): void
    {
        $guard = 0;

        while ($guard < 50) {
            $guard++;
            $targets = [];

            foreach ($this->descendantElements($root) as $element) {
                if ($this->shouldUnwrap($element)) {
                    $targets[] = $element;
                }
            }

            if ($targets === []) {
                return;
            }

            usort($targets, fn (DOMElement $a, DOMElement $b): int => $this->depth($b) <=> $this->depth($a));

            foreach ($targets as $element) {
                if ($element->parentNode instanceof DOMNode) {
                    $this->promoteChildren($element);
                }
            }
        }
    }

    protected function promoteChildren(DOMElement $element): void
    {
        $parent = $element->parentNode;

        if (! $parent instanceof DOMNode) {
            return;
        }

        while ($element->firstChild instanceof DOMNode) {
            $parent->insertBefore($element->firstChild, $element);
        }

        $parent->removeChild($element);
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

    protected function depth(DOMNode $node): int
    {
        $depth = 0;

        while ($node->parentNode instanceof DOMNode) {
            $depth++;
            $node = $node->parentNode;
        }

        return $depth;
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
        $xpath = new DOMXPath($dom);
        $node = $xpath->query('//*[@id="wp-import-root"]')->item(0);

        return $node instanceof DOMElement ? $node : null;
    }

    protected function innerHtml(DOMNode $node): string
    {
        $html = '';

        foreach ($node->childNodes as $child) {
            $html .= $node->ownerDocument?->saveHTML($child) ?: '';
        }

        return $html;
    }
}
