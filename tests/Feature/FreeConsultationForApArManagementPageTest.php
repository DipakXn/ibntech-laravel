<?php

namespace Tests\Feature;

use App\Livewire\Forms\ContactForm;
use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FreeConsultationForApArManagementPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_page_renders_hero_form_and_homepage_testimonials(): void
    {
        $this->withoutVite();

        $page = Page::query()->create([
            'title' => 'Free Consultation For AP AR Management',
            'slug' => 'free-consultation-for-ap-ar-management',
            'template' => 'free-consultation-for-ap-ar-management',
            'status' => 'published',
        ]);

        SeoMeta::query()->create([
            'metable_type' => Page::class,
            'metable_id' => $page->id,
            'meta_title' => 'Free Consultation For AP AR Management - IBN Technologies',
            'meta_description' => 'Take control of cash flow with expert AP/AR management from IBN Technologies.',
            'canonical_url' => 'https://www.ibntech.com/free-consultation-for-ap-ar-management/',
        ]);

        $this->assertSame(
            'http://localhost/free-consultation-for-ap-ar-management/',
            route('page.show', ['slug' => 'free-consultation-for-ap-ar-management']),
        );

        $response = $this->followingRedirects()->get('/free-consultation-for-ap-ar-management/');

        $response->assertOk();
        $response->assertSee('AP AR Management', false);
        $response->assertSee('Boost Cash Flow with Expert AP/AR—Act Today!', false);
        $response->assertSee('Improve Cash Flow by 20-30%', false);
        $response->assertSee('Client Testimonial', false);
        $response->assertSeeLivewire(ContactForm::class);
        $response->assertSee('BOOK A FREE CONSULTATION', false);
        $response->assertSee('Free Consultation For AP AR Management - IBN Technologies', false);
        $response->assertSee('https://www.ibntech.com/free-consultation-for-ap-ar-management/', false);
        $response->assertDontSee('Please Select Services', false);
    }

    public function test_draft_page_is_not_publicly_accessible(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'AP AR Consultation Draft',
            'slug' => 'free-consultation-for-ap-ar-management-draft',
            'template' => 'free-consultation-for-ap-ar-management',
            'status' => 'draft',
        ]);

        $this->get('/free-consultation-for-ap-ar-management-draft/')->assertNotFound();
    }
}
