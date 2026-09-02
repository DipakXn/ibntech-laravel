<?php

namespace Tests\Feature;

use App\Livewire\Forms\ContactForm;
use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FreeConsultationPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_free_consultation_page_renders_hero_form_and_testimonials(): void
    {
        $this->withoutVite();

        $page = Page::query()->create([
            'title' => 'Free Consultation',
            'slug' => 'free-consultation',
            'template' => 'free-consultation',
            'status' => 'published',
        ]);

        SeoMeta::query()->create([
            'metable_type' => Page::class,
            'metable_id' => $page->id,
            'meta_title' => 'Free 30 Min Consultation | Outsourced Finance & Accounting Services',
            'meta_description' => 'Book a free 30-minute consultation with IBN Technologies. Cut operational costs with expert outsourced finance and accounting solutions.',
            'canonical_url' => 'https://www.ibntech.com/free-consultation/',
        ]);

        $this->assertSame('http://localhost/free-consultation/', route('page.show', ['slug' => 'free-consultation']));

        $response = $this->followingRedirects()->get('/free-consultation/');

        $response->assertOk();
        $response->assertSee('Streamline Your Business. Save Time and Money.', false);
        $response->assertSee('Book a Free Consultation – Unlock Up to 70% Cost Savings', false);
        $response->assertSee('What Our Clients Say', false);
        $response->assertSee('Trusted by industry leaders', false);
        $response->assertSeeLivewire(ContactForm::class);
        $response->assertSee('Please Select Services', false);
        $response->assertSee('Submit and Book Now', false);
        $response->assertSee('Free 30 Min Consultation | Outsourced Finance &amp; Accounting Services', false);
        $response->assertSee('https://www.ibntech.com/free-consultation/', false);
    }

    public function test_draft_free_consultation_page_is_not_publicly_accessible(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Free Consultation Draft',
            'slug' => 'free-consultation-draft',
            'template' => 'free-consultation',
            'status' => 'draft',
        ]);

        $this->get('/free-consultation-draft/')->assertNotFound();
    }
}
