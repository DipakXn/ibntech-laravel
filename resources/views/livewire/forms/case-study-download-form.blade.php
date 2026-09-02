<form wire:submit="submit" class="contact-form case-study-download-form">
    <input type="hidden" wire:model="formName">
    <input type="hidden" wire:model="pageUrl">
    <input type="hidden" wire:model="caseStudySlug">
    <input type="hidden" wire:model="caseStudyTitle">

    @if($submitted)
        <x-forms.success-alert title="Case study unlocked">
            @if($downloadUrl)
                <x-slot:actions>
                    <a href="{{ $downloadUrl }}" class="form-success__button button-dark" target="_blank" rel="noopener">Download PDF</a>
                </x-slot:actions>
            @endif
            Download the full Case study PDF below.
        </x-forms.success-alert>
    @endif

    @if(! $compact)
        <div class="case-study-download-form__intro">
            <h3>Download This Case Study</h3>
            <p>Share your work details and get the full PDF for {{ $caseStudyTitle }}.</p>
        </div>
    @endif

    <div>
        <label class="sr-only" for="case-study-name-{{ $this->getId() }}">Full Name</label>
        <input id="case-study-name-{{ $this->getId() }}" type="text" wire:model="name" placeholder="Full Name" autocomplete="name">
        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="sr-only" for="case-study-email-{{ $this->getId() }}">Business Email</label>
        <input id="case-study-email-{{ $this->getId() }}" type="email" wire:model="email" placeholder="Business Email" autocomplete="email">
        @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <label class="contact-form__terms case-study-download-form__terms">
        <input type="checkbox" wire:model="acceptedTerms">
        <span>
            By using our services, you agree to our
            <a href="{{ route('page.show', ['slug' => 'terms-of-use']) }}">Terms &amp; Conditions</a>
            and
            <a href="{{ route('page.show', ['slug' => 'privacy-policy']) }}">Privacy Policy</a>.
            <x-forms.messaging-consent-tooltip />
        </span>
    </label>
    @error('acceptedTerms') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    @error('download') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

    <x-forms.recaptcha />

    <button type="submit" class="contact-form__submit case-study-download-form__submit" wire:loading.attr="disabled" wire:target="submit">
        <span wire:loading.remove>Unlock PDF Download</span>
        <span wire:loading wire:target="submit">Submitting...</span>
    </button>
</form>
