<?php

namespace App\Services;

use App\Models\FormNotificationSetting;
use Illuminate\Support\Facades\Schema;
use Throwable;

class FormRecipientResolver
{
    public function __construct(
        private WebsiteSettingService $websiteSettings,
    ) {}

    public function adminTo(?string $formName = null): ?string
    {
        $override = $this->formOverride($formName);

        if ($override !== null) {
            return $override;
        }

        $default = $this->websiteDefault();

        if ($default !== null) {
            return $default;
        }

        $legacy = $this->normalize(config('mail.lead_notification_to'));

        if ($legacy !== null) {
            return $legacy;
        }

        return $this->normalize(config('mail.from.address'));
    }

    private function formOverride(?string $formName): ?string
    {
        if (! filled($formName) || ! $this->overridesTableExists()) {
            return null;
        }

        try {
            $adminTo = FormNotificationSetting::query()
                ->where('form_name', $formName)
                ->value('admin_to');
        } catch (Throwable) {
            return null;
        }

        return $this->normalize($adminTo);
    }

    private function websiteDefault(): ?string
    {
        try {
            return $this->normalize($this->websiteSettings->get()->form_notification_to);
        } catch (Throwable) {
            return null;
        }
    }

    private function overridesTableExists(): bool
    {
        try {
            return Schema::hasTable('form_notification_settings');
        } catch (Throwable) {
            return false;
        }
    }

    private function normalize(mixed $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        $value = trim($value);

        return $value !== '' ? $value : null;
    }
}
