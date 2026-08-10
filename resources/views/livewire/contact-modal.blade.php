@php
    $isQuoteVariant = $this->isQuoteVariant();
    $formName = $isQuoteVariant ? 'vapt-pricing-quote' : 'header-contact-modal';
    $formKey = $formName.'-'.($service ?: 'none');
@endphp

<div
    x-data="contactModal()"
    x-on:open-contact-modal.window="$wire.open($event.detail?.service ?? null, $event.detail?.variant ?? null)"
    x-on:keydown.escape.window="if ($wire.isOpen) close()"
    x-cloak
>
    @if ($isOpen)
        <div
            class="contact-modal{{ $isQuoteVariant ? ' contact-modal--quote' : '' }}"
            x-show="$wire.isOpen"
            x-transition.opacity.duration.200ms
            role="presentation"
        >
            <div
                class="contact-modal__backdrop"
                @click="close()"
                aria-hidden="true"
            ></div>

            <div
                class="contact-modal__dialog"
                x-ref="dialog"
                x-transition:enter="contact-modal__dialog--enter"
                x-transition:enter-start="contact-modal__dialog--enter-start"
                x-transition:enter-end="contact-modal__dialog--enter-end"
                x-transition:leave="contact-modal__dialog--leave"
                x-transition:leave-start="contact-modal__dialog--leave-start"
                x-transition:leave-end="contact-modal__dialog--leave-end"
                role="dialog"
                aria-modal="true"
                aria-labelledby="contact-modal-title"
                @if(! $isQuoteVariant)
                    aria-describedby="contact-modal-description"
                @endif
                tabindex="-1"
                @click.stop
                @keydown.tab="trapFocus($event)"
            >
                <div class="contact-modal__header">
                    <div>
                        @unless($isQuoteVariant)
                            <p class="contact-modal__eyebrow">IBN Technologies</p>
                        @endunless
                        <h2 id="contact-modal-title" class="contact-modal__title">
                            @if($isQuoteVariant)
                                Please provide the following details to request a quote.
                            @else
                                Get In Touch
                            @endif
                        </h2>
                        @unless($isQuoteVariant)
                            <p id="contact-modal-description" class="contact-modal__subtitle">
                                Tell us about your goals and our team will respond shortly.
                            </p>
                        @endunless
                    </div>
                    <button
                        type="button"
                        class="contact-modal__close"
                        @click="close()"
                        aria-label="Close contact form"
                    >
                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="contact-modal__body">
                    @if($isQuoteVariant)
                        <livewire:forms.contact-form
                            wire:key="{{ $formKey }}"
                            :form-name="$formName"
                            id-prefix="modal-vapt-quote"
                            layout="modal"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$planOptions"
                            service-placeholder="Select Plan"
                            message-placeholder="Describe your security testing requirements:"
                            submit-label="Submit Request"
                            :initial-service="$service"
                        />
                    @else
                        <livewire:forms.contact-form
                            wire:key="{{ $formKey }}"
                            form-name="header-contact-modal"
                            id-prefix="modal-contact"
                            layout="modal"
                        />
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
