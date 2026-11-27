<?php

namespace App\Support\Health;

final class ApplicationOrigin
{
    private function __construct(
        public readonly bool $valid,
        public readonly ?string $url,
        public readonly ?string $scheme,
        public readonly ?string $host,
        public readonly ?int $port,
        public readonly ?string $reason,
    ) {}

    public static function fromConfig(): self
    {
        $url = trim((string) config('app.url'));

        if ($url === '' || preg_match('/\s/', $url) === 1) {
            return self::invalid('The application URL is not configured.');
        }

        $parts = parse_url($url);

        if (! is_array($parts) || isset($parts['user']) || isset($parts['pass'])) {
            return self::invalid('The application URL is not valid.');
        }

        $scheme = strtolower((string) ($parts['scheme'] ?? ''));
        $host = self::normalizeHost((string) ($parts['host'] ?? ''));

        if (! in_array($scheme, ['http', 'https'], true) || $host === '') {
            return self::invalid('The application URL is not valid.');
        }

        $port = self::portFromParts($parts, $scheme);

        if ($port === null) {
            return self::invalid('The application URL is not valid.');
        }

        return new self(true, $url, $scheme, $host, $port, null);
    }

    public function isSameOrigin(string $candidate): bool
    {
        if (! $this->valid || $this->scheme === null || $this->host === null || $this->port === null) {
            return false;
        }

        $candidate = trim($candidate);

        if ($candidate === '' || str_starts_with($candidate, '//') || preg_match('/\s/', $candidate) === 1) {
            return false;
        }

        if (str_starts_with($candidate, '/') && $this->url !== null) {
            $candidate = $this->scheme.'://'.$this->host.self::portSuffix($this->scheme, $this->port).$candidate;
        }

        $parts = parse_url($candidate);

        if (! is_array($parts) || isset($parts['user']) || isset($parts['pass'])) {
            return false;
        }

        $scheme = strtolower((string) ($parts['scheme'] ?? ''));
        $host = self::normalizeHost((string) ($parts['host'] ?? ''));
        $port = self::portFromParts($parts, $scheme);

        return $scheme === $this->scheme
            && $host !== ''
            && $host === $this->host
            && $port === $this->port;
    }

    public function isLocalHost(): bool
    {
        return in_array($this->host, ['localhost', '127.0.0.1', '::1'], true);
    }

    public function isIpAddress(): bool
    {
        return $this->host !== null && filter_var($this->host, FILTER_VALIDATE_IP) !== false;
    }

    private static function invalid(string $reason): self
    {
        return new self(false, null, null, null, null, $reason);
    }

    /**
     * @param  array<string, mixed>  $parts
     */
    private static function portFromParts(array $parts, string $scheme): ?int
    {
        if (isset($parts['port'])) {
            $port = (int) $parts['port'];

            return ($port >= 1 && $port <= 65535) ? $port : null;
        }

        return match ($scheme) {
            'https' => 443,
            'http' => 80,
            default => null,
        };
    }

    private static function normalizeHost(string $host): string
    {
        $host = strtolower(trim($host));

        if (str_starts_with($host, '[') && str_ends_with($host, ']')) {
            $host = substr($host, 1, -1);
        }

        return $host;
    }

    private static function portSuffix(string $scheme, int $port): string
    {
        $default = $scheme === 'https' ? 443 : 80;

        return $port === $default ? '' : ':'.$port;
    }
}
