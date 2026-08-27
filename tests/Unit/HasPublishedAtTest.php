<?php

namespace Tests\Unit;

use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HasPublishedAtTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_at_helper_prefers_published_at_then_created_at(): void
    {
        $publishedAt = Carbon::parse('2024-06-01 10:00:00');
        $createdAt = Carbon::parse('2026-08-21 12:00:00');

        $pageWithPublishedAt = new Page([
            'title' => 'VAPT Services',
            'published_at' => $publishedAt,
        ]);
        $pageWithPublishedAt->created_at = $createdAt;

        $this->assertTrue($pageWithPublishedAt->publishedAt()->equalTo($publishedAt));

        $pageWithoutPublishedAt = new Page([
            'title' => 'Draft page',
        ]);
        $pageWithoutPublishedAt->created_at = $createdAt;

        $this->assertTrue($pageWithoutPublishedAt->publishedAt()->equalTo($createdAt));
    }

    public function test_latest_scope_orders_by_coalesce_of_published_at_and_created_at(): void
    {
        $olderPublished = Page::query()->create([
            'title' => 'Older published date',
            'slug' => 'older-published-date',
            'template' => 'default',
            'status' => 'published',
            'published_at' => '2020-01-01 00:00:00',
        ]);
        $olderPublished->forceFill(['created_at' => '2026-08-21 12:00:00'])->saveQuietly();

        $newerCreatedFallback = Page::query()->create([
            'title' => 'Newer created fallback',
            'slug' => 'newer-created-fallback',
            'template' => 'default',
            'status' => 'published',
            'published_at' => null,
        ]);
        $newerCreatedFallback->forceFill([
            'created_at' => '2025-01-01 00:00:00',
            'published_at' => null,
        ])->saveQuietly();

        $newestPublished = Page::query()->create([
            'title' => 'Newest published date',
            'slug' => 'newest-published-date',
            'template' => 'default',
            'status' => 'published',
            'published_at' => '2026-01-01 00:00:00',
        ]);
        $newestPublished->forceFill(['created_at' => '2024-01-01 00:00:00'])->saveQuietly();

        $this->assertSame(
            [
                $newestPublished->id,
                $newerCreatedFallback->id,
                $olderPublished->id,
            ],
            Page::query()->latest()->pluck('id')->all()
        );

        $this->assertStringContainsString(
            'coalesce',
            strtolower(Page::query()->latest()->toSql())
        );
    }
}
