<div
    x-data="contactModal()"
    x-on:open-contact-modal.window="$wire.open()"
    x-on:keydown.escape.window="if ($wire.isOpen) close()"
    x-cloak
>
    @if ($isOpen)
        <div
            class="contact-modal"
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
                aria-describedby="contact-modal-description"
                tabindex="-1"
                @click.stop
                @keydown.tab="trapFocus($event)"
            >
                <div class="contact-modal__header">
                    <div>
                        <p class="contact-modal__eyebrow">IBN Technologies</p>
                        <h2 id="contact-modal-title" class="contact-modal__title">Get In Touch</h2>
                        <p id="contact-modal-description" class="contact-modal__subtitle">
                            Tell us about your goals and our team will respond shortly.
                        </p>
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
                    <livewire:forms.contact-form
                        wire:key="header-contact-modal-form"
                        form-name="header-contact-modal"
                        id-prefix="modal-contact"
                    />
                </div>
            </div>
        </div>
    @endif
</div>
