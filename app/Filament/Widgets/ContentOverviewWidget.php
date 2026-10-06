<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Ebooks\EbookResource;
use App\Filament\Resources\Industries\IndustryResource;
use App\Filament\Resources\LandingPages\LandingPageResource;
use App\Filament\Resources\Leads\LeadResource;
use App\Filament\Resources\Newsletters\NewsletterResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use App\Filament\Resources\Users\UserResource;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
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
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentOverviewWidget extends StatsOverviewWidget
{
    protected static bool $isLazy = false;

    protected ?string $heading = 'Publishing performance';

    protected ?string $description = 'Monitor the core modules that drive content, submission capture, and admin operations.';

    protected int|array|null $columns = [
        'md' => 2,
        'xl' => 4,
    ];

    protected function getStats(): array
    {
        $stats = [
            Stat::make('Blogs', Blog::query()->count())
                ->description(Blog::published()->count().' published posts')
                ->icon(Heroicon::OutlinedDocumentText)
                ->url(BlogResource::getUrl())
                ->color('info'),
            Stat::make('Case Studies', CaseStudy::query()->count())
                ->description(CaseStudy::published()->count().' live case studies')
                ->icon(Heroicon::OutlinedPresentationChartLine)
                ->url(CaseStudyResource::getUrl())
                ->color('success'),
            Stat::make('eBooks', Ebook::query()->count())
                ->description(Ebook::published()->count().' available downloads')
                ->icon(Heroicon::OutlinedBookOpen)
                ->url(EbookResource::getUrl())
                ->color('info'),
            Stat::make('Press Releases', PressRelease::query()->count())
                ->description(PressRelease::published()->count().' published announcements')
                ->icon(Heroicon::OutlinedNewspaper)
                ->url(PressReleaseResource::getUrl())
                ->color('info'),
            Stat::make('White Papers', WhitePaper::query()->count())
                ->description(WhitePaper::published()->count().' published resources')
                ->icon(Heroicon::OutlinedDocumentText)
                ->url(WhitePaperResource::getUrl())
                ->color('info'),
        ];

        if (auth()->user() instanceof User && auth()->user()->isAdministrator()) {
            $stats[] = Stat::make('Pages', Page::query()->count())
                ->description(Page::published()->count().' published pages')
                ->icon(Heroicon::OutlinedRectangleStack)
                ->url(PageResource::getUrl())
                ->color('gray');

            $stats[] = Stat::make('Industries', Industry::query()->count())
                ->description(Industry::published()->count().' published industry pages')
                ->icon(Heroicon::OutlinedBuildingOffice2)
                ->url(IndustryResource::getUrl())
                ->color('gray');

            $stats[] = Stat::make('Landing Pages', LandingPage::query()->count())
                ->description(LandingPage::published()->count().' published landing pages')
                ->icon(Heroicon::OutlinedMegaphone)
                ->url(LandingPageResource::getUrl())
                ->color('gray');

            $stats[] = Stat::make('Newsletters', Newsletter::query()->count())
                ->description(Newsletter::published()->count().' published newsletters')
                ->icon(Heroicon::OutlinedEnvelope)
                ->url(NewsletterResource::getUrl())
                ->color('gray');

            $stats[] = Stat::make('Submissions', Lead::query()->count())
                ->description(Lead::query()->whereDate('created_at', '>=', now()->subDays(7))->count().' in the last 7 days')
                ->icon(Heroicon::OutlinedInboxStack)
                ->url(LeadResource::getUrl())
                ->color('danger');

            $stats[] = Stat::make('Users', User::query()->count())
                ->description('Dashboard seats')
                ->icon(Heroicon::OutlinedUsers)
                ->url(UserResource::getUrl())
                ->color('primary');
        }

        return $stats;
    }
}
