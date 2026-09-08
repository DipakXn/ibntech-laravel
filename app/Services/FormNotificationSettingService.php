<?php

namespace App\Services;

use App\Models\FormNotificationSetting;

class FormNotificationSettingService
{
    /**
     * @param  list<array<string, mixed>>  $rows
     */
    public function sync(array $rows): void
    {
        $keptFormNames = [];

        foreach ($rows as $row) {
            $formName = $this->normalize($row['form_name'] ?? null);
            $adminTo = $this->normalize($row['admin_to'] ?? null);

            if ($formName === null) {
                continue;
            }

            if ($adminTo === null) {
                FormNotificationSetting::query()->where('form_name', $formName)->delete();

                continue;
            }

            FormNotificationSetting::query()->updateOrCreate(
                ['form_name' => $formName],
                ['admin_to' => $adminTo],
            );

            $keptFormNames[] = $formName;
        }

        $query = FormNotificationSetting::query();

        if ($keptFormNames !== []) {
            $query->whereNotIn('form_name', $keptFormNames);
        }

        $query->delete();
    }

    /**
     * @return list<array{form_name: string, admin_to: string}>
     */
    public function repeaterState(): array
    {
        return FormNotificationSetting::query()
            ->orderBy('form_name')
            ->get(['form_name', 'admin_to'])
            ->map(fn (FormNotificationSetting $setting): array => [
                'form_name' => $setting->form_name,
                'admin_to' => $setting->admin_to,
            ])
            ->all();
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
