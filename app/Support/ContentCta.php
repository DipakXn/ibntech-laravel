<?php

namespace App\Support;

class ContentCta
{
    /**
     * @return array<string, string>
     */
    public static function themes(): array
    {
        return [
            'navy' => 'Navy',
            'green' => 'Green',
            'light' => 'Light',
        ];
    }

    public static function theme(?string $theme): string
    {
        $theme = (string) $theme;

        return array_key_exists($theme, self::themes()) ? $theme : 'navy';
    }

    /**
     * @return array<string, string>
     */
    public static function icons(): array
    {
        return [
            'comments' => 'Comments',
            'envelope' => 'Envelope',
            'phone' => 'Phone',
            'calendar-days' => 'Calendar',
            'headset' => 'Headset',
            'handshake' => 'Handshake',
            'circle-check' => 'Check',
            'shield-halved' => 'Shield',
            'lock' => 'Lock',
            'cloud' => 'Cloud',
            'chart-line' => 'Chart',
            'users' => 'Users',
            'briefcase' => 'Briefcase',
            'file-lines' => 'Document',
            'rocket' => 'Rocket',
            'arrow-right' => 'Arrow',
        ];
    }

    public static function iconClass(?string $icon): ?string
    {
        $icon = strtolower(trim((string) $icon));
        $icon = preg_replace('/^fa-(solid|regular|brands)\s+/', '', $icon) ?? $icon;
        $icon = preg_replace('/^fa-/', '', $icon) ?? $icon;

        if ($icon === '' || ! array_key_exists($icon, self::icons())) {
            return null;
        }

        return 'fa-solid fa-'.$icon;
    }
}
