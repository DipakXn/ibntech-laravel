<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ThankYouPagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{slug: string, template: string, title: string, heading: string, unique: string, seoTitle: string, canonical: string, robots: string}>
     */
    public static function thankYouPages(): array
    {
        return [
            'brochures' => [[
                'slug' => 'thank-you-brochures-download',
                'template' => 'thank-you-brochures-download',
                'title' => 'Thank You Brochures Download',
                'heading' => 'Thank You.',
                'unique' => 'Thank you for choosing to download our brochures.',
                'seoTitle' => 'Thank You Brochures Download - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thank-you-brochures-download/',
                'robots' => 'nofollow, noindex, nosnippet',
            ]],
            'download' => [[
                'slug' => 'thank-you-download',
                'template' => 'thank-you-download',
                'title' => 'Thank You Download',
                'heading' => 'Thank You !',
                'unique' => 'Your file download link has been sent to your email.',
                'seoTitle' => 'Thank You Download - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thank-you-download/',
                'robots' => 'noindex, nofollow',
            ]],
            'free-trial' => [[
                'slug' => 'thank-you-free-trial',
                'template' => 'thank-you-free-trial',
                'title' => 'Thank You Free Trial',
                'heading' => 'Thank You!',
                'unique' => 'Enjoy the free trial of our outsourcing service.',
                'seoTitle' => 'Thank You Free Trial - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thank-you-free-trial/',
                'robots' => 'noindex, nofollow',
            ]],
            'thank-you' => [[
                'slug' => 'thank-you',
                'template' => 'thank-you',
                'title' => 'Thanks You',
                'heading' => 'Thank You!',
                'unique' => 'Last Step! There’s one Last Thing You Need to Do Right Now!!',
                'seoTitle' => 'Thanks You - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thank-you/',
                'robots' => 'noindex, nofollow',
            ]],
            'ap-ar' => [[
                'slug' => 'thanks-you-for-ap-ar-management',
                'template' => 'thanks-you-for-ap-ar-management',
                'title' => 'Thanks You  For AP AR Management',
                'heading' => 'Thank You for Choosing IBN Technologies!',
                'unique' => 'Optimize your cash flow with our expert AP/AR management',
                'seoTitle' => 'Thanks You For AP AR Management - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thanks-you-for-ap-ar-management/',
                'robots' => 'noindex, nofollow',
            ]],
            'construction' => [[
                'slug' => 'thank-you-for-construction-services-consultation',
                'template' => 'thank-you-for-construction-services-consultation',
                'title' => 'Thanks You  For Construction',
                'heading' => 'Thank You for Choosing IBN Technologies!',
                'unique' => 'We appreciate your interest in our Outsourced Civil Engineering Services.',
                'seoTitle' => 'Thanks You For Construction - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thank-you-for-construction-services-consultation/',
                'robots' => 'noindex, nofollow',
            ]],
            'free-trail' => [[
                'slug' => 'thanks-you-for-free-trail',
                'template' => 'thanks-you-for-free-trail',
                'title' => 'Thanks You  For Free Trail',
                'heading' => 'Thank You for Joining Us!',
                'unique' => 'Our expert will contact you shortly to streamline your books with accuracy',
                'seoTitle' => 'Thanks You For Free Trail - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thanks-you-for-free-trail/',
                'robots' => 'noindex, nofollow',
            ]],
            'ipa' => [[
                'slug' => 'thanks-you-for-ipa',
                'template' => 'thanks-you-for-ipa',
                'title' => 'Thanks You  For IPA',
                'heading' => 'Thank You for Choosing IBN Technologies!',
                'unique' => 'Transform your AP/AR with our IPA-driven automation',
                'seoTitle' => 'Thanks You For IPA - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thanks-you-for-ipa/',
                'robots' => 'noindex, nofollow',
            ]],
            'bookkeeping' => [[
                'slug' => 'thanks-you-for-bookkeeping',
                'template' => 'thanks-you-for-bookkeeping',
                'title' => 'Thanks You For Bookkeeping',
                'heading' => 'Thank You for Choosing IBN Technologies!',
                'unique' => 'Saving up to 70% Operational Cost',
                'seoTitle' => 'Thanks You For Bookkeeping - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thanks-you-for-bookkeeping/',
                'robots' => 'noindex, nofollow',
            ]],
            'cloud' => [[
                'slug' => 'thanks-you-for-cloud',
                'template' => 'thanks-you-for-cloud',
                'title' => 'Thanks You For Cloud',
                'heading' => 'Thank You for Choosing IBN Technologies for Your Cloud Transformation!',
                'unique' => 'Empower your business with flexible, cost-effective cloud solutions',
                'seoTitle' => 'Thanks You For Cloud - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thanks-you-for-cloud/',
                'robots' => 'noindex, nofollow',
            ]],
            'cybersecurity' => [[
                'slug' => 'thanks-you-for-cybersecurity',
                'template' => 'thanks-you-for-cybersecurity',
                'title' => 'Thanks You For Cybersecurity',
                'heading' => 'Thank You for Trusting IBN Technologies with Your Cybersecurity Needs!',
                'unique' => 'Secure your business with trusted cybersecurity solutions',
                'seoTitle' => 'Thanks You For Cybersecurity - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thanks-you-for-cybersecurity/',
                'robots' => 'noindex, nofollow',
            ]],
            'payroll' => [[
                'slug' => 'thanks-you-for-payroll-service',
                'template' => 'thanks-you-for-payroll-service',
                'title' => 'Thanks You for payroll service',
                'heading' => 'Thank You for Choosing IBN Technologies!',
                'unique' => 'Your payroll processing is in expert hands',
                'seoTitle' => 'Thanks You for payroll service - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thanks-you-for-payroll-service/',
                'robots' => 'noindex, nofollow',
            ]],
            'tax' => [[
                'slug' => 'thanks-you-for-tax-preparation',
                'template' => 'thanks-you-for-tax-preparation',
                'title' => 'Thanks You For Tax Preparation',
                'heading' => 'Thank You for Choosing IBN Technologies!',
                'unique' => 'Simplify tax season with our expert tax return preparation',
                'seoTitle' => 'Thanks You For Tax Preparation - IBN Technologies',
                'canonical' => 'https://www.ibntech.com/thanks-you-for-tax-preparation/',
                'robots' => 'noindex, nofollow',
            ]],
        ];
    }

    /**
     * @param  array{slug: string, template: string, title: string, heading: string, unique: string, seoTitle: string, canonical: string, robots: string}  $pageData
     */
    #[DataProvider('thankYouPages')]
    public function test_published_thank_you_page_renders_live_content_and_seo(array $pageData): void
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
            'canonical_url' => $pageData['canonical'],
            'robots_index' => 'noindex',
            'robots_follow' => 'nofollow',
            'custom_meta_robots' => $pageData['robots'] === 'noindex, nofollow' ? null : $pageData['robots'],
            'sitemap_include' => false,
        ]);

        $this->assertSame('http://localhost/'.$pageData['slug'].'/', route('page.show', ['slug' => $pageData['slug']]));

        $response = $this->followingRedirects()->get('/'.$pageData['slug'].'/');

        $response->assertOk();
        $response->assertSee($pageData['heading'], false);
        $response->assertSee($pageData['unique'], false);
        $response->assertSee($pageData['seoTitle'], false);
        $response->assertSee($pageData['canonical'], false);
        $response->assertSee('noindex', false);
        $response->assertSee('nofollow', false);
        if (str_contains($pageData['robots'], 'nosnippet')) {
            $response->assertSee('nosnippet', false);
        }

        $response->assertDontSee('Let’s Talk Business', false);
    }

    public function test_thank_you_page_includes_schedule_call_action(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Thanks You',
            'slug' => 'thank-you',
            'template' => 'thank-you',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/thank-you/');

        $response->assertOk();
        $response->assertSee('Schedule your Call', false);
        $response->assertSee('https://outlook.office365.com/book/IBNBookkeepingServices@cloudibn.com/', false);
        $response->assertSee('personalized Bookkeeping and tax Support', false);
        $response->assertDontSee('Let’s Talk Business', false);
    }

    public function test_draft_thank_you_page_is_not_publicly_accessible(): void
    {
        $this->withoutVite();

        Page::query()->create([
            'title' => 'Thank You Download Draft',
            'slug' => 'thank-you-download-draft',
            'template' => 'thank-you-download',
            'status' => 'draft',
        ]);

        $this->get('/thank-you-download-draft/')->assertNotFound();
    }
}
