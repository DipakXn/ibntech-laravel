<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use App\Services\WebsiteSettingService;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $service = app(WebsiteSettingService::class);

        $settings = WebsiteSetting::query()->first();

        if (! $settings) {
            $settings = WebsiteSetting::query()->create($service->defaultAttributes());
        }

        $service->forget();
        $service->syncRobotsTxt($settings);
    }
}
