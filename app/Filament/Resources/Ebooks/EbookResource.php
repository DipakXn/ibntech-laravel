<?php

namespace App\Filament\Resources\Ebooks;

use App\Filament\Resources\Ebooks\Pages\CreateEbook;
use App\Filament\Resources\Ebooks\Pages\EditEbook;
use App\Filament\Resources\Ebooks\Pages\ListEbooks;
use App\Filament\Resources\Ebooks\Schemas\EbookForm;
use App\Filament\Resources\Ebooks\Tables\EbooksTable;
use App\Models\Ebook;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class EbookResource extends Resource
{
    protected static ?string $model = Ebook::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $navigationLabel = 'eBooks';

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return EbookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EbooksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEbooks::route('/'),
            'create' => CreateEbook::route('/create'),
            'edit' => EditEbook::route('/{record}/edit'),
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
