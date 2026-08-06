<form wire:submit="submit" class="contact-form newsletter-form">
    <input type="hidden" wire:model="formName">
    <input type="hidden" wire:model="pageUrl">

    @if($submitted)
        <x-forms.success-alert title="Inquiry submitted">
            Thank you. Your inquiry has been submitted.
        </x-forms.success-alert>
    @endif

    <div>
        <label class="sr-only" for="newsletter-name">Full Name</label>
        <input id="newsletter-name" type="text" wire:model="name" placeholder="Full Name" autocomplete="name">
        @error('name') <p class="contact-form__error">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="sr-only" for="newsletter-company">Company Name</label>
        <input id="newsletter-company" type="text" wire:model="company" placeholder="Company Name" autocomplete="organization">
        @error('company') <p class="contact-form__error">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="sr-only" for="newsletter-email">Business Email</label>
        <input id="newsletter-email" type="email" wire:model="email" placeholder="Business Email" autocomplete="email">
        @error('email') <p class="contact-form__error">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="sr-only" for="newsletter-phone">Contact Number</label>
        <x-forms.phone-input id="newsletter-phone" model="phone" name="phone" placeholder="Contact Number" />
        @error('phone') <p class="contact-form__error">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="sr-only" for="newsletter-industry">Select Industry</label>
        <select id="newsletter-industry" wire:model="industry">
            <option value="">Select Industry</option>
            <option value="Cybersecurity">Cybersecurity</option>
            <option value="Cloud Services">Cloud Services</option>
            <option value="Finance and Accounting">Finance and Accounting</option>
            <option value="Construction and Real Estate">Construction and Real Estate</option>
            <option value="Healthcare">Healthcare</option>
            <option value="Manufacturing">Manufacturing</option>
            <option value="Other">Other</option>
        </select>
        @error('industry') <p class="contact-form__error">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="sr-only" for="newsletter-message">Describe your current security challenge</label>
        <textarea id="newsletter-message" wire:model="message" rows="4" placeholder="Describe your current security challenge..."></textarea>
        @error('message') <p class="contact-form__error">{{ $message }}</p> @enderror
    </div>

    <label class="newsletter-form__terms">
        <input type="checkbox" wire:model="acceptedTerms">
        <span>
            By using our services, you agree to our
            <a href="{{ route('page.show', ['slug' => 'contact']) }}">Privacy Policy</a>
            and
            <a href="{{ route('page.show', ['slug' => 'contact']) }}">Terms &amp; Conditions</a>.
        </span>
    </label>
    @error('acceptedTerms') <p class="contact-form__error">{{ $message }}</p> @enderror
 
    <x-forms.recaptcha errorClass="contact-form__error" />

    <button type="submit" class="newsletter-form__submit" wire:loading.attr="disabled" wire:target="submit">
        <span wire:loading.remove>Submit</span>
        <span wire:loading wire:target="submit">Sending...</span>
    </button>
</form>
