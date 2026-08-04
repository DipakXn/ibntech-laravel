<form wire:submit="submit" class="contact-form case-study-download-form">
    <input type="hidden" wire:model="formName">
    <input type="hidden" wire:model="pageUrl">

    @if($ebookSlug !== '')
        <input type="hidden" wire:model="ebookSlug">
        <input type="hidden" wire:model="ebookTitle">
    @endif

    @if(! $submitted)
        <div class="case-study-download-form__intro">
            <h3>{{ $ebookSlug !== '' ? 'Download This eBook' : 'Get This eBook' }}</h3>
            <p>
                {{ $ebookSlug !== '' ? 'Enter your details to unlock the PDF instantly.' : 'Share your details and we will follow up with the resource.' }}
            </p>
        </div>
    @endif

    <label class="sr-only" for="ebook-name-{{ $this->getId() }}">Full Name</label>
    <input id="ebook-name-{{ $this->getId() }}" type="text" wire:model="name" placeholder="Full Name" autocomplete="name">
    @error('name') <p class="contact-form__error">{{ $message }}</p> @enderror

    <label class="sr-only" for="ebook-email-{{ $this->getId() }}">Business Email</label>
    <input id="ebook-email-{{ $this->getId() }}" type="email" wire:model="email" placeholder="Business Email" autocomplete="email">
    @error('email') <p class="contact-form__error">{{ $message }}</p> @enderror

    <label class="contact-form__terms case-study-download-form__terms">
        <input type="checkbox" wire:model="acceptedTerms">
        <span>I agree to be contacted about this resource and related services.</span>
    </label>
    @error('acceptedTerms') <p class="contact-form__error">{{ $message }}</p> @enderror
    @error('download') <p class="contact-form__error">{{ $message }}</p> @enderror

    <x-forms.recaptcha errorClass="contact-form__error" />

    <button type="submit" class="contact-form__submit case-study-download-form__submit" wire:loading.attr="disabled" wire:target="submit">
        {{ $ebookSlug !== '' ? 'Get The eBook' : 'Submit' }}
    </button>

    @if($submitted)
        <div class="contact-form__success case-study-download-form__success">
            @if($downloadUrl)
                <p>Your download is ready. <a href="{{ $downloadUrl }}" target="_blank" rel="noopener">Open the PDF</a>.</p>
            @else
                <p>Your request is submitted. Check your inbox shortly.</p>
            @endif
        </div>
    @endif
</form>
