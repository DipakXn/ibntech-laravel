<?php

namespace Tests\Feature;

use App\Jobs\SendLeadSubmissionNotification;
use App\Models\Lead;
use App\Services\LeadService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class FormSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_submission_metadata_in_form_submissions_table(): void
    {
        Mail::fake();
        Queue::fake();

        $request = Request::create('https://example.com/livewire/update', 'POST', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'REMOTE_ADDR' => '36.255.4.132',
        ]);

        app()->instance('request', $request);

        $service = app(LeadService::class);

        $submission = $service->createLead([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'company' => 'Acme Inc',
            'form_name' => 'contact',
            'page_url' => 'https://example.com/contact',
            'message' => 'Need help with bookkeeping services.',
        ]);

        $this->assertDatabaseHas('form_submissions', [
            'id' => $submission->id,
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'company' => 'Acme Inc',
            'form_name' => 'contact',
            'page_url' => 'https://example.com/contact',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'ip_address' => '36.255.4.132',
        ]);

        $this->assertSame('Contact Form', $submission->fresh()->form_label);
        Queue::assertPushed(SendLeadSubmissionNotification::class, fn (SendLeadSubmissionNotification $job): bool => $job->submissionId === $submission->id);
        Mail::assertNothingSent();
    }

    public function test_lead_model_uses_form_submissions_table(): void
    {
        $this->assertSame('form_submissions', (new Lead())->getTable());
    }
}
