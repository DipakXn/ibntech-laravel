<?php

namespace App\Services\Analytics;

final readonly class SubmissionSource
{
    public const CONTENT = 'content';

    public const PATH = 'path';

    public const UNAVAILABLE = 'unavailable';

    private function __construct(
        public string $kind,
        public ?string $contentType,
        public ?int $contentId,
        public ?string $path,
    ) {}

    public static function content(string $contentType, int $contentId, string $path): self
    {
        return new self(self::CONTENT, $contentType, $contentId, $path);
    }

    public static function path(string $path): self
    {
        return new self(self::PATH, null, null, $path);
    }

    public static function unavailable(): self
    {
        return new self(self::UNAVAILABLE, null, null, null);
    }

    public function key(): ?string
    {
        return match ($this->kind) {
            self::CONTENT => 'content:'.$this->contentType.':'.$this->contentId,
            self::PATH => 'path:'.$this->path,
            default => null,
        };
    }
}
