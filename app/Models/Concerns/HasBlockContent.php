<?php

namespace App\Models\Concerns;

use App\Casts\BlockContentCast;
use App\Support\BlockContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait HasBlockContent
{
    protected static function bootHasBlockContent(): void
    {
        static::saved(function (Model $model): void {
            if (! method_exists($model, 'getMedia')) {
                return;
            }

            $activeBlockIds = collect(BlockContent::normalize($model->content))
                ->map(fn (array $block): ?string => data_get($block, 'data.block_id'))
                ->filter()
                ->all();

            $model
                ->getMedia('content_blocks')
                ->filter(fn ($media): bool => ! in_array(data_get($media, 'custom_properties.block_id'), $activeBlockIds, true))
                ->each(fn ($media) => $media->delete());
        });
    }

    protected function casts(): array
    {
        return [
            'content' => BlockContentCast::class,
        ];
    }

    public function plainTextContent(): string
    {
        return BlockContent::toPlainText($this->content);
    }

    public function estimatedReadTime(int $wordsPerMinute = 220): int
    {
        $wordCount = str_word_count($this->plainTextContent());

        return max(1, (int) ceil($wordCount / $wordsPerMinute));
    }

    public function contentBlockMedia(string $blockId, string $collection = 'content_blocks'): Collection
    {
        if (blank($blockId) || ! method_exists($this, 'getMedia')) {
            return collect();
        }

        return $this
            ->getMedia($collection)
            ->filter(fn ($media): bool => data_get($media, 'custom_properties.block_id') === $blockId)
            ->values();
    }
}
