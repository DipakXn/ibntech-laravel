<?php

namespace App\Filament\Clusters\SmtpSettings\Concerns;

use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;

trait HasSmtpSettingsPageChrome
{
    /**
     * @return array<string>
     */
    public function getPageClasses(): array
    {
        return ['ibn-smtp-settings'];
    }

    /**
     * @return array<NavigationItem | NavigationGroup>
     */
    public function getSubNavigation(): array
    {
        $items = parent::getSubNavigation();
        $seen = [];
        $unique = [];

        foreach ($items as $item) {
            if ($item instanceof NavigationGroup) {
                $unique[] = $item;

                continue;
            }

            $key = $item->getUrl() ?: $item->getLabel();

            if (isset($seen[$key])) {
                continue;
            }

            $seen[$key] = true;
            $unique[] = $item;
        }

        return $unique;
    }
}
