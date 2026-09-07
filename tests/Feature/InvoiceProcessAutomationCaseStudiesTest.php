<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Page;
use App\Repositories\CaseStudyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceProcessAutomationCaseStudiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_case_studies_across_all_categories(): void
    {
        Page::query()->create([
            'slug' => 'invoice-process-automation',
            'title' => 'Invoice Process Automation',
            'template' => 'invoice-process-automation',
            'status' => 'published',
        ]);

        $awsCategory = Category::query()->create([
            'name' => 'AWS',
            'slug' => 'aws',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $cloudCategory = Category::query()->create([
            'name' => 'Cloud Case Studies',
            'slug' => 'cloud-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $awsStudy = CaseStudy::query()->create([
            'title' => 'AWS Cloud Optimization with RDS',
            'slug' => 'aws-cloud-optimization-with-rds',
            'template' => 'default',
            'category_id' => $awsCategory->id,
            'status' => 'published',
            'content' => 'AWS content',
        ]);

        $cloudStudy = CaseStudy::query()->create([
            'title' => 'Secure Financial Data Exchange on Azure',
            'slug' => 'secure-financial-data-exchange-on-azure',
            'template' => 'default',
            'category_id' => $cloudCategory->id,
            'status' => 'published',
            'content' => 'Cloud content',
        ]);

        $draftStudy = CaseStudy::query()->create([
            'title' => 'Draft Case Study Title',
            'slug' => 'draft-case-study-title',
            'template' => 'default',
            'category_id' => $awsCategory->id,
            'status' => 'draft',
            'content' => 'Draft content',
        ]);

        $response = $this->get('/invoice-process-automation/');

        $response->assertOk();
        $response->assertSee('AWS Cloud Optimization with RDS');
        $response->assertSee(route('case-studies.show', $awsStudy->slug));
        $response->assertSee('Secure Financial Data Exchange on Azure');
        $response->assertSee(route('case-studies.show', $cloudStudy->slug));
        $response->assertSee('Read More &raquo;', false);
        $response->assertSee('View All');

        $response->assertDontSee('Draft Case Study Title');
    }

    public function test_displays_at_most_three_latest_published_case_studies(): void
    {
        Page::query()->create([
            'slug' => 'invoice-process-automation',
            'title' => 'Invoice Process Automation',
            'template' => 'invoice-process-automation',
            'status' => 'published',
        ]);

        $category = Category::query()->create([
            'name' => 'General Case Studies',
            'slug' => 'general-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $oldest = CaseStudy::query()->create([
            'title' => 'Case Study One (Oldest)',
            'slug' => 'case-study-one-oldest',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Oldest content',
        ]);

        $studyTwo = CaseStudy::query()->create([
            'title' => 'Case Study Two',
            'slug' => 'case-study-two',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'content' => 'Content two',
        ]);

        $studyThree = CaseStudy::query()->create([
            'title' => 'Case Study Three',
            'slug' => 'case-study-three',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'content' => 'Content three',
        ]);

        $latest = CaseStudy::query()->create([
            'title' => 'Case Study Four (Latest)',
            'slug' => 'case-study-four-latest',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subHour(),
            'content' => 'Latest content',
        ]);

        $response = $this->get('/invoice-process-automation/');

        $response->assertOk();
        $response->assertSee('Case Study Four (Latest)');
        $response->assertSee(route('case-studies.show', $latest->slug));
        $response->assertSee('Case Study Three');
        $response->assertSee(route('case-studies.show', $studyThree->slug));
        $response->assertSee('Case Study Two');
        $response->assertSee(route('case-studies.show', $studyTwo->slug));

        // Limit 3 must exclude the 4th (oldest)
        $response->assertDontSee('Case Study One (Oldest)');
        $response->assertDontSee(route('case-studies.show', $oldest->slug));
    }

    public function test_case_studies_section_is_omitted_when_no_case_studies_exist(): void
    {
        Page::query()->create([
            'slug' => 'invoice-process-automation',
            'title' => 'Invoice Process Automation',
            'template' => 'invoice-process-automation',
            'status' => 'published',
        ]);

        $response = $this->get('/invoice-process-automation/');

        $response->assertOk();
        $response->assertDontSee('id="inva-cases-title"', false);
    }

    public function test_inva_case_studies_eager_loads_relations_without_n_plus_one(): void
    {
        $category = Category::query()->create([
            'name' => 'General Case Studies',
            'slug' => 'general-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        CaseStudy::query()->create([
            'title' => 'Study A',
            'slug' => 'study-a',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'content' => 'A content',
        ]);

        CaseStudy::query()->create([
            'title' => 'Study B',
            'slug' => 'study-b',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'content' => 'B content',
        ]);

        $repository = app(CaseStudyRepository::class);
        $studies = $repository->getPublishedByCategorySlug(null, limit: 3);

        $this->assertCount(2, $studies);
        foreach ($studies as $study) {
            $this->assertTrue($study->relationLoaded('media'), 'media relation must be eager-loaded');
            $this->assertTrue($study->relationLoaded('category'), 'category relation must be eager-loaded');
        }
    }
}
