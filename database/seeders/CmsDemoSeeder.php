<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\SeoMeta;
use App\Models\Tag;
use App\Models\WhitePaper;
use Illuminate\Database\Seeder;

class CmsDemoSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'template' => 'home',
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'Home | IbnTech Laravel CMS Demo',
                    'meta_description' => 'Landing page for the Laravel CMS demo with services, lead forms, and reusable Blade components.',
                ],
            ],
            [
                'title' => 'About Us',
                'slug' => 'about',
                'template' => 'about',
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'About Us | IbnTech Laravel CMS Demo',
                    'meta_description' => 'Company overview page seeded for testing the page templates and SEO editor.',
                ],
            ],
            [
                'title' => 'Services',
                'slug' => 'services',
                'template' => 'services',
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'Services | IbnTech Laravel CMS Demo',
                    'meta_description' => 'Service listing page for migration, CMS engineering, and support offerings.',
                ],
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'template' => 'contact',
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'Contact | IbnTech Laravel CMS Demo',
                    'meta_description' => 'Contact page with inquiry forms for testing lead capture and SEO fields.',
                ],
            ],
            [
                'title' => 'Our Vision',
                'slug' => 'our-vision',
                'template' => 'our-vision',
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'Our Vision | IbnTech Laravel CMS Demo',
                    'meta_description' => 'Sample vision page to validate custom page templates in the CMS.',
                ],
            ],
        ];

        foreach ($pages as $pageData) {
            $page = Page::query()->updateOrCreate(
                ['slug' => $pageData['slug']],
                [
                    'title' => $pageData['title'],
                    'template' => $pageData['template'],
                    'status' => $pageData['status'],
                ]
            );

            $this->syncSeoMeta($page, $pageData['seo']);
        }

        $categories = collect([
            ['slug' => 'migration', 'name' => 'Migration'],
            ['slug' => 'cms', 'name' => 'CMS'],
            ['slug' => 'seo', 'name' => 'SEO'],
            ['slug' => 'engineering', 'name' => 'Engineering'],
        ])->mapWithKeys(function (array $category): array {
            $model = Category::query()->updateOrCreate(
                ['slug' => $category['slug'], 'module' => \App\Models\Category::MODULE_BLOG],
                ['name' => $category['name']]
            );

            return [$category['slug'] => $model];
        });

        $tags = collect([
            ['slug' => 'seo', 'name' => 'SEO'],
            ['slug' => 'laravel', 'name' => 'Laravel'],
            ['slug' => 'migration', 'name' => 'Migration'],
            ['slug' => 'blade', 'name' => 'Blade'],
            ['slug' => 'filament', 'name' => 'Filament'],
            ['slug' => 'performance', 'name' => 'Performance'],
        ])->mapWithKeys(function (array $tag): array {
            $model = Tag::query()->updateOrCreate(
                ['slug' => $tag['slug']],
                ['name' => $tag['name']]
            );

            return [$tag['slug'] => $model];
        });

        $blogs = [
            [
                'title' => 'WordPress to Laravel Migration Checklist',
                'slug' => 'wordpress-to-laravel-migration-checklist',
                'template' => 'default',
                'content' => "Audit your existing content structure.\nMap current URLs and redirects.\nRebuild repeatable sections as Blade components.\nValidate SEO metadata before launch.",
                'featured_image' => null,
                'category_slug' => 'migration',
                'status' => 'published',
                'tag_slugs' => ['seo', 'laravel', 'migration'],
                'seo' => [
                    'meta_title' => 'WordPress to Laravel Migration Checklist',
                    'meta_description' => 'A seeded blog article for testing blog templates, taxonomy filters, and metadata editing.',
                ],
            ],
            [
                'title' => 'Blade Template Patterns for Corporate Sites',
                'slug' => 'blade-template-patterns-for-corporate-sites',
                'template' => 'default',
                'content' => "Use a small set of explicit templates.\nPush reusable sections into Blade components.\nKeep controllers thin and move content decisions into services.",
                'featured_image' => null,
                'category_slug' => 'cms',
                'status' => 'published',
                'tag_slugs' => ['laravel', 'blade', 'filament'],
                'seo' => [
                    'meta_title' => 'Blade Template Patterns for Corporate Sites',
                    'meta_description' => 'Sample Blade architecture article included for dummy blog data.',
                ],
            ],
            [
                'title' => 'Technical SEO Checks Before a CMS Relaunch',
                'slug' => 'technical-seo-checks-before-a-cms-relaunch',
                'template' => 'default',
                'content' => "Review canonicals.\nVerify metadata completeness.\nCheck sitemap coverage.\nConfirm redirects from legacy URLs.",
                'featured_image' => null,
                'category_slug' => 'seo',
                'status' => 'published',
                'tag_slugs' => ['seo', 'migration'],
                'seo' => [
                    'meta_title' => 'Technical SEO Checks Before a CMS Relaunch',
                    'meta_description' => 'Dummy SEO-focused article for testing search snippets and article rendering.',
                ],
            ],
            [
                'title' => 'Improving Filament Admin Workflows for Content Teams',
                'slug' => 'improving-filament-admin-workflows-for-content-teams',
                'template' => 'default',
                'content' => "Group related content types.\nExpose only the fields editors need.\nUse dedicated templates per content stream.\nStandardize SEO inputs across resources.",
                'featured_image' => null,
                'category_slug' => 'engineering',
                'status' => 'draft',
                'tag_slugs' => ['filament', 'laravel', 'performance'],
                'seo' => [
                    'meta_title' => 'Improving Filament Admin Workflows for Content Teams',
                    'meta_description' => 'Draft article to test admin filtering and unpublished content handling.',
                ],
            ],
            [
                'title' => 'Scaling Content Operations with Structured Templates',
                'slug' => 'scaling-content-operations-with-structured-templates',
                'template' => 'default',
                'content' => "Templates reduce authoring drift.\nMetadata becomes predictable.\nPublishing workflows stay consistent across pages, blogs, and campaigns.",
                'featured_image' => null,
                'category_slug' => 'cms',
                'status' => 'published',
                'tag_slugs' => ['blade', 'filament'],
                'seo' => [
                    'meta_title' => 'Scaling Content Operations with Structured Templates',
                    'meta_description' => 'Seeded article for testing larger blog lists and pagination.',
                ],
            ],
        ];

        foreach ($blogs as $blogData) {
            $blog = Blog::query()->updateOrCreate(
                ['slug' => $blogData['slug']],
                [
                    'title' => $blogData['title'],
                    'template' => $blogData['template'],
                    'content' => $blogData['content'],
                    'featured_image' => $blogData['featured_image'],
                    'category_id' => $categories[$blogData['category_slug']]->id,
                    'status' => $blogData['status'],
                ]
            );

            $blog->tags()->sync(
                collect($blogData['tag_slugs'])
                    ->map(fn (string $slug) => $tags[$slug]->id)
                    ->all()
            );

            $this->syncSeoMeta($blog, $blogData['seo']);
        }

        $caseStudies = [
            [
                'title' => 'Enterprise Portal Modernization',
                'slug' => 'enterprise-portal-modernization',
                'template' => 'default',
                'excerpt' => 'How we replaced a brittle legacy CMS with a maintainable Laravel platform.',
                'content' => "The team audited legacy templates, mapped publishing flows, and rebuilt the site around reusable Blade sections.\nThe result was faster content production, clearer governance, and safer SEO operations.",
                'featured_image' => null,
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'Enterprise Portal Modernization Case Study',
                    'meta_description' => 'Dummy case study seeded for testing the new content type and metadata form.',
                ],
            ],
            [
                'title' => 'B2B Lead Generation Platform Refresh',
                'slug' => 'b2b-lead-generation-platform-refresh',
                'template' => 'default',
                'excerpt' => 'A corporate marketing site redesign focused on forms, landing pages, and conversion tracking.',
                'content' => "This seeded case study highlights landing page consolidation, ebook funnel cleanup, and faster editorial publishing.\nIt is designed to test listing pages and detail page templates.",
                'featured_image' => null,
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'B2B Lead Generation Platform Refresh',
                    'meta_description' => 'Sample case study content for validating public routes and admin editing.',
                ],
            ],
            [
                'title' => 'Multi-Brand CMS Consolidation',
                'slug' => 'multi-brand-cms-consolidation',
                'template' => 'default',
                'excerpt' => 'A draft record for testing moderation and status filters in Filament.',
                'content' => "This draft entry exists mainly to validate admin filters, counts, and SEO data persistence for unpublished case studies.",
                'featured_image' => null,
                'status' => 'draft',
                'seo' => [
                    'meta_title' => 'Multi-Brand CMS Consolidation',
                    'meta_description' => 'Draft case study used for back-office testing.',
                ],
            ],
        ];

        foreach ($caseStudies as $caseStudyData) {
            $caseStudy = CaseStudy::query()->updateOrCreate(
                ['slug' => $caseStudyData['slug']],
                [
                    'title' => $caseStudyData['title'],
                    'template' => $caseStudyData['template'],
                    'excerpt' => $caseStudyData['excerpt'],
                    'content' => $caseStudyData['content'],
                    'featured_image' => $caseStudyData['featured_image'],
                    'status' => $caseStudyData['status'],
                ]
            );

            $this->syncSeoMeta($caseStudy, $caseStudyData['seo']);
        }

        $ebooks = [
            [
                'title' => 'Laravel Migration Playbook',
                'slug' => 'laravel-migration-playbook',
                'template' => 'default',
                'excerpt' => 'A practical guide for planning a WordPress-to-Laravel migration.',
                'content' => "Use this seeded ebook to test metadata editing, PDF uploads, and ebook listing templates.\nIt simulates a gated resource promoted from the homepage.",
                'featured_image' => null,
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'Laravel Migration Playbook',
                    'meta_description' => 'Seeded ebook asset for testing ebook content management.',
                ],
            ],
            [
                'title' => 'SEO Governance Checklist for Content Teams',
                'slug' => 'seo-governance-checklist-for-content-teams',
                'template' => 'default',
                'excerpt' => 'A checklist for maintaining metadata quality at scale.',
                'content' => "This dummy ebook provides another published record for list pagination and route testing.\nUse it to verify editor workflows in the new ebook resource.",
                'featured_image' => null,
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'SEO Governance Checklist for Content Teams',
                    'meta_description' => 'Sample downloadable asset for testing ebook templates and metadata.',
                ],
            ],
            [
                'title' => 'Editorial Workflow Blueprint',
                'slug' => 'editorial-workflow-blueprint',
                'template' => 'default',
                'excerpt' => 'A draft ebook used to validate unpublished content behavior in the admin.',
                'content' => "This draft ebook lets you test status filters, dashboard counts, and SEO saving in the ebook admin area.",
                'featured_image' => null,
                'status' => 'draft',
                'seo' => [
                    'meta_title' => 'Editorial Workflow Blueprint',
                    'meta_description' => 'Draft ebook for testing admin-only workflows.',
                ],
            ],
        ];

        foreach ($ebooks as $ebookData) {
            $ebook = Ebook::query()->updateOrCreate(
                ['slug' => $ebookData['slug']],
                [
                    'title' => $ebookData['title'],
                    'template' => $ebookData['template'],
                    'excerpt' => $ebookData['excerpt'],
                    'content' => $ebookData['content'],
                    'featured_image' => $ebookData['featured_image'],
                    'status' => $ebookData['status'],
                ]
            );

            $this->syncSeoMeta($ebook, $ebookData['seo']);
        }

        $pressReleases = [
            [
                'title' => 'IBN Technologies Launches Expanded Remote Accounting Delivery Program',
                'slug' => 'ibn-technologies-launches-expanded-remote-accounting-delivery-program',
                'template' => 'default',
                'excerpt' => 'The company announced a broader delivery model for finance and bookkeeping teams needing scalable remote support.',
                'content' => "This seeded press release is intended to validate the new module's public listing and detail templates.\nIt mirrors the editorial structure used by the other content modules without introducing gated downloads or forms.",
                'featured_image' => null,
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'IBN Technologies Launches Expanded Remote Accounting Delivery Program',
                    'meta_description' => 'Sample press release seeded for testing press release publishing, routing, and metadata handling.',
                ],
            ],
            [
                'title' => 'IBN Technologies Announces New Compliance Reporting Initiative',
                'slug' => 'ibn-technologies-announces-new-compliance-reporting-initiative',
                'template' => 'default',
                'excerpt' => 'A sample announcement covering new reporting workflows and operational governance updates.',
                'content' => "Use this published press release to verify pagination, template rendering, and recent activity widgets.\nThe record exists to provide realistic frontend and admin coverage for the new module.",
                'featured_image' => null,
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'IBN Technologies Announces New Compliance Reporting Initiative',
                    'meta_description' => 'Seeded press release content for verifying frontend page rendering and admin visibility.',
                ],
            ],
            [
                'title' => 'Quarterly Operations Update',
                'slug' => 'quarterly-operations-update',
                'template' => 'default',
                'excerpt' => 'A draft press release retained for testing unpublished content behavior in Filament.',
                'content' => "This draft record validates status filters, dashboard counts, and SEO persistence for press releases before publication.",
                'featured_image' => null,
                'status' => 'draft',
                'seo' => [
                    'meta_title' => 'Quarterly Operations Update',
                    'meta_description' => 'Draft press release used for back-office testing.',
                ],
            ],
        ];

        foreach ($pressReleases as $pressReleaseData) {
            $pressRelease = PressRelease::query()->updateOrCreate(
                ['slug' => $pressReleaseData['slug']],
                [
                    'title' => $pressReleaseData['title'],
                    'template' => $pressReleaseData['template'],
                    'excerpt' => $pressReleaseData['excerpt'],
                    'content' => $pressReleaseData['content'],
                    'featured_image' => $pressReleaseData['featured_image'],
                    'status' => $pressReleaseData['status'],
                ]
            );

            $this->syncSeoMeta($pressRelease, $pressReleaseData['seo']);
        }

        $whitePapers = [
            [
                'title' => 'Cloud Cost Governance Framework for Mid-Market Teams',
                'slug' => 'cloud-cost-governance-framework-for-mid-market-teams',
                'template' => 'default',
                'excerpt' => 'A practical framework for reducing unmanaged cloud spend while improving reporting discipline.',
                'content' => "This seeded white paper exists to validate the new module's public listing and detail pages.\nIt mirrors the press release implementation while presenting the content as a long-form resource instead of a company announcement.",
                'featured_image' => null,
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'Cloud Cost Governance Framework for Mid-Market Teams',
                    'meta_description' => 'Sample white paper seeded for testing the white papers module, routing, and metadata handling.',
                ],
            ],
            [
                'title' => 'Modern Finance Automation Readiness Guide',
                'slug' => 'modern-finance-automation-readiness-guide',
                'template' => 'default',
                'excerpt' => 'A sample white paper outlining the process, controls, and change-management steps behind finance automation programs.',
                'content' => "Use this published white paper to verify pagination, template rendering, and dashboard activity aggregation.\nThe record gives the frontend and admin module realistic content coverage.",
                'featured_image' => null,
                'status' => 'published',
                'seo' => [
                    'meta_title' => 'Modern Finance Automation Readiness Guide',
                    'meta_description' => 'Seeded white paper content for verifying frontend page rendering and admin visibility.',
                ],
            ],
            [
                'title' => 'Operational Resilience Assessment Workbook',
                'slug' => 'operational-resilience-assessment-workbook',
                'template' => 'default',
                'excerpt' => 'A draft white paper retained for testing unpublished content behavior in Filament.',
                'content' => "This draft record validates status filters, dashboard counts, and SEO persistence for white papers before publication.",
                'featured_image' => null,
                'status' => 'draft',
                'seo' => [
                    'meta_title' => 'Operational Resilience Assessment Workbook',
                    'meta_description' => 'Draft white paper used for back-office testing.',
                ],
            ],
        ];

        foreach ($whitePapers as $whitePaperData) {
            $whitePaper = WhitePaper::query()->updateOrCreate(
                ['slug' => $whitePaperData['slug']],
                [
                    'title' => $whitePaperData['title'],
                    'template' => $whitePaperData['template'],
                    'excerpt' => $whitePaperData['excerpt'],
                    'content' => $whitePaperData['content'],
                    'featured_image' => $whitePaperData['featured_image'],
                    'status' => $whitePaperData['status'],
                ]
            );

            $this->syncSeoMeta($whitePaper, $whitePaperData['seo']);
        }
    }

    protected function syncSeoMeta(object $model, array $data): void
    {
        SeoMeta::query()->updateOrCreate(
            [
                'metable_type' => $model::class,
                'metable_id' => $model->id,
            ],
            [
                'meta_title' => $data['meta_title'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
                'og_title' => $data['og_title'] ?? ($data['meta_title'] ?? null),
                'og_description' => $data['og_description'] ?? ($data['meta_description'] ?? null),
                'og_image' => $data['og_image'] ?? null,
                'canonical_url' => $data['canonical_url'] ?? null,
            ]
        );
    }
}
