<?php

namespace Tests\Feature;

use App\Jobs\SendCaseStudyThankYouMail;
use App\Jobs\SendLeadSubmissionNotification;
use App\Livewire\Forms\CaseStudyDownloadForm;
use App\Mail\CaseStudyThankYouMail;
use App\Models\CaseStudy;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class CaseStudyDownloadFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_case_study_form_shows_unlocked_success_message_and_queues_thank_you_email(): void
    {
        Queue::fake();

        $caseStudy = $this->publishedCaseStudyWithPdf();

        Livewire::test(CaseStudyDownloadForm::class, [
            'caseStudySlug' => $caseStudy->slug,
            'caseStudyTitle' => $caseStudy->title,
        ])
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('acceptedTerms', true)
            ->set('pageUrl', 'https://example.com/case-study/cloud-migration')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true)
            ->assertSee('Case study unlocked')
            ->assertSee('Download the full Case study PDF below.')
            ->assertDontSee('Request submitted')
            ->assertDontSee('Your request has been submitted.');

        $this->assertDatabaseHas('form_submissions', [
            'email' => 'jane@example.com',
            'form_name' => 'case_study_download',
            'page_url' => 'https://example.com/case-study/cloud-migration',
        ]);

        $lead = Lead::query()->where('email', 'jane@example.com')->first();

        $this->assertNotNull($lead);
        $this->assertSame('Cloud Migration', data_get($lead->payload, 'asset_title'));

        Queue::assertPushed(SendLeadSubmissionNotification::class, 1);
        Queue::assertPushed(
            SendCaseStudyThankYouMail::class,
            fn (SendCaseStudyThankYouMail $job): bool => $job->submissionId === $lead->id,
        );
    }

    public function test_thank_you_job_sends_mail_to_the_submitter(): void
    {
        Mail::fake();

        $lead = Lead::query()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'form_name' => 'case_study_download',
            'page_url' => 'https://example.com/case-study/cloud-migration',
            'payload' => [
                'asset_type' => 'case_study',
                'asset_slug' => 'cloud-migration',
                'asset_title' => 'Cloud Migration',
            ],
        ]);

        (new SendCaseStudyThankYouMail($lead->id))->handle();

        Mail::assertSent(CaseStudyThankYouMail::class, function (CaseStudyThankYouMail $mail) use ($lead): bool {
            return $mail->hasTo('jane@example.com')
                && $mail->lead->is($lead);
        });
    }

    public function test_thank_you_email_includes_unlocked_copy(): void
    {
        $lead = Lead::query()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'form_name' => 'case_study_download',
            'payload' => [
                'asset_title' => 'Cloud Migration',
            ],
        ]);

        $mail = new CaseStudyThankYouMail($lead);

        $this->assertSame('Thank you for unlocking Cloud Migration', $mail->envelope()->subject);

        $html = $mail->render();

        $this->assertStringContainsString('Thank You', $html);
        $this->assertStringContainsString('Case study unlocked', $html);
        $this->assertStringContainsString('Hi Jane Doe', $html);
        $this->assertStringContainsString('Cloud Migration', $html);
        $this->assertStringContainsString('download the full Case study PDF', $html);
    }

    private function publishedCaseStudyWithPdf(): CaseStudy
    {
        Storage::fake('media');

        $caseStudy = CaseStudy::query()->create([
            'title' => 'Cloud Migration',
            'slug' => 'cloud-migration',
            'template' => 'default',
            'excerpt' => 'A delivery story.',
            'content' => [],
            'status' => 'published',
        ]);

        $caseStudy
            ->addMedia(UploadedFile::fake()->create('case-study.pdf', 120, 'application/pdf'))
            ->toMediaCollection('download_pdf');

        return $caseStudy->fresh();
    }
}
