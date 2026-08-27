<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tracks WordPress posts imported into blogs.
 *
 * Native Laravel blogs must never have a row here. The importer is idempotent:
 * match by wordpress_id first, never update a blog that has no mapping row.
 * Extra WordPress categories (beyond the primary category_id) are stored in
 * unmapped_categories for review and are not written to seo_meta.article_tags.
 */
class BlogImport extends Model
{
    protected $fillable = [
        'wordpress_id',
        'wordpress_guid',
        'blog_id',
        'source_file',
        'source_url',
        'checksum',
        'unmapped_categories',
        'imported_at',
    ];

    protected $casts = [
        'wordpress_id' => 'integer',
        'unmapped_categories' => 'array',
        'imported_at' => 'datetime',
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
