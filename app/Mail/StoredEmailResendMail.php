<?php

namespace App\Mail;

use App\Models\EmailLog;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class StoredEmailResendMail extends Mailable
{
    public function __construct(public EmailLog $log) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: (string) $this->log->subject,
        );
    }

    public function content(): Content
    {
        $html = $this->log->html_body;

        if (! filled($html)) {
            $html = nl2br(e((string) $this->log->text_body));
        }

        return new Content(
            htmlString: $html,
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
