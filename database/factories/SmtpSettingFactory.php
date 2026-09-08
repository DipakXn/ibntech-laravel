<?php

namespace Database\Factories;

use App\Models\SmtpSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SmtpSetting>
 */
class SmtpSettingFactory extends Factory
{
    protected $model = SmtpSetting::class;

    public function definition(): array
    {
        return [
            'is_enabled' => false,
            'host' => 'smtp.example.test',
            'port' => 2525,
            'encryption' => SmtpSetting::ENCRYPTION_NONE,
            'auth_mode' => SmtpSetting::AUTH_CRAM_MD5,
            'username' => 'smtp-user',
            'password' => 'secret-password',
            'from_email' => 'noreply@example.test',
            'from_name' => 'IBNTECH',
            'lead_notification_to' => 'leads@example.test',
        ];
    }

    public function enabled(): static
    {
        return $this->state(fn (): array => [
            'is_enabled' => true,
        ]);
    }
}
