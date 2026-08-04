<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WebsiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'site_name',
        'organization_name',
        'tagline',
        'default_meta_title',
        'default_meta_description',
        'default_meta_keywords',
        'default_locale',
        'og_site_name',
        'og_type',
        'og_locale',
        'og_image_alt',
        'twitter_card_type',
        'twitter_site',
        'twitter_creator',
        'robots_index',
        'robots_follow',
        'robots_max_snippet',
        'robots_max_image_preview',
        'custom_meta_robots',
        'robots_txt',
        'contact_email',
        'header_phones',
        'offices',
        'social_facebook',
        'social_linkedin',
        'social_twitter',
        'social_instagram',
        'social_youtube',
        'google_analytics_id',
        'google_tag_manager_id',
        'google_site_verification',
        'bing_site_verification',
        'custom_head_code',
        'custom_body_end_code',
    ];

    protected function casts(): array
    {
        return [
            'header_phones' => 'array',
            'offices' => 'array',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('site_logo')
            ->useDisk('public')
            ->singleFile();

        $this
            ->addMediaCollection('site_logo_dark')
            ->useDisk('public')
            ->singleFile();

        $this
            ->addMediaCollection('favicon')
            ->useDisk('public')
            ->singleFile();

        $this
            ->addMediaCollection('apple_touch_icon')
            ->useDisk('public')
            ->singleFile();

        $this
            ->addMediaCollection('default_og_image')
            ->useDisk('public')
            ->singleFile();
    }

    public function mediaUrl(string $collection): ?string
    {
        $url = $this->getFirstMediaUrl($collection);

        return $url !== '' ? $url : null;
    }

    public function logoUrl(): ?string
    {
        return $this->mediaUrl('site_logo');
    }

    public function logoDarkUrl(): ?string
    {
        return $this->mediaUrl('site_logo_dark');
    }

    public function faviconUrl(): ?string
    {
        return $this->mediaUrl('favicon');
    }

    public function appleTouchIconUrl(): ?string
    {
        return $this->mediaUrl('apple_touch_icon');
    }

    public function defaultOgImageUrl(): ?string
    {
        return $this->mediaUrl('default_og_image');
    }

    public function robotsMetaString(): string
    {
        if (! empty($this->custom_meta_robots)) {
            return $this->custom_meta_robots;
        }

        $parts = [
            $this->robots_index ?: 'index',
            $this->robots_follow ?: 'follow',
        ];

        if ($this->robots_max_snippet !== null && $this->robots_max_snippet !== '') {
            $parts[] = 'max-snippet:'.$this->robots_max_snippet;
        }

        if (! empty($this->robots_max_image_preview)) {
            $parts[] = 'max-image-preview:'.$this->robots_max_image_preview;
        }

        return implode(', ', $parts);
    }

    /**
     * @return array<string, string>
     */
    public function socialLinks(): array
    {
        return array_filter([
            'facebook' => $this->social_facebook,
            'linkedin' => $this->social_linkedin,
            'twitter' => $this->social_twitter,
            'instagram' => $this->social_instagram,
            'youtube' => $this->social_youtube,
        ]);
    }
}
