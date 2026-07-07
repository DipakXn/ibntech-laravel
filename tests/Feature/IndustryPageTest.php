<?php

namespace Tests\Feature;

use App\Models\Industry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndustryPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_industry_page_renders_from_the_industries_folder(): void
    {
        $this->withoutVite();

        Industry::query()->create([
            'title' => 'Real Estate and Construction',
            'slug' => 'real-estate-and-construction',
            'template' => 'real-estate-and-construction',
            'status' => 'published',
        ]);

        $response = $this->followingRedirects()->get('/industry/real-estate-and-construction/');

        $response->assertOk();
        $response->assertSee('Real Estate and Construction');
    }

    public function test_draft_industry_page_is_not_publicly_accessible(): void
    {
        $this->withoutVite();

        Industry::query()->create([
            'title' => 'Draft Industry',
            'slug' => 'draft-industry',
            'template' => 'real-estate-and-construction',
            'status' => 'draft',
        ]);

        $this->get('/industry/draft-industry/')->assertNotFound();
    }
}
