<?php

namespace App\Services\WordPress;

class WordpressPost
{
    public function __construct(
        public int $wordpressId,
        public string $title,
        public string $slug,
        public string $status,
        public ?string $permalink,
        public ?string $excerpt,
        public string $content,
        public ?string $publishedDate,
        public ?string $featuredImageUrl,
        public array $imageUrls,
        public array $categoryPaths,
        public ?string $rankMathTitle,
        public ?string $rankMathDescription,
        public array $tags = [],
    ) {}

    public function isPublished(): bool
    {
        return $this->status === 'publish';
    }

    public function checksum(): string
    {
        return sha1(implode("\n", [
            (string) $this->wordpressId,
            $this->title,
            $this->slug,
            $this->content,
            (string) $this->publishedDate,
            (string) $this->featuredImageUrl,
            implode('|', array_map(fn (array $path): string => implode('>', $path), $this->categoryPaths)),
        ]));
    }
}
