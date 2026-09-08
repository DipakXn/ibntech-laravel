<?php

namespace App\Filament\Clusters\SmtpSettings\Resources\EmailLogs;

use App\Filament\Clusters\SmtpSettings\Resources\EmailLogs\Pages\ListEmailLogs;
use App\Filament\Clusters\SmtpSettings\Resources\EmailLogs\Pages\ViewEmailLog;
use App\Filament\Clusters\SmtpSettings\Resources\EmailLogs\Tables\EmailLogsTable;
use App\Filament\Clusters\SmtpSettings\SmtpSettingsCluster;
use App\Models\EmailLog;
use App\Models\User;
use BackedEnum;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class EmailLogResource extends Resource
{
    protected static ?string $model = EmailLog::class;

    protected static ?string $cluster = SmtpSettingsCluster::class;

    protected static string|BackedEnum|null $navigationIcon = null;

    protected static ?string $navigationLabel = 'Email Logs';

    protected static ?string $modelLabel = 'Email log';

    protected static ?string $pluralModelLabel = 'Email logs';

    protected static ?string $recordTitleAttribute = 'subject';

    protected static ?int $navigationSort = 3;

    protected static ?string $slug = 'email-logs';

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Delivery')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('subject')->columnSpanFull(),
                        TextEntry::make('recipient')->label('Recipient'),
                        TextEntry::make('from_email')
                            ->label('Sender')
                            ->formatStateUsing(function (EmailLog $record): string {
                                $name = $record->from_name ? $record->from_name.' ' : '';

                                return trim($name.'<'.($record->from_email ?? '').'>');
                            }),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                EmailLog::STATUS_SENT => 'success',
                                EmailLog::STATUS_FAILED => 'danger',
                                default => 'warning',
                            }),
                        TextEntry::make('created_at')->dateTime()->label('Date & time'),
                        TextEntry::make('mailer')->label('Mailer'),
                        TextEntry::make('connection_summary')
                            ->label('SMTP connection')
                            ->columnSpanFull(),
                        TextEntry::make('error_message')
                            ->label('Error')
                            ->placeholder('None')
                            ->columnSpanFull()
                            ->visible(fn (EmailLog $record): bool => filled($record->error_message)),
                    ]),
                Section::make('Message')
                    ->schema([
                        TextEntry::make('html_body')
                            ->label('HTML body')
                            ->html()
                            ->placeholder('No HTML body stored')
                            ->columnSpanFull(),
                        TextEntry::make('text_body')
                            ->label('Text body')
                            ->placeholder('No text body stored')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return EmailLogsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmailLogs::route('/'),
            'view' => ViewEmailLog::route('/{record}'),
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
}
