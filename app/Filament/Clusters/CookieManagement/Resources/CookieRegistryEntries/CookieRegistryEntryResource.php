<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries;

use App\Filament\Clusters\CookieManagement\CookieManagementCluster;
use App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\Pages\CreateCookieRegistryEntry;
use App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\Pages\EditCookieRegistryEntry;
use App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\Pages\ListCookieRegistryEntries;
use App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\Schemas\CookieRegistryEntryForm;
use App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\Tables\CookieRegistryEntriesTable;
use App\Models\CookieRegistryEntry;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CookieRegistryEntryResource extends Resource
{
    protected static ?string $model = CookieRegistryEntry::class;

    protected static ?string $cluster = CookieManagementCluster::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedListBullet;

    protected static ?string $navigationLabel = 'Cookie registry';

    protected static ?string $modelLabel = 'Cookie';

    protected static ?string $pluralModelLabel = 'Cookie registry';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'registry';

    public static function form(Schema $schema): Schema
    {
        return CookieRegistryEntryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CookieRegistryEntriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCookieRegistryEntries::route('/'),
            'create' => CreateCookieRegistryEntry::route('/create'),
            'edit' => EditCookieRegistryEntry::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user() instanceof User && auth()->user()->isAdministrator();
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
}
