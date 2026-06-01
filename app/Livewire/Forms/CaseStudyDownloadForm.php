<?php

namespace App\Livewire\Forms;

use App\Models\CaseStudy;
use App\Services\LeadService;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class CaseStudyDownloadForm extends Component
{
    public string $caseStudySlug = '';
    public string $caseStudyTitle = '';
    public string $formName = 'case_study_download';
    public string $pageUrl = '';
    public string $name = '';
    public string $email = '';
    public bool $acceptedTerms = true;
    public bool $submitted = false;
    public bool $compact = false;
    public ?string $downloadUrl = null;

    public function mount(string $caseStudySlug, string $caseStudyTitle, bool $compact = false): void
    {
        $this->caseStudySlug = $caseStudySlug;
        $this->caseStudyTitle = $caseStudyTitle;
        $this->compact = $compact;
        $this->pageUrl = url()->current();
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'acceptedTerms' => ['accepted'],
            'formName' => ['required', 'string', 'max:100'],
            'pageUrl' => ['required', 'url', 'max:2048'],
            'caseStudySlug' => ['required', 'string', 'max:255'],
            'caseStudyTitle' => ['required', 'string', 'max:255'],
        ];
    }

    public function submit(LeadService $leadService): void
    {
        $validated = $this->validate();
        $caseStudy = CaseStudy::query()
            ->published()
            ->where('slug', $validated['caseStudySlug'])
            ->first();

        if (! $caseStudy || ! $caseStudy->downloadPdfUrl()) {
            $this->addError('download', 'The download is not available for this case study yet.');

            return;
        }

        unset($validated['acceptedTerms']);

        $leadService->createLead([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'form_name' => $validated['formName'],
            'page_url' => $validated['pageUrl'],
            'asset_type' => 'case_study',
            'asset_slug' => $validated['caseStudySlug'],
            'asset_title' => $validated['caseStudyTitle'],
        ], 'case_study_download');

        $this->downloadUrl = URL::temporarySignedRoute(
            'case-studies.download',
            now()->addMinutes(30),
            ['slug' => $caseStudy->slug],
        );

        $this->reset(['name', 'email']);
        $this->acceptedTerms = true;
        $this->formName = 'case_study_download';
        $this->pageUrl = url()->current();
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.forms.case-study-download-form');
    }
}
