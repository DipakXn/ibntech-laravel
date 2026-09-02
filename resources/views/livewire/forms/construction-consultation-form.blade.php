@php
    $fieldId = fn (string $name): string => $idPrefix.'-'.$name;
    $detailed = $this->needsDetailedRequirements();
@endphp

<form
    wire:submit="submit"
    class="contact-form fccons-form"
    wire:loading.class="contact-form--loading"
    wire:target="submit,nextStep"
    novalidate
>
    <input type="hidden" wire:model="formName">
    <input type="hidden" wire:model="pageUrl">

    <ol class="fccons-steps" data-step="{{ $step }}" aria-label="Form progress">
        <li class="{{ $step === 1 ? 'is-active' : 'is-complete' }}">
            <span class="fccons-steps__index" aria-hidden="true">1</span>
            <span class="fccons-steps__label">Contact Information</span>
        </li>
        <li class="{{ $step === 2 ? 'is-active' : ($step > 2 ? 'is-complete' : '') }}">
            <span class="fccons-steps__index" aria-hidden="true">2</span>
            <span class="fccons-steps__label">Requirements</span>
        </li>
        <li class="{{ $step === 3 ? 'is-active' : '' }}">
            <span class="fccons-steps__index" aria-hidden="true">3</span>
            <span class="fccons-steps__label">Details</span>
        </li>
    </ol>

    @if($submitError)
        <p class="contact-form__error contact-form__banner" role="alert">{{ $submitError }}</p>
    @endif

    @if($submitted)
        <x-forms.success-alert title="Message submitted">
            Thank you. Your message has been submitted.
        </x-forms.success-alert>
    @endif

    <div class="fccons-form__stages">
        <div class="fccons-form__panel{{ $step === 1 ? '' : ' is-inactive' }}" @if($step !== 1) aria-hidden="true" inert @endif>
            <div class="contact-form__field">
                <label class="sr-only" for="{{ $fieldId('name') }}">Full Name</label>
                <input id="{{ $fieldId('name') }}" type="text" wire:model="name" placeholder="Full Name" autocomplete="name">
                @error('name') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
            </div>

            <div class="contact-form__field">
                <label class="sr-only" for="{{ $fieldId('phone') }}">Phone Number</label>
                <x-forms.phone-input
                    :id="$fieldId('phone')"
                    model="phone"
                    name="phone"
                    placeholder="Phone Number"
                    :value="$phone"
                />
                @error('phone') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
            </div>

            <div class="contact-form__field">
                <label class="sr-only" for="{{ $fieldId('email') }}">Business Email</label>
                <input id="{{ $fieldId('email') }}" type="email" wire:model="email" placeholder="Business Email" autocomplete="email">
                @error('email') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
            </div>

            <div class="contact-form__field">
                <label class="fccons-form__label" for="{{ $fieldId('lookingFor') }}">What are you looking for?</label>
                <select id="{{ $fieldId('lookingFor') }}" wire:model.live="lookingFor">
                    <option value="">Please select an option</option>
                    @foreach (\App\Livewire\Forms\ConstructionConsultationForm::LOOKING_FOR_OPTIONS as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
                @error('lookingFor') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
            </div>

            <button
                type="button"
                class="contact-form__submit"
                wire:click="nextStep"
                wire:loading.attr="disabled"
                wire:target="nextStep"
            >
                <span wire:loading.remove wire:target="nextStep">Next</span>
                <span wire:loading wire:target="nextStep">Checking...</span>
            </button>
        </div>

        <div class="fccons-form__panel{{ $step === 2 ? '' : ' is-inactive' }}" @if($step !== 2) aria-hidden="true" inert @endif>
            <div
                class="fccons-form__extras{{ $detailed ? '' : ' is-placeholder' }}"
                @unless($detailed) aria-hidden="true" inert @endunless
            >
                <div class="contact-form__field">
                    <label class="fccons-form__label" for="{{ $fieldId('neededService') }}">Which service do you need?</label>
                    <select id="{{ $fieldId('neededService') }}" wire:model="neededService" @unless($detailed) tabindex="-1" @endunless>
                        <option value="">Please select an option</option>
                        @foreach (\App\Livewire\Forms\ConstructionConsultationForm::NEEDED_SERVICE_OPTIONS as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('neededService') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
                </div>

                <div class="contact-form__field">
                    <label class="fccons-form__label" for="{{ $fieldId('resourceType') }}">Select Resource Type</label>
                    <select id="{{ $fieldId('resourceType') }}" wire:model="resourceType" @unless($detailed) tabindex="-1" @endunless>
                        <option value="">Please select an option</option>
                        @foreach (\App\Livewire\Forms\ConstructionConsultationForm::RESOURCE_TYPE_OPTIONS as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('resourceType') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="contact-form__field">
                <label class="fccons-form__label" for="{{ $fieldId('hireWhen') }}">When do you want to hire?</label>
                <select id="{{ $fieldId('hireWhen') }}" wire:model="hireWhen">
                    <option value="">Please select an option</option>
                    @foreach (\App\Livewire\Forms\ConstructionConsultationForm::HIRE_WHEN_OPTIONS as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
                @error('hireWhen') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
            </div>

            <div class="fccons-form__actions">
                <button type="button" class="fccons-form__back" wire:click="previousStep">Previous</button>
                <button
                    type="button"
                    class="contact-form__submit"
                    wire:click="nextStep"
                    wire:loading.attr="disabled"
                    wire:target="nextStep"
                >
                    <span wire:loading.remove wire:target="nextStep">Next</span>
                    <span wire:loading wire:target="nextStep">Checking...</span>
                </button>
            </div>
        </div>

        <div class="fccons-form__panel{{ $step === 3 ? '' : ' is-inactive' }}" @if($step !== 3) aria-hidden="true" inert @endif>
            <div class="contact-form__field contact-form__field--message">
                <label class="fccons-form__label" for="{{ $fieldId('message') }}">Briefly describe your requirement</label>
                <textarea
                    id="{{ $fieldId('message') }}"
                    wire:model="message"
                    rows="3"
                    placeholder="Briefly describe your requirement"
                    data-gramm="false"
                    data-gramm_editor="false"
                    data-enable-grammarly="false"
                ></textarea>
                @error('message') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror
            </div>

            <label class="contact-form__terms">
                <input type="checkbox" wire:model="acceptedTerms">
                <span>
                    By using our services, you agree to our
                    <a href="{{ route('page.show', ['slug' => 'terms-of-use']) }}">Terms &amp; Conditions</a>
                    and
                    <a href="{{ route('page.show', ['slug' => 'privacy-policy']) }}">Privacy Policy</a>.
                    <x-forms.messaging-consent-tooltip />
                </span>
            </label>
            @error('acceptedTerms') <p class="contact-form__error" role="alert">{{ $message }}</p> @enderror

            <div class="fccons-form__captcha">
                @if($step === 3)
                    <x-forms.recaptcha />
                @endif
            </div>

            <div class="fccons-form__actions">
                <button type="button" class="fccons-form__back" wire:click="previousStep">Previous</button>
                <button
                    type="submit"
                    class="contact-form__submit"
                    wire:loading.attr="disabled"
                    wire:target="submit"
                >
                    <span wire:loading.remove wire:target="submit">Book Your Appointment</span>
                    <span wire:loading wire:target="submit">Sending...</span>
                </button>
            </div>
        </div>
    </div>
</form>
