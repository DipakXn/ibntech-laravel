<?php

namespace App\Support\Sitemap;

use DateTimeInterface;

class SitemapUrlEntry
{
    public function __construct(
        public readonly string $loc,
        public readonly ?DateTimeInterface $lastmod = null,
        public readonly ?string $changefreq = null,
        public readonly ?string $priority = null,
    ) {}

    /**
     * @return array{loc: string, lastmod: ?string, changefreq: ?string, priority: ?string}
     */
    public function toViewData(): array
    {
        return [
            'loc' => $this->loc,
            'lastmod' => $this->lastmod?->format('Y-m-d\TH:i:sP'),
            'changefreq' => $this->changefreq,
            'priority' => $this->priority,
        ];
    }
}
