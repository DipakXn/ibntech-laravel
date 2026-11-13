<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use App\Support\Users\PasswordPolicy;
use App\Support\Users\UserInvitationSender;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected bool $sendInvitation = false;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->sendInvitation = (bool) ($data['send_invitation'] ?? false);
        unset($data['send_invitation']);

        if ($this->sendInvitation && blank($data['password'] ?? null)) {
            $data['password'] = PasswordPolicy::generate();
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        if (! $this->sendInvitation || ! $this->getRecord() instanceof User) {
            return;
        }

        app(UserInvitationSender::class)->send($this->getRecord(), invitation: true);

        Notification::make()
            ->success()
            ->title('Invitation email sent')
            ->body('The new user can set a password from the link in that email.')
            ->send();
    }
}
