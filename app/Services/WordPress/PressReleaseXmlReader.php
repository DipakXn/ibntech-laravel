<?php

namespace App\Services\WordPress;

use SimpleXMLElement;

class PressReleaseXmlReader
{
    /**
     * @return \Generator<int, PressReleasePost>
     */
    public function posts(string $directory): \Generator
    {
        if (! is_dir($directory)) {
            throw new \RuntimeException("Press release XML directory not found: {$directory}");
        }

        $files = glob(rtrim($directory, '\\/').DIRECTORY_SEPARATOR.'*.xml') ?: [];
        sort($files);

        foreach ($files as $path) {
            $post = $this->readFile($path);

            if ($post !== null) {
                yield $post;
            }
        }
    }

    public function readFile(string $path): ?PressReleasePost
    {
        $element = @simplexml_load_file($path, SimpleXMLElement::class, LIBXML_NOCDATA | LIBXML_NONET);

        if (! $element instanceof SimpleXMLElement) {
            throw new \RuntimeException('Unable to parse Press Release XML: '.$path);
        }

        $title = $this->text($element, 'Title');
        $permalink = $this->text($element, 'Permalink');
        $content = $this->text($element, 'Content');

        if ($title === '' && $content === '') {
            return null;
        }

        if ($title === '' || $permalink === '' || $content === '') {
            throw new \RuntimeException('Press Release XML is missing Title, Permalink, or Content: '.$path);
        }

        return new PressReleasePost(
            sourceFile: basename($path),
            title: $title,
            slug: PressReleasePermalink::slug($permalink, $title),
            permalink: $permalink,
            content: $content,
            rankMathTitle: $this->text($element, 'rank_math_title') ?: null,
            rankMathDescription: $this->text($element, 'rank_math_description') ?: null,
        );
    }

    protected function text(SimpleXMLElement $element, string $name): string
    {
        $value = $element->{$name} ?? null;

        if ($value === null) {
            return '';
        }

        return trim(html_entity_decode((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }
}
