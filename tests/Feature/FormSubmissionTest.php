<?php

namespace Tests\Feature;

use App\Jobs\SendLeadSubmissionNotification;
use App\Mail\LeadReceivedMail;
use App\Models\Lead;
use App\Services\LeadService;
use App\Support\LeadSource;
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
            'service' => 'Cybersecurity',
            'form_name' => 'homepage-contact',
            'page_url' => 'https://example.com/contact',
            'message' => 'Need help with bookkeeping services.',
        ]);

        $this->assertDatabaseHas('form_submissions', [
            'id' => $submission->id,
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'company' => 'Acme Inc',
            'form_name' => 'homepage-contact',
            'page_url' => 'https://example.com/contact',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'ip_address' => '36.255.4.132',
        ]);

        $fresh = $submission->fresh();
        $this->assertSame('Homepage Contact', $fresh->form_label);
        $this->assertSame('Cybersecurity', $fresh->service);
        $this->assertSame('Cybersecurity', data_get($fresh->payload, 'service'));
        $this->assertSame(LeadSource::ORGANIC_SEO, data_get($fresh->payload, 'lead_source'));
        $this->assertSame(LeadSource::ORGANIC_SEO, $fresh->lead_source);
        Queue::assertPushed(SendLeadSubmissionNotification::class, fn (SendLeadSubmissionNotification $job): bool => $job->submissionId === $submission->id);
        Mail::assertNothingSent();
    }

    public function test_create_lead_overwrites_tampered_lead_source_for_organic_submissions(): void
    {
        Queue::fake();

        $submission = app(LeadService::class)->createLead([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'form_name' => 'contact',
            'lead_source' => 'Google Ads',
        ]);

        $this->assertSame(LeadSource::ORGANIC_SEO, data_get($submission->fresh()->payload, 'lead_source'));
    }

    public function test_create_lead_strips_lead_source_when_landing_flag_is_false(): void
    {
        Queue::fake();

        $submission = app(LeadService::class)->createLead([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'form_name' => 'lp-vapt-audit-services',
            'lead_source' => LeadSource::ORGANIC_SEO,
        ], 'lp-vapt-audit-services', recordOrganicLeadSource: false);

        $this->assertNull(data_get($submission->fresh()->payload, 'lead_source'));
    }

    public function test_lead_model_uses_form_submissions_table(): void
    {
        $this->assertSame('form_submissions', (new Lead())->getTable());
    }

    public function test_admin_notification_email_includes_service(): void
    {
        $lead = Lead::query()->create([
            'name' => 'Dipak Patil',
            'email' => 'patildipak@gmail.com',
            'phone' => '+918983300222',
            'company' => 'VOLie',
            'form_name' => 'homepage-contact',
            'message' => 'This is a test message.',
            'page_url' => 'http://localhost:8000',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'PHPUnit',
            'payload' => [
                'service' => 'Cybersecurity',
                'lead_source' => LeadSource::ORGANIC_SEO,
            ],
        ]);

        $html = (new LeadReceivedMail($lead))->render();
        $text = view('emails.leads.received-text', ['lead' => $lead])->render();

        $this->assertStringContainsString('Admin Notification', $html);
        $this->assertStringContainsString('New Submission Received', $html);
        $this->assertStringContainsString('Lead Source', $html);
        $this->assertStringContainsString(LeadSource::ORGANIC_SEO, $html);
        $this->assertStringContainsString('Service', $html);
        $this->assertStringContainsString('Cybersecurity', $html);
        $this->assertStringContainsString('Lead ID', $html);
        $this->assertStringContainsString('#'.$lead->id, $html);
        $this->assertStringContainsString('Lead Source: '.LeadSource::ORGANIC_SEO, $text);
    }

    public function test_admin_notification_email_omits_lead_source_when_not_stored(): void
    {
        $lead = Lead::query()->create([
            'name' => 'Landing Lead',
            'email' => 'landing@example.com',
            'form_name' => 'lp-vapt-audit-services',
            'message' => 'LP inquiry.',
            'payload' => [],
        ]);

        $html = (new LeadReceivedMail($lead))->render();
        $text = view('emails.leads.received-text', ['lead' => $lead])->render();

        $this->assertStringNotContainsString('Lead Source', $html);
        $this->assertStringNotContainsString('Not recorded', $html);
        $this->assertStringNotContainsString('Lead Source:', $text);
    }
}
