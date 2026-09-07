<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Page;
use App\Repositories\CaseStudyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ElectronicFundsTransferCaseStudiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_only_case_studies_assigned_to_finance_and_accounting_category(): void
    {
        Page::query()->create([
            'slug' => 'electronic-funds-transfer',
            'title' => 'Electronic Funds Transfer',
            'template' => 'electronic-funds-transfer',
            'status' => 'published',
        ]);

        $financeCategory = Category::query()->create([
            'name' => 'Finance and Accounting Case Studies',
            'slug' => 'finance-and-accounting-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $cloudCategory = Category::query()->create([
            'name' => 'Cloud Case Studies',
            'slug' => 'cloud-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $financeStudy = CaseStudy::query()->create([
            'title' => 'Nonprofit-Focused CPA Firm in New York',
            'slug' => 'nonprofit-focused-cpa-firm-in-new-york',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'content' => 'Finance content',
        ]);

        $cloudStudy = CaseStudy::query()->create([
            'title' => 'Cloud Optimization with AWS RDS',
            'slug' => 'cloud-optimization-with-aws-rds',
            'template' => 'default',
            'category_id' => $cloudCategory->id,
            'status' => 'published',
            'content' => 'Cloud content',
        ]);

        $draftFinanceStudy = CaseStudy::query()->create([
            'title' => 'Draft Finance Study Title',
            'slug' => 'draft-finance-study-title',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'draft',
            'content' => 'Draft content',
        ]);

        $response = $this->get('/electronic-funds-transfer/');

        $response->assertOk();
        $response->assertSee('Nonprofit-Focused CPA Firm in New York');
        $response->assertSee(route('case-studies.show', $financeStudy->slug));
        $response->assertSee('Know More');
        $response->assertSee('View All');

        $response->assertDontSee('Cloud Optimization with AWS RDS');
        $response->assertDontSee('Draft Finance Study Title');
    }

    public function test_displays_at_most_three_latest_published_finance_case_studies(): void
    {
        Page::query()->create([
            'slug' => 'electronic-funds-transfer',
            'title' => 'Electronic Funds Transfer',
            'template' => 'electronic-funds-transfer',
            'status' => 'published',
        ]);

        $financeCategory = Category::query()->create([
            'name' => 'Finance and Accounting Case Studies',
            'slug' => 'finance-and-accounting-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $oldest = CaseStudy::query()->create([
            'title' => 'Finance Study One (Oldest)',
            'slug' => 'finance-study-one-oldest',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Oldest content',
        ]);

        $studyTwo = CaseStudy::query()->create([
            'title' => 'Finance Study Two',
            'slug' => 'finance-study-two',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'content' => 'Content two',
        ]);

        $studyThree = CaseStudy::query()->create([
            'title' => 'Finance Study Three',
            'slug' => 'finance-study-three',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'content' => 'Content three',
        ]);

        $latest = CaseStudy::query()->create([
            'title' => 'Finance Study Four (Latest)',
            'slug' => 'finance-study-four-latest',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'published_at' => now()->subHour(),
            'content' => 'Latest content',
        ]);

        $response = $this->get('/electronic-funds-transfer/');

        $response->assertOk();
        $response->assertSee('Finance Study Four (Latest)');
        $response->assertSee(route('case-studies.show', $latest->slug));
        $response->assertSee('Finance Study Three');
        $response->assertSee(route('case-studies.show', $studyThree->slug));
        $response->assertSee('Finance Study Two');
        $response->assertSee(route('case-studies.show', $studyTwo->slug));

        // Limit 3 must exclude the 4th (oldest)
        $response->assertDontSee('Finance Study One (Oldest)');
        $response->assertDontSee(route('case-studies.show', $oldest->slug));
    }

    public function test_case_studies_section_is_omitted_when_no_finance_case_studies_exist(): void
    {
        Page::query()->create([
            'slug' => 'electronic-funds-transfer',
            'title' => 'Electronic Funds Transfer',
            'template' => 'electronic-funds-transfer',
            'status' => 'published',
        ]);

        $otherCategory = Category::query()->create([
            'name' => 'Cloud Case Studies',
            'slug' => 'cloud-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        CaseStudy::query()->create([
            'title' => 'Only In Cloud Category',
            'slug' => 'only-in-cloud-category',
            'template' => 'default',
            'category_id' => $otherCategory->id,
            'status' => 'published',
            'content' => 'Only in cloud content',
        ]);

        $response = $this->get('/electronic-funds-transfer/');

        $response->assertOk();
        $response->assertDontSee('Only In Cloud Category');
        $response->assertDontSee('id="eft-cases-title"', false);
    }

    public function test_eft_case_studies_eager_loads_relations_without_n_plus_one(): void
    {
        $financeCategory = Category::query()->create([
            'name' => 'Finance and Accounting Case Studies',
            'slug' => 'finance-and-accounting-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        CaseStudy::query()->create([
            'title' => 'Finance Study A',
            'slug' => 'finance-study-a',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'content' => 'A content',
        ]);

        CaseStudy::query()->create([
            'title' => 'Finance Study B',
            'slug' => 'finance-study-b',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'content' => 'B content',
        ]);

        $repository = app(CaseStudyRepository::class);
        $studies = $repository->getPublishedByCategorySlug('finance-and-accounting-case-studies', limit: 3);

        $this->assertCount(2, $studies);
        foreach ($studies as $study) {
            $this->assertTrue($study->relationLoaded('media'), 'media relation must be eager-loaded');
            $this->assertTrue($study->relationLoaded('category'), 'category relation must be eager-loaded');
        }
    }
}
