<?php

namespace App\Filament\Widgets;

use App\Filament\Clusters\SmtpSettings\Pages\SmtpConfiguration;
use App\Filament\Pages\LogViewer;
use App\Filament\Pages\QueueMonitor;
use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Ebooks\EbookResource;
use App\Filament\Resources\Industries\IndustryResource;
use App\Filament\Resources\LandingPages\LandingPageResource;
use App\Filament\Resources\Leads\LeadResource;
use App\Filament\Resources\Newsletters\NewsletterResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Lead;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\User;
use App\Models\WhitePaper;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class AdminQuickActionsWidget extends Widget
{
    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.admin-quick-actions-widget';

    protected int|string|array $columnSpan = 1;

    protected function getViewData(): array
    {
        $user = auth()->user();

        if ($user instanceof User && $user->isAuthor()) {
            return [
                'actions' => $this->authorActions(),
                'metrics' => [
                    $this->coverageMetric([
                        Blog::class,
                        CaseStudy::class,
                        PressRelease::class,
                        Ebook::class,
                        WhitePaper::class,
                        Article::class,
                    ]),
                ],
            ];
        }

        $actions = [
            ['label' => 'New blog', 'description' => 'Draft or publish a post', 'url' => BlogResource::getUrl('create')],
            ['label' => 'New case study', 'description' => 'Create a proof-driven story', 'url' => CaseStudyResource::getUrl('create')],
            ['label' => 'New eBook', 'description' => 'Add a gated asset', 'url' => EbookResource::getUrl('create')],
            ['label' => 'New press release', 'description' => 'Publish a company announcement', 'url' => PressReleaseResource::getUrl('create')],
            ['label' => 'New white paper', 'description' => 'Add a research-driven resource', 'url' => WhitePaperResource::getUrl('create')],
            ['label' => 'Update pages', 'description' => 'Refresh landing page content', 'url' => PageResource::getUrl()],
            ['label' => 'Update industries', 'description' => 'Manage industry landing pages', 'url' => IndustryResource::getUrl()],
            ['label' => 'Update LPs', 'description' => 'Manage campaign landing pages', 'url' => LandingPageResource::getUrl()],
            ['label' => 'Update newsletters', 'description' => 'Manage archived newsletter pages', 'url' => NewsletterResource::getUrl()],
        ];

        $metrics = [
            $this->coverageMetric([
                Blog::class,
                CaseStudy::class,
                Ebook::class,
                PressRelease::class,
                WhitePaper::class,
                Page::class,
                Industry::class,
                LandingPage::class,
                Newsletter::class,
            ]),
        ];

        if ($user?->isAdministrator()) {
            $actions[] = ['label' => 'Review submissions', 'description' => 'Respond to new inbound requests', 'url' => LeadResource::getUrl()];
            $actions[] = ['label' => 'SMTP settings', 'description' => 'Configure outgoing mail and review email logs', 'url' => SmtpConfiguration::getUrl()];
            $actions[] = ['label' => 'Monitor queues', 'description' => 'Inspect backlog and failed jobs', 'url' => QueueMonitor::getUrl()];
            $actions[] = ['label' => 'Review logs', 'description' => 'Inspect rotated application logs', 'url' => LogViewer::getUrl()];

            $metrics[] = [
                'label' => 'Submission queue',
                'value' => Lead::query()->whereDate('created_at', '>=', now()->subDays(7))->count(),
                'hint' => 'New submissions in the last 7 days',
            ];
        }

        return [
            'actions' => $actions,
            'metrics' => $metrics,
        ];
    }

    /**
     * @return list<array{label: string, description: string, url: string}>
     */
    private function authorActions(): array
    {
        return [
            ['label' => 'New blog', 'description' => 'Draft or publish a post', 'url' => BlogResource::getUrl('create')],
            ['label' => 'New case study', 'description' => 'Create a proof-driven story', 'url' => CaseStudyResource::getUrl('create')],
            ['label' => 'New press release', 'description' => 'Publish a company announcement', 'url' => PressReleaseResource::getUrl('create')],
            ['label' => 'New eBook', 'description' => 'Add a gated asset', 'url' => EbookResource::getUrl('create')],
            ['label' => 'New white paper', 'description' => 'Add a research-driven resource', 'url' => WhitePaperResource::getUrl('create')],
            ['label' => 'New article', 'description' => 'Draft or publish an article', 'url' => ArticleResource::getUrl('create')],
        ];
    }

    /**
     * @param  list<class-string<Model>>  $models
     * @return array{label: string, value: string, hint: string}
     */
    private function coverageMetric(array $models): array
    {
        $totalContent = 0;
        $publishedContent = 0;

        foreach ($models as $model) {
            $totalContent += $model::query()->count();
            $publishedContent += $model::published()->count();
        }

        return [
            'label' => 'Publishing coverage',
            'value' => $totalContent > 0 ? (int) round(($publishedContent / $totalContent) * 100).'%' : '0%',
            'hint' => $publishedContent.' of '.$totalContent.' items live',
        ];
    }
}
