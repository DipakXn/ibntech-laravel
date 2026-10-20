<?php

namespace App\Support\UserGuide;

final class UserGuideTopic
{
    public function __construct(
        public readonly string $slug,
        public readonly string $title,
        public readonly string $group,
        public readonly string $summary,
        public readonly int $sort,
        public readonly string $keywords,
        public readonly string $body,
        public readonly string $path,
    ) {}
}
