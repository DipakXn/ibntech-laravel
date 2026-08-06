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

    public ?string $service = null;

    public string $message = '';

    public bool $acceptedTerms = true;

    public bool $submitted = false;

    public bool $showCompany = true;

    public bool $showService = false;

    /** @var 'default'|'home'|'modal' */
    public string $layout = 'default';

    public ?string $submitError = null;

    /**
     * @var list<string>
     */
    public array $serviceOptions = [
        'Cybersecurity',
        'Cloud',
        'Finance & Accounting',
        'Automation',
        'BPO',
        'Other',
    ];

    public function mount(
        bool $showCompany = true,
        bool $showService = false,
        string $layout = 'default',
        string $formName = 'contact',
        string $idPrefix = 'contact',
    ): void {
        $this->showCompany = $showCompany;
        $this->showService = $showService;
        $this->layout = in_array($layout, ['default', 'home', 'modal'], true) ? $layout : 'default';
        $this->formName = $formName;
        $this->idPrefix = $idPrefix;
        $this->pageUrl = url()->current();
    }

    public function isCompactLayout(): bool
    {
        return in_array($this->layout, ['home', 'modal'], true);
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^\+[1-9]\d{6,14}$/'],
            'company' => ['nullable', 'string', 'max:120'],
            'service' => [$this->showService ? 'required' : 'nullable', 'string', 'max:120'],
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

            if (! $this->showService) {
                $validated['service'] = null;
            }

            $leadService->createLead([
                ...$validated,
                'form_name' => $validated['formName'],
                'page_url' => $validated['pageUrl'],
            ], 'contact');

            $this->reset(['name', 'email', 'phone', 'company', 'service', 'message']);
            $this->acceptedTerms = true;
            $this->pageUrl = url()->current();
            $this->resetReCaptcha();
            $this->submitted = true;
            $this->dispatch('contact-form-submitted');
            $this->dispatch('form-success-revealed');
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
