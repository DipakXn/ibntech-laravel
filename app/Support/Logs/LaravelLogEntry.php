<?php

namespace App\Support\Logs;

readonly class LaravelLogEntry
{
    /**
     * @param  array<int, string>  $contextLines
     */
    public function __construct(
        public string $timestamp,
        public string $environment,
        public string $level,
        public string $message,
        public array $contextLines,
        public string $raw,
    ) {}

    public function hasContext(): bool
    {
        return $this->contextLines !== [];
    }

    public function context(): string
    {
        return implode("\n", $this->contextLines);
    }

    public function searchHaystack(): string
    {
        return $this->raw;
    }
}
