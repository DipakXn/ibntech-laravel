<?php

namespace App\Filament\Clusters\SmtpSettings;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Facades\Filament;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class SmtpSettingsCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static string|UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'SMTP Settings';

    protected static ?string $clusterBreadcrumb = 'SMTP Settings';

    protected static ?int $navigationSort = 6;

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    /**
     * @return array<class-string>
     */
    public static function getClusteredComponents(): array
    {
        return array_values(array_unique(Filament::getClusteredComponents(static::class)));
    }
}
