<?php

namespace Tests\Feature;

use App\Jobs\SendLeadSubmissionNotification;
use App\Livewire\Forms\ContactForm;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireFormSubmissionTest extends TestCase
{
    use RefreshDatabase;

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
}
