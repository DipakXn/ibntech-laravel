<form wire:submit="submit" class="contact-form case-study-download-form">
    <input type="hidden" wire:model.defer="formName">
    <input type="hidden" wire:model.defer="pageUrl">
    <input type="hidden" wire:model.defer="caseStudySlug">
    <input type="hidden" wire:model.defer="caseStudyTitle">

    @if(! $compact)
        <div class="case-study-download-form__intro">
            <h3>Download This Case Study</h3>
            <p>Share your work details and get the full PDF for {{ $caseStudyTitle }}.</p>
        </div>
    @endif

    <div>
        <label class="sr-only" for="case-study-name-{{ $this->getId() }}">Full Name</label>
        <input id="case-study-name-{{ $this->getId() }}" type="text" wire:model.defer="name" placeholder="Full Name" autocomplete="name">
        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="sr-only" for="case-study-email-{{ $this->getId() }}">Business Email</label>
        <input id="case-study-email-{{ $this->getId() }}" type="email" wire:model.defer="email" placeholder="Business Email" autocomplete="email">
        @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <label class="contact-form__terms case-study-download-form__terms">
        <input type="checkbox" wire:model.defer="acceptedTerms">
        <span>
            By using our services, you agree to our
            <a href="{{ route('page.show', ['slug' => 'contact']) }}">Terms &amp; Conditions</a>
            and
            <a href="{{ route('page.show', ['slug' => 'contact']) }}">Privacy Policy</a>.
        </span>
    </label>
    @error('acceptedTerms') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    @error('download') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

    <button type="submit" class="contact-form__submit case-study-download-form__submit" wire:loading.attr="disabled" wire:target="submit">
        <span wire:loading.remove>Unlock PDF Download</span>
        <span wire:loading wire:target="submit">Submitting...</span>
    </button>

    @if($submitted)
        <div class="contact-form__success case-study-download-form__success">
            <p>Your request has been submitted.</p>
            @if($downloadUrl)
                <a href="{{ $downloadUrl }}" class="button-dark" target="_blank" rel="noopener">Download PDF</a>
            @endif
        </div>
    @endif
</form>
