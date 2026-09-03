<?php

namespace Tests\Unit;

use App\Models\Page;
use App\Services\PageFeaturedImageBackfillService;
use PHPUnit\Framework\TestCase;

class PageFeaturedImageBackfillServiceTest extends TestCase
{
    protected PageFeaturedImageBackfillService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PageFeaturedImageBackfillService();
    }

    public function test_svg_files_are_rejected(): void
    {
        $candidate = [
            'relative_path' => 'images/icons/shield.svg',
            'filename' => 'shield.svg',
            'dimensions' => ['width' => 200, 'height' => 200],
        ];

        $this->assertFalse($this->service->isMeaningfulImage($candidate));
    }

    public function test_decorative_icons_and_ui_elements_are_rejected(): void
    {
        $icons = [
            ['relative_path' => 'images/about-ibn/Transparency.webp', 'filename' => 'Transparency.webp', 'dimensions' => ['width' => 75, 'height' => 75]],
            ['relative_path' => 'images/about-ibn/reliability.webp', 'filename' => 'reliability.webp', 'dimensions' => ['width' => 75, 'height' => 75]],
            ['relative_path' => 'images/common/search-icon.webp', 'filename' => 'search-icon.webp', 'dimensions' => ['width' => 64, 'height' => 64]],
            ['relative_path' => 'images/home/call-icon.png', 'filename' => 'call-icon.png', 'dimensions' => ['width' => 32, 'height' => 32]],
            ['relative_path' => 'images/icons/green-icon.png', 'filename' => 'green-icon.png', 'dimensions' => ['width' => 100, 'height' => 100]],
            ['relative_path' => 'images/icons/pc-check-icon.webp', 'filename' => 'pc-check-icon.webp', 'dimensions' => ['width' => 90, 'height' => 90]],
            ['relative_path' => 'images/common/arrow.png', 'filename' => 'arrow.png', 'dimensions' => ['width' => 24, 'height' => 24]],
        ];

        foreach ($icons as $icon) {
            $this->assertFalse(
                $this->service->isMeaningfulImage($icon),
                "Expected {$icon['filename']} to be rejected as decorative icon."
            );
        }
    }

    public function test_client_partner_and_certification_logos_are_rejected(): void
    {
        $logos = [
            ['relative_path' => 'images/client-logos/google.png', 'filename' => 'google.png', 'dimensions' => ['width' => 300, 'height' => 100]],
            ['relative_path' => 'images/vapt-certs/iso-27001.webp', 'filename' => 'iso-27001.webp', 'dimensions' => ['width' => 140, 'height' => 80]],
            ['relative_path' => 'images/Certificates/ms-azure-security.webp', 'filename' => 'ms-azure-security.webp', 'dimensions' => ['width' => 200, 'height' => 150]],
            ['relative_path' => 'images/accounting-certified-logos/cpa.png', 'filename' => 'cpa.png', 'dimensions' => ['width' => 200, 'height' => 80]],
            ['relative_path' => 'images/accounting-software-expertise-logos/quickbooks.webp', 'filename' => 'quickbooks.webp', 'dimensions' => ['width' => 180, 'height' => 90]],
            ['relative_path' => 'images/partners/aws-partner-logo.webp', 'filename' => 'aws-partner-logo.webp', 'dimensions' => ['width' => 250, 'height' => 120]],
            ['relative_path' => 'images/vapt-services/Nessus.webp', 'filename' => 'Nessus.webp', 'dimensions' => ['width' => 150, 'height' => 60]],
        ];

        foreach ($logos as $logo) {
            $this->assertFalse(
                $this->service->isMeaningfulImage($logo),
                "Expected {$logo['filename']} to be rejected as logo/cert."
            );
        }
    }

    public function test_small_dimension_assets_are_rejected(): void
    {
        $small = [
            'relative_path' => 'images/general/tiny-badge.webp',
            'filename' => 'tiny-badge.webp',
            'dimensions' => ['width' => 80, 'height' => 80],
        ];

        $this->assertFalse($this->service->isMeaningfulImage($small));
    }

    public function test_meaningful_hero_and_content_images_are_accepted(): void
    {
        $meaningfulImages = [
            ['relative_path' => 'images/about-ibn/about-ibn-banner.webp', 'filename' => 'about-ibn-banner.webp', 'dimensions' => ['width' => 1080, 'height' => 1080]],
            ['relative_path' => 'images/1040-tax-filing/IRS-Tax-Filing.webp', 'filename' => 'IRS-Tax-Filing.webp', 'dimensions' => ['width' => 900, 'height' => 879]],
            ['relative_path' => 'images/ap-ar-automation/AP-AR-Automation-Banner.webp', 'filename' => 'AP-AR-Automation-Banner.webp', 'dimensions' => ['width' => 385, 'height' => 385]],
            ['relative_path' => 'images/bookkeeping-services-austin/bookkeeping-services-1.webp', 'filename' => 'bookkeeping-services-1.webp', 'dimensions' => ['width' => 850, 'height' => 450]],
            ['relative_path' => 'images/finance-and-accounting-services/bookkeeping.webp', 'filename' => 'bookkeeping.webp', 'dimensions' => ['width' => 1941, 'height' => 610]],
            ['relative_path' => 'images/soc-2-compliance/soc-2-type-2-hero.webp', 'filename' => 'soc-2-type-2-hero.webp', 'dimensions' => ['width' => 500, 'height' => 326]],
        ];

        foreach ($meaningfulImages as $img) {
            $this->assertTrue(
                $this->service->isMeaningfulImage($img),
                "Expected {$img['filename']} to be accepted as a meaningful image."
            );
        }
    }
}
