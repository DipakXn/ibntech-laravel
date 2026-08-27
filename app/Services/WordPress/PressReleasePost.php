<?php

namespace App\Services\WordPress;

class PressReleasePost
{
    public const PROTECTED_SLUG = 'outsourcing-accounting-and-bookkeeping-services-for-small-businesses-uk';

    public function __construct(
        public string $sourceFile,
        public string $title,
        public string $slug,
        public string $permalink,
        public string $content,
        public ?string $rankMathTitle,
        public ?string $rankMathDescription,
    ) {}

    public function isProtected(): bool
    {
        return $this->slug === self::PROTECTED_SLUG;
    }

    public function checksum(): string
    {
        return sha1(implode("\n", [
            $this->permalink,
            $this->title,
            $this->slug,
            $this->content,
            (string) $this->rankMathTitle,
            (string) $this->rankMathDescription,
        ]));
    }
}
