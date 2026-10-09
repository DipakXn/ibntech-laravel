<?php

namespace Tests\Feature;

use App\Jobs\SendEbookThankYouMail;
use App\Jobs\SendLeadSubmissionNotification;
use App\Livewire\Forms\EbookDownloadForm;
use App\Mail\EbookThankYouMail;
use App\Models\Ebook;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class EbookDownloadFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_ebook_form_shows_unlocked_success_message_and_queues_thank_you_email(): void
    {
        Queue::fake();

        $ebook = $this->publishedEbookWithPdf();

        Livewire::test(EbookDownloadForm::class, [
            'ebookSlug' => $ebook->slug,
            'ebookTitle' => $ebook->title,
        ])
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('acceptedTerms', true)
            ->set('pageUrl', 'https://example.com/ebook/cloud-playbook')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true)
            ->assertSee('eBook unlocked')
            ->assertSee('Download the full eBook PDF below.')
            ->assertDontSee('Request submitted')
            ->assertDontSee('Your download is ready.');

        $this->assertDatabaseHas('form_submissions', [
            'email' => 'jane@example.com',
            'form_name' => 'ebook_download',
            'page_url' => 'https://example.com/ebook/cloud-playbook',
        ]);

        $lead = Lead::query()->where('email', 'jane@example.com')->first();

        $this->assertNotNull($lead);
        $this->assertSame('Cloud Playbook', data_get($lead->payload, 'asset_title'));

        Queue::assertPushed(SendLeadSubmissionNotification::class, 1);
        Queue::assertPushed(
            SendEbookThankYouMail::class,
            fn (SendEbookThankYouMail $job): bool => $job->submissionId === $lead->id,
        );
    }

    public function test_thank_you_job_sends_mail_to_the_submitter(): void
    {
        Mail::fake();

        $lead = Lead::query()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'form_name' => 'ebook_download',
            'page_url' => 'https://example.com/ebook/cloud-playbook',
            'payload' => [
                'asset_type' => 'ebook',
                'asset_slug' => 'cloud-playbook',
                'asset_title' => 'Cloud Playbook',
            ],
        ]);

        (new SendEbookThankYouMail($lead->id))->handle();

        Mail::assertSent(EbookThankYouMail::class, function (EbookThankYouMail $mail) use ($lead): bool {
            return $mail->hasTo('jane@example.com')
                && $mail->lead->is($lead);
        });
    }

    public function test_thank_you_email_includes_unlocked_copy(): void
    {
        $lead = Lead::query()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'form_name' => 'ebook_download',
            'payload' => [
                'asset_title' => 'Cloud Playbook',
            ],
        ]);

        $mail = new EbookThankYouMail($lead);

        $this->assertSame('Thank you for unlocking Cloud Playbook', $mail->envelope()->subject);

        $html = $mail->render();

        $this->assertStringContainsString('Thank You', $html);
        $this->assertStringContainsString('eBook unlocked', $html);
        $this->assertStringContainsString('Hi Jane Doe', $html);
        $this->assertStringContainsString('Cloud Playbook', $html);
        $this->assertStringContainsString('download the full eBook PDF', $html);
    }

    private function publishedEbookWithPdf(): Ebook
    {
        Storage::fake('media');

        $ebook = Ebook::query()->create([
            'title' => 'Cloud Playbook',
            'slug' => 'cloud-playbook',
            'template' => 'default',
            'excerpt' => 'A delivery playbook.',
            'content' => [],
            'status' => 'published',
        ]);

        $ebook
            ->addMedia(UploadedFile::fake()->create('ebook.pdf', 120, 'application/pdf'))
            ->toMediaCollection('download_pdf');

        return $ebook->fresh();
    }
}
