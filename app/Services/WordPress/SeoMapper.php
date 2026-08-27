<?php

namespace App\Services\WordPress;

use App\Models\Blog;
use App\Support\BlockContent;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SeoMapper
{
    /**
     * @param  array<int, string>  $tags
     * @param  array<int, array<string, mixed>>  $blocks
     * @return array<string, mixed>
     */
    public function forPost(WordpressPost $post, Blog $blog, array $blocks, array $tags = []): array
    {
        $title = $post->rankMathTitle ?: $post->title;
        $description = $post->rankMathDescription
            ?: $post->excerpt
            ?: BlockContent::summary($blocks, 160);

        $canonical = rtrim(route('blog.show', ['slug' => $blog->slug]), '/').'/';
        $publishedAt = $blog->published_at instanceof Carbon
            ? $blog->published_at
            : ($post->publishedDate ? Carbon::parse($post->publishedDate)->startOfDay() : null);

        return [
            'meta_title' => Str::limit($title, 255, ''),
            'meta_description' => $description !== '' ? $description : null,
            'meta_keywords' => $tags !== [] ? implode(', ', $tags) : null,
            'canonical_url' => $canonical,
            'og_title' => Str::limit($title, 255, ''),
            'og_description' => $description !== '' ? $description : null,
            'og_type' => 'article',
            'twitter_title' => Str::limit($title, 255, ''),
            'twitter_description' => $description !== '' ? $description : null,
            'twitter_card_type' => 'summary_large_image',
            'robots_index' => 'index',
            'robots_follow' => 'follow',
            'article_author' => 'IBN Technologies',
            'published_at' => $publishedAt,
            'modified_at' => now(),
            'article_section' => $blog->category?->name,
            'article_tags' => $tags !== [] ? array_values($tags) : null,
            'reading_time' => $blog->estimatedReadTime(),
            'sitemap_include' => true,
            'schema_generated' => true,
            'faq_schema' => collect($blocks)->contains(fn (array $block): bool => ($block['type'] ?? null) === 'faq'),
        ];
    }
}
