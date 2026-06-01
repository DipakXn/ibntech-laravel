<?php

namespace App\Livewire\Forms;

use App\Services\LeadService;
use Livewire\Component;

class ContactForm extends Component
{
    public string $formName = 'contact';
    public string $pageUrl = '';
    public string $name = '';
    public string $email = '';
    public ?string $phone = null;
    public ?string $company = null;
    public string $message = '';
    public bool $acceptedTerms = true;
    public bool $submitted = false;
    public bool $showCompany = true;

    public function mount(bool $showCompany = true): void
    {
        $this->showCompany = $showCompany;
        $this->pageUrl = url()->current();
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^\+[1-9]\d{6,14}$/'],
            'company' => ['nullable', 'string', 'max:120'],
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

        if (! $this->showCompany) {
            $validated['company'] = null;
        }

        $leadService->createLead([
            ...$validated,
            'form_name' => $validated['formName'],
            'page_url' => $validated['pageUrl'],
        ], 'contact');

        $this->reset(['name', 'email', 'phone', 'company', 'message']);
        $this->acceptedTerms = true;
        $this->formName = 'contact';
        $this->pageUrl = url()->current();
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.forms.contact-form');
    }
}
