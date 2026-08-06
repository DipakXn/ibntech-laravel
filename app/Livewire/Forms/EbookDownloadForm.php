<?php

namespace App\Livewire\Forms;

use App\Livewire\Concerns\HasReCaptcha;
use App\Models\Ebook;
use App\Services\LeadService;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class EbookDownloadForm extends Component
{
    use HasReCaptcha;
    public string $ebookSlug = '';
    public string $ebookTitle = '';
    public string $formName = 'ebook_download';
    public string $pageUrl = '';
    public string $name = '';
    public string $email = '';
    public bool $acceptedTerms = true;
    public bool $submitted = false;
    public bool $compact = false;
    public ?string $downloadUrl = null;

    public function mount(string $ebookSlug = '', string $ebookTitle = '', bool $compact = false): void
    {
        $this->ebookSlug = $ebookSlug;
        $this->ebookTitle = $ebookTitle;
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
            'ebookSlug' => ['nullable', 'string', 'max:255'],
            'ebookTitle' => ['nullable', 'string', 'max:255'],
            ...$this->getReCaptchaRules(),
        ];
    }

    public function submit(LeadService $leadService): void
    {
        $validated = $this->validate();

        $ebook = null;

        if ($validated['ebookSlug'] !== '') {
            $ebook = Ebook::query()
                ->published()
                ->where('slug', $validated['ebookSlug'])
                ->first();

            if (! $ebook || ! $ebook->downloadPdfUrl()) {
                $this->addError('download', 'The download is not available for this eBook yet.');

                return;
            }
        }

        unset($validated['acceptedTerms']);
        unset($validated['recaptchaToken']);

        $leadService->createLead([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'form_name' => $validated['formName'],
            'page_url' => $validated['pageUrl'],
            'asset_type' => $ebook ? 'ebook' : null,
            'asset_slug' => $validated['ebookSlug'] ?: null,
            'asset_title' => $validated['ebookTitle'] ?: null,
        ], 'ebook_download');

        if ($ebook) {
            $this->downloadUrl = URL::temporarySignedRoute(
                'ebooks.download',
                now()->addMinutes(30),
                ['slug' => $ebook->slug],
            );
        }

        $this->reset(['name', 'email']);
        $this->acceptedTerms = true;
        $this->formName = 'ebook_download';
        $this->pageUrl = url()->current();
        $this->resetReCaptcha();
        $this->submitted = true;
        $this->dispatch('form-success-revealed');
    }

    public function render()
    {
        return view('livewire.forms.ebook-download-form');
    }
}
