<?php

namespace App\Services\WordPress;

use Illuminate\Support\Str;
use SimpleXMLElement;
use XMLReader;

class WordpressXmlReader
{
    /**
     * @return \Generator<int, WordpressPost>
     */
    public function posts(string $path): \Generator
    {
        $reader = new XMLReader;

        if (! $reader->open($path, null, LIBXML_NONET)) {
            throw new \RuntimeException("Unable to open WordPress XML file: {$path}");
        }

        try {
            while ($reader->read()) {
                if ($reader->nodeType !== XMLReader::ELEMENT || $reader->localName !== 'post') {
                    continue;
                }

                $xml = $reader->readOuterXML();
                $element = @simplexml_load_string($xml, SimpleXMLElement::class, LIBXML_NOCDATA);

                if ($element instanceof SimpleXMLElement) {
                    $post = $this->mapPost($element);

                    if ($post !== null) {
                        yield $post;
                    }
                }
            }
        } finally {
            $reader->close();
        }
    }

    protected function mapPost(SimpleXMLElement $element): ?WordpressPost
    {
        $wordpressId = (int) $this->text($element, 'id');

        if ($wordpressId < 1) {
            return null;
        }

        $title = $this->text($element, 'Title') ?: 'Untitled post';
        $permalink = $this->text($element, 'Permalink');
        $imageUrls = $this->imageUrls($this->text($element, 'ImageURL'));

        return new WordpressPost(
            wordpressId: $wordpressId,
            title: $title,
            slug: $this->slugFromPermalink($permalink, $title),
            status: Str::lower($this->text($element, 'Status') ?: ''),
            permalink: $permalink ?: null,
            excerpt: $this->text($element, 'Excerpt') ?: null,
            content: $this->text($element, 'Content'),
            publishedDate: $this->text($element, 'Date') ?: null,
            featuredImageUrl: $imageUrls[0] ?? null,
            imageUrls: $imageUrls,
            categoryPaths: $this->categoryPaths($this->text($element, 'Categories')),
            rankMathTitle: $this->text($element, 'rank_math_title') ?: null,
            rankMathDescription: $this->text($element, 'rank_math_description') ?: null,
            tags: $this->tags($this->text($element, 'Tags')),
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

    /**
     * @return array<int, string>
     */
    protected function imageUrls(?string $value): array
    {
        if (blank($value)) {
            return [];
        }

        return collect(preg_split('/\s*\|\s*/', $value) ?: [])
            ->map(fn (string $url): string => trim($url))
            ->filter(fn (string $url): bool => str_starts_with($url, 'http://') || str_starts_with($url, 'https://'))
            ->values()
            ->all();
    }

    /**
     * @return array<int, array<int, string>>
     */
    protected function categoryPaths(?string $value): array
    {
        if (blank($value)) {
            return [];
        }

        return collect(preg_split('/\s*\|\s*/', $value) ?: [])
            ->map(function (string $path): array {
                return collect(explode('>', html_entity_decode($path, ENT_QUOTES | ENT_HTML5, 'UTF-8')))
                    ->map(fn (string $name): string => trim($name))
                    ->filter()
                    ->values()
                    ->all();
            })
            ->filter()
            ->values()
            ->all();
    }

    /**
     * @return array<int, string>
     */
    protected function tags(?string $value): array
    {
        if (blank($value)) {
            return [];
        }

        return collect(preg_split('/\s*[|,]\s*/', $value) ?: [])
            ->map(fn (string $tag): string => trim($tag))
            ->filter()
            ->values()
            ->all();
    }

    protected function slugFromPermalink(?string $permalink, string $title): string
    {
        $slug = '';

        if (filled($permalink)) {
            $path = (string) parse_url($permalink, PHP_URL_PATH);
            $slug = trim((string) basename(rtrim($path, '/')), '/');
        }

        $slug = Str::slug($slug !== '' ? $slug : $title);

        return $slug !== '' ? $slug : 'blog-post';
    }
}
