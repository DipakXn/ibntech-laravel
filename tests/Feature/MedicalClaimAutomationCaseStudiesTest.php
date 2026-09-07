<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Page;
use App\Repositories\CaseStudyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicalClaimAutomationCaseStudiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_case_studies_across_all_categories(): void
    {
        Page::query()->create([
            'slug' => 'medical-claim-automation',
            'title' => 'Medical Claim Automation',
            'template' => 'medical-claim-automation',
            'status' => 'published',
        ]);

        $healthcareCategory = Category::query()->create([
            'name' => 'Healthcare Case Studies',
            'slug' => 'healthcare-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $securityCategory = Category::query()->create([
            'name' => 'Cyber Security Case Studies',
            'slug' => 'cyber-security-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $healthcareStudy = CaseStudy::query()->create([
            'title' => 'Boost Medical Claims Processing Efficiency',
            'slug' => 'boost-medical-claims-processing-efficiency',
            'template' => 'default',
            'category_id' => $healthcareCategory->id,
            'status' => 'published',
            'content' => 'Healthcare content',
        ]);

        $securityStudy = CaseStudy::query()->create([
            'title' => 'Medical Practice Solutions Achieves HIPAA Compliance With VAPT',
            'slug' => 'medical-practice-solutions-achieves-hipaa-compliance-with-vapt',
            'template' => 'default',
            'category_id' => $securityCategory->id,
            'status' => 'published',
            'content' => 'Security content',
        ]);

        $draftStudy = CaseStudy::query()->create([
            'title' => 'Draft Healthcare Study',
            'slug' => 'draft-healthcare-study',
            'template' => 'default',
            'category_id' => $healthcareCategory->id,
            'status' => 'draft',
            'content' => 'Draft content',
        ]);

        $response = $this->get('/medical-claim-automation/');

        $response->assertOk();
        $response->assertSee('Boost Medical Claims Processing Efficiency');
        $response->assertSee(route('case-studies.show', $healthcareStudy->slug));
        $response->assertSee('Medical Practice Solutions Achieves HIPAA Compliance With VAPT');
        $response->assertSee(route('case-studies.show', $securityStudy->slug));
        $response->assertSee('Read More');
        $response->assertSee('View All');

        $response->assertDontSee('Draft Healthcare Study');
    }

    public function test_displays_at_most_three_latest_published_case_studies(): void
    {
        Page::query()->create([
            'slug' => 'medical-claim-automation',
            'title' => 'Medical Claim Automation',
            'template' => 'medical-claim-automation',
            'status' => 'published',
        ]);

        $category = Category::query()->create([
            'name' => 'General Case Studies',
            'slug' => 'general-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $oldest = CaseStudy::query()->create([
            'title' => 'Medical Case Study One (Oldest)',
            'slug' => 'medical-case-study-one-oldest',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Oldest content',
        ]);

        $studyTwo = CaseStudy::query()->create([
            'title' => 'Medical Case Study Two',
            'slug' => 'medical-case-study-two',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'content' => 'Content two',
        ]);

        $studyThree = CaseStudy::query()->create([
            'title' => 'Medical Case Study Three',
            'slug' => 'medical-case-study-three',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'content' => 'Content three',
        ]);

        $latest = CaseStudy::query()->create([
            'title' => 'Medical Case Study Four (Latest)',
            'slug' => 'medical-case-study-four-latest',
            'template' => 'default',
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => now()->subHour(),
            'content' => 'Latest content',
        ]);

        $response = $this->get('/medical-claim-automation/');

        $response->assertOk();
        $response->assertSee('Medical Case Study Four (Latest)');
        $response->assertSee(route('case-studies.show', $latest->slug));
        $response->assertSee('Medical Case Study Three');
        $response->assertSee(route('case-studies.show', $studyThree->slug));
        $response->assertSee('Medical Case Study Two');
        $response->assertSee(route('case-studies.show', $studyTwo->slug));

        // Limit 3 must exclude the 4th (oldest)
        $response->assertDontSee('Medical Case Study One (Oldest)');
        $response->assertDontSee(route('case-studies.show', $oldest->slug));
    }

    public function test_case_studies_section_is_omitted_when_no_case_studies_exist(): void
    {
        Page::query()->create([
            'slug' => 'medical-claim-automation',
            'title' => 'Medical Claim Automation',
            'template' => 'medical-claim-automation',
            'status' => 'published',
        ]);

        $response = $this->get('/medical-claim-automation/');

        $response->assertOk();
        $response->assertDontSee('id="mca-cases-title"', false);
    }

    public function test_mca_case_studies_eager_loads_relations_without_n_plus_one(): void
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
