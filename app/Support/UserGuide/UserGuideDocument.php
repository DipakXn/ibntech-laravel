<?php

namespace App\Support\UserGuide;

final class UserGuideDocument
{
    /**
     * @param  list<array{id: string, text: string, level: int}>  $headings
     */
    public function __construct(
        public readonly UserGuideTopic $topic,
        public readonly string $html,
        public readonly array $headings,
    ) {}
}
