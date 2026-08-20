<?php

namespace App\Jobs;

use App\Mail\CaseStudyThankYouMail;
use App\Models\Lead;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendCaseStudyThankYouMail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $timeout = 30;

    public function __construct(
        public int $submissionId,
    ) {
    }

    public function handle(): void
    {
        $submission = Lead::query()->find($this->submissionId);

        if (! $submission || ! $submission->email) {
            return;
        }

        Mail::to($submission->email)->send(new CaseStudyThankYouMail($submission));
    }
}
