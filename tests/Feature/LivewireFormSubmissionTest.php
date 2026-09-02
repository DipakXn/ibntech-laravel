<?php

namespace Tests\Feature;

use App\Jobs\SendLeadSubmissionNotification;
use App\Livewire\ContactModal;
use App\Livewire\Forms\CaseStudyDownloadForm;
use App\Livewire\Forms\ConstructionConsultationForm;
use App\Livewire\Forms\ContactForm;
use App\Livewire\Forms\LandingInquiryForm;
use App\Livewire\Forms\NewsletterInquiryForm;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireFormSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_forms_link_terms_and_privacy_to_the_correct_pages(): void
    {
        $termsUrl = route('page.show', ['slug' => 'terms-of-use']);
        $privacyUrl = route('page.show', ['slug' => 'privacy-policy']);

        $this->assertStringEndsWith('/terms-of-use/', parse_url($termsUrl, PHP_URL_PATH));
        $this->assertStringEndsWith('/privacy-policy/', parse_url($privacyUrl, PHP_URL_PATH));

        Livewire::test(ContactForm::class)
            ->assertSeeHtml('href="'.$termsUrl.'"')
            ->assertSeeHtml('href="'.$privacyUrl.'"');

        Livewire::test(NewsletterInquiryForm::class)
            ->assertSeeHtml('href="'.$termsUrl.'"')
            ->assertSeeHtml('href="'.$privacyUrl.'"');

        Livewire::test(ConstructionConsultationForm::class)
            ->assertSeeHtml('href="'.$termsUrl.'"')
            ->assertSeeHtml('href="'.$privacyUrl.'"');

        Livewire::test(CaseStudyDownloadForm::class, [
            'caseStudySlug' => 'example-case-study',
            'caseStudyTitle' => 'Example Case Study',
        ])
            ->assertSeeHtml('href="'.$termsUrl.'"')
            ->assertSeeHtml('href="'.$privacyUrl.'"');

        Livewire::test(LandingInquiryForm::class, [
            'landingPageSlug' => 'vapt-audit-services',
            'landingPageTitle' => 'VAPT Audit Services',
        ])
            ->assertSeeHtml('href="'.$termsUrl.'"')
            ->assertSeeHtml('href="'.$privacyUrl.'"');
    }

    public function test_contact_form_validates_required_fields(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', '')
            ->set('email', 'invalid-email')
            ->set('message', 'short')
            ->set('acceptedTerms', false)
            ->call('submit')
            ->assertHasErrors([
                'name' => ['required'],
                'email' => ['email'],
                'message' => ['min'],
                'acceptedTerms' => ['accepted'],
            ]);
    }

    public function test_contact_form_returns_success_while_queueing_notification(): void
    {
        Queue::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('phone', '+14155550123')
            ->set('company', 'Acme Inc')
            ->set('message', 'Need help with outsourced bookkeeping services.')
            ->set('acceptedTerms', true)
            ->set('pageUrl', 'https://example.com/contact')
            ->call('submit')
            ->assertSet('submitted', true)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('form_submissions', [
            'email' => 'jane@example.com',
            'form_name' => 'contact',
            'page_url' => 'https://example.com/contact',
        ]);

        Queue::assertPushed(SendLeadSubmissionNotification::class, 1);
    }

    public function test_homepage_contact_form_stores_service_in_payload(): void
    {
        Queue::fake();

        Livewire::test(ContactForm::class, ['showService' => true, 'formName' => 'homepage-contact'])
            ->set('name', 'Dipak Patil')
            ->set('email', 'patildipak@gmail.com')
            ->set('phone', '+918983300222')
            ->set('company', 'VOLie')
            ->set('service', 'Cybersecurity')
            ->set('message', 'This is a test message.')
            ->set('acceptedTerms', true)
            ->set('pageUrl', 'http://localhost:8000')
            ->call('submit')
            ->assertSet('submitError', null)
            ->assertSet('submitted', true)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('form_submissions', [
            'email' => 'patildipak@gmail.com',
            'form_name' => 'homepage-contact',
        ]);

        $this->assertSame('Cybersecurity', data_get(
            Lead::query()->where('email', 'patildipak@gmail.com')->first()?->payload,
            'service'
        ));
    }

    public function test_contact_modal_opens_vapt_quote_variant_with_selected_plan(): void
    {
        Livewire::test(ContactModal::class)
            ->dispatch('open-contact-modal', service: 'Gold', variant: 'vapt-quote')
            ->assertSet('isOpen', true)
            ->assertSet('variant', 'vapt-quote')
            ->assertSet('service', 'Gold');
    }

    public function test_vapt_pricing_quote_form_stores_selected_plan_in_payload(): void
    {
        Queue::fake();

        Livewire::test(ContactForm::class, [
            'showCompany' => false,
            'showService' => true,
            'formName' => 'vapt-pricing-quote',
            'serviceOptions' => ['Silver', 'Gold', 'Platinum'],
            'initialService' => 'Gold',
            'layout' => 'modal',
        ])
            ->assertSet('service', 'Gold')
            ->set('name', 'Quote Seeker')
            ->set('email', 'quote@example.com')
            ->set('phone', '+14155550199')
            ->set('message', 'Looking for a Gold package VAPT assessment.')
            ->set('acceptedTerms', true)
            ->set('pageUrl', 'https://example.com/vapt-services')
            ->call('submit')
            ->assertSet('submitted', true)
            ->assertHasNoErrors();

        $lead = Lead::query()->where('email', 'quote@example.com')->first();

        $this->assertNotNull($lead);
        $this->assertSame('vapt-pricing-quote', $lead->form_name);
        $this->assertSame('VAPT Pricing Quote', $lead->form_label);
        $this->assertSame('Gold', $lead->service);
        $this->assertSame('Gold', data_get($lead->payload, 'service'));
    }

    public function test_contact_modal_opens_pricing_enquire_variant_with_selected_plan(): void
    {
        Livewire::test(ContactModal::class)
            ->dispatch('open-contact-modal', service: 'CBA US (Basic)', variant: 'pricing-enquire')
            ->assertSet('isOpen', true)
            ->assertSet('variant', 'pricing-enquire')
            ->assertSet('service', 'CBA US (Basic)')
            ->assertSee('Overwhelmed By Your Books ?')
            ->assertSee('Catch up Now at the Lowest Rates Guaranteed !');
    }

    public function test_pricing_enquire_form_stores_selected_plan_in_payload(): void
    {
        Queue::fake();

        Livewire::test(ContactForm::class, [
            'showCompany' => false,
            'showService' => false,
            'formName' => 'pricing-enquire',
            'initialService' => 'CBA US (Advance)',
            'layout' => 'modal',
        ])
            ->assertSet('service', 'CBA US (Advance)')
            ->set('name', 'Pricing Seeker')
            ->set('email', 'pricing@example.com')
            ->set('phone', '+14155550188')
            ->set('message', 'Interested in the Advance cash-basis plan.')
            ->set('acceptedTerms', true)
            ->set('pageUrl', 'https://example.com/pricing')
            ->call('submit')
            ->assertSet('submitted', true)
            ->assertHasNoErrors();

        $lead = Lead::query()->where('email', 'pricing@example.com')->first();

        $this->assertNotNull($lead);
        $this->assertSame('pricing-enquire', $lead->form_name);
        $this->assertSame('Pricing Enquire', $lead->form_label);
        $this->assertSame('CBA US (Advance)', $lead->service);
        $this->assertSame('CBA US (Advance)', $lead->package_selected);
        $this->assertSame('CBA US (Advance)', data_get($lead->payload, 'package_selected'));
        $this->assertContains('Selected Plan', array_column($lead->extraAnswers(), 'label'));
    }
}
