<?php

namespace Tests\Feature;

use App\Filament\Resources\Leads\Pages\EditLead;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LeadAdminDisplayTest extends TestCase
{
    use RefreshDatabase;

    public function test_construction_submission_shows_requirement_answers_in_admin(): void
    {
        $this->withoutVite();

        $user = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $lead = Lead::query()->create([
            'name' => 'Dipak Construction',
            'email' => 'contruction@gmail.com',
            'phone' => '+18547747874',
            'form_name' => 'free-consultation-for-construction',
            'message' => 'this is a test message.',
            'page_url' => 'http://localhost:8000/free-consultation-for-construction/',
            'payload' => [
                'service' => 'Construction Engineering & Back Office Support',
                'looking_for' => 'Construction Engineering & Back Office Support',
                'needed_service' => 'Drafting / Drawing Service',
                'resource_type' => 'Full-Time Dedicated Resource',
                'hire_when' => '2–4 weeks',
            ],
        ]);

        $this->actingAs($user);

        Livewire::test(EditLead::class, ['record' => $lead->getRouteKey()])
            ->assertOk()
            ->assertSee('Construction Engineering & Back Office Support')
            ->assertSee('Which service do you need?')
            ->assertSee('Drafting / Drawing Service')
            ->assertSee('Resource Type')
            ->assertSee('Full-Time Dedicated Resource')
            ->assertSee('When do you want to hire?')
            ->assertSee('2–4 weeks')
            ->assertDontSee('Job Title')
            ->assertDontSee('Asset');
    }

    public function test_other_form_submissions_still_show_their_own_payload_fields(): void
    {
        $this->withoutVite();

        $user = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $lead = Lead::query()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'company' => 'Acme Inc',
            'form_name' => 'ebook_download',
            'message' => 'Please send the ebook.',
            'payload' => [
                'service' => 'Cybersecurity',
                'job_title' => 'CFO',
                'asset_title' => 'Q1 Playbook',
            ],
        ]);

        $this->actingAs($user);

        Livewire::test(EditLead::class, ['record' => $lead->getRouteKey()])
            ->assertOk()
            ->assertSee('Cybersecurity')
            ->assertSee('Job Title')
            ->assertSee('CFO')
            ->assertSee('Asset')
            ->assertSee('Q1 Playbook')
            ->assertDontSee('Which service do you need?')
            ->assertDontSee('When do you want to hire?')
            ->assertDontSee('Resource Type');
    }
}
