<?php

namespace Tests\Feature;

use App\Models\Newsletter;
use App\Models\SeoMeta;
use Database\Seeders\NewsletterSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class NewsletterPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return list<string>
     */
    protected function newsletterSlugs(): array
    {
        return [
            'vciso-as-a-service',
            'securing-enterprise-ai-data-protection-prompt-integrity-and-governance-at-scale',
            'cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure',
        ];
    }

    public function test_published_newsletter_page_renders_from_the_newsletters_folder(): void
    {
        $this->withoutVite();

        Newsletter::query()->create([
            'title' => 'Cloud Misconfiguration Insights',
            'slug' => 'cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure',
            'template' => 'cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/newsletter/cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure/');

        $response->assertOk();
        $response->assertSee('Cloud Misconfiguration Insights');
        $this->assertUsesNewsletterChrome($response);
    }

    public function test_securing_enterprise_ai_newsletter_renders_xml_sections(): void
    {
        $this->withoutVite();
        $this->seed(NewsletterSeeder::class);

        $response = $this->followingRedirects()->get('/newsletter/securing-enterprise-ai-data-protection-prompt-integrity-and-governance-at-scale/');

        $response->assertOk();
        $response->assertSee('The Emerging AI Attack Surface');
        $response->assertSee('Prompt Injection &amp; AI Agent Risks', false);
        $response->assertSee('Common Data Exposure Paths in AI Workflows');
        $response->assertSee('Building Secure Enterprise AI Architectures');
        $response->assertSee('Governance, Auditability, and Control');
        $response->assertSee('Key Takeaway');
        $response->assertSee('Start with Us Today!');
        $response->assertSee('Securing-Enterprise-AI.webp', false);
        $response->assertSee('Common-Data-Exposure-Paths-in-AI-Workflows-1024x499.webp', false);
        $response->assertSee('Building-Secure-Enterprise-AI-Architectures-1024x334.webp', false);
        $this->assertUsesNewsletterChrome($response);
    }

    public function test_draft_newsletter_is_not_publicly_accessible(): void
    {
        $this->withoutVite();

        Newsletter::query()->create([
            'title' => 'Draft Newsletter',
            'slug' => 'vciso-as-a-service',
            'template' => 'vciso-as-a-service',
            'status' => 'draft',
        ]);

        $this->get('/newsletter/vciso-as-a-service/')->assertNotFound();
    }

    public function test_newsletter_index_lists_published_newsletters(): void
    {
        $this->withoutVite();

        $newsletter = Newsletter::query()->create([
            'title' => 'Cloud Misconfiguration Insights',
            'slug' => 'cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure',
            'template' => 'cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure',
            'status' => 'published',
        ]);

        SeoMeta::query()->create([
            'metable_type' => Newsletter::class,
            'metable_id' => $newsletter->id,
            'meta_description' => 'Newsletter summary for the archive card.',
        ]);

        $response = $this->followingRedirects()->get('/newsletter/');

        $response->assertOk();
        $response->assertSee('Cloud Misconfiguration Insights');
        $response->assertSee('Newsletter summary for the archive card.');
        $this->assertUsesNewsletterChrome($response);
    }

    public function test_seeded_newsletters_are_publicly_accessible_at_wordpress_urls(): void
    {
        $this->withoutVite();
        $this->seed(NewsletterSeeder::class);

        foreach ($this->newsletterSlugs() as $slug) {
            $newsletter = Newsletter::query()->where('slug', $slug)->first();

            $this->assertNotNull($newsletter);
            $this->assertSame('published', $newsletter->status);
            $this->assertSame($slug, $newsletter->template);

            $response = $this->followingRedirects()->get('/newsletter/'.$slug.'/');

            $response->assertOk();
            $response->assertSee($newsletter->title);
            $this->assertUsesNewsletterChrome($response);
        }

        $this->assertDatabaseHas('newsletters', [
            'slug' => 'vciso-as-a-service',
            'title' => 'vCISO-as-a-Service: Executive Cyber Leadership Without the Full-Time Cost',
        ]);
        $this->assertDatabaseHas('seo_meta', [
            'metable_type' => Newsletter::class,
            'canonical_url' => 'https://www.ibntech.com/newsletter/vciso-as-a-service/',
        ]);
    }

    protected function assertUsesNewsletterChrome(TestResponse $response): void
    {
        $response->assertSee('site-ibn-header', false);
        $response->assertSee('newsletter-footer', false);
        $response->assertSee('Experience. Compliance. Partnership.');
        $response->assertSee('Microsoft Partner');
        $response->assertSee('AWS Partner');
        $response->assertSee('Cookies Policy');
        $response->assertDontSee('site-footer__grid', false);
        $response->assertDontSee('lp-footer', false);
    }
}
