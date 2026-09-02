<?php

namespace Tests\Feature;

use App\Models\PressRelease;
use App\Models\PressReleaseImport;
use App\Services\WordPress\PressReleaseImporter;
use App\Services\WordPress\PressReleasePost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PressReleaseStageTwoPilotTest extends TestCase
{
    use RefreshDatabase;

    protected string $tempDir;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tempDir = sys_get_temp_dir().DIRECTORY_SEPARATOR.'pr-pilot-'.bin2hex(random_bytes(4));
        File::ensureDirectoryExists($this->tempDir);
        Storage::fake((string) config('media-library.disk_name', 'media'));
        config(['media-library.queue_conversions_by_default' => false]);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->tempDir);

        parent::tearDown();
    }

    #[Test]
    public function write_imports_only_allowlisted_slugs_and_does_not_modify_the_protected_record(): void
    {
        $protected = PressRelease::query()->create([
            'title' => 'MANUAL PROTECTED',
            'slug' => PressReleasePost::PROTECTED_SLUG,
            'template' => 'default',
            'content' => [['type' => 'paragraph', 'data' => ['content' => '<p>Do not change</p>']]],
            'status' => 'published',
            'published_at' => '2023-08-29 00:00:00',
        ]);

        $this->writePost(
            'protected.xml',
            'Outsourcing accounting and bookkeeping services for small businesses uk',
            'https://www.ibntech.com/pressrelease/outsourcing-accounting-and-bookkeeping-services-for-small-businesses-uk/',
            '<p>WordPress copy that must not overwrite #4</p>',
        );
        $this->writePost(
            'candidate.xml',
            'AP/AR Automation Key to Payment Fraud Reduction',
            'https://www.ibntech.com/pressrelease/ap-ar-automation-key-to-payment-fraud-reduction/',
            '<p>Candidate body</p><p><b>About IBN Technologies</b></p><p>Bio.</p><p><strong>Contact Details:</strong></p>',
        );
        $this->writePost(
            'construction.xml',
            'Construction Payment Cycles Slow to 94 Days on Average, Costing the Industry Billions',
            'https://www.ibntech.com/pressrelease/construction-payment-cycles/',
            '[caption id="attachment_36417" align="alignnone" width="1000"]<img src="https://www.ibntech.com/wp-content/uploads/2024/02/construction-payment-cycles.jpg" alt="Construction Payment Cycles" /> Construction Payment Cycles Slow to 94 Days[/caption]<p>Body copy.</p>',
        );
        $this->writePost(
            'other.xml',
            'Must Not Import',
            'https://www.ibntech.com/pressrelease/must-not-import/',
            '<p>Left for the remaining 54.</p>',
        );

        $dateFile = $this->writeDates([
            'https://www.ibntech.com/pressrelease/outsourcing-accounting-and-bookkeeping-services-for-small-businesses-uk/' => '2023-08-29',
            'https://www.ibntech.com/pressrelease/ap-ar-automation-key-to-payment-fraud-reduction/' => '2024-01-24',
            'https://www.ibntech.com/pressrelease/construction-payment-cycles/' => '2024-02-05',
            'https://www.ibntech.com/pressrelease/must-not-import/' => '2024-03-01',
        ]);

        Http::fake(function () {
            return Http::response(
                $this->jpegBytes(),
                200,
                ['Content-Type' => 'image/jpeg'],
            );
        });

        $report = app(PressReleaseImporter::class)->write($this->tempDir, $dateFile, [
            'ap-ar-automation-key-to-payment-fraud-reduction',
            'construction-payment-cycles',
            PressReleasePost::PROTECTED_SLUG,
        ]);

        $this->assertSame(4, $report->scanned);
        $this->assertSame(2, $report->created);
        $this->assertSame(1, $report->skippedProtected);
        $this->assertSame(1, $report->skippedNotInOnly);
        $this->assertSame(0, $report->failed);
        $this->assertSame(1, $report->featuredImages);
        $this->assertContains(
            'https://www.ibntech.com/wp-content/uploads/2024/02/construction-payment-cycles.jpg',
            array_column($report->createdItems, 'featured_image'),
        );
        $this->assertEqualsCanonicalizing(
            [
                'ap-ar-automation-key-to-payment-fraud-reduction',
                'construction-payment-cycles',
            ],
            $report->createdSlugs,
        );

        $this->assertSame(3, PressRelease::query()->count());
        $this->assertNull(PressRelease::query()->where('slug', 'must-not-import')->first());

        $protected->refresh();
        $this->assertSame('MANUAL PROTECTED', $protected->title);
        $this->assertSame('<p>Do not change</p>', $protected->content[0]['data']['content'] ?? null);

        $normal = PressRelease::query()->where('slug', 'ap-ar-automation-key-to-payment-fraud-reduction')->first();
        $this->assertNotNull($normal);
        $this->assertSame('AP/AR Automation Key to Payment Fraud Reduction', $normal->title);
        $this->assertSame('published', $normal->status);
        $this->assertSame('default', $normal->template);
        $this->assertNull($normal->excerpt);
        $this->assertNull($normal->category_id);
        $this->assertSame('2024-01-24', $normal->published_at?->toDateString());
        $types = collect($normal->content)->pluck('type')->all();
        $this->assertContains('paragraph', $types);
        $this->assertContains('heading', $types);
        $this->assertNull($normal->seoMeta?->canonical_url);
        $this->assertFalse((bool) $normal->seoMeta?->schema_generated);
        $this->assertSame('article', $normal->seoMeta?->og_type);
        $this->assertTrue($normal->isImportedFromWordPress());

        $imagePost = PressRelease::query()->where('slug', 'construction-payment-cycles')->first();
        $this->assertNotNull($imagePost);
        $this->assertSame('2024-02-05', $imagePost->published_at?->toDateString());
        $this->assertFalse(collect($imagePost->content)->contains(fn (array $block): bool => ($block['type'] ?? '') === 'image'));
        if ($report->featuredDownloaded === 1) {
            $this->assertNotEmpty($imagePost->getFirstMediaUrl('featured_image'));
            $this->assertSame(0, $imagePost->getMedia('content_blocks')->count());
        }

        $this->assertSame(2, PressReleaseImport::query()->count());

        $second = app(PressReleaseImporter::class)->write($this->tempDir, $dateFile, [
            'ap-ar-automation-key-to-payment-fraud-reduction',
            'construction-payment-cycles',
        ]);
        $this->assertSame(0, $second->created);
        $this->assertSame(2, $second->skippedExisting);
        $this->assertSame(3, PressRelease::query()->count());
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

    protected function jpegBytes(): string
    {
        $image = imagecreatetruecolor(12, 12);
        imagefill($image, 0, 0, imagecolorallocate($image, 200, 80, 40));
        ob_start();
        imagejpeg($image, null, 90);
        imagedestroy($image);

        return (string) ob_get_clean();
    }
}
