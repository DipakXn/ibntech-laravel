<?php

namespace App\Filament\Resources\WhitePapers;

use App\Filament\Resources\WhitePapers\Pages\CreateWhitePaper;
use App\Filament\Resources\WhitePapers\Pages\EditWhitePaper;
use App\Filament\Resources\WhitePapers\Pages\ListWhitePapers;
use App\Filament\Resources\WhitePapers\Schemas\WhitePaperForm;
use App\Filament\Resources\WhitePapers\Tables\WhitePapersTable;
use App\Models\User;
use App\Models\WhitePaper;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class WhitePaperResource extends Resource
{
    protected static ?string $model = WhitePaper::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'White Papers';

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return WhitePaperForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WhitePapersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWhitePapers::route('/'),
            'create' => CreateWhitePaper::route('/create'),
            'edit' => EditWhitePaper::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user() instanceof User
            && in_array(auth()->user()->role, [User::ROLE_ADMINISTRATOR, User::ROLE_AUTHOR], true);
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
