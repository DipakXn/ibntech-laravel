<?php

namespace Tests\Unit;

use App\Services\BlogSeoMetadataBackfillService;
use PHPUnit\Framework\TestCase;

class BlogSeoMetadataBackfillServiceTest extends TestCase
{
    public function test_constant_values_match_specification(): void
    {
        $this->assertSame('IBN Technologies', BlogSeoMetadataBackfillService::OG_SITE_NAME);
        $this->assertSame('en_US', BlogSeoMetadataBackfillService::OG_LOCALE);
        $this->assertSame('IBNTechnology', BlogSeoMetadataBackfillService::TWITTER_CREATOR);
        $this->assertSame('IBNTechnology', BlogSeoMetadataBackfillService::TWITTER_SITE);
    }

    public function test_allowed_fields_strictly_match_5_fields(): void
    {
        $expected = [
            'og_image_alt',
            'og_site_name',
            'og_locale',
            'twitter_creator',
            'twitter_site',
        ];

        $this->assertSame($expected, BlogSeoMetadataBackfillService::ALLOWED_FIELDS);
    }

    public function test_disallowed_fields_are_excluded(): void
    {
        $forbidden = [
            'og_type',
            'og_image',
            'twitter_card_type',
            'twitter_image',
            'twitter_title',
            'twitter_description',
            'meta_title',
            'meta_description',
            'canonical_url',
            'robots',
            'schema',
        ];

        foreach ($forbidden as $field) {
            $this->assertNotContains($field, BlogSeoMetadataBackfillService::ALLOWED_FIELDS);
        }
    }
}
