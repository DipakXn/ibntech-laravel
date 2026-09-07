<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Page;
use App\Repositories\CaseStudyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalesOrderProcessingCaseStudiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_case_studies_across_all_categories(): void
    {
        Page::query()->create([
            'slug' => 'sales-order-processing',
            'title' => 'Sales Order Processing',
            'template' => 'sales-order-processing',
            'status' => 'published',
        ]);

        $awsCategory = Category::query()->create([
            'name' => 'AWS',
            'slug' => 'aws',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $financeCategory = Category::query()->create([
            'name' => 'Finance and Accounting Case Studies',
            'slug' => 'finance-and-accounting-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $awsStudy = CaseStudy::query()->create([
            'title' => 'Cloud Optimization & Database Modernization with AWS RDS',
            'slug' => 'cloud-optimization-database-modernization-with-aws-rds',
            'template' => 'default',
            'category_id' => $awsCategory->id,
            'status' => 'published',
            'content' => 'AWS content',
        ]);

        $financeStudy = CaseStudy::query()->create([
            'title' => 'Nonprofit-Focused CPA Firm in New York',
            'slug' => 'nonprofit-focused-cpa-firm-in-new-york',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'content' => 'Finance content',
        ]);

        $draftStudy = CaseStudy::query()->create([
            'title' => 'Draft Case Study Title',
            'slug' => 'draft-case-study-title',
            'template' => 'default',
            'category_id' => $awsCategory->id,
            'status' => 'draft',
            'content' => 'Draft content',
        ]);

        $response = $this->get('/sales-order-processing/');

        $response->assertOk();
        $response->assertSee('Cloud Optimization &amp; Database Modernization with AWS RDS', false);
        $response->assertSee(route('case-studies.show', $awsStudy->slug));
        $response->assertSee('Nonprofit-Focused CPA Firm in New York');
        $response->assertSee(route('case-studies.show', $financeStudy->slug));
        $response->assertSee('Read More &raquo;', false);
        $response->assertSee('Learn More');

        $response->assertDontSee('Draft Case Study Title');
    }

    public function test_displays_at_most_three_latest_published_case_studies(): void
    {
        Page::query()->create([
            'slug' => 'sales-order-processing',
            'title' => 'Sales Order Processing',
            'template' => 'sales-order-processing',
            'status' => 'published',
        ]);

        $category = Category::query()->create([
            'name' => 'General Case Studies',
            'slug' => 'general-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $oldest = CaseStudy::query()->create([
            'title' => 'Sales Order Case Study One (Oldest)',
            'slug' => 'sales-order-case-study-one-oldest',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Oldest content',
        ]);

        $studyTwo = CaseStudy::query()->create([
            'title' => 'Sales Order Case Study Two',
            'slug' => 'sales-order-case-study-two',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'content' => 'Content two',
        ]);

        $studyThree = CaseStudy::query()->create([
            'title' => 'Sales Order Case Study Three',
            'slug' => 'sales-order-case-study-three',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'content' => 'Content three',
        ]);

        $latest = CaseStudy::query()->create([
            'title' => 'Sales Order Case Study Four (Latest)',
            'slug' => 'sales-order-case-study-four-latest',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subHour(),
            'content' => 'Latest content',
        ]);

        $response = $this->get('/sales-order-processing/');

        $response->assertOk();
        $response->assertSee('Sales Order Case Study Four (Latest)');
        $response->assertSee(route('case-studies.show', $latest->slug));
        $response->assertSee('Sales Order Case Study Three');
        $response->assertSee(route('case-studies.show', $studyThree->slug));
        $response->assertSee('Sales Order Case Study Two');
        $response->assertSee(route('case-studies.show', $studyTwo->slug));

        // Limit 3 must exclude the 4th (oldest)
        $response->assertDontSee('Sales Order Case Study One (Oldest)');
        $response->assertDontSee(route('case-studies.show', $oldest->slug));
    }

    public function test_case_studies_section_is_omitted_when_no_case_studies_exist(): void
    {
        Page::query()->create([
            'slug' => 'sales-order-processing',
            'title' => 'Sales Order Processing',
            'template' => 'sales-order-processing',
            'status' => 'published',
        ]);

        $response = $this->get('/sales-order-processing/');

        $response->assertOk();
        $response->assertDontSee('id="sop-cases-title"', false);
    }

    public function test_sop_case_studies_eager_loads_relations_without_n_plus_one(): void
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
