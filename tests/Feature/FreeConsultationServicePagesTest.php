<?php

namespace Tests\Feature;

use App\Livewire\Forms\ConstructionConsultationForm;
use App\Livewire\Forms\ContactForm;
use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class FreeConsultationServicePagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{slug: string, template: string, title: string, heading: string, seoTitle: string, canonical: string, form: class-string}>
     */
    public static function consultationPages(): array
    {
        return [
            'cloud' => [[
                'slug' => 'free-consultation-for-cloud',
                'template' => 'free-consultation-for-cloud',
                'title' => 'Free Consultation For Cloud',
                'heading' => 'Accelerate Your Cloud Transformation with IBN Technologies',
                'seoTitle' => 'Free Consultation For Cloud - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/free-consultation-for-cloud/',
                'form' => ContactForm::class,
            ]],
            'construction' => [[
                'slug' => 'free-consultation-for-construction',
                'template' => 'free-consultation-for-construction',
                'title' => 'Free Consultation For Construction',
                'heading' => 'Skilled Full-Time Remote Engineers for',
                'seoTitle' => 'Free Consultation For Construction - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/free-consultation-for-construction/',
                'form' => ConstructionConsultationForm::class,
            ]],
            'cybersecurity' => [[
                'slug' => 'free-consultation-for-cybersecurity',
                'template' => 'free-consultation-for-cybersecurity',
                'title' => 'Free Consultation For Cybersecurity',
                'heading' => 'Secure Your Business with IBN Tech Cybersecurity Services',
                'seoTitle' => 'Free Consultation For Cybersecurity - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/free-consultation-for-cybersecurity/',
                'form' => ContactForm::class,
            ]],
        ];
    }

    /**
     * @param  array{slug: string, template: string, title: string, heading: string, seoTitle: string, canonical: string, form: class-string}  $pageData
     */
    #[DataProvider('consultationPages')]
    public function test_published_consultation_page_renders(array $pageData): void
    {
        $this->withoutVite();

        $page = Page::query()->create([
            'title' => $pageData['title'],
            'slug' => $pageData['slug'],
            'template' => $pageData['template'],
            'status' => 'published',
        ]);

        SeoMeta::query()->create([
            'metable_type' => Page::class,
            'metable_id' => $page->id,
            'meta_title' => $pageData['seoTitle'],
            'meta_description' => $pageData['title'],
            'canonical_url' => $pageData['canonical'],
        ]);

        $this->assertSame(
            'http://localhost/'.$pageData['slug'].'/',
            route('page.show', ['slug' => $pageData['slug']]),
        );

        $response = $this->followingRedirects()->get('/'.$pageData['slug'].'/');

        $response->assertOk();
        $response->assertSee($pageData['heading'], false);
        $response->assertSeeLivewire($pageData['form']);
        $response->assertSee($pageData['seoTitle'], false);
        $response->assertSee($pageData['canonical'], false);
    }

    public function test_construction_page_uses_homepage_testimonials(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Free Consultation For Construction',
            'slug' => 'free-consultation-for-construction',
            'template' => 'free-consultation-for-construction',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/free-consultation-for-construction/');

        $response->assertOk();
        $response->assertSee('Client Testimonial', false);
        $response->assertSeeLivewire(ConstructionConsultationForm::class);
        $response->assertSee('Contact Information', false);
        $response->assertSee('Requirements', false);
        $response->assertSee('Next', false);
    }

    public function test_cloud_expertise_cards_link_to_service_pages(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Free Consultation For Cloud',
            'slug' => 'free-consultation-for-cloud',
            'template' => 'free-consultation-for-cloud',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/free-consultation-for-cloud/');

        $response->assertOk();
        $response->assertSee(route('page.show', ['slug' => 'cloud-managed-services']), false);
        $response->assertSee(route('page.show', ['slug' => 'business-continuity-disaster-recovery-services']), false);
        $response->assertSee(route('page.show', ['slug' => 'devsecops-services']), false);
        $response->assertSee(route('page.show', ['slug' => 'microsoft-office-365-migration-support-services']), false);
    }

    public function test_cybersecurity_core_service_cards_link_to_service_pages(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Free Consultation For Cybersecurity',
            'slug' => 'free-consultation-for-cybersecurity',
            'template' => 'free-consultation-for-cybersecurity',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/free-consultation-for-cybersecurity/');

        $response->assertOk();
        $response->assertSee(route('page.show', ['slug' => 'vapt-services']), false);
        $response->assertSee(route('page.show', ['slug' => 'managed-siem-soc-services']), false);
        $response->assertSee(route('page.show', ['slug' => 'vciso-services']), false);
        $response->assertSee(route('page.show', ['slug' => 'managed-detection-response-services']), false);
        $response->assertSee(route('page.show', ['slug' => 'microsoft-security-services']), false);
        $response->assertSee(route('page.show', ['slug' => 'cybersecurity-audit-compliance-services']), false);
    }
}
