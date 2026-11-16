<?php

namespace App\Services;

use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Database\QueryException;

class MaintenanceMode
{
    public const RETRY_AFTER = 3600;

    public function enabled(): bool
    {
        try {
            return (int) WebsiteSetting::query()->value('maintenance_enabled') === 1;
        } catch (QueryException $exception) {
            if ($this->isSettingUnavailable($exception)) {
                return false;
            }

            throw $exception;
        }
    }

    public function set(bool $enabled, ?User $actor = null): void
    {
        $settings = app(WebsiteSettingService::class);
        $record = $settings->current();
        $record->maintenance_enabled = $enabled;
        $record->save();
        $settings->forget();

        app(MaintenanceActionLogger::class)->succeeded(
            $enabled ? 'enable_maintenance_mode' : 'disable_maintenance_mode',
            $actor,
        );
    }

    private function isSettingUnavailable(QueryException $exception): bool
    {
        $message = strtolower($exception->getMessage());

        if (! str_contains($message, 'maintenance_enabled') && ! str_contains($message, 'website_settings')) {
            return false;
        }

        return str_contains($message, 'no such table')
            || str_contains($message, 'no such column')
            || str_contains($message, 'unknown column')
            || str_contains($message, 'does not exist')
            || str_contains($message, 'base table or view not found');
    }
}
