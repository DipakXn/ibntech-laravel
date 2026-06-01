<?php

namespace Tests\Feature;

use App\Jobs\SendLeadSubmissionNotification;
use App\Livewire\Forms\ContactForm;
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
}
