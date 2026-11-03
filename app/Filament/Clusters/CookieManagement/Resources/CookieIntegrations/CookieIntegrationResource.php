<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieIntegrations;

use App\Filament\Clusters\CookieManagement\CookieManagementCluster;
use App\Filament\Clusters\CookieManagement\Resources\CookieIntegrations\Pages\EditCookieIntegration;
use App\Filament\Clusters\CookieManagement\Resources\CookieIntegrations\Pages\ListCookieIntegrations;
use App\Filament\Clusters\CookieManagement\Resources\CookieIntegrations\Schemas\CookieIntegrationForm;
use App\Filament\Clusters\CookieManagement\Resources\CookieIntegrations\Tables\CookieIntegrationsTable;
use App\Models\CookieIntegration;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CookieIntegrationResource extends Resource
{
    protected static ?string $model = CookieIntegration::class;

    protected static ?string $cluster = CookieManagementCluster::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPuzzlePiece;

    protected static ?string $navigationLabel = 'Integrations';

    protected static ?string $modelLabel = 'Integration';

    protected static ?string $pluralModelLabel = 'Integrations';

    protected static ?int $navigationSort = 3;

    protected static ?string $slug = 'integrations';

    public static function form(Schema $schema): Schema
    {
        return CookieIntegrationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CookieIntegrationsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCookieIntegrations::route('/'),
            'edit' => EditCookieIntegration::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user() instanceof User && auth()->user()->isAdministrator();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
