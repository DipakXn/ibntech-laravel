<?php

namespace App\Services\CookieConsent;

use Illuminate\Support\Facades\DB;

final class CookieConsentDefaults
{
    public static function install(): void
    {
        $now = now();

        $categories = [
            [
                'key' => 'necessary',
                'name' => 'Necessary cookies',
                'description' => 'Required for security, page navigation, and the features you ask for. These cookies keep your session, protect forms, and store this consent choice.',
                'details' => 'Necessary cookies include the Laravel session, the CSRF token, the consent cookie, and Google reCAPTCHA when a form needs abuse protection. They stay on and cannot be switched off.',
                'is_mandatory' => true,
                'is_enabled' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'analytics',
                'name' => 'Analytics cookies',
                'description' => 'Help us understand how the site is used. This covers first-party page counts and Google Analytics when that service is enabled for this environment.',
                'details' => 'Analytics cookies stay off until you allow them. Rejecting analytics does not affect pages, forms, or security.',
                'is_mandatory' => false,
                'is_enabled' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'marketing',
                'name' => 'Marketing cookies',
                'description' => 'Used to measure advertising, including Google Ads and the LinkedIn Insight Tag when those services are enabled.',
                'details' => 'Marketing cookies stay off until you allow them. Allowing analytics does not allow marketing.',
                'is_mandatory' => false,
                'is_enabled' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'functional',
                'name' => 'Functional cookies',
                'description' => 'Used for optional features such as videos embedded from YouTube or Vimeo.',
                'details' => 'Embedded media stays blocked until you allow functional cookies. The rest of the page continues to work.',
                'is_mandatory' => false,
                'is_enabled' => true,
                'sort_order' => 4,
            ],
        ];

        $categoryIds = [];

        foreach ($categories as $category) {
            DB::table('cookie_categories')->insert($category + [
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $categoryIds[$category['key']] = (int) DB::table('cookie_categories')->where('key', $category['key'])->value('id');
        }

        $entries = [
            [
                'category' => 'necessary',
                'name' => (string) config('session.cookie'),
                'provider' => 'IBN Technologies',
                'purpose' => 'Keeps your secure session so forms, CSRF protection, and signed-in administration work.',
                'duration' => 'Session',
                'domain' => 'First party',
                'integration_key' => null,
                'sort_order' => 1,
            ],
            [
                'category' => 'necessary',
                'name' => 'XSRF-TOKEN',
                'provider' => 'IBN Technologies',
                'purpose' => 'Protects forms against cross-site request forgery.',
                'duration' => 'Session',
                'domain' => 'First party',
                'integration_key' => null,
                'sort_order' => 2,
            ],
            [
                'category' => 'necessary',
                'name' => (string) config('cookie-consent.cookie'),
                'provider' => 'IBN Technologies',
                'purpose' => 'Stores your cookie category choices, the time you chose, and the consent policy version.',
                'duration' => '365 days',
                'domain' => 'First party',
                'integration_key' => null,
                'sort_order' => 3,
            ],
            [
                'category' => 'necessary',
                'name' => '_GRECAPTCHA',
                'provider' => 'Google reCAPTCHA',
                'purpose' => 'Helps protect forms from abuse. It is requested only when a form that uses reCAPTCHA is shown or opened.',
                'duration' => 'Up to 6 months',
                'domain' => 'google.com',
                'integration_key' => null,
                'sort_order' => 4,
            ],
            [
                'category' => 'analytics',
                'name' => (string) config('analytics.visitor_cookie'),
                'provider' => 'IBN Technologies',
                'purpose' => 'Anonymous first-party identifier used to count page views after analytics consent. It is not derived from your IP address.',
                'duration' => '400 days',
                'domain' => 'First party',
                'integration_key' => null,
                'sort_order' => 5,
            ],
        ];

        foreach ($entries as $entry) {
            $category = $entry['category'];
            unset($entry['category']);

            DB::table('cookie_registry_entries')->insert($entry + [
                'cookie_category_id' => $categoryIds[$category],
                'privacy_policy_url' => null,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $integrations = [
            [
                'key' => 'ga4',
                'name' => 'Google Analytics 4',
                'description' => 'Loads the GA4 tag only after analytics consent. The measurement ID comes from Website Settings for this environment. Disable this integration if the same GA4 property is already sent by Google Tag Manager.',
                'category_key' => 'analytics',
                'consent_categories' => json_encode(['analytics']),
                'is_enabled' => true,
                'environments' => json_encode(['production']),
                'sort_order' => 1,
            ],
            [
                'key' => 'google_ads',
                'name' => 'Google Ads',
                'description' => 'Loads the Google Ads tag only after marketing consent. Leave the ID empty until this environment has its own Ads ID.',
                'category_key' => 'marketing',
                'consent_categories' => json_encode(['marketing']),
                'is_enabled' => false,
                'environments' => json_encode(['production']),
                'sort_order' => 2,
            ],
            [
                'key' => 'gtm',
                'name' => 'Google Tag Manager',
                'description' => 'Loads the container only after consent for at least one of its categories, and only after Google Consent Mode v2 is set. GA4 tags must require analytics storage. Google Ads tags must require ad storage, ad user data, and ad personalization. The LinkedIn Insight Tag and any other non-Google tag must require the marketing consent signal. Analytics consent must not fire marketing tags.',
                'category_key' => 'mixed',
                'consent_categories' => json_encode(['analytics', 'marketing']),
                'is_enabled' => true,
                'environments' => json_encode(['production']),
                'sort_order' => 3,
            ],
            [
                'key' => 'linkedin',
                'name' => 'LinkedIn Insight Tag',
                'description' => 'Loads the LinkedIn Insight Tag only after marketing consent. Leave the partner ID empty until this environment has its own ID.',
                'category_key' => 'marketing',
                'consent_categories' => json_encode(['marketing']),
                'is_enabled' => false,
                'environments' => json_encode(['production']),
                'sort_order' => 4,
            ],
            [
                'key' => 'recaptcha',
                'name' => 'Google reCAPTCHA',
                'description' => 'Protects forms from abuse. It is necessary and loads only when a form that uses it is present or opened. The site key stays in the server environment.',
                'category_key' => 'necessary',
                'consent_categories' => json_encode(['necessary']),
                'is_enabled' => true,
                'environments' => json_encode(['local', 'staging', 'production']),
                'sort_order' => 5,
            ],
            [
                'key' => 'media_embeds',
                'name' => 'Embedded video',
                'description' => 'YouTube and Vimeo embeds. The player loads only after functional consent.',
                'category_key' => 'functional',
                'consent_categories' => json_encode(['functional']),
                'is_enabled' => true,
                'environments' => json_encode(['local', 'staging', 'production']),
                'sort_order' => 6,
            ],
        ];

        foreach ($integrations as $integration) {
            DB::table('cookie_integrations')->insert($integration + [
                'measurement_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        DB::table('cookie_consent_settings')->insert([
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
            'modal_text' => 'Necessary cookies are always on. Optional categories stay off until you enable them. You can change or withdraw this choice at any time.',
            'jurisdiction_mode' => JurisdictionResolver::OPT_IN,
            'jurisdiction_rules' => json_encode([]),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('cookie_consent_metrics')->insert([
            'accept_all_count' => 0,
            'reject_all_count' => 0,
            'custom_count' => 0,
            'withdrawal_count' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
