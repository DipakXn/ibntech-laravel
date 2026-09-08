<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class SmtpTestMail extends Mailable
{
    public function __construct(
        public string $testSubject,
        public string $testBody,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->testSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.smtp.test',
            text: 'emails.smtp.test-text',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
