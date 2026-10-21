<?php

namespace Tests\Feature;

use App\Livewire\Forms\ContactForm;
use App\Models\Lead;
use App\Services\LeadService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class ContactModalPageUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_service_rejects_livewire_endpoint_for_stored_page_url(): void
    {
        Queue::fake();

        $publicPageUrl = 'https://dev.ibntech.com/blog/vapt-insights/';
        $livewireUrl = 'https://dev.ibntech.com/livewire-4e37d65f/update';

        $request = Request::create(
            $livewireUrl,
            'POST',
            server: ['HTTP_REFERER' => $publicPageUrl]
        );
        $this->app->instance('request', $request);

        app(LeadService::class)->createLead([
            'name' => 'Modal Tester',
            'email' => 'modal-page-url@example.com',
            'phone' => '+14155550199',
            'company' => 'IBN',
            'message' => 'Testing modal page URL capture.',
            'form_name' => 'header-contact-modal',
            'page_url' => $livewireUrl,
        ], 'header-contact-modal');

        $lead = Lead::query()->where('email', 'modal-page-url@example.com')->first();

        $this->assertNotNull($lead);
        $this->assertSame($publicPageUrl, $lead->page_url);
        $this->assertStringNotContainsString('/livewire-', (string) $lead->page_url);
    }

    public function test_contact_form_replaces_livewire_page_url_before_submit(): void
    {
        Queue::fake();

        $publicPageUrl = 'https://dev.ibntech.com/blog/vapt-insights/';
        $livewireUrl = 'https://dev.ibntech.com/livewire-4e37d65f/update';

        Livewire::test(ContactForm::class, [
            'layout' => 'modal',
            'formName' => 'header-contact-modal',
            'idPrefix' => 'modal-contact',
            'showCompany' => true,
        ])
            ->set('pageUrl', $publicPageUrl)
            ->set('name', 'Modal Tester')
            ->set('email', 'modal-page-url-2@example.com')
            ->set('phone', '+14155550198')
            ->set('company', 'IBN')
            ->set('message', 'Testing modal page URL capture.')
            ->set('acceptedTerms', true)
            ->call('submit')
            ->assertHasNoErrors();

        $lead = Lead::query()->where('email', 'modal-page-url-2@example.com')->first();

        $this->assertNotNull($lead);
        $this->assertSame($publicPageUrl, $lead->page_url);
        $this->assertNotSame($livewireUrl, $lead->page_url);
    }
}
