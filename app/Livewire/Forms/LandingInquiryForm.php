<?php

namespace App\Livewire\Forms;

use App\Livewire\Concerns\HasReCaptcha;
use App\Models\LandingPage;
use App\Repositories\LeadRepository;
use App\Services\LeadService;
use App\Support\PathPageUrl;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Throwable;

class LandingInquiryForm extends Component
{
    use HasReCaptcha;

    public ?string $thankYouUrl = null;

    #[Locked]
    public string $landingPageSlug = '';

    #[Locked]
    public string $landingPageTitle = '';

    #[Locked]
    public string $formName = '';

    #[Locked]
    public int $formLoadedAt = 0;

    #[Locked]
    public bool $withRecaptcha = false;

    #[Locked]
    public bool $showStaffingFields = false;

    public string $idPrefix = 'landing';

    #[Locked]
    public string $phoneCountry = '';

    /**
     * @var list<string>
     */
    #[Locked]
    public array $resourceTypeOptions = [];

    /**
     * @var list<string>
     */
    #[Locked]
    public array $serviceOptions = [];

    public string $pageUrl = '';

    public string $name = '';

    public string $email = '';

    public ?string $phone = null;

    public ?string $company = null;

    public ?string $resourceType = null;

    public ?string $service = null;

    public string $message = '';

    public bool $acceptedTerms = true;

    public string $website = '';

    public bool $submitted = false;

    public ?string $submitError = null;

    /**
     * @param  list<string>|null  $resourceTypeOptions
     * @param  list<string>|null  $serviceOptions
     */
    public function mount(
        string $landingPageSlug,
        string $landingPageTitle,
        string $idPrefix = 'landing',
        bool $withRecaptcha = false,
        string $phoneCountry = '',
        bool $showStaffingFields = false,
        ?array $resourceTypeOptions = null,
        ?array $serviceOptions = null,
        ?string $thankYouUrl = null,
    ): void {
        $this->landingPageSlug = $landingPageSlug;
        $this->landingPageTitle = $landingPageTitle;
        $this->formName = 'lp-'.$landingPageSlug;
        $this->idPrefix = $idPrefix !== '' ? $idPrefix : 'landing';
        $this->withRecaptcha = $withRecaptcha;
        $this->phoneCountry = strtolower(trim($phoneCountry));
        $this->showStaffingFields = $showStaffingFields;
        $this->resourceTypeOptions = $this->normalizeOptions($resourceTypeOptions);
        $this->serviceOptions = $this->normalizeOptions($serviceOptions);
        if (is_string($thankYouUrl) && trim($thankYouUrl) !== '') {
            $this->thankYouUrl = trim($thankYouUrl);
        }
        $this->pageUrl = url()->current();
        $this->formLoadedAt = time();
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^\+[1-9]\d{6,14}$/'],
            'company' => [$this->showStaffingFields ? 'nullable' : 'required', 'string', 'max:120'],
            'resourceType' => $this->optionalSelectRules($this->showStaffingFields, $this->resourceTypeOptions),
            'service' => $this->optionalSelectRules($this->showStaffingFields, $this->serviceOptions),
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'acceptedTerms' => ['accepted'],
            'formName' => ['required', 'string', 'max:100'],
            'pageUrl' => ['required', 'url', 'max:2048'],
            'landingPageSlug' => ['required', 'string', 'max:255'],
            'landingPageTitle' => ['required', 'string', 'max:255'],
            ...($this->withRecaptcha ? $this->getReCaptchaRules() : []),
        ];
    }

    protected function messages(): array
    {
        return [
            'phone.regex' => 'Enter a valid phone number including the country code.',
        ];
    }

    public function submit(LeadService $leadService, LeadRepository $leads): void
    {
        $this->submitted = false;
        $this->submitError = null;
        $this->sanitizeInput();

        if ($this->isAutomatedSubmission()) {
            $landingPage = LandingPage::query()
                ->published()
                ->where('slug', $this->landingPageSlug)
                ->first();

            $this->completeSuccessfully($landingPage);

            return;
        }

        $validated = $this->validate();

        if ($this->isRateLimited()) {
            $this->addError('email', 'Too many submissions. Please try again shortly.');

            return;
        }

        RateLimiter::hit($this->rateLimitKey(), 60);

        $landingPage = LandingPage::query()
            ->published()
            ->where('slug', $validated['landingPageSlug'])
            ->first();

        if (! $landingPage || $landingPage->isThankYouPage()) {
            $this->addError('email', 'This form is no longer available.');

            return;
        }

        $email = strtolower((string) $validated['email']);

        if ($leads->hasRecentDuplicate($email, $landingPage->formName(), request()->ip())) {
            $this->completeSuccessfully($landingPage);

            return;
        }

        unset($validated['acceptedTerms']);

        if ($this->withRecaptcha) {
            unset($validated['recaptchaToken']);
        }

        try {
            $leadService->createLead([
                'name' => $validated['name'],
                'email' => $email,
                'phone' => $validated['phone'],
                'company' => $this->showStaffingFields ? null : $validated['company'],
                'message' => $validated['message'],
                'form_name' => $landingPage->formName(),
                'page_url' => $validated['pageUrl'],
                'landing_page_slug' => $landingPage->slug,
                'landing_page_title' => $landingPage->title,
                ...($this->showStaffingFields ? [
                    'resource_type' => $validated['resourceType'] ?? null,
                    'service' => $validated['service'] ?? null,
                ] : []),
            ], $landingPage->formName());
        } catch (Throwable $exception) {
            report($exception);
            $this->submitError = 'Something went wrong while sending your message. Please try again.';

            if ($this->withRecaptcha) {
                $this->resetReCaptcha();
            }

            return;
        }

        $this->reset(['name', 'email', 'phone', 'company', 'resourceType', 'service', 'message', 'website']);
        $this->acceptedTerms = true;
        $this->completeSuccessfully($landingPage);
    }

    protected function sanitizeInput(): void
    {
        $this->name = $this->sanitizeString($this->name);
        $this->email = strtolower($this->sanitizeString($this->email));
        $this->phone = $this->phone !== null ? $this->sanitizeString($this->phone) : null;
        $this->company = $this->company !== null ? $this->sanitizeString($this->company) : null;
        $this->resourceType = $this->resourceType !== null ? $this->sanitizeString($this->resourceType) : null;
        $this->service = $this->service !== null ? $this->sanitizeString($this->service) : null;
        $this->message = $this->sanitizeString($this->message);
        $this->website = $this->sanitizeString($this->website);
    }

    protected function sanitizeString(?string $value): string
    {
        return trim(strip_tags((string) $value));
    }

    /**
     * @param  list<string>|null  $options
     * @return list<string>
     */
    protected function normalizeOptions(?array $options): array
    {
        if (! is_array($options) || $options === []) {
            return [];
        }

        return array_values(array_filter(
            $options,
            static fn (mixed $option): bool => is_string($option) && $option !== ''
        ));
    }

    /**
     * @param  list<string>  $options
     * @return list<mixed>
     */
    protected function optionalSelectRules(bool $required, array $options): array
    {
        $rules = [
            $required ? 'required' : 'nullable',
            'string',
            'max:120',
        ];

        if ($required && $options !== []) {
            $rules[] = Rule::in($options);
        }

        return $rules;
    }

    protected function isAutomatedSubmission(): bool
    {
        if ($this->website !== '') {
            return true;
        }

        if (app()->runningUnitTests()) {
            return false;
        }

        return (time() - $this->formLoadedAt) < 2;
    }

    protected function isRateLimited(): bool
    {
        return RateLimiter::tooManyAttempts($this->rateLimitKey(), 5);
    }

    protected function rateLimitKey(): string
    {
        return 'landing-inquiry:'.request()->ip();
    }

    public function publishedThankYouUrl(): ?string
    {
        if (! is_string($this->thankYouUrl) || trim($this->thankYouUrl) === '') {
            return null;
        }

        return PathPageUrl::withTrailingSlash(url(trim($this->thankYouUrl)));
    }

    protected function completeSuccessfully(?LandingPage $landingPage = null): void
    {
        $thankYouUrl = $this->publishedThankYouUrl();

        if ($thankYouUrl) {
            $this->redirect($thankYouUrl);

            return;
        }

        $this->submitted = true;
        $this->dispatch('form-success-revealed');

        if ($this->withRecaptcha) {
            $this->resetReCaptcha();
        }
    }

    public function render()
    {
        return view('livewire.forms.landing-inquiry-form');
    }
}
