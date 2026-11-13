<?php

namespace App\Support\Users;

use App\Models\User;
use App\Notifications\UserInvitation;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Password;

class UserInvitationSender
{
    public function send(User $user, bool $invitation): void
    {
        $panel = Filament::getPanel('admin');
        $token = Password::broker()->createToken($user);

        $user->notifyNow(new UserInvitation(
            url: $panel->getResetPasswordUrl($token, $user),
            invitation: $invitation,
        ));

        $actor = auth()->user();

        app(UserAuditLogger::class)->record(
            $actor instanceof User ? $actor : null,
            $user,
            $invitation ? 'invitation_sent' : 'password_reset_sent',
        );
    }
}
