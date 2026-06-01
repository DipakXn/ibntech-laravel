<?php

namespace App\Jobs;

use App\Mail\LeadReceivedMail;
use App\Models\Lead;
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
        public string $recipient,
    ) {
    }

    public function handle(): void
    {
        $submission = Lead::query()->find($this->submissionId);

        if (! $submission) {
            return;
        }

        Mail::to($this->recipient)->send(new LeadReceivedMail($submission));
    }
}
