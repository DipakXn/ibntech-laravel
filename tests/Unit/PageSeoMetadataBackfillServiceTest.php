<?php

namespace Tests\Unit;

use App\Services\PageSeoMetadataBackfillService;
use PHPUnit\Framework\TestCase;

class PageSeoMetadataBackfillServiceTest extends TestCase
{
    protected PageSeoMetadataBackfillService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PageSeoMetadataBackfillService();
    }

    public function test_constant_values_match_specification(): void
    {
        $this->assertSame('article', PageSeoMetadataBackfillService::OG_TYPE);
        $this->assertSame('IBN Technologies', PageSeoMetadataBackfillService::OG_SITE_NAME);
        $this->assertSame('en_US', PageSeoMetadataBackfillService::OG_LOCALE);
        $this->assertSame('summary_large_image', PageSeoMetadataBackfillService::TWITTER_CARD_TYPE);
        $this->assertSame('IBNTechnology', PageSeoMetadataBackfillService::TWITTER_CREATOR);
        $this->assertSame('IBNTechnology', PageSeoMetadataBackfillService::TWITTER_SITE);
    }
}
