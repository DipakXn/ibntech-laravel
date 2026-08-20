<?php

namespace Tests\Feature;

use App\Livewire\ContactModal;
use App\Livewire\Forms\LandingInquiryForm;
use App\Models\LandingPage;
use App\Models\Lead;
use App\Models\Page;
use Database\Seeders\LandingPageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Testing\TestResponse;
use Livewire\Livewire;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return list<string>
     */
    protected function campaignSlugs(): array
    {
        return [
            'vapt-audit-services',
            'cloud-consulting-services',
            'construction-engineering-services',
            'cyber-security-services-india',
            'cybersecurity-services',
            'managed-soc-services',
            'office-365-migration-consulting',
            'soc-calculator',
        ];
    }

    /**
     * @return list<string>
     */
    protected function thankYouSlugs(): array
    {
        return [
            'vapt-audit-services-thank-you',
            'cloud-consulting-services-thank-you',
            'cyber-security-services-india-thank-you',
            'cybersecurity-thank-you',
            'office-365-migration-consulting-thank-you',
            'thank-you',
        ];
    }

    public function test_published_landing_page_renders_from_the_landing_pages_folder(): void
    {
        $this->withoutVite();

        LandingPage::query()->create([
            'title' => 'VAPT Audit Services',
            'slug' => 'vapt-audit-services',
            'template' => 'vapt-audit-services',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/lp/vapt-audit-services/');

        $response->assertOk();
        $response->assertSee('VAPT Audit Services');
        $response->assertSeeLivewire(LandingInquiryForm::class);
        $response->assertDontSee('renderRecaptcha');
        $this->assertUsesLandingPageChrome($response);
    }

    public function test_draft_landing_page_is_not_publicly_accessible(): void
    {
        $this->withoutVite();

        LandingPage::query()->create([
            'title' => 'Draft Landing Page',
            'slug' => 'draft-landing-page',
            'template' => 'vapt-audit-services',
            'status' => 'draft',
        ]);

        $this->get('/lp/draft-landing-page/')->assertNotFound();
    }

    public function test_seeded_campaign_and_thank_you_pages_are_publicly_accessible(): void
    {
        $this->withoutVite();
        $this->seed(LandingPageSeeder::class);

        foreach ($this->campaignSlugs() as $slug) {
            $response = $this->followingRedirects()->get('/lp/'.$slug.'/');

            $response->assertOk();
            $response->assertSeeLivewire(LandingInquiryForm::class);
            if ($slug === 'construction-engineering-services') {
                $response->assertSee('renderRecaptcha', false);
            } else {
                $response->assertDontSee('renderRecaptcha');
            }
            $this->assertUsesLandingPageChrome($response);
        }

        foreach ($this->thankYouSlugs() as $slug) {
            $response = $this->followingRedirects()->get('/lp/'.$slug.'/');

            $response->assertOk();
            $response->assertDontSeeLivewire(LandingInquiryForm::class);
            $this->assertUsesLandingPageChrome($response);
        }

        $this->assertDatabaseHas('landing_pages', [
            'slug' => 'construction-engineering-services',
            'thank_you_slug' => null,
        ]);
        $this->assertDatabaseHas('landing_pages', [
            'slug' => 'managed-soc-services',
            'thank_you_slug' => 'cybersecurity-thank-you',
        ]);
        $this->assertDatabaseMissing('landing_pages', [
            'slug' => 'construction-engineering-services-thank-you',
        ]);
    }

    public function test_landing_inquiry_form_validates_required_fields(): void
    {
        $this->createPublishedLandingPage();

        Livewire::test(LandingInquiryForm::class, [
            'landingPageSlug' => 'vapt-audit-services',
            'landingPageTitle' => 'VAPT Audit Services',
        ])
            ->set('name', '')
            ->set('email', 'invalid-email')
            ->set('phone', '')
            ->set('company', '')
            ->set('message', 'short')
            ->set('acceptedTerms', false)
            ->call('submit')
            ->assertHasErrors([
                'name' => ['required'],
                'email' => ['email'],
                'phone' => ['required'],
                'company' => ['required'],
                'message' => ['min'],
                'acceptedTerms' => ['accepted'],
            ]);
    }

    public function test_landing_inquiry_form_stores_the_landing_page_name_and_redirects_to_thank_you(): void
    {
        Queue::fake();
        $this->createPublishedLandingPage('vapt-audit-services-thank-you');

        Livewire::test(LandingInquiryForm::class, [
            'landingPageSlug' => 'vapt-audit-services',
            'landingPageTitle' => 'VAPT Audit Services',
        ])
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('phone', '+14155550123')
            ->set('company', 'Acme Inc')
            ->set('message', 'Need a VAPT audit for our applications.')
            ->set('acceptedTerms', true)
            ->set('pageUrl', 'http://localhost/lp/vapt-audit-services/')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('http://localhost/lp/vapt-audit-services-thank-you/');

        $this->assertDatabaseHas('form_submissions', [
            'email' => 'jane@example.com',
            'form_name' => 'lp-vapt-audit-services',
            'page_url' => 'http://localhost/lp/vapt-audit-services/',
        ]);

        $submission = Lead::query()->where('email', 'jane@example.com')->first();

        $this->assertNotNull($submission);
        $this->assertSame('VAPT Audit Services', $submission->form_label);
        $this->assertSame('vapt-audit-services', data_get($submission->payload, 'landing_page_slug'));
        $this->assertSame('VAPT Audit Services', data_get($submission->payload, 'landing_page_title'));
    }

    public function test_construction_engineering_form_stays_on_page_without_a_thank_you_redirect(): void
    {
        Queue::fake();

        LandingPage::query()->create([
            'title' => 'Construction Engineering Services',
            'slug' => 'construction-engineering-services',
            'template' => 'construction-engineering-services',
            'thank_you_slug' => null,
            'status' => 'published',
        ]);

        Livewire::test(LandingInquiryForm::class, [
            'landingPageSlug' => 'construction-engineering-services',
            'landingPageTitle' => 'Construction Engineering Services',
            'showStaffingFields' => true,
            'resourceTypeOptions' => [
                'Full-Time Dedicated Support',
                'Part-Time / Hourly Based',
                'Not Sure',
            ],
            'serviceOptions' => [
                'Drawing & Drafting',
                'Estimation & Takeoffs',
                'Bid Management',
                'Not Sure yet – Need Guidance',
            ],
        ])
            ->set('name', 'Alex Rivera')
            ->set('email', 'alex@example.com')
            ->set('phone', '+14155550199')
            ->set('resourceType', 'Full-Time Dedicated Support')
            ->set('service', 'Drawing & Drafting')
            ->set('message', 'Need construction engineering support for a new site.')
            ->set('acceptedTerms', true)
            ->set('pageUrl', 'http://localhost/lp/construction-engineering-services/')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true)
            ->assertNoRedirect();

        $this->assertDatabaseHas('form_submissions', [
            'email' => 'alex@example.com',
            'form_name' => 'lp-construction-engineering-services',
        ]);

        $submission = Lead::query()->where('email', 'alex@example.com')->first();
        $this->assertNotNull($submission);
        $this->assertSame('Full-Time Dedicated Support', data_get($submission->payload, 'resource_type'));
        $this->assertSame('Drawing & Drafting', data_get($submission->payload, 'service'));
    }

    public function test_honeypot_submissions_are_ignored(): void
    {
        Queue::fake();
        $this->createPublishedLandingPage('vapt-audit-services-thank-you');

        Livewire::test(LandingInquiryForm::class, [
            'landingPageSlug' => 'vapt-audit-services',
            'landingPageTitle' => 'VAPT Audit Services',
        ])
            ->set('name', 'Bot User')
            ->set('email', 'bot@example.com')
            ->set('phone', '+14155550123')
            ->set('company', 'Spam Co')
            ->set('message', 'This is an automated submission attempt.')
            ->set('acceptedTerms', true)
            ->set('website', 'https://spam.example')
            ->set('pageUrl', 'http://localhost/lp/vapt-audit-services/')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('http://localhost/lp/vapt-audit-services-thank-you/');

        $this->assertDatabaseMissing('form_submissions', [
            'email' => 'bot@example.com',
        ]);
    }

    public function test_duplicate_landing_form_submissions_are_not_stored_twice(): void
    {
        Queue::fake();
        $this->createPublishedLandingPage();

        $payload = [
            'landingPageSlug' => 'vapt-audit-services',
            'landingPageTitle' => 'VAPT Audit Services',
        ];

        $submit = function () use ($payload) {
            return Livewire::test(LandingInquiryForm::class, $payload)
                ->set('name', 'Jane Doe')
                ->set('email', 'jane@example.com')
                ->set('phone', '+14155550123')
                ->set('company', 'Acme Inc')
                ->set('message', 'Need a VAPT audit for our applications.')
                ->set('acceptedTerms', true)
                ->set('pageUrl', 'http://localhost/lp/vapt-audit-services/')
                ->call('submit');
        };

        $submit()->assertHasNoErrors()->assertRedirect();
        $submit()->assertHasNoErrors()->assertRedirect();

        $this->assertSame(1, Lead::query()->where('email', 'jane@example.com')->count());
    }

    public function test_landing_inquiry_form_is_rate_limited(): void
    {
        Queue::fake();
        $this->createPublishedLandingPage();
        RateLimiter::clear('landing-inquiry:127.0.0.1');

        for ($i = 1; $i <= 5; $i++) {
            Livewire::test(LandingInquiryForm::class, [
                'landingPageSlug' => 'vapt-audit-services',
                'landingPageTitle' => 'VAPT Audit Services',
            ])
                ->set('name', 'User '.$i)
                ->set('email', 'user'.$i.'@example.com')
                ->set('phone', '+14155550123')
                ->set('company', 'Acme Inc')
                ->set('message', 'Need a VAPT audit for our applications.')
                ->set('acceptedTerms', true)
                ->set('pageUrl', 'http://localhost/lp/vapt-audit-services/')
                ->call('submit')
                ->assertHasNoErrors();
        }

        Livewire::test(LandingInquiryForm::class, [
            'landingPageSlug' => 'vapt-audit-services',
            'landingPageTitle' => 'VAPT Audit Services',
        ])
            ->set('name', 'User Six')
            ->set('email', 'user6@example.com')
            ->set('phone', '+14155550123')
            ->set('company', 'Acme Inc')
            ->set('message', 'Need a VAPT audit for our applications.')
            ->set('acceptedTerms', true)
            ->set('pageUrl', 'http://localhost/lp/vapt-audit-services/')
            ->call('submit')
            ->assertHasErrors(['email']);

        $this->assertDatabaseMissing('form_submissions', [
            'email' => 'user6@example.com',
        ]);
    }

    public function test_submitted_values_are_sanitized(): void
    {
        Queue::fake();
        $this->createPublishedLandingPage();

        Livewire::test(LandingInquiryForm::class, [
            'landingPageSlug' => 'vapt-audit-services',
            'landingPageTitle' => 'VAPT Audit Services',
        ])
            ->set('name', '<script>alert(1)</script>Jane')
            ->set('email', 'jane@example.com')
            ->set('phone', '+14155550123')
            ->set('company', '<b>Acme</b>')
            ->set('message', '<p>Need a VAPT audit for our applications.</p>')
            ->set('acceptedTerms', true)
            ->set('pageUrl', 'http://localhost/lp/vapt-audit-services/')
            ->call('submit')
            ->assertHasNoErrors();

        $submission = Lead::query()->where('email', 'jane@example.com')->first();

        $this->assertNotNull($submission);
        $this->assertSame('Jane', $submission->name);
        $this->assertSame('Acme', $submission->company);
        $this->assertSame('Need a VAPT audit for our applications.', $submission->message);
    }

    public function test_main_website_pages_keep_the_standard_header_and_footer(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'home',
            'status' => 'published',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('site-ibn-header', false);
        $response->assertSee('site-footer', false);
        $response->assertDontSee('lp-header', false);
        $response->assertDontSee('lp-footer', false);
        $response->assertSeeLivewire(ContactModal::class);
    }

    protected function assertUsesLandingPageChrome(TestResponse $response): void
    {
        $response->assertSee('lp-header', false);
        $response->assertSee('lp-footer', false);
        $response->assertSee('SINCE 1999 | ISO 9001:2015 &amp; 20000-1:2018 &amp; 27001:2022', false);
        $response->assertSee('https://www.facebook.com/ibntechnologies/');
        $response->assertSee('https://www.linkedin.com/company/ibn-technologies-limited/');
        $response->assertSee('https://twitter.com/IBNTechnology/');
        $response->assertSee('https://www.instagram.com/ibntechnologies/');
        $response->assertSee('https://www.youtube.com/@ibn-technologies');
        $response->assertSee('https://ibntech.com/privacy-policy/');
        $response->assertSee('https://ibntech.com/terms-of-use/');
        $response->assertSee('All Rights Reserved');
        $response->assertDontSee('site-ibn-header', false);
        $response->assertDontSee('site-ibn-topbar', false);
        $response->assertDontSee('site-footer__grid', false);
        $response->assertDontSeeLivewire(ContactModal::class);
    }

    protected function createPublishedLandingPage(?string $thankYouSlug = 'vapt-audit-services-thank-you'): LandingPage
    {
        if ($thankYouSlug) {
            LandingPage::query()->create([
                'title' => 'VAPT Audit Services Thank You',
                'slug' => $thankYouSlug,
                'template' => $thankYouSlug,
                'status' => 'published',
            ]);
        }

        return LandingPage::query()->create([
            'title' => 'VAPT Audit Services',
            'slug' => 'vapt-audit-services',
            'template' => 'vapt-audit-services',
            'thank_you_slug' => $thankYouSlug,
            'status' => 'published',
        ]);
    }
}
