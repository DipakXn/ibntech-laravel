<?php

namespace App\Livewire\Forms;

use App\Livewire\Concerns\HasReCaptcha;
use App\Services\LeadService;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Throwable;

class ConstructionConsultationForm extends Component
{
    use HasReCaptcha;

    public const LOOKING_FOR_DETAILED = 'Construction Engineering & Back Office Support';

    public const LOOKING_FOR_OPTIONS = [
        self::LOOKING_FOR_DETAILED,
        'Not sure',
    ];

    public const NEEDED_SERVICE_OPTIONS = [
        'Estimation & Takeoffs',
        'Project Engineering Support',
        'Cost Engineer',
        'Drafting / Drawing Service',
        'Bid Management',
        'Not sure',
    ];

    public const RESOURCE_TYPE_OPTIONS = [
        'Full-Time Dedicated Resource',
        'Part-Time / Hourly-based',
        'Not sure – need guidance',
    ];

    public const HIRE_WHEN_OPTIONS = [
        '2–4 weeks',
        '1–2 months',
        'Just exploring',
    ];

    public string $formName = 'free-consultation-for-construction';

    public string $pageUrl = '';

    public string $idPrefix = 'fccons';

    public int $step = 1;

    public string $name = '';

    public string $email = '';

    public ?string $phone = null;

    public ?string $lookingFor = null;

    public ?string $neededService = null;

    public ?string $resourceType = null;

    public ?string $hireWhen = null;

    public string $message = '';

    public bool $acceptedTerms = true;

    public bool $submitted = false;

    public ?string $submitError = null;

    public function mount(string $formName = 'free-consultation-for-construction', string $idPrefix = 'fccons'): void
    {
        $this->formName = $formName !== '' ? $formName : 'free-consultation-for-construction';
        $this->idPrefix = $idPrefix !== '' ? $idPrefix : 'fccons';
        $this->pageUrl = url()->current();
    }

    public function needsDetailedRequirements(): bool
    {
        return $this->lookingFor === self::LOOKING_FOR_DETAILED;
    }

    public function needsHireWhen(): bool
    {
        return is_string($this->lookingFor) && $this->lookingFor !== '';
    }

    public function updatedLookingFor(?string $value): void
    {
        $this->lookingFor = is_string($value) && $value !== '' ? $value : null;

        if (! $this->needsDetailedRequirements()) {
            $this->neededService = null;
            $this->resourceType = null;
            $this->resetErrorBag(['neededService', 'resourceType']);
        }

        if (! $this->needsHireWhen()) {
            $this->hireWhen = null;
            $this->resetErrorBag(['hireWhen']);
        }
    }

    public function nextStep(): void
    {
        if ($this->step === 1) {
            $this->validate($this->stepOneRules());
            $this->step = 2;
            $this->resetErrorBag();

            return;
        }

        if ($this->step === 2) {
            $this->validate($this->stepTwoRules());
            $this->step = 3;
            $this->resetErrorBag();
        }
    }

    public function previousStep(): void
    {
        $this->step = max(1, $this->step - 1);
        $this->resetErrorBag();
    }

    /**
     * @return array<string, list<mixed>>
     */
    protected function stepOneRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^\+[1-9]\d{6,14}$/'],
            'lookingFor' => ['required', 'string', Rule::in(self::LOOKING_FOR_OPTIONS)],
        ];
    }

    /**
     * @return array<string, list<mixed>>
     */
    protected function stepTwoRules(): array
    {
        $detailed = $this->needsDetailedRequirements();

        return [
            ...$this->stepOneRules(),
            'neededService' => $this->conditionalSelectRules($detailed, self::NEEDED_SERVICE_OPTIONS),
            'resourceType' => $this->conditionalSelectRules($detailed, self::RESOURCE_TYPE_OPTIONS),
            'hireWhen' => $this->conditionalSelectRules($this->needsHireWhen(), self::HIRE_WHEN_OPTIONS),
        ];
    }

    /**
     * @return array<string, list<mixed>>
     */
    protected function stepThreeRules(): array
    {
        return [
            ...$this->stepTwoRules(),
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'acceptedTerms' => ['accepted'],
            'formName' => ['required', 'string', 'max:100'],
            'pageUrl' => ['required', 'url', 'max:2048'],
            ...$this->getReCaptchaRules(),
        ];
    }

    /**
     * @param  list<string>  $options
     * @return list<mixed>
     */
    protected function conditionalSelectRules(bool $required, array $options): array
    {
        $rules = [
            $required ? 'required' : 'nullable',
            'string',
            'max:120',
        ];

        if ($required) {
            $rules[] = Rule::in($options);
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'phone.required' => 'Enter a valid phone number including the country code.',
            'phone.regex' => 'Enter a valid phone number including the country code.',
            'lookingFor.required' => 'Please select what you are looking for.',
            'neededService.required' => 'Please select a service.',
            'resourceType.required' => 'Please select a resource type.',
            'hireWhen.required' => 'Please select when you want to hire.',
        ];
    }

    public function submit(LeadService $leadService): void
    {
        if ($this->step < 3) {
            $this->nextStep();

            return;
        }

        $this->submitted = false;
        $this->submitError = null;

        if (! $this->needsDetailedRequirements()) {
            $this->neededService = null;
            $this->resourceType = null;
        }

        if (! $this->needsHireWhen()) {
            $this->hireWhen = null;
        }

        try {
            $validated = $this->validate($this->stepThreeRules());

            unset($validated['acceptedTerms'], $validated['recaptchaToken']);

            $leadService->createLead([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'company' => null,
                'message' => $validated['message'],
                'form_name' => $validated['formName'],
                'page_url' => $validated['pageUrl'],
                'service' => $validated['lookingFor'],
                'looking_for' => $validated['lookingFor'],
                'needed_service' => $this->needsDetailedRequirements() ? ($validated['neededService'] ?? null) : null,
                'resource_type' => $this->needsDetailedRequirements() ? ($validated['resourceType'] ?? null) : null,
                'hire_when' => $validated['hireWhen'] ?? null,
            ], $this->formName);

            $this->reset([
                'name',
                'email',
                'phone',
                'lookingFor',
                'neededService',
                'resourceType',
                'hireWhen',
                'message',
                'step',
            ]);
            $this->step = 1;
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
        return view('livewire.forms.construction-consultation-form');
    }
}
