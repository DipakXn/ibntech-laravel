<?php

namespace App\Filament\Resources\OldSubmissions;

use App\Filament\Resources\OldSubmissions\Pages\ListOldSubmissions;
use App\Filament\Resources\OldSubmissions\Pages\ViewOldSubmission;
use App\Filament\Resources\OldSubmissions\Schemas\OldSubmissionInfolist;
use App\Filament\Resources\OldSubmissions\Tables\OldSubmissionsTable;
use App\Models\OldSubmission;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class OldSubmissionResource extends Resource
{
    protected static ?string $model = OldSubmission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $navigationLabel = 'Old Submissions';

    protected static ?string $modelLabel = 'Old submission';

    protected static ?string $pluralModelLabel = 'Old submissions';

    protected static string|UnitEnum|null $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'old-submissions';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function infolist(Schema $schema): Schema
    {
        return OldSubmissionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OldSubmissionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOldSubmissions::route('/'),
            'view' => ViewOldSubmission::route('/{record}'),
        ];
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (! $record instanceof OldSubmission) {
            return 'Old submission';
        }

        $title = $record->name ?: $record->email;

        return filled($title) ? (string) $title : 'Submission '.$record->external_submission_id;
    }

    /**
     * @return array<string>
     */
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'form_name', 'external_submission_id'];
    }

    /**
     * @return array<string, string>
     */
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        if (! $record instanceof OldSubmission) {
            return [];
        }

        return [
            'Form' => (string) $record->form_name,
            'Submitted' => $record->submitted_at?->format('Y-m-d H:i') ?? '',
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function canViewAny(): bool
    {
        return auth()->user() instanceof User
            && (auth()->user()->isAdministrator() || auth()->user()->isAuthor());
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function canForceDelete(Model $record): bool
    {
        return false;
    }

    public static function canForceDeleteAny(): bool
    {
        return false;
    }

    public static function canReplicate(Model $record): bool
    {
        return false;
    }

    public static function canRestore(Model $record): bool
    {
        return false;
    }

    public static function canRestoreAny(): bool
    {
        return false;
    }
}
