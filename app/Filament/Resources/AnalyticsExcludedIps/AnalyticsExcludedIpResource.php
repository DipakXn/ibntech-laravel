<?php

namespace App\Filament\Resources\AnalyticsExcludedIps;

use App\Filament\Resources\AnalyticsExcludedIps\Pages\CreateAnalyticsExcludedIp;
use App\Filament\Resources\AnalyticsExcludedIps\Pages\EditAnalyticsExcludedIp;
use App\Filament\Resources\AnalyticsExcludedIps\Pages\ListAnalyticsExcludedIps;
use App\Filament\Resources\AnalyticsExcludedIps\Schemas\AnalyticsExcludedIpForm;
use App\Filament\Resources\AnalyticsExcludedIps\Tables\AnalyticsExcludedIpsTable;
use App\Models\AnalyticsExcludedIp;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class AnalyticsExcludedIpResource extends Resource
{
    protected static ?string $model = AnalyticsExcludedIp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNoSymbol;

    protected static ?string $navigationLabel = 'Excluded IPs';

    protected static ?string $modelLabel = 'Excluded IP';

    protected static ?string $pluralModelLabel = 'Excluded IPs';

    protected static string|UnitEnum|null $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 12;

    protected static ?string $slug = 'excluded-ips';

    protected static ?string $recordTitleAttribute = 'ip_address';

    public static function form(Schema $schema): Schema
    {
        return AnalyticsExcludedIpForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnalyticsExcludedIpsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAnalyticsExcludedIps::route('/'),
            'create' => CreateAnalyticsExcludedIp::route('/create'),
            'edit' => EditAnalyticsExcludedIp::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user() instanceof User && auth()->user()->isAdministrator();
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDeleteAny(): bool
    {
        return static::canViewAny();
    }
}
