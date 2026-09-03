<?php

namespace Tests\Unit;

use App\Services\IndustryBackfillService;
use PHPUnit\Framework\TestCase;

class IndustryBackfillServiceTest extends TestCase
{
    public function test_constant_values_match_specification(): void
    {
        $this->assertSame('article', IndustryBackfillService::OG_TYPE);
        $this->assertSame('IBN Technologies', IndustryBackfillService::OG_SITE_NAME);
        $this->assertSame('en_US', IndustryBackfillService::OG_LOCALE);
        $this->assertSame('summary_large_image', IndustryBackfillService::TWITTER_CARD_TYPE);
        $this->assertSame('IBNTechnology', IndustryBackfillService::TWITTER_CREATOR);
        $this->assertSame('IBNTechnology', IndustryBackfillService::TWITTER_SITE);
    }
}
