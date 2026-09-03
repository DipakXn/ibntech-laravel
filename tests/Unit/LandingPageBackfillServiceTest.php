<?php

namespace Tests\Unit;

use App\Services\LandingPageBackfillService;
use PHPUnit\Framework\TestCase;

class LandingPageBackfillServiceTest extends TestCase
{
    public function test_constant_values_match_specification(): void
    {
        $this->assertSame('article', LandingPageBackfillService::OG_TYPE);
        $this->assertSame('IBN Technologies', LandingPageBackfillService::OG_SITE_NAME);
        $this->assertSame('en_US', LandingPageBackfillService::OG_LOCALE);
        $this->assertSame('summary_large_image', LandingPageBackfillService::TWITTER_CARD_TYPE);
        $this->assertSame('IBNTechnology', LandingPageBackfillService::TWITTER_CREATOR);
        $this->assertSame('IBNTechnology', LandingPageBackfillService::TWITTER_SITE);
    }
}
