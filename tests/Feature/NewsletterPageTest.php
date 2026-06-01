<?php

namespace Tests\Feature;

use App\Models\Newsletter;
use App\Models\SeoMeta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsletterPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_newsletter_page_renders_from_the_newsletters_folder(): void
    {
        $this->withoutVite();

        Newsletter::query()->create([
            'title' => 'Cloud Misconfiguration Insights',
            'slug' => 'cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure',
            'template' => 'cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure',
            'status' => 'published',
        ]);

        $response = $this->get('/newsletter/cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure');

        $response->assertOk();
        $response->assertSee('Cloud Misconfiguration Insights');
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

        $response = $this->get('/newsletter');

        $response->assertOk();
        $response->assertSee('Cloud Misconfiguration Insights');
        $response->assertSee('Newsletter summary for the archive card.');
    }
}
