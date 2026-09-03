<?php

namespace Tests\Unit;

use App\Services\NewsletterBackfillService;
use PHPUnit\Framework\TestCase;

class NewsletterBackfillServiceTest extends TestCase
{
    public function test_constant_values_match_specification(): void
    {
        $this->assertSame('article', NewsletterBackfillService::OG_TYPE);
        $this->assertSame('IBN Technologies', NewsletterBackfillService::OG_SITE_NAME);
        $this->assertSame('en_US', NewsletterBackfillService::OG_LOCALE);
        $this->assertSame('summary_large_image', NewsletterBackfillService::TWITTER_CARD_TYPE);
        $this->assertSame('IBNTechnology', NewsletterBackfillService::TWITTER_CREATOR);
        $this->assertSame('IBNTechnology', NewsletterBackfillService::TWITTER_SITE);
    }
}
