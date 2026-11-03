<?php

use App\Models\CookieConsentSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $setting = CookieConsentSetting::query()->first();

        if (! $setting) {
            return;
        }

        $originalText = 'We use necessary cookies to run this website. With your permission, we also use analytics, marketing, and functional cookies. You can accept all, reject optional cookies, or choose categories. Closing this notice does not count as consent.';

        if ($setting->banner_text === $originalText) {
            $setting->banner_text = 'We use cookies to improve your experience on our website. You can manage your preferences at any time.';
        }

        if ($setting->settings_label === 'Cookie Settings') {
            $setting->settings_label = 'Preferences';
        }

        if ($setting->banner_title === 'We value your privacy') {
            $setting->banner_title = 'Cookies';
        }

        if ($setting->isDirty()) {
            $setting->save();
        }
    }

    public function down(): void
    {
        $setting = CookieConsentSetting::query()->first();

        if (! $setting) {
            return;
        }

        if ($setting->banner_text === 'We use cookies to improve your experience on our website. You can manage your preferences at any time.') {
            $setting->banner_text = 'We use necessary cookies to run this website. With your permission, we also use analytics, marketing, and functional cookies. You can accept all, reject optional cookies, or choose categories. Closing this notice does not count as consent.';
        }

        if ($setting->settings_label === 'Preferences') {
            $setting->settings_label = 'Cookie Settings';
        }

        if ($setting->banner_title === 'Cookies') {
            $setting->banner_title = 'We value your privacy';
        }

        if ($setting->isDirty()) {
            $setting->save();
        }
    }
};
