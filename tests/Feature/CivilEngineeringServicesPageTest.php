<?php

namespace Tests\Feature;

use App\Livewire\Forms\ConstructionConsultationForm;
use App\Livewire\Forms\ContactForm;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CivilEngineeringServicesPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_page_renders_construction_consultation_form(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Civil Engineering Services',
            'slug' => 'civil-engineering-services',
            'template' => 'civil-engineering-services',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/civil-engineering-services/');

        $response->assertOk();
        $response->assertSee('Full-Time Remote Construction Engineering Support', false);
        $response->assertSee('Get a Quote', false);
        $response->assertSeeLivewire(ConstructionConsultationForm::class);
        $response->assertDontSeeLivewire(ContactForm::class);
        $response->assertSee('Contact Information', false);
        $response->assertSee('What are you looking for?', false);
        $response->assertSee('Book Your Appointment', false);
    }
}
