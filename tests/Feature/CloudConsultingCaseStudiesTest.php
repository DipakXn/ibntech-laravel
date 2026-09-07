<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Page;
use App\Repositories\CaseStudyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CloudConsultingCaseStudiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_case_studies_assigned_to_cloud_category_and_child_aws_category(): void
    {
        Page::query()->create([
            'slug' => 'cloud-consulting-and-migration-services',
            'title' => 'Cloud Consulting Services',
            'template' => 'cloud-consulting-and-migration-services',
            'status' => 'published',
        ]);

        $parentCloudCategory = Category::query()->create([
            'name' => 'Cloud Case Studies',
            'slug' => 'cloud-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $awsChildCategory = Category::query()->create([
            'name' => 'AWS',
            'slug' => 'aws',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => $parentCloudCategory->id,
        ]);

        $cyberCategory = Category::query()->create([
            'name' => 'Cyber Security Case Studies',
            'slug' => 'cyber-security-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $cloudStudy = CaseStudy::query()->create([
            'title' => 'Secure Financial Data Exchange on Azure',
            'slug' => 'secure-financial-data-exchange-on-azure',
            'template' => 'default',
            'category_id' => $parentCloudCategory->id,
            'status' => 'published',
            'content' => 'Cloud content',
        ]);

        $awsStudy = CaseStudy::query()->create([
            'title' => 'AWS Database Modernization with RDS',
            'slug' => 'aws-database-modernization-with-rds',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'published',
            'content' => 'AWS content',
        ]);

        $cyberStudy = CaseStudy::query()->create([
            'title' => 'Cyber Security Ransomware Defense',
            'slug' => 'cyber-security-ransomware-defense',
            'template' => 'default',
            'category_id' => $cyberCategory->id,
            'status' => 'published',
            'content' => 'Cyber content',
        ]);

        $draftStudy = CaseStudy::query()->create([
            'title' => 'Draft Cloud Case Study',
            'slug' => 'draft-cloud-case-study',
            'template' => 'default',
            'category_id' => $parentCloudCategory->id,
            'status' => 'draft',
            'content' => 'Draft content',
        ]);

        $response = $this->get('/cloud-consulting-and-migration-services/');

        $response->assertOk();
        $response->assertSee('Secure Financial Data Exchange on Azure');
        $response->assertSee(route('case-studies.show', $cloudStudy->slug));
        $response->assertSee('AWS Database Modernization with RDS');
        $response->assertSee(route('case-studies.show', $awsStudy->slug));
        $response->assertSee('View Case Study »');
        $response->assertSee('Open More Case Studies →');

        $response->assertDontSee('Cyber Security Ransomware Defense');
        $response->assertDontSee('Draft Cloud Case Study');
    }

    public function test_displays_at_most_three_latest_published_cloud_and_child_case_studies(): void
    {
        Page::query()->create([
            'slug' => 'cloud-consulting-and-migration-services',
            'title' => 'Cloud Consulting Services',
            'template' => 'cloud-consulting-and-migration-services',
            'status' => 'published',
        ]);

        $parentCloudCategory = Category::query()->create([
            'name' => 'Cloud Case Studies',
            'slug' => 'cloud-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $awsChildCategory = Category::query()->create([
            'name' => 'AWS',
            'slug' => 'aws',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => $parentCloudCategory->id,
        ]);

        $oldest = CaseStudy::query()->create([
            'title' => 'Study One (Oldest Cloud Study)',
            'slug' => 'study-one-oldest-cloud-study',
            'template' => 'default',
            'category_id' => $parentCloudCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'content' => 'Oldest content',
        ]);

        $studyTwo = CaseStudy::query()->create([
            'title' => 'Study Two (AWS Child Study)',
            'slug' => 'study-two-aws-child-study',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'content' => 'Study two content',
        ]);

        $studyThree = CaseStudy::query()->create([
            'title' => 'Study Three (Parent Cloud Study)',
            'slug' => 'study-three-parent-cloud-study',
            'template' => 'default',
            'category_id' => $parentCloudCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'content' => 'Study three content',
        ]);

        $latest = CaseStudy::query()->create([
            'title' => 'Study Four (Latest AWS Child Study)',
            'slug' => 'study-four-latest-aws-child-study',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'published',
            'published_at' => now()->subHour(),
            'content' => 'Latest content',
        ]);

        $response = $this->get('/cloud-consulting-and-migration-services/');

        $response->assertOk();
        $response->assertSee('Study Four (Latest AWS Child Study)');
        $response->assertSee(route('case-studies.show', $latest->slug));
        $response->assertSee('Study Three (Parent Cloud Study)');
        $response->assertSee(route('case-studies.show', $studyThree->slug));
        $response->assertSee('Study Two (AWS Child Study)');
        $response->assertSee(route('case-studies.show', $studyTwo->slug));

        // Limit 3 must exclude the 4th (oldest)
        $response->assertDontSee('Study One (Oldest Cloud Study)');
        $response->assertDontSee(route('case-studies.show', $oldest->slug));
    }

    public function test_case_studies_section_is_omitted_when_no_cloud_case_studies_exist(): void
    {
        Page::query()->create([
            'slug' => 'cloud-consulting-and-migration-services',
            'title' => 'Cloud Consulting Services',
            'template' => 'cloud-consulting-and-migration-services',
            'status' => 'published',
        ]);

        $otherCategory = Category::query()->create([
            'name' => 'Cyber Security Case Studies',
            'slug' => 'cyber-security-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        CaseStudy::query()->create([
            'title' => 'Cyber Security Study Only',
            'slug' => 'cyber-security-study-only',
            'template' => 'default',
            'category_id' => $otherCategory->id,
            'status' => 'published',
            'content' => 'Cyber only content',
        ]);

        $response = $this->get('/cloud-consulting-and-migration-services/');

        $response->assertOk();
        $response->assertDontSee('Cyber Security Study Only');
        $response->assertDontSee('id="ccms-cases-title"', false);
    }

    public function test_cloud_case_studies_eager_loads_relations_without_n_plus_one(): void
    {
        $parentCloudCategory = Category::query()->create([
            'name' => 'Cloud Case Studies',
            'slug' => 'cloud-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $awsChildCategory = Category::query()->create([
            'name' => 'AWS',
            'slug' => 'aws',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => $parentCloudCategory->id,
        ]);

        CaseStudy::query()->create([
            'title' => 'Cloud Study A',
            'slug' => 'cloud-study-a',
            'template' => 'default',
            'category_id' => $parentCloudCategory->id,
            'status' => 'published',
            'content' => 'A content',
        ]);

        CaseStudy::query()->create([
            'title' => 'AWS Study B',
            'slug' => 'aws-study-b',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'published',
            'content' => 'B content',
        ]);

        $repository = app(CaseStudyRepository::class);
        $studies = $repository->getPublishedByCategorySlug('cloud-case-studies', limit: 3, includeChildren: true);

        $this->assertCount(2, $studies);
        foreach ($studies as $study) {
            $this->assertTrue($study->relationLoaded('media'), 'media relation must be eager-loaded');
            $this->assertTrue($study->relationLoaded('category'), 'category relation must be eager-loaded');
        }
    }
}
