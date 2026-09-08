<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadReceivedMail extends Mailable
{
    use SerializesModels;

    public function __construct(public Lead $lead) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Submission: '.$this->lead->form_label
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.leads.received',
            text: 'emails.leads.received-text',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
