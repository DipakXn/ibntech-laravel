<?php

namespace App\Livewire\Forms;

use App\Services\LeadService;
use Livewire\Component;

class LeadForm extends Component
{
    public string $formName = 'lead';
    public string $pageUrl = '';
    public string $name = '';
    public string $email = '';
    public ?string $company = null;
    public bool $submitted = false;

    public function mount(): void
    {
        $this->pageUrl = url()->current();
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'company' => ['nullable', 'string', 'max:120'],
            'formName' => ['required', 'string', 'max:100'],
            'pageUrl' => ['required', 'url', 'max:2048'],
        ];
    }

    public function submit(LeadService $leadService): void
    {
        $validated = $this->validate();

        $leadService->createLead([
            ...$validated,
            'form_name' => $validated['formName'],
            'page_url' => $validated['pageUrl'],
        ], 'lead');

        $this->reset(['name', 'email', 'company']);
        $this->formName = 'lead';
        $this->pageUrl = url()->current();
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.forms.lead-form');
    }
}
