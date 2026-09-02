<?php

namespace Tests\Feature;

use App\Livewire\Forms\ContactForm;
use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class FreeConsultationRemainingPagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{slug: string, template: string, title: string, heading: string, formTitle: string, bullet: string, submit: string, seoTitle: string, canonical: string, companyPlaceholder: ?string}>
     */
    public static function remainingPages(): array
    {
        return [
            'ipa' => [[
                'slug' => 'free-consultation-for-ipa',
                'template' => 'free-consultation-for-ipa',
                'title' => 'Free Consultation For IPA',
                'heading' => 'Experience the Future of Workflow Automation',
                'formTitle' => 'Automate AP/AR with IPA',
                'bullet' => 'Three-way matching (Invoice, PO, and Goods Receipt) for 100% accuracy',
                'submit' => 'BOOK A FREE CONSULTATION',
                'seoTitle' => 'Free Consultation For IPA - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/free-consultation-for-ipa/',
                'companyPlaceholder' => null,
            ]],
            'payroll' => [[
                'slug' => 'free-consultation-for-payroll-service',
                'template' => 'free-consultation-for-payroll-service',
                'title' => 'Free Consultation For Payroll Service',
                'heading' => 'Outsourced Payroll Processing',
                'formTitle' => 'Perfect Your Payroll in Hours',
                'bullet' => '100% Accuracy Guarantee',
                'submit' => 'BOOK A FREE CONSULTATION',
                'seoTitle' => 'Free Consultation For Payroll Service - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/free-consultation-for-payroll-service/',
                'companyPlaceholder' => null,
            ]],
            'tax' => [[
                'slug' => 'free-consultation-for-tax-return',
                'template' => 'free-consultation-for-tax-return',
                'title' => 'Free Consultation For Tax Return Preparation',
                'heading' => 'Accurate Tax Return Preparation. Expert Support. Zero Stress.',
                'formTitle' => 'Get Your Free Tax Prep Consultation Today!',
                'bullet' => '100% Pre and Post Filing Support',
                'submit' => 'BOOK A FREE CONSULTATION',
                'seoTitle' => 'Free Consultation For Tax Return Preparation - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/free-consultation-for-tax-return/',
                'companyPlaceholder' => null,
            ]],
            'trial' => [[
                'slug' => 'free-trial',
                'template' => 'free-trial',
                'title' => 'Free Trial',
                'heading' => 'Take Control of Your Business Books',
                'formTitle' => 'Schedule Your Free Trial Today',
                'bullet' => 'No credit card required to start',
                'submit' => 'BOOK A FREE TRIAL',
                'seoTitle' => 'Free Trial - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/free-trial/',
                'companyPlaceholder' => 'Company Name',
            ]],
        ];
    }

    /**
     * @param  array{slug: string, template: string, title: string, heading: string, formTitle: string, bullet: string, submit: string, seoTitle: string, canonical: string, companyPlaceholder: ?string}  $pageData
     */
    #[DataProvider('remainingPages')]
    public function test_published_page_renders_hero_form_and_homepage_testimonials(array $pageData): void
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
        $response->assertSee($pageData['formTitle'], false);
        $response->assertSee($pageData['bullet'], false);
        $response->assertSee($pageData['submit'], false);
        $response->assertSee('Client Testimonial', false);
        $response->assertSeeLivewire(ContactForm::class);
        $response->assertSee($pageData['seoTitle'], false);
        $response->assertSee($pageData['canonical'], false);
        $response->assertDontSee('Please Select Services', false);

        if ($pageData['companyPlaceholder'] !== null) {
            $response->assertSee($pageData['companyPlaceholder'], false);
        }
    }
}
