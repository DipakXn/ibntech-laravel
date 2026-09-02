<?php

namespace Tests\Feature;

use App\Jobs\SendLeadSubmissionNotification;
use App\Livewire\Forms\ConstructionConsultationForm;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class ConstructionConsultationFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_step_one_requires_contact_fields_before_continuing(): void
    {
        Livewire::test(ConstructionConsultationForm::class)
            ->assertSet('step', 1)
            ->assertSee('Contact Information')
            ->assertSee('What are you looking for?')
            ->assertSee('Details')
            ->assertSee('Next')
            ->call('nextStep')
            ->assertHasErrors(['name', 'email', 'phone', 'lookingFor'])
            ->assertSet('step', 1);
    }

    public function test_submit_on_step_one_advances_after_validation(): void
    {
        Livewire::test(ConstructionConsultationForm::class)
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('phone', '+14155550123')
            ->set('lookingFor', ConstructionConsultationForm::LOOKING_FOR_DETAILED)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('step', 2)
            ->assertSee('When do you want to hire?');
    }

    public function test_navigation_preserves_entered_values_across_three_steps(): void
    {
        Livewire::test(ConstructionConsultationForm::class)
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('phone', '+14155550123')
            ->set('lookingFor', ConstructionConsultationForm::LOOKING_FOR_DETAILED)
            ->call('nextStep')
            ->assertSet('step', 2)
            ->set('neededService', 'Estimation & Takeoffs')
            ->set('resourceType', 'Full-Time Dedicated Resource')
            ->set('hireWhen', '2–4 weeks')
            ->call('nextStep')
            ->assertSet('step', 3)
            ->set('message', 'Need a dedicated estimator for upcoming bids.')
            ->call('previousStep')
            ->assertSet('step', 2)
            ->assertSet('neededService', 'Estimation & Takeoffs')
            ->call('previousStep')
            ->assertSet('step', 1)
            ->assertSet('name', 'Jane Doe')
            ->assertSet('lookingFor', ConstructionConsultationForm::LOOKING_FOR_DETAILED)
            ->assertSet('message', 'Need a dedicated estimator for upcoming bids.')
            ->call('nextStep')
            ->call('nextStep')
            ->assertSet('step', 3)
            ->assertSet('neededService', 'Estimation & Takeoffs');
    }

    public function test_not_sure_hides_and_clears_service_and_resource_fields(): void
    {
        Livewire::test(ConstructionConsultationForm::class)
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('phone', '+14155550123')
            ->set('lookingFor', ConstructionConsultationForm::LOOKING_FOR_DETAILED)
            ->call('nextStep')
            ->assertSeeHtml('fccons-form__extras')
            ->set('neededService', 'Cost Engineer')
            ->set('resourceType', 'Part-Time / Hourly-based')
            ->set('hireWhen', '1–2 months')
            ->call('previousStep')
            ->set('lookingFor', 'Not sure')
            ->assertSet('neededService', null)
            ->assertSet('resourceType', null)
            ->assertSet('hireWhen', '1–2 months')
            ->call('nextStep')
            ->assertSeeHtml('fccons-form__extras is-placeholder')
            ->assertSee('When do you want to hire?');
    }

    public function test_combined_engineering_option_shows_detailed_requirement_fields(): void
    {
        Livewire::test(ConstructionConsultationForm::class)
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('phone', '+14155550123')
            ->assertSee('Construction Engineering & Back Office Support')
            ->set('lookingFor', ConstructionConsultationForm::LOOKING_FOR_DETAILED)
            ->call('nextStep')
            ->assertDontSeeHtml('fccons-form__extras is-placeholder')
            ->assertSee('Which service do you need?')
            ->assertSee('Select Resource Type')
            ->assertSee('When do you want to hire?');
    }

    public function test_hidden_fields_are_not_required_when_not_sure_is_selected(): void
    {
        Queue::fake();

        Livewire::test(ConstructionConsultationForm::class)
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('phone', '+14155550123')
            ->set('pageUrl', 'https://example.com/free-consultation-for-construction/')
            ->set('lookingFor', 'Not sure')
            ->call('nextStep')
            ->set('hireWhen', 'Just exploring')
            ->call('nextStep')
            ->assertSet('step', 3)
            ->set('message', 'Not sure yet, please recommend a starting point.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true);

        $lead = Lead::query()->where('email', 'jane@example.com')->first();

        $this->assertNotNull($lead);
        $this->assertSame('Not sure', data_get($lead->payload, 'looking_for'));
        $this->assertNull(data_get($lead->payload, 'needed_service'));
        $this->assertNull(data_get($lead->payload, 'resource_type'));
        $this->assertSame('Just exploring', data_get($lead->payload, 'hire_when'));
    }

    public function test_construction_engineering_submission_stores_conditional_answers(): void
    {
        Queue::fake();

        Livewire::test(ConstructionConsultationForm::class)
            ->set('name', 'Alex Rivera')
            ->set('email', 'alex@example.com')
            ->set('phone', '+14155550199')
            ->set('pageUrl', 'https://example.com/free-consultation-for-construction/')
            ->set('lookingFor', ConstructionConsultationForm::LOOKING_FOR_DETAILED)
            ->call('nextStep')
            ->set('neededService', 'Drafting / Drawing Service')
            ->set('resourceType', 'Full-Time Dedicated Resource')
            ->set('hireWhen', '2–4 weeks')
            ->call('nextStep')
            ->set('message', 'Need drafting support for a commercial project.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true)
            ->assertSet('step', 1);

        $lead = Lead::query()->where('email', 'alex@example.com')->first();

        $this->assertNotNull($lead);
        $this->assertSame('free-consultation-for-construction', $lead->form_name);
        $this->assertSame('Free Consultation For Construction', $lead->form_label);
        $this->assertSame(ConstructionConsultationForm::LOOKING_FOR_DETAILED, $lead->service);
        $this->assertSame('Drafting / Drawing Service', data_get($lead->payload, 'needed_service'));
        $this->assertSame('Full-Time Dedicated Resource', data_get($lead->payload, 'resource_type'));
        $this->assertSame('2–4 weeks', data_get($lead->payload, 'hire_when'));
        Queue::assertPushed(SendLeadSubmissionNotification::class, 1);
    }

    public function test_step_two_requires_requirement_fields_before_continuing(): void
    {
        Livewire::test(ConstructionConsultationForm::class)
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('phone', '+14155550123')
            ->set('lookingFor', ConstructionConsultationForm::LOOKING_FOR_DETAILED)
            ->call('nextStep')
            ->call('nextStep')
            ->assertHasErrors(['neededService', 'resourceType', 'hireWhen'])
            ->assertHasNoErrors(['message'])
            ->assertSet('step', 2);
    }

    public function test_step_three_requires_message_before_submit(): void
    {
        Livewire::test(ConstructionConsultationForm::class)
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('phone', '+14155550123')
            ->set('pageUrl', 'https://example.com/free-consultation-for-construction/')
            ->set('lookingFor', ConstructionConsultationForm::LOOKING_FOR_DETAILED)
            ->call('nextStep')
            ->set('neededService', 'Estimation & Takeoffs')
            ->set('resourceType', 'Full-Time Dedicated Resource')
            ->set('hireWhen', 'Just exploring')
            ->call('nextStep')
            ->assertSet('step', 3)
            ->set('message', 'short')
            ->call('submit')
            ->assertHasErrors(['message']);
    }
}
