<?php

namespace App\Filament\Resources\Redirects\Concerns;

use App\Models\ContentRedirect;
use App\Services\SiteRedirects;
use Filament\Schemas\Components\Component;
use Filament\Support\Enums\Alignment;

trait SavesRedirectionSources
{
    /** @var list<array<string, mixed>> */
    protected array $additionalRedirections = [];

    public function hasInlineLabels(): bool
    {
        return true;
    }

    public function getFormActionsAlignment(): string|Alignment
    {
        return Alignment::Between;
    }

    public function getFormActionsContentComponent(): Component
    {
        return parent::getFormActionsContentComponent()
            ->extraAttributes(['class' => 'ibn-redirection-form-actions'], merge: true);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function redirectionFormRecord(array $data): array
    {
        $split = app(SiteRedirects::class)->splitForm($data);
        $this->additionalRedirections = $split['additional'];

        return $split['record'];
    }

    protected function storeAdditionalRedirections(): void
    {
        foreach ($this->additionalRedirections as $row) {
            ContentRedirect::query()->create(array_merge($row, [
                'origin' => ContentRedirect::ORIGIN_MANUAL,
            ]));
        }

        $this->additionalRedirections = [];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['sources'] = [[
            'source_path' => $data['source_path'] ?? '',
            'match_type' => $data['match_type'] ?? ContentRedirect::MATCH_EXACT,
            'ignore_case' => (bool) ($data['ignore_case'] ?? false),
        ]];

        return $data;
    }
}
