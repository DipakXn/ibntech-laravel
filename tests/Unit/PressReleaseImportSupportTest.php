<?php

namespace Tests\Unit;

use App\Services\WordPress\PressReleaseHtmlPreprocessor;
use App\Services\WordPress\PressReleaseImporter;
use App\Services\WordPress\PressReleasePermalink;
use App\Services\WordPress\PressReleasePost;
use App\Services\WordPress\PressReleasePublishDateReader;
use App\Services\WordPress\PressReleaseXmlReader;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PressReleaseImportSupportTest extends TestCase
{
    protected string $tempDir;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tempDir = sys_get_temp_dir().DIRECTORY_SEPARATOR.'pr-import-'.bin2hex(random_bytes(4));
        File::ensureDirectoryExists($this->tempDir);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->tempDir);

        parent::tearDown();
    }

    #[Test]
    public function it_reads_slug_from_permalink_not_filename(): void
    {
        $path = $this->writePost(
            'System_Xml_XmlElement.xml',
            'DIY Bookkeeping',
            'https://www.ibntech.com/pressrelease/diy-bookkeeping-of-us/',
            '<p>Body</p>',
        );

        $post = (new PressReleaseXmlReader)->readFile($path);

        $this->assertSame('diy-bookkeeping-of-us', $post->slug);
        $this->assertSame('System_Xml_XmlElement.xml', $post->sourceFile);
    }

    #[Test]
    public function it_matches_publish_dates_by_normalized_permalink(): void
    {
        $dateFile = $this->writeDates([
            'https://www.ibntech.com/pressrelease/diy-bookkeeping-of-us/' => '2024-08-05',
            'https://www.ibntech.com/pressrelease/ap-ar-automation-key-to-payment-fraud-reduction' => '2024-01-24',
        ]);

        $map = (new PressReleasePublishDateReader)->mappings($dateFile);

        $this->assertCount(2, $map['dates']);
        $this->assertSame(
            '2024-08-05',
            $map['dates'][PressReleasePermalink::normalize('https://www.ibntech.com/pressrelease/diy-bookkeeping-of-us')]->toDateString(),
        );
        $this->assertSame(
            '2024-01-24',
            $map['dates'][PressReleasePermalink::normalize('https://www.ibntech.com/pressrelease/ap-ar-automation-key-to-payment-fraud-reduction/')]->toDateString(),
        );
        $this->assertSame([], $map['duplicates']);
        $this->assertSame([], $map['invalid']);
    }

    #[Test]
    public function it_reports_duplicate_and_invalid_publish_dates(): void
    {
        $dateFile = $this->tempDir.DIRECTORY_SEPARATOR.'dates.xml';
        File::put($dateFile, <<<'XML'
<data>
  <post>
    <Permalink>https://www.ibntech.com/pressrelease/one/</Permalink>
    <Date>2024-08-05</Date>
  </post>
  <post>
    <Permalink>https://www.ibntech.com/pressrelease/one/</Permalink>
    <Date>2024-08-06</Date>
  </post>
  <post>
    <Permalink>https://www.ibntech.com/pressrelease/two/</Permalink>
    <Date>not-a-date</Date>
  </post>
</data>
XML);

        $map = (new PressReleasePublishDateReader)->mappings($dateFile);

        $this->assertCount(1, $map['dates']);
        $this->assertSame(['https://www.ibntech.com/pressrelease/one/'], $map['duplicates']);
        $this->assertCount(1, $map['invalid']);
        $this->assertSame('not-a-date', $map['invalid'][0]['date']);
    }

    #[Test]
    public function it_converts_caption_shortcodes_and_unwraps_empty_anchors(): void
    {
        $html = <<<'HTML'
[caption id="attachment_36417" align="alignnone" width="1000"]<img src="https://www.ibntech.com/wp-content/uploads/2024/02/construction-payment-cycles.jpg" alt="Construction Payment Cycles" /> Construction Payment Cycles Slow to 94 Days[/caption]
<p><a>
Pradip Gore </a></p>
HTML;

        $processed = (new PressReleaseHtmlPreprocessor)->process($html);

        $this->assertStringContainsString('<figure>', $processed);
        $this->assertStringContainsString('<figcaption>Construction Payment Cycles Slow to 94 Days</figcaption>', $processed);
        $this->assertStringNotContainsString('[caption', $processed);
        $this->assertStringContainsString('Pradip Gore', $processed);
        $this->assertStringNotContainsString('<a>', $processed);
    }

    #[Test]
    public function it_promotes_about_and_contact_headings(): void
    {
        $html = <<<'HTML'
<p>Body copy.</p>
<p><b>About IBN Technologies</b></p>
<p>Company bio.</p>
<p><strong>Contact Details:</strong></p>
HTML;

        $processed = (new PressReleaseHtmlPreprocessor)->process($html);

        $this->assertStringContainsString('<h3>About IBN Technologies</h3>', $processed);
        $this->assertStringContainsString('<h4>Contact Details:</h4>', $processed);
    }

    #[Test]
    public function dry_run_skips_only_the_protected_press_release_and_writes_nothing(): void
    {
        $this->writePost(
            'protected.xml',
            'Outsourcing accounting and bookkeeping services for small businesses uk',
            'https://www.ibntech.com/pressrelease/outsourcing-accounting-and-bookkeeping-services-for-small-businesses-uk/',
            '<p>Protected body</p>',
        );
        $this->writePost(
            'candidate.xml',
            'AP/AR Automation Key to Payment Fraud Reduction',
            'https://www.ibntech.com/pressrelease/ap-ar-automation-key-to-payment-fraud-reduction/',
            '<p>Candidate body</p><p>About IBN Technologies</p>',
        );

        $dateFile = $this->writeDates([
            'https://www.ibntech.com/pressrelease/outsourcing-accounting-and-bookkeeping-services-for-small-businesses-uk/' => '2023-08-29',
            'https://www.ibntech.com/pressrelease/ap-ar-automation-key-to-payment-fraud-reduction/' => '2024-01-24',
        ]);

        $report = app(PressReleaseImporter::class)->dryRun($this->tempDir, $dateFile);

        $this->assertSame(2, $report->scanned);
        $this->assertSame(1, $report->skippedProtected);
        $this->assertSame(1, $report->wouldCreate);
        $this->assertSame(['ap-ar-automation-key-to-payment-fraud-reduction'], $report->wouldCreateSlugs);
        $this->assertTrue($report->dateCoverageComplete());
        $this->assertSame('/pressrelease/ap-ar-automation-key-to-payment-fraud-reduction/', $report->wouldCreateItems[0]['public_url']);
        $this->assertSame('2024-01-24', $report->wouldCreateItems[0]['published_at']);
        $this->assertNull($report->wouldCreateItems[0]['seo']['canonical_url']);
        $this->assertFalse($report->wouldCreateItems[0]['seo']['schema_generated']);

        $onlyReport = app(PressReleaseImporter::class)->dryRun($this->tempDir, $dateFile, [
            'ap-ar-automation-key-to-payment-fraud-reduction',
        ]);
        $this->assertSame(1, $onlyReport->wouldCreate);
        $this->assertSame(1, $onlyReport->skippedProtected);
        $this->assertSame(0, $onlyReport->skippedNotInOnly);
    }

    #[Test]
    public function dry_run_fails_coverage_when_a_publish_date_is_missing(): void
    {
        $this->writePost(
            'candidate.xml',
            'AP/AR Automation Key to Payment Fraud Reduction',
            'https://www.ibntech.com/pressrelease/ap-ar-automation-key-to-payment-fraud-reduction/',
            '<p>Body</p>',
        );
        $dateFile = $this->writeDates([
            'https://www.ibntech.com/pressrelease/unrelated/' => '2024-01-24',
        ]);

        $report = app(PressReleaseImporter::class)->dryRun($this->tempDir, $dateFile);

        $this->assertFalse($report->dateCoverageComplete());
        $this->assertCount(1, $report->missingDates);
        $this->assertCount(1, $report->extraDates);
        $this->assertSame(0, $report->wouldCreate);
        $this->assertSame(1, $report->failed);
        $this->assertSame('publish date missing from pr-publish-date.xml', $report->failedItems[0]['error']);
    }

    #[Test]
    public function write_without_only_slugs_is_rejected(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Write mode requires --only or --remaining so Press Releases are not imported accidentally.');

        app(PressReleaseImporter::class)->write($this->tempDir, $this->writeDates([]), []);
    }

    #[Test]
    public function protected_slug_constant_matches_the_manual_press_release(): void
    {
        $this->assertSame(
            'outsourcing-accounting-and-bookkeeping-services-for-small-businesses-uk',
            PressReleasePost::PROTECTED_SLUG,
        );
    }

    protected function writePost(string $filename, string $title, string $permalink, string $content): string
    {
        $path = $this->tempDir.DIRECTORY_SEPARATOR.$filename;
        $safeTitle = htmlspecialchars($title, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $safePermalink = htmlspecialchars($permalink, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        File::put($path, <<<XML
<post>
  <Title>{$safeTitle}</Title>
  <Permalink>{$safePermalink}</Permalink>
  <rank_math_title>SEO {$safeTitle}</rank_math_title>
  <rank_math_description>Description for {$safeTitle}</rank_math_description>
  <Content><![CDATA[{$content}]]></Content>
</post>
XML);

        return $path;
    }

    /**
     * @param  array<string, string>  $dates
     */
    protected function writeDates(array $dates): string
    {
        $posts = '';
        foreach ($dates as $permalink => $date) {
            $posts .= "<post><Permalink>{$permalink}</Permalink><Date>{$date}</Date></post>\n";
        }

        $path = $this->tempDir.DIRECTORY_SEPARATOR.'pr-publish-date.xml';
        File::put($path, "<data>{$posts}</data>");

        return $path;
    }
}
