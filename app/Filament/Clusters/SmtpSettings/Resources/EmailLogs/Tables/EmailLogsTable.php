<?php

namespace App\Filament\Clusters\SmtpSettings\Resources\EmailLogs\Tables;

use App\Models\EmailLog;
use App\Services\EmailLogService;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class EmailLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject')
                    ->searchable()
                    ->limit(60)
                    ->wrap(),
                TextColumn::make('recipient')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('from_email')
                    ->label('Sender')
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        EmailLog::STATUS_SENT => 'success',
                        EmailLog::STATUS_FAILED => 'danger',
                        default => 'warning',
                    }),
                TextColumn::make('mailer')
                    ->toggleable(),
                TextColumn::make('connection_summary')
                    ->label('Mailer / SMTP')
                    ->limit(40)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Date & time')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        EmailLog::STATUS_SENT => 'Sent',
                        EmailLog::STATUS_FAILED => 'Failed',
                        EmailLog::STATUS_PENDING => 'Pending',
                    ]),
                Filter::make('created_at')
                    ->schema([
                        DatePicker::make('from')->label('From date'),
                        DatePicker::make('until')->label('Until date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'] ?? null, fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date))
                            ->when($data['until'] ?? null, fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->searchPlaceholder('Search subject or recipient')
            ->emptyStateIcon('heroicon-o-inbox')
            ->emptyStateHeading('No emails logged yet')
            ->emptyStateDescription('Outgoing messages will appear here after they are sent or fail.')
            ->striped()
            ->recordActions([
                ViewAction::make(),
                Action::make('resend')
                    ->label('Resend')
                    ->icon('heroicon-o-arrow-path')
                    ->requiresConfirmation()
                    ->visible(fn (EmailLog $record): bool => $record->canResend())
                    ->action(function (EmailLog $record): void {
                        try {
                            app(EmailLogService::class)->resend($record);

                            Notification::make()
                                ->success()
                                ->title('Email resent')
                                ->body('A new log entry is created for this attempt.')
                                ->send();
                        } catch (Throwable $exception) {
                            Notification::make()
                                ->danger()
                                ->title('Resend failed')
                                ->body(app(EmailLogService::class)->sanitizeError($exception) ?: 'The message could not be resent.')
                                ->send();
                        }
                    }),
            ]);
    }
}
