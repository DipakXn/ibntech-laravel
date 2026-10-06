<?php

namespace App\Services\Analytics;

final readonly class UserAgentSummary
{
    private const BOT_PATTERN = '/(?:googlebot|bingbot|bingpreview|duckduckbot|baiduspider|yandex(?:bot|images)?|slurp|sogou|exabot|facebot|facebookexternalhit|ia_archiver|ahrefs|semrush|mj12bot|dotbot|petalbot|bytespider|gptbot|oai-searchbot|chatgpt-user|claudebot|anthropic-ai|amazonbot|applebot|twitterbot|linkedinbot|telegrambot|slackbot|discordbot|pinterestbot|redditbot|embedly|quora link preview|outbrain|rogerbot|screaming frog|headless|phantomjs|selenium|wget\/|curl\/|python-requests|go-http-client|libwww-perl|scrapy|crawler|spider|httpclient|okhttp|node-fetch|postmanruntime|uptimerobot|pingdom|statuscake|site24x7|lighthouse|pagespeed|gtmetrix|dataforseo|serpstat|blexbot|seznambot|qwantify|archive\.org_bot|ccbot|diffbot)/i';

    public function __construct(
        public ?string $device,
        public ?string $browser,
        public ?string $operatingSystem,
        public bool $isBot,
    ) {}

    public static function from(?string $userAgent): self
    {
        $userAgent = trim((string) $userAgent);

        if ($userAgent === '' || self::isBot($userAgent)) {
            return new self(null, null, null, true);
        }

        return new self(
            self::device($userAgent),
            self::browser($userAgent),
            self::operatingSystem($userAgent),
            false,
        );
    }

    private static function isBot(string $userAgent): bool
    {
        if (preg_match(self::BOT_PATTERN, $userAgent) === 1) {
            return true;
        }

        if (preg_match('/cubot/i', $userAgent) === 1) {
            return false;
        }

        return preg_match('/(?:bot|crawler|spider)\b/i', $userAgent) === 1;
    }

    private static function device(string $userAgent): string
    {
        if (preg_match('/iPad|Tablet|PlayBook|Kindle|Silk/i', $userAgent) === 1) {
            return 'tablet';
        }

        if (preg_match('/Macintosh/i', $userAgent) === 1 && preg_match('/Mobile/i', $userAgent) === 1) {
            return 'tablet';
        }

        if (preg_match('/Android/i', $userAgent) === 1 && preg_match('/Mobile/i', $userAgent) !== 1) {
            return 'tablet';
        }

        if (preg_match('/Mobile|iPhone|iPod|Android|webOS|BlackBerry|IEMobile|Opera Mini/i', $userAgent) === 1) {
            return 'mobile';
        }

        return 'desktop';
    }

    private static function browser(string $userAgent): ?string
    {
        return match (true) {
            preg_match('/Edg(?:e|A|iOS)?\//i', $userAgent) === 1 => 'Edge',
            preg_match('/OPR\/|Opera\//i', $userAgent) === 1 => 'Opera',
            preg_match('/SamsungBrowser/i', $userAgent) === 1 => 'Samsung Internet',
            preg_match('/Chrome\/|CriOS\//i', $userAgent) === 1 => 'Chrome',
            preg_match('/Firefox\/|FxiOS\//i', $userAgent) === 1 => 'Firefox',
            preg_match('/Safari\//i', $userAgent) === 1 => 'Safari',
            preg_match('/MSIE |Trident\//i', $userAgent) === 1 => 'Internet Explorer',
            default => null,
        };
    }

    private static function operatingSystem(string $userAgent): ?string
    {
        return match (true) {
            preg_match('/iPhone|iPad|iPod/i', $userAgent) === 1 => 'iOS',
            preg_match('/Macintosh/i', $userAgent) === 1 && preg_match('/Mobile/i', $userAgent) === 1 => 'iOS',
            preg_match('/Android/i', $userAgent) === 1 => 'Android',
            preg_match('/CrOS/i', $userAgent) === 1 => 'ChromeOS',
            preg_match('/Windows/i', $userAgent) === 1 => 'Windows',
            preg_match('/Macintosh|Mac OS X/i', $userAgent) === 1 => 'macOS',
            preg_match('/Linux/i', $userAgent) === 1 => 'Linux',
            default => null,
        };
    }
}
