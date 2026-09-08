<?php

namespace Database\Factories;

use App\Models\FormNotificationSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FormNotificationSetting>
 */
class FormNotificationSettingFactory extends Factory
{
    protected $model = FormNotificationSetting::class;

    public function definition(): array
    {
        return [
            'form_name' => 'contact',
            'admin_to' => 'form-override@example.test',
        ];
    }
}
