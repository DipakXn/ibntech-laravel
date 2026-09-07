<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Page;
use App\Repositories\CaseStudyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AwsPartnerCaseStudiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_only_case_studies_assigned_to_aws_child_category_and_not_parent(): void
    {
        Page::query()->create([
            'slug' => 'aws-partner',
            'title' => 'AWS Cloud Services',
            'template' => 'aws-partner',
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

        $otherCategory = Category::query()->create([
            'name' => 'Cyber Security Case Studies',
            'slug' => 'cyber-security-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        $awsStudy = CaseStudy::query()->create([
            'title' => 'Cloud Optimization & Database Modernization with AWS RDS',
            'slug' => 'cloud-optimization-database-modernization-with-aws-rds',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'published',
            'content' => 'AWS case study content',
            'featured_image' => 'images/aws-partner/cloud-optimization-and-database-modernization.png',
        ]);

        $parentCloudStudy = CaseStudy::query()->create([
            'title' => 'Parent Cloud Case Study Title',
            'slug' => 'parent-cloud-case-study',
            'template' => 'default',
            'category_id' => $parentCloudCategory->id,
            'status' => 'published',
            'content' => 'Parent cloud content',
        ]);

        $otherCategoryStudy = CaseStudy::query()->create([
            'title' => 'Cyber Security Case Study Title',
            'slug' => 'cyber-security-case-study',
            'template' => 'default',
            'category_id' => $otherCategory->id,
            'status' => 'published',
            'content' => 'Other content',
        ]);

        $draftAwsStudy = CaseStudy::query()->create([
            'title' => 'Unpublished AWS Draft Study',
            'slug' => 'unpublished-aws-draft-study',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'draft',
            'content' => 'Draft content',
        ]);

        $response = $this->get('/aws-partner/');

        $response->assertOk();
        $response->assertSee('Cloud Optimization &amp; Database Modernization with AWS RDS', false);
        $response->assertSee(route('case-studies.show', $awsStudy->slug));
        $response->assertSee('View Case Study »');
        $response->assertSee('Open More Case Studies →');

        $response->assertDontSee('Parent Cloud Case Study Title');
        $response->assertDontSee('Cyber Security Case Study Title');
        $response->assertDontSee('Unpublished AWS Draft Study');
    }

    public function test_case_studies_section_is_omitted_when_no_aws_case_studies_exist(): void
    {
        Page::query()->create([
            'slug' => 'aws-partner',
            'title' => 'AWS Cloud Services',
            'template' => 'aws-partner',
            'status' => 'published',
        ]);

        $parentCloudCategory = Category::query()->create([
            'name' => 'Cloud Case Studies',
            'slug' => 'cloud-case-studies',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        Category::query()->create([
            'name' => 'AWS',
            'slug' => 'aws',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => $parentCloudCategory->id,
        ]);

        // Case study in parent category should NOT cause the section to show
        CaseStudy::query()->create([
            'title' => 'Only In Parent Category',
            'slug' => 'only-in-parent-category',
            'template' => 'default',
            'category_id' => $parentCloudCategory->id,
            'status' => 'published',
            'content' => 'Parent only content',
        ]);

        $response = $this->get('/aws-partner/');

        $response->assertOk();
        $response->assertDontSee('Only In Parent Category');
        $response->assertDontSee('id="awsp-cases-title"', false);
    }

    public function test_displays_at_most_two_latest_published_aws_child_case_studies(): void
    {
        Page::query()->create([
            'slug' => 'aws-partner',
            'title' => 'AWS Cloud Services',
            'template' => 'aws-partner',
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

        $oldestChildStudy = CaseStudy::query()->create([
            'title' => 'Oldest AWS Child Study',
            'slug' => 'oldest-aws-child-study',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'content' => 'Oldest content',
        ]);

        $middleChildStudy = CaseStudy::query()->create([
            'title' => 'Middle AWS Child Study',
            'slug' => 'middle-aws-child-study',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'published',
            'published_at' => now()->subDays(3),
            'content' => 'Middle content',
        ]);

        $latestChildStudy = CaseStudy::query()->create([
            'title' => 'Latest AWS Child Study',
            'slug' => 'latest-aws-child-study',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'published',
            'published_at' => now()->subDay(),
            'content' => 'Latest content',
        ]);

        $response = $this->get('/aws-partner/');

        $response->assertOk();
        $response->assertSee('Latest AWS Child Study');
        $response->assertSee(route('case-studies.show', $latestChildStudy->slug));
        $response->assertSee('Middle AWS Child Study');
        $response->assertSee(route('case-studies.show', $middleChildStudy->slug));

        // Limit of 2 must exclude the 3rd (oldest) child study
        $response->assertDontSee('Oldest AWS Child Study');
        $response->assertDontSee(route('case-studies.show', $oldestChildStudy->slug));
    }

    public function test_child_only_flag_excludes_root_category(): void
    {
        $rootCategory = Category::query()->create([
            'name' => 'Root Category',
            'slug' => 'root-category',
            'module' => Category::MODULE_CASE_STUDY,
            'parent_id' => null,
        ]);

        CaseStudy::query()->create([
            'title' => 'Root Category Study',
            'slug' => 'root-category-study',
            'template' => 'default',
            'category_id' => $rootCategory->id,
            'status' => 'published',
            'content' => 'Root category content',
        ]);

        $repository = app(CaseStudyRepository::class);

        $withChildOnly = $repository->getPublishedByCategorySlug('root-category', limit: 2, childOnly: true);
        $withoutChildOnly = $repository->getPublishedByCategorySlug('root-category', limit: 2, childOnly: false);

        $this->assertCount(0, $withChildOnly);
        $this->assertCount(1, $withoutChildOnly);
    }

    public function test_aws_case_studies_eager_loads_relations_without_n_plus_one(): void
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
            'title' => 'AWS Case Study 1',
            'slug' => 'aws-case-study-1',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'published',
            'content' => 'Content 1',
        ]);

        CaseStudy::query()->create([
            'title' => 'AWS Case Study 2',
            'slug' => 'aws-case-study-2',
            'template' => 'default',
            'category_id' => $awsChildCategory->id,
            'status' => 'published',
            'content' => 'Content 2',
        ]);

        $repository = app(CaseStudyRepository::class);
        $studies = $repository->getPublishedByCategorySlug('aws', limit: 2, childOnly: true);

        $this->assertCount(2, $studies);
        foreach ($studies as $study) {
            $this->assertTrue($study->relationLoaded('media'), 'media relation must be eager-loaded');
            $this->assertTrue($study->relationLoaded('category'), 'category relation must be eager-loaded');
        }
    }
}
