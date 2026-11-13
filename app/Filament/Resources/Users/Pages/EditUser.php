<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\Tables\UsersTable;
use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use App\Support\Users\UserInvitationSender;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sendPasswordReset')
                ->label('Email password reset')
                ->icon(Heroicon::OutlinedEnvelope)
                ->requiresConfirmation()
                ->modalDescription('Sends a password reset link to this email address. The current password keeps working until they choose a new one.')
                ->action(function (): void {
                    $record = $this->getRecord();

                    if (! $record instanceof User) {
                        return;
                    }

                    app(UserInvitationSender::class)->send($record, invitation: false);

                    Notification::make()
                        ->success()
                        ->title('Password reset email sent')
                        ->send();
                }),
            UsersTable::deleteAction(),
        ];
    }
}
