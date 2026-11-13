<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserInvitation extends Notification
{
    use Queueable;

    public function __construct(
        public string $url,
        public bool $invitation,
    ) {}

    /**
     * @return list<string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        if ($this->invitation) {
            return (new MailMessage)
                ->subject('Set your IBNTECH Control password')
                ->line('An administrator created a control panel account for you.')
                ->line('Use the button below to choose your own password. The temporary password is not included in this email.')
                ->action('Set password', $this->url)
                ->line('If you were not expecting this message, you can ignore it.');
        }

        return (new MailMessage)
            ->subject('Reset your IBNTECH Control password')
            ->line('An administrator asked us to send you a password reset link.')
            ->action('Reset password', $this->url)
            ->line('If you were not expecting this message, you can ignore it.');
    }
}
