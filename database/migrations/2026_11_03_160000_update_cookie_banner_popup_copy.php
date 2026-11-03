<?php

use App\Models\CookieConsentSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private const NEW_TEXT = 'We use cookies to improve your experience. Do you accept?';

    /**
     * @var list<string>
     */
    private const PREVIOUS_TEXTS = [
        'We use necessary cookies to run this website. With your permission, we also use analytics, marketing, and functional cookies. You can accept all, reject optional cookies, or choose categories. Closing this notice does not count as consent.',
        'We use cookies to improve your experience on our website. You can manage your preferences at any time.',
    ];

    public function up(): void
    {
        $setting = CookieConsentSetting::query()->first();

        if (! $setting) {
            return;
        }

        if (in_array($setting->banner_text, self::PREVIOUS_TEXTS, true)) {
            $setting->banner_text = self::NEW_TEXT;
            $setting->save();
        }
    }

    public function down(): void
    {
        $setting = CookieConsentSetting::query()->first();

        if (! $setting || $setting->banner_text !== self::NEW_TEXT) {
            return;
        }

        $setting->banner_text = 'We use cookies to improve your experience on our website. You can manage your preferences at any time.';
        $setting->save();
    }
};
