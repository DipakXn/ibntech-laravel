<?php

namespace App\Listeners;

use App\Services\EmailLogService;
use Illuminate\Mail\Events\MessageSending;
use Symfony\Component\Mime\Email;

class RecordOutgoingEmail
{
    public function __construct(private EmailLogService $emailLogs) {}

    public function handle(MessageSending $event): void
    {
        if (! $event->message instanceof Email) {
            return;
        }

        $this->emailLogs->recordSending($event->message);
    }
}
