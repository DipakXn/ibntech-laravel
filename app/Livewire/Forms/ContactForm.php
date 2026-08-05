<?php

namespace App\Livewire\Forms;

use App\Livewire\Concerns\HasReCaptcha;
use App\Services\LeadService;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Throwable;

class ContactForm extends Component
{
    use HasReCaptcha;

    public string $formName = 'contact';

    public string $pageUrl = '';

    public string $idPrefix = 'contact';

    public string $name = '';

    public string $email = '';

    public ?string $phone = null;

    public ?string $company = null;

    public string $message = '';

    public bool $acceptedTerms = true;

    public bool $submitted = false;

    public bool $showCompany = true;

    public ?string $submitError = null;

    public function mount(
        bool $showCompany = true,
        string $formName = 'contact',
        string $idPrefix = 'contact',
    ): void {
        $this->showCompany = $showCompany;
        $this->formName = $formName;
        $this->idPrefix = $idPrefix;
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
            ...$this->getReCaptchaRules(),
        ];
    }

    public function submit(LeadService $leadService): void
    {
        $this->submitted = false;
        $this->submitError = null;

        try {
            $validated = $this->validate();

            unset($validated['acceptedTerms'], $validated['recaptchaToken']);

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
            $this->pageUrl = url()->current();
            $this->resetReCaptcha();
            $this->submitted = true;
            $this->dispatch('contact-form-submitted');
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            report($exception);
            $this->submitError = 'Something went wrong while sending your message. Please try again.';
        }
    }

    public function render()
    {
        return view('livewire.forms.contact-form');
    }
}
