@props([
    'model' => 'recaptchaToken',
    'errorClass' => 'mt-1 text-xs text-red-600',
])

<div wire:ignore 
     x-data="{
        widgetId: null,
        recaptchaScheduled: false,
        init() {
            let attempts = 0;
            const attemptRender = () => {
                if (this.widgetId !== null) {
                    return true;
                }

                if (this.recaptchaScheduled || typeof grecaptcha === 'undefined' || typeof grecaptcha.render !== 'function') {
                    return false;
                }

                const mount = () => {
                    if (this.widgetId !== null) {
                        return;
                    }

                    try {
                        this.widgetId = grecaptcha.render('recaptcha-{{ $this->getId() }}', {
                            'sitekey': '{{ config('services.recaptcha.site_key') }}',
                            'callback': (token) => {
                                $wire.set('{{ $model }}', token);
                            },
                            'expired-callback': () => {
                                $wire.set('{{ $model }}', null);
                            }
                        });
                    } catch (error) {
                        this.recaptchaScheduled = false;
                    }
                };

                this.recaptchaScheduled = true;

                if (typeof grecaptcha.ready === 'function') {
                    grecaptcha.ready(mount);
                } else {
                    mount();
                }

                return this.widgetId !== null;
            };

            if (!attemptRender()) {
                const checkInterval = setInterval(() => {
                    attempts += 1;

                    if (this.widgetId !== null || attemptRender() || attempts > 80) {
                        clearInterval(checkInterval);
                    }
                }, 250);
            }

            $wire.on('reset-recaptcha', () => {
                if (this.widgetId !== null && typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset(this.widgetId);
                }
                $wire.set('{{ $model }}', null);
            });
        }
     }"
     {{ $attributes->merge(['class' => 'my-4']) }}
>
    <div id="recaptcha-{{ $this->getId() }}"></div>
    @error($model)
        <p class="{{ $errorClass }}">{{ $message }}</p>
    @enderror
</div>
