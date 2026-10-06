<?php

namespace App\Filament\Clusters\SmtpSettings\Resources\EmailLogs\Pages;

use App\Filament\Clusters\SmtpSettings\Concerns\HasSmtpSettingsPageChrome;
use App\Filament\Clusters\SmtpSettings\Resources\EmailLogs\EmailLogResource;
use App\Models\EmailLog;
use App\Services\EmailLogService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Throwable;

class ViewEmailLog extends ViewRecord
{
    use HasSmtpSettingsPageChrome;

    protected static string $resource = EmailLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('resend')
                ->label('Resend')
                ->icon('heroicon-o-arrow-path')
                ->requiresConfirmation()
                ->visible(fn (): bool => $this->record instanceof EmailLog && $this->record->canResend())
                ->action(function (): void {
                    if (! $this->record instanceof EmailLog) {
                        return;
                    }

                    try {
                        app(EmailLogService::class)->resend($this->record);

                        Notification::make()
                            ->success()
                            ->title('Email resent')
                            ->body('A new log entry will be created for this attempt.')
                            ->send();
                    } catch (Throwable $exception) {
                        Notification::make()
                            ->danger()
                            ->title('Resend failed')
                            ->body(app(EmailLogService::class)->sanitizeError($exception) ?: 'The message could not be resent.')
                            ->send();
                    }
                }),
        ];
    }
}
