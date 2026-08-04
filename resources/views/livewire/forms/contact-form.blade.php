<form wire:submit="submit" class="contact-form">
    <input type="hidden" wire:model="formName">
    <input type="hidden" wire:model="pageUrl">
    <div>
        <label class="sr-only" for="contact-name">Full Name</label>
        <input id="contact-name" type="text" wire:model="name" placeholder="Full Name" autocomplete="name">
        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="sr-only" for="contact-email">Business Email</label>
        <input id="contact-email" type="email" wire:model="email" placeholder="Business Email" autocomplete="email">
        @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="sr-only" for="contact-phone">Contact Number</label>
        <x-forms.phone-input id="contact-phone" model="phone" name="phone" placeholder="Contact Number" />
        @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    @if($showCompany)
        <div>
            <label class="sr-only" for="contact-company">Company</label>
            <input id="contact-company" type="text" wire:model="company" placeholder="Company" autocomplete="organization">
            @error('company') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    @endif
    <div>
        <label class="sr-only" for="contact-message">Tell us how we can help</label>
        <textarea id="contact-message" wire:model="message" rows="5" placeholder="Tell us how we can help"></textarea>
        @error('message') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <label class="contact-form__terms">
        <input type="checkbox" wire:model="acceptedTerms">
        <span>
            By using our services, you agree to our
            <a href="{{ route('page.show', ['slug' => 'contact']) }}">Terms &amp; Conditions</a>
            and
            <a href="{{ route('page.show', ['slug' => 'contact']) }}">Privacy Policy</a>.
        </span>
    </label>
    @error('acceptedTerms') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

    <x-forms.recaptcha />

    <button type="submit" class="contact-form__submit" wire:loading.attr="disabled" wire:target="submit">
        <span wire:loading.remove>Submit</span>
        <span wire:loading wire:target="submit">Sending...</span>
    </button>
    @if($submitted)
        <p class="contact-form__success">Thank you. Your message has been submitted.</p>
    @endif
</form>
