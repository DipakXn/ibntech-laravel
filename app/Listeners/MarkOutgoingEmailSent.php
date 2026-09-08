<?php

namespace App\Listeners;

use App\Services\EmailLogService;
use Illuminate\Mail\Events\MessageSent;

class MarkOutgoingEmailSent
{
    public function __construct(private EmailLogService $emailLogs) {}

    public function handle(MessageSent $event): void
    {
        $message = $event->message;

        if (! is_object($message)) {
            return;
        }

        $this->emailLogs->markSent($message);
    }
}
