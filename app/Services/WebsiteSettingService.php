<?php

namespace App\Services;

use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class WebsiteSettingService
{
    public const CACHE_KEY = 'website_settings.singleton';

    public function get(): WebsiteSetting
    {
        return Cache::rememberForever(self::CACHE_KEY, function (): WebsiteSetting {
            $settings = WebsiteSetting::query()->first();

            if (! $settings) {
                $settings = WebsiteSetting::query()->create($this->defaultAttributes());
            }

            return $settings;
        });
    }

    public function refresh(): WebsiteSetting
    {
        $this->forget();

        return $this->get();
    }

    public function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * @return array<string, mixed>
     */
    public function defaultAttributes(): array
    {
        return [
            'site_name' => config('app.name', 'IBN Technologies'),
            'organization_name' => 'IBN Technologies Ltd',
            'tagline' => null,
            'default_meta_title' => null,
            'default_meta_description' => null,
            'default_meta_keywords' => null,
            'default_locale' => config('app.locale', 'en'),
            'og_site_name' => config('app.name', 'IBN Technologies'),
            'og_type' => 'website',
            'og_locale' => config('app.locale', 'en'),
            'og_image_alt' => null,
            'twitter_card_type' => 'summary_large_image',
            'twitter_site' => null,
            'twitter_creator' => null,
            'robots_index' => 'index',
            'robots_follow' => 'follow',
            'robots_max_snippet' => null,
            'robots_max_image_preview' => 'large',
            'custom_meta_robots' => null,
            'robots_txt' => "User-agent: *\nDisallow:\n",
            'contact_email' => 'sales@ibntech.com',
            'form_notification_to' => null,
            'header_phones' => [
                ['label' => 'USA', 'number' => '+1-844-644-8440'],
                ['label' => 'UK', 'number' => '+44-800-041-8618'],
                ['label' => 'IND', 'number' => '020-711-79586'],
            ],
            'offices' => [
                [
                    'name' => 'IBN Technologies LLC.',
                    'address' => '66 West Flagler Street Suite 900 Miami, FL 33130',
                    'email' => null,
                    'phones' => [
                        ['label' => 'Cybersecurity and Cloud', 'number' => '+1-281-544-0740'],
                        ['label' => 'Finance & Accounting and Others', 'number' => '+1-844-644-8440'],
                    ],
                ],
                [
                    'name' => 'IBN Tech Ltd.',
                    'address' => '30 Orange Street, London UK WC2H 7HF',
                    'email' => null,
                    'phones' => [
                        ['label' => 'Cybersecurity and Cloud', 'number' => '+44-203-769-9111'],
                        ['label' => 'Finance & Accounting and Others', 'number' => '+44-800-041-8618'],
                    ],
                ],
                [
                    'name' => 'IBN Technologies Ltd.',
                    'address' => 'Kohinoor House, 2nd floor, 691/A/1B, Plot no. 7, Bibwewadi Road, Pune-411037, Maharashtra, India',
                    'email' => 'sales@ibntech.com',
                    'phones' => [
                        ['label' => null, 'number' => '020-6768-0404'],
                    ],
                ],
            ],
            'social_facebook' => null,
            'social_linkedin' => null,
            'social_twitter' => null,
            'social_instagram' => null,
            'social_youtube' => null,
            'google_analytics_id' => null,
            'google_tag_manager_id' => null,
            'google_site_verification' => null,
            'bing_site_verification' => null,
            'custom_head_code' => null,
            'custom_body_end_code' => null,
        ];
    }

    public function syncRobotsTxt(?WebsiteSetting $settings = null): void
    {
        $settings ??= $this->get();
        $contents = $settings->robots_txt;

        if ($contents === null || trim($contents) === '') {
            $contents = "User-agent: *\nDisallow:\n";
        }

        File::put(public_path('robots.txt'), rtrim($contents)."\n");
    }

    /**
     * @return array<string, mixed>
     */
    public function seoDefaults(): array
    {
        $settings = $this->get();
        $siteName = $settings->site_name ?: config('app.name');
        $ogImage = $settings->defaultOgImageUrl();

        return [
            'meta_title' => $settings->default_meta_title ?: $siteName,
            'meta_description' => $settings->default_meta_description,
            'meta_keywords' => $settings->default_meta_keywords,
            'og_title' => $settings->default_meta_title ?: $siteName,
            'og_description' => $settings->default_meta_description,
            'og_image' => $ogImage,
            'og_image_alt' => $settings->og_image_alt,
            'og_type' => $settings->og_type ?: 'website',
            'og_site_name' => $settings->og_site_name ?: $siteName,
            'og_locale' => $settings->og_locale ?: config('app.locale'),
            'twitter_card_type' => $settings->twitter_card_type ?: 'summary_large_image',
            'twitter_title' => $settings->default_meta_title ?: $siteName,
            'twitter_description' => $settings->default_meta_description,
            'twitter_image' => $ogImage,
            'twitter_site' => $settings->twitter_site,
            'twitter_creator' => $settings->twitter_creator,
            'robots' => $settings->robotsMetaString(),
        ];
    }
}
