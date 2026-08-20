@php
    $fieldId = fn (string $name): string => $idPrefix.'-'.$name;
    $isCompact = $this->isCompactLayout();
    $isHomeLayout = $layout === 'home';
    $isModalLayout = $layout === 'modal';
    $isVaptLayout = $layout === 'vapt';
@endphp

<form
    wire:submit="submit"
    class="contact-form{{ $isCompact ? ' contact-form--compact' : '' }}{{ $isModalLayout ? ' contact-form--modal' : '' }}{{ $isVaptLayout ? ' contact-form--vapt' : '' }}"
    wire:loading.class="contact-form--loading"
    wire:target="submit"
>
    <input type="hidden" wire:model="formName">
    <input type="hidden" wire:model="pageUrl">

    @if($submitError)
        <p class="contact-form__error contact-form__banner" role="alert">{{ $submitError }}</p>
    @endif

    @if($submitted)
        <x-forms.success-alert title="Message submitted">
            Thank you. Your message has been submitted.
        </x-forms.success-alert>
    @endif

    <div class="contact-form__row">
        <div class="contact-form__field">
            <label class="sr-only" for="{{ $fieldId('name') }}">Full Name</label>
            <input id="{{ $fieldId('name') }}" type="text" wire:model="name" placeholder="Full Name" autocomplete="name">
            @error('name') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
        </div>
        <div class="contact-form__field">
            <label class="sr-only" for="{{ $fieldId('email') }}">Business Email</label>
            <input id="{{ $fieldId('email') }}" type="email" wire:model="email" placeholder="Business Email" autocomplete="email">
            @error('email') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
        </div>
    </div>

    @if($isHomeLayout && $showService)
        <div class="contact-form__row">
            <div class="contact-form__field">
                <label class="sr-only" for="{{ $fieldId('phone') }}">Contact Number</label>
                <x-forms.phone-input :id="$fieldId('phone')" model="phone" name="phone" placeholder="Contact Number" />
                @error('phone') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
            </div>
            <div class="contact-form__field">
                <label class="sr-only" for="{{ $fieldId('service') }}">Select Service</label>
                <select id="{{ $fieldId('service') }}" wire:model="service">
                    <option value="">{{ $servicePlaceholder }}</option>
                    @foreach ($serviceOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
                @error('service') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
            </div>
        </div>
    @elseif($isVaptLayout || ($isModalLayout && $showCompany))
        <div class="contact-form__row">
            <div class="contact-form__field">
                <label class="sr-only" for="{{ $fieldId('phone') }}">Contact Number</label>
                <x-forms.phone-input :id="$fieldId('phone')" model="phone" name="phone" placeholder="Contact Number" />
                @error('phone') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
            </div>
            <div class="contact-form__field">
                <label class="sr-only" for="{{ $fieldId('company') }}">Company</label>
                <input id="{{ $fieldId('company') }}" type="text" wire:model="company" placeholder="Company Name" autocomplete="organization">
                @error('company') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
            </div>
        </div>

        @if($isVaptLayout && $showService)
            <div class="contact-form__field">
                <label class="sr-only" for="{{ $fieldId('service') }}">Select Service</label>
                <select id="{{ $fieldId('service') }}" wire:model="service">
                    <option value="">{{ $servicePlaceholder }}</option>
                    @foreach ($serviceOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
                @error('service') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
            </div>
        @endif
    @else
        <div class="contact-form__field">
            <label class="sr-only" for="{{ $fieldId('phone') }}">{{ $isModalLayout ? 'Phone Number' : 'Contact Number' }}</label>
            <x-forms.phone-input
                :id="$fieldId('phone')"
                model="phone"
                name="phone"
                :placeholder="$isModalLayout ? 'Phone Number' : 'Contact Number'"
            />
            @error('phone') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
        </div>

        @if($showService)
            <div class="contact-form__field">
                <label class="sr-only" for="{{ $fieldId('service') }}">{{ $servicePlaceholder }}</label>
                <select id="{{ $fieldId('service') }}" wire:model="service">
                    <option value="">{{ $servicePlaceholder }}</option>
                    @foreach ($serviceOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
                @error('service') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
            </div>
        @endif
    @endif

    @if($showCompany && ! $isModalLayout && ! $isVaptLayout)
        <div class="contact-form__field">
            <label class="sr-only" for="{{ $fieldId('company') }}">Company</label>
            <input id="{{ $fieldId('company') }}" type="text" wire:model="company" placeholder="Company" autocomplete="organization">
            @error('company') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
        </div>
    @endif

    <div class="contact-form__field contact-form__field--message">
        <label class="sr-only" for="{{ $fieldId('message') }}">Tell us how we can help</label>
        <textarea
            id="{{ $fieldId('message') }}"
            wire:model="message"
            rows="{{ $messageRows ?: ($isCompact ? 2 : ($isVaptLayout ? 4 : 5)) }}"
            placeholder="{{ $messagePlaceholder }}"
            data-gramm="false"
            data-gramm_editor="false"
            data-enable-grammarly="false"
        ></textarea>
        @error('message') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
    </div>
    <label class="contact-form__terms">
        <input type="checkbox" wire:model="acceptedTerms">
        <span>
            By using our services, you agree to our
            <a href="{{ route('page.show', ['slug' => 'contact']) }}">Terms &amp; Conditions</a>
            and
            <a href="{{ route('page.show', ['slug' => 'contact']) }}">Privacy Policy</a>.
            <x-forms.messaging-consent-tooltip />
        </span>
    </label>
    @error('acceptedTerms') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror

    <x-forms.recaptcha />

    <button
        type="submit"
        class="contact-form__submit"
        wire:loading.attr="disabled"
        wire:target="submit"
    >
        <span wire:loading.remove wire:target="submit">{{ $submitLabel }}</span>
        <span wire:loading wire:target="submit">Sending...</span>
    </button>
</form>
