<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Page;
use App\Repositories\CaseStudyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VaptServicesCaseStudiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_only_case_studies_assigned_to_cyber_security_category(): void
    {
        Page::query()->create([
            'slug' => 'vapt-services',
            'title' => 'Vulnerability Assessment and Penetration Testing (VAPT) Services',
            'template' => 'vapt-services',
            'status' => 'published',
        ]);

        $cyberCategory = Category::query()->create([
            'name' => 'Cyber Security Case Studies',
            'slug' => 'cyber-security-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $otherCategory = Category::query()->create([
            'name' => 'Finance and Accounting Case Studies',
            'slug' => 'finance-and-accounting-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $cyberStudy = CaseStudy::query()->create([
            'title' => 'A Pioneer In Medical Practice Solutions Achieves HIPAA Compliance And Enhanced Security With VAPT',
            'slug' => 'a-pioneer-in-medical-practice-solutions-achieves-hipaa-compliance-and-enhanced-security-with-vapt',
            'template' => 'default',
            'category_id' => $cyberCategory->id,
            'status' => 'published',
            'content' => 'Cyber security study content',
        ]);

        $otherCategoryStudy = CaseStudy::query()->create([
            'title' => 'Nonprofit-Focused CPA Firm in New York',
            'slug' => 'nonprofit-focused-cpa-firm-in-new-york',
            'template' => 'default',
            'category_id' => $otherCategory->id,
            'status' => 'published',
            'content' => 'Finance study content',
        ]);

        $draftStudy = CaseStudy::query()->create([
            'title' => 'Draft Cyber Security Case Study',
            'slug' => 'draft-cyber-security-case-study',
            'template' => 'default',
            'category_id' => $cyberCategory->id,
            'status' => 'draft',
            'content' => 'Draft content',
        ]);

        $response = $this->get('/vapt-services/');

        $response->assertOk();
        $response->assertSee('A Pioneer In Medical Practice Solutions Achieves HIPAA Compliance And Enhanced Security With VAPT');
        $response->assertSee(route('case-studies.show', $cyberStudy->slug));

        $response->assertDontSee('Nonprofit-Focused CPA Firm in New York');
        $response->assertDontSee('Draft Cyber Security Case Study');
    }

    public function test_displays_at_most_three_latest_published_cyber_security_case_studies(): void
    {
        Page::query()->create([
            'slug' => 'vapt-services',
            'title' => 'Vulnerability Assessment and Penetration Testing (VAPT) Services',
            'template' => 'vapt-services',
            'status' => 'published',
        ]);

        $cyberCategory = Category::query()->create([
            'name' => 'Cyber Security Case Studies',
            'slug' => 'cyber-security-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $oldest = CaseStudy::query()->create([
            'title' => 'Cyber Security Case Study One (Oldest)',
            'slug' => 'cyber-security-case-study-one-oldest',
            'template' => 'default',
            'category_id' => $cyberCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Oldest cyber content',
        ]);

        $studyTwo = CaseStudy::query()->create([
            'title' => 'Cyber Security Case Study Two',
            'slug' => 'cyber-security-case-study-two',
            'template' => 'default',
            'category_id' => $cyberCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'content' => 'Cyber two content',
        ]);

        $studyThree = CaseStudy::query()->create([
            'title' => 'Cyber Security Case Study Three',
            'slug' => 'cyber-security-case-study-three',
            'template' => 'default',
            'category_id' => $cyberCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'content' => 'Cyber three content',
        ]);

        $latest = CaseStudy::query()->create([
            'title' => 'Cyber Security Case Study Four (Latest)',
            'slug' => 'cyber-security-case-study-four-latest',
            'template' => 'default',
            'category_id' => $cyberCategory->id,
            'status' => 'published',
            'published_at' => now()->subHour(),
            'content' => 'Latest cyber content',
        ]);

        $response = $this->get('/vapt-services/');

        $response->assertOk();
        $response->assertSee('Cyber Security Case Study Four (Latest)');
        $response->assertSee(route('case-studies.show', $latest->slug));
        $response->assertSee('Cyber Security Case Study Three');
        $response->assertSee(route('case-studies.show', $studyThree->slug));
        $response->assertSee('Cyber Security Case Study Two');
        $response->assertSee(route('case-studies.show', $studyTwo->slug));

        // Limit of 3 must exclude the 4th (oldest)
        $response->assertDontSee('Cyber Security Case Study One (Oldest)');
        $response->assertDontSee(route('case-studies.show', $oldest->slug));
    }

    public function test_case_studies_section_is_omitted_when_no_cyber_security_case_studies_exist(): void
    {
        Page::query()->create([
            'slug' => 'vapt-services',
            'title' => 'Vulnerability Assessment and Penetration Testing (VAPT) Services',
            'template' => 'vapt-services',
            'status' => 'published',
        ]);

        $otherCategory = Category::query()->create([
            'name' => 'Finance and Accounting Case Studies',
            'slug' => 'finance-and-accounting-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        CaseStudy::query()->create([
            'title' => 'Only In Finance Category',
            'slug' => 'only-in-finance-category',
            'template' => 'default',
            'category_id' => $otherCategory->id,
            'status' => 'published',
            'content' => 'Only in finance content',
        ]);

        $response = $this->get('/vapt-services/');

        $response->assertOk();
        $response->assertDontSee('Only In Finance Category');
        $response->assertDontSee('id="vapt-cases-title"', false);
    }

    public function test_vapt_case_studies_eager_loads_relations_without_n_plus_one(): void
    {
        $cyberCategory = Category::query()->create([
            'name' => 'Cyber Security Case Studies',
            'slug' => 'cyber-security-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        CaseStudy::query()->create([
            'title' => 'Cyber Study A',
            'slug' => 'cyber-study-a',
            'template' => 'default',
            'category_id' => $cyberCategory->id,
            'status' => 'published',
            'content' => 'A content',
        ]);

        CaseStudy::query()->create([
            'title' => 'Cyber Study B',
            'slug' => 'cyber-study-b',
            'template' => 'default',
            'category_id' => $cyberCategory->id,
            'status' => 'published',
            'content' => 'B content',
        ]);

        $repository = app(CaseStudyRepository::class);
        $studies = $repository->getPublishedByCategorySlug('cyber-security-case-studies', limit: 3);

        $this->assertCount(2, $studies);
        foreach ($studies as $study) {
            $this->assertTrue($study->relationLoaded('media'), 'media relation must be eager-loaded');
            $this->assertTrue($study->relationLoaded('category'), 'category relation must be eager-loaded');
        }
    }
}
