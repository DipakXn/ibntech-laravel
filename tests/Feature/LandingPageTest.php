<?php

namespace Tests\Feature;

use App\Models\LandingPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_landing_page_renders_from_the_landing_pages_folder(): void
    {
        $this->withoutVite();

        LandingPage::query()->create([
            'title' => 'VAPT Audit Services',
            'slug' => 'vapt-audit-services',
            'template' => 'vapt-audit-services',
            'status' => 'published',
        ]);

        $response = $this->get('/lp/vapt-audit-services');

        $response->assertOk();
        $response->assertSee('VAPT Audit Services');
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

        $this->get('/lp/draft-landing-page')->assertNotFound();
    }
}
