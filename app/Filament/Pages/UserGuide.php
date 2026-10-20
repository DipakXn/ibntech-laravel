<?php

namespace App\Filament\Pages;

use App\Support\UserGuide\UserGuideCatalog;
use App\Support\UserGuide\UserGuideTopic;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Livewire\Attributes\Url;

class UserGuide extends Page
{
    protected static ?string $title = 'User Guide';

    protected static ?string $navigationLabel = 'User Guide';

    protected static ?string $slug = 'user-guide';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 4;

    protected string $view = 'filament.pages.user-guide';

    protected ?string $subheading = 'Project features, modules, workflows, configuration, and administrator procedures.';

    protected Width|string|null $maxContentWidth = 'full';

    public string $search = '';

    #[Url(as: 'topic')]
    public ?string $topic = null;

    private ?UserGuideCatalog $resolvedCatalog = null;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    public function mount(): void
    {
        $this->syncTopic();
    }

    public function selectTopic(string $slug): void
    {
        if ($this->catalog()->find($slug) === null) {
            return;
        }

        $this->topic = $slug;
        $this->scrollArticleIntoViewOnSmallScreens();
    }

    public function clearSearch(): void
    {
        $this->search = '';
        $this->syncTopic();
    }

    public function updatedSearch(): void
    {
        $this->syncTopic();
    }

    protected function getViewData(): array
    {
        $catalog = $this->catalog();
        $groups = $catalog->grouped($this->search);
        $topic = $this->topic !== null ? $catalog->find($this->topic) : null;

        return [
            'groups' => $groups,
            'document' => $topic ? $catalog->render($topic) : null,
            'matchCount' => array_sum(array_map(
                fn (array $group): int => count($group['topics']),
                $groups,
            )),
            'totalCount' => count($catalog->topics()),
        ];
    }

    private function syncTopic(): void
    {
        $slugs = array_map(
            fn (UserGuideTopic $topic): string => $topic->slug,
            $this->catalog()->search($this->search),
        );

        if ($this->topic !== null && in_array($this->topic, $slugs, true)) {
            return;
        }

        $this->topic = $slugs[0] ?? null;
    }

    private function scrollArticleIntoViewOnSmallScreens(): void
    {
        $this->js(<<<'JS'
            const article = document.getElementById('user-guide-article');
            if (article && window.matchMedia('(max-width: 960px)').matches) {
                article.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        JS);
    }

    private function catalog(): UserGuideCatalog
    {
        return $this->resolvedCatalog ??= app(UserGuideCatalog::class);
    }
}
