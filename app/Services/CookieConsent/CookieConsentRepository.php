<?php

namespace App\Services\CookieConsent;

use App\Models\CookieCategory;
use App\Models\CookieConsentSetting;
use App\Models\CookieIntegration;
use App\Models\CookieRegistryEntry;
use App\Models\WebsiteSetting;
use App\Services\WebsiteSettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final class CookieConsentRepository
{
    public function __construct(
        private readonly WebsiteSettingService $websiteSettings,
        private readonly JurisdictionResolver $jurisdictions,
    ) {}

    public function forget(): void
    {
        foreach ((array) config('cookie-consent.environments', []) as $environment) {
            Cache::forget($this->cacheKey((string) $environment));
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function payload(): array
    {
        $snapshot = $this->snapshot();

        return [
            'cookieName' => (string) config('cookie-consent.cookie'),
            'policyVersion' => $snapshot['policy_version'],
            'configVersion' => $snapshot['config_version'],
            'lifetimeDays' => $snapshot['lifetime_days'],
            'mode' => $this->jurisdictions->publicMode(),
            'metricsUrl' => route('cookie-consent.metrics'),
            'banner' => $snapshot['banner'],
            'categories' => $snapshot['categories'],
            'integrations' => $snapshot['integrations'],
        ];
    }

    /**
     * @return array{categories: list<array<string, mixed>>, entries: list<array<string, mixed>>}
     */
    public function policy(): array
    {
        $snapshot = $this->snapshot();

        return [
            'categories' => $snapshot['categories'],
            'entries' => $snapshot['entries'],
        ];
    }

    public function choiceFromRequest(Request $request): ?ConsentChoice
    {
        $raw = $request->cookies->get((string) config('cookie-consent.cookie'));

        return $this->parse(is_string($raw) ? $raw : null);
    }

    public function parse(?string $raw): ?ConsentChoice
    {
        if ($raw === null || strlen($raw) > 600) {
            return null;
        }

        $data = json_decode($raw, true);

        if (! is_array($data)) {
            return null;
        }

        $snapshot = $this->snapshot();
        $version = $data['v'] ?? null;
        $configVersion = $data['cv'] ?? null;
        $timestamp = $data['ts'] ?? null;
        $action = $data['action'] ?? null;

        if (! is_string($version) || $version !== $snapshot['policy_version']) {
            return null;
        }

        if (! is_int($configVersion) || $configVersion !== $snapshot['config_version']) {
            return null;
        }

        if (! is_int($timestamp)) {
            return null;
        }

        $now = time();

        if ($timestamp > $now + 300) {
            return null;
        }

        if ($now - $timestamp > ($snapshot['lifetime_days'] * 86400)) {
            return null;
        }

        if (! in_array($action, ['accept_all', 'reject_all', 'custom'], true)) {
            return null;
        }

        $flags = [];

        foreach (['necessary', 'analytics', 'marketing', 'functional'] as $category) {
            if (! array_key_exists($category, $data) || ! is_bool($data[$category])) {
                return null;
            }

            $flags[$category] = $data[$category];
        }

        if ($flags['necessary'] !== true) {
            return null;
        }

        foreach (['analytics', 'marketing', 'functional'] as $category) {
            $enabled = (bool) ($snapshot['enabled'][$category] ?? false);

            if (! $enabled && $flags[$category] === true) {
                return null;
            }

            if ($action === 'reject_all' && $flags[$category] === true) {
                return null;
            }

            if ($action === 'accept_all' && $enabled && $flags[$category] !== true) {
                return null;
            }
        }

        return new ConsentChoice(
            policyVersion: $version,
            configVersion: $configVersion,
            timestamp: $timestamp,
            necessary: true,
            analytics: $flags['analytics'],
            marketing: $flags['marketing'],
            functional: $flags['functional'],
            action: $action,
        );
    }

    /**
     * @return array<string, mixed>
     */
    private function snapshot(): array
    {
        return Cache::rememberForever($this->cacheKey(app()->environment()), function (): array {
            return $this->buildSnapshot();
        });
    }

    /**
     * @return array<string, mixed>
     */
    private function buildSnapshot(): array
    {
        $setting = CookieConsentSetting::query()->first();

        if (! $setting) {
            $setting = new CookieConsentSetting([
                'banner_enabled' => true,
                'banner_position' => 'bottom',
                'consent_lifetime_days' => 365,
                'policy_version' => '1',
                'config_version' => 1,
                'privacy_policy_url' => '/privacy-policy/',
                'cookie_policy_url' => '/cookies-policy/',
                'banner_title' => 'Cookies',
                'banner_text' => 'We use cookies to improve your experience. Do you accept?',
                'accept_label' => 'Accept All',
                'reject_label' => 'Reject All',
                'settings_label' => 'Preferences',
                'save_label' => 'Save My Preferences',
                'modal_title' => 'Cookie settings',
                'modal_text' => 'Necessary cookies are always on.',
            ]);
        }

        $categories = CookieCategory::query()->orderBy('sort_order')->orderBy('id')->get();
        $enabled = [];
        $categoryPayload = [];

        foreach ($categories as $category) {
            $isEnabled = $category->isNecessary() ? true : (bool) $category->is_enabled;
            $enabled[$category->key] = $isEnabled;
            $categoryPayload[] = [
                'key' => $category->key,
                'name' => $category->name,
                'description' => $category->description,
                'details' => $category->details,
                'required' => $category->isNecessary() || (bool) $category->is_mandatory,
                'enabled' => $isEnabled,
            ];
        }

        $website = $this->websiteSettings();
        $environment = app()->environment();
        $integrations = [];

        foreach (CookieIntegration::query()->orderBy('sort_order')->orderBy('id')->get() as $integration) {
            if (! $integration->is_enabled) {
                continue;
            }

            if (! in_array($environment, (array) $integration->environments, true)) {
                continue;
            }

            if ($integration->key === 'recaptcha') {
                continue;
            }

            $categoriesForIntegration = array_values(array_filter(
                (array) $integration->consent_categories,
                fn (mixed $category): bool => is_string($category) && ($enabled[$category] ?? false) === true,
            ));

            if ($categoriesForIntegration === []) {
                continue;
            }

            $id = $this->measurementId($integration, $website);

            if (in_array($integration->key, ['ga4', 'gtm', 'google_ads', 'linkedin'], true) && $id === null) {
                continue;
            }

            $integrations[] = [
                'key' => $integration->key,
                'categories' => $categoriesForIntegration,
                'id' => $id,
            ];
        }

        $liveIntegrationKeys = array_column($integrations, 'key');
        $entries = [];

        $registry = CookieRegistryEntry::query()
            ->with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        foreach ($registry as $entry) {
            if (is_string($entry->integration_key) && $entry->integration_key !== '' && ! in_array($entry->integration_key, $liveIntegrationKeys, true)) {
                continue;
            }

            $entries[] = [
                'name' => $entry->name,
                'provider' => $entry->provider,
                'category' => $entry->category?->name,
                'purpose' => $entry->purpose,
                'duration' => $entry->duration,
                'domain' => $entry->domain,
                'privacyUrl' => $this->safeUrl($entry->privacy_policy_url),
            ];
        }

        return [
            'policy_version' => (string) $setting->policy_version,
            'config_version' => (int) $setting->config_version,
            'lifetime_days' => max(1, (int) $setting->consent_lifetime_days),
            'enabled' => $enabled,
            'banner' => [
                'enabled' => (bool) $setting->banner_enabled,
                'position' => 'bottom',
                'title' => $setting->banner_title,
                'text' => $setting->banner_text,
                'acceptLabel' => $setting->accept_label,
                'rejectLabel' => $setting->reject_label,
                'settingsLabel' => $setting->settings_label,
                'saveLabel' => $setting->save_label,
                'modalTitle' => $setting->modal_title,
                'modalText' => $setting->modal_text,
                'privacyUrl' => $this->safeUrl($setting->privacy_policy_url) ?? url('/privacy-policy/'),
                'cookieUrl' => $this->safeUrl($setting->cookie_policy_url) ?? url('/cookies-policy/'),
            ],
            'categories' => $categoryPayload,
            'integrations' => $integrations,
            'entries' => $entries,
        ];
    }

    private function websiteSettings(): ?WebsiteSetting
    {
        try {
            return $this->websiteSettings->get();
        } catch (\Throwable) {
            return null;
        }
    }

    private function measurementId(CookieIntegration $integration, ?WebsiteSetting $settings): ?string
    {
        $override = match ($integration->key) {
            'ga4' => config('cookie-consent.google_analytics_id'),
            'gtm' => config('cookie-consent.google_tag_manager_id'),
            'google_ads' => config('cookie-consent.google_ads_id'),
            'linkedin' => config('cookie-consent.linkedin_partner_id'),
            default => null,
        };

        $raw = filled($override) ? (string) $override : match ($integration->key) {
            'ga4' => $settings?->google_analytics_id,
            'gtm' => $settings?->google_tag_manager_id,
            'google_ads', 'linkedin' => $integration->measurement_id,
            default => null,
        };

        $id = trim((string) $raw);

        return preg_match('/^[A-Za-z0-9_-]{2,40}$/', $id) === 1 ? $id : null;
    }

    private function safeUrl(?string $url): ?string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return null;
        }

        if (str_starts_with($url, '/') && ! str_starts_with($url, '//')) {
            return url($url);
        }

        if (filter_var($url, FILTER_VALIDATE_URL) && preg_match('/^https?:\/\//i', $url) === 1) {
            return $url;
        }

        return null;
    }

    private function cacheKey(string $environment): string
    {
        return 'cookie-consent.snapshot.'.$environment;
    }
}
