@php
    $fieldId = fn (string $name): string => $idPrefix.'-'.$name;
    $isStaffing = $showStaffingFields;
@endphp

<form
    wire:submit="submit"
    class="contact-form newsletter-form landing-inquiry-form{{ $isStaffing ? ' landing-inquiry-form--staffing' : '' }}"
    wire:loading.class="contact-form--loading"
    wire:target="submit"
    novalidate
>
    <div class="honeypot-field" aria-hidden="true">
        <label for="{{ $fieldId('website') }}">Website</label>
        <input
            id="{{ $fieldId('website') }}"
            type="text"
            name="website"
            wire:model="website"
            tabindex="-1"
            autocomplete="off"
        >
    </div>

    @if($submitError)
        <p class="contact-form__error contact-form__banner" role="alert">{{ $submitError }}</p>
    @endif

    @if($submitted)
        <x-forms.success-alert title="Request submitted">
            Thank you. Your message has been submitted.
        </x-forms.success-alert>
    @endif

    <div class="contact-form__field">
        <label class="sr-only" for="{{ $fieldId('name') }}">{{ $isStaffing ? 'Full Name' : 'Your Name' }}</label>
        <input id="{{ $fieldId('name') }}" type="text" wire:model="name" placeholder="{{ $isStaffing ? 'Full Name' : 'Your Name' }}" autocomplete="name">
        @error('name') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
    </div>

    @if($isStaffing)
        <div class="contact-form__field">
            <label class="sr-only" for="{{ $fieldId('email') }}">Business Email</label>
            <input id="{{ $fieldId('email') }}" type="email" wire:model="email" placeholder="Business Email" autocomplete="email">
            @error('email') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
        </div>
    @else
        <div class="contact-form__field">
            <label class="sr-only" for="{{ $fieldId('company') }}">Company Name</label>
            <input id="{{ $fieldId('company') }}" type="text" wire:model="company" placeholder="Company Name" autocomplete="organization">
            @error('company') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
        </div>
    @endif

    <div class="contact-form__field">
        <label class="sr-only" for="{{ $fieldId('phone') }}">Phone Number</label>
        <x-forms.phone-input
            :id="$fieldId('phone')"
            model="phone"
            name="phone"
            placeholder="Phone Number"
            :initial-country="$phoneCountry !== '' ? $phoneCountry : null"
        />
        @error('phone') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
    </div>

    @if($isStaffing)
        <div class="contact-form__field">
            <label class="sr-only" for="{{ $fieldId('resourceType') }}">Select Resource Type</label>
            <select id="{{ $fieldId('resourceType') }}" wire:model="resourceType" required>
                <option value="">Select Resource Type...</option>
                @foreach ($resourceTypeOptions as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            @error('resourceType') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
        </div>

        <div class="contact-form__field contact-form__field--full">
            <label class="sr-only" for="{{ $fieldId('service') }}">Select Service</label>
            <select id="{{ $fieldId('service') }}" wire:model="service" required>
                <option value="">Select Service...</option>
                @foreach ($serviceOptions as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            @error('service') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
        </div>
    @else
        <div class="contact-form__field">
            <label class="sr-only" for="{{ $fieldId('email') }}">Business Email ID</label>
            <input id="{{ $fieldId('email') }}" type="email" wire:model="email" placeholder="Business Email ID" autocomplete="email">
            @error('email') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
        </div>
    @endif

    <div class="contact-form__field contact-form__field--message">
        <label class="sr-only" for="{{ $fieldId('message') }}">{{ $isStaffing ? 'Project requirements' : 'Message' }}</label>
        <textarea
            id="{{ $fieldId('message') }}"
            wire:model="message"
            rows="4"
            placeholder="{{ $isStaffing ? 'Tell us about your project requirements...' : 'Message' }}"
            data-gramm="false"
            data-gramm_editor="false"
            data-enable-grammarly="false"
        ></textarea>
        @error('message') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
    </div>

    <label class="newsletter-form__terms">
        <input type="checkbox" wire:model="acceptedTerms">
        <span>
            By using our services, you agree to our
            <a href="{{ route('page.show', ['slug' => 'privacy-policy']) }}">Privacy Policy</a>
            and
            <a href="{{ route('page.show', ['slug' => 'terms-of-use']) }}">Terms &amp; Conditions</a>.
            <x-forms.messaging-consent-tooltip />
        </span>
    </label>
    @error('acceptedTerms') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror

    @if($withRecaptcha)
        <x-forms.recaptcha class="landing-inquiry-form__recaptcha" errorClass="contact-form__error" />
    @endif

    <button
        type="submit"
        class="newsletter-form__submit"
        wire:loading.attr="disabled"
        wire:target="submit"
    >
        <span wire:loading.remove wire:target="submit">Submit</span>
        <span wire:loading wire:target="submit">Sending...</span>
    </button>
</form>
