<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CaseStudyThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead)
    {
    }

    public function envelope(): Envelope
    {
        $title = $this->lead->asset_title;

        return new Envelope(
            subject: is_string($title) && $title !== ''
                ? 'Thank you for unlocking '.$title
                : 'Thank you for unlocking the case study',
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.case-studies.thank-you',
            text: 'emails.case-studies.thank-you-text',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
