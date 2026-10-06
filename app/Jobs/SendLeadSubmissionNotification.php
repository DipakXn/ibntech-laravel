<?php

namespace App\Jobs;

use App\Mail\LeadReceivedMail;
use App\Models\Lead;
use App\Services\FormRecipientResolver;
use App\Services\SmtpSettingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendLeadSubmissionNotification implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $timeout = 30;

    public function __construct(
        public int $submissionId,
        public ?string $recipient = null,
    ) {}

    public function handle(): void
    {
        $submission = Lead::query()->find($this->submissionId);

        if (! $submission) {
            return;
        }

        $recipient = app(FormRecipientResolver::class)->adminTo($submission->form_name);

        if (! filled($recipient)) {
            return;
        }

        $smtp = app(SmtpSettingService::class);
        $smtp->applyToRuntimeConfig();

        Mail::mailer((string) config('mail.default'))
            ->to($recipient)
            ->sendNow(new LeadReceivedMail($submission));
    }
}
