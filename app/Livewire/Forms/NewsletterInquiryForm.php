<?php

namespace App\Livewire\Forms;

use App\Services\LeadService;
use Livewire\Component;

class NewsletterInquiryForm extends Component
{
    public string $formName = 'newsletter_inquiry';
    public string $pageUrl = '';
    public string $name = '';
    public ?string $company = null;
    public string $email = '';
    public ?string $phone = null;
    public string $industry = '';
    public string $message = '';
    public bool $acceptedTerms = true;
    public bool $submitted = false;

    public function mount(): void
    {
        $this->pageUrl = url()->current();
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^\+[1-9]\d{6,14}$/'],
            'industry' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'min:10'],
            'acceptedTerms' => ['accepted'],
            'formName' => ['required', 'string', 'max:100'],
            'pageUrl' => ['required', 'url', 'max:2048'],
        ];
    }

    public function submit(LeadService $leadService): void
    {
        $validated = $this->validate();

        unset($validated['acceptedTerms']);

        $leadService->createLead([
            ...$validated,
            'form_name' => $validated['formName'],
            'page_url' => $validated['pageUrl'],
        ], 'newsletter_inquiry');

        $this->reset(['name', 'company', 'email', 'phone', 'industry', 'message']);
        $this->acceptedTerms = true;
        $this->formName = 'newsletter_inquiry';
        $this->pageUrl = url()->current();
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.forms.newsletter-inquiry-form');
    }
}
