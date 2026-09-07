<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Page;
use App\Repositories\CaseStudyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookkeepingServicesCaseStudiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_only_case_studies_assigned_to_finance_and_accounting_category(): void
    {
        Page::query()->create([
            'slug' => 'bookkeeping-services',
            'title' => 'Bookkeeping Services',
            'template' => 'bookkeeping-services',
            'status' => 'published',
        ]);

        $financeCategory = Category::query()->create([
            'name' => 'Finance and Accounting Case Studies',
            'slug' => 'finance-and-accounting-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $otherCategory = Category::query()->create([
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
            'content' => 'Nonprofit CPA firm content',
        ]);

        $otherCategoryStudy = CaseStudy::query()->create([
            'title' => 'Cloud Architecture Transformation',
            'slug' => 'cloud-architecture-transformation',
            'template' => 'default',
            'category_id' => $otherCategory->id,
            'status' => 'published',
            'content' => 'Cloud architecture content',
        ]);

        $draftStudy = CaseStudy::query()->create([
            'title' => 'Draft Finance Case Study',
            'slug' => 'draft-finance-case-study',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'draft',
            'content' => 'Draft content',
        ]);

        $response = $this->get('/bookkeeping-services/');

        $response->assertOk();
        $response->assertSee('Nonprofit-Focused CPA Firm in New York');
        $response->assertSee(route('case-studies.show', $financeStudy->slug));
        $response->assertSee('VIEW CASE STUDY »');

        $response->assertDontSee('Cloud Architecture Transformation');
        $response->assertDontSee('Draft Finance Case Study');
    }

    public function test_case_studies_section_is_omitted_when_no_finance_case_studies_exist(): void
    {
        Page::query()->create([
            'slug' => 'bookkeeping-services',
            'title' => 'Bookkeeping Services',
            'template' => 'bookkeeping-services',
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

        $response = $this->get('/bookkeeping-services/');

        $response->assertOk();
        $response->assertDontSee('Only In Cloud Category');
        $response->assertDontSee('id="bkpsvc-stories-title"', false);
    }

    public function test_displays_at_most_three_latest_published_finance_and_accounting_case_studies(): void
    {
        Page::query()->create([
            'slug' => 'bookkeeping-services',
            'title' => 'Bookkeeping Services',
            'template' => 'bookkeeping-services',
            'status' => 'published',
        ]);

        $financeCategory = Category::query()->create([
            'name' => 'Finance and Accounting Case Studies',
            'slug' => 'finance-and-accounting-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $oldest = CaseStudy::query()->create([
            'title' => 'Finance Case Study One (Oldest)',
            'slug' => 'finance-case-study-one',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Oldest finance content',
        ]);

        $studyTwo = CaseStudy::query()->create([
            'title' => 'Finance Case Study Two',
            'slug' => 'finance-case-study-two',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'content' => 'Finance two content',
        ]);

        $studyThree = CaseStudy::query()->create([
            'title' => 'Finance Case Study Three',
            'slug' => 'finance-case-study-three',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'content' => 'Finance three content',
        ]);

        $latest = CaseStudy::query()->create([
            'title' => 'Finance Case Study Four (Latest)',
            'slug' => 'finance-case-study-four',
            'template' => 'default',
            'category_id' => $financeCategory->id,
            'status' => 'published',
            'published_at' => now()->subHour(),
            'content' => 'Latest finance content',
        ]);

        $response = $this->get('/bookkeeping-services/');

        $response->assertOk();
        $response->assertSee('Finance Case Study Four (Latest)');
        $response->assertSee(route('case-studies.show', $latest->slug));
        $response->assertSee('Finance Case Study Three');
        $response->assertSee(route('case-studies.show', $studyThree->slug));
        $response->assertSee('Finance Case Study Two');
        $response->assertSee(route('case-studies.show', $studyTwo->slug));

        // Limit of 3 must exclude the 4th (oldest)
        $response->assertDontSee('Finance Case Study One (Oldest)');
        $response->assertDontSee(route('case-studies.show', $oldest->slug));
    }

    public function test_bookkeeping_case_studies_eager_loads_relations_without_n_plus_one(): void
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
