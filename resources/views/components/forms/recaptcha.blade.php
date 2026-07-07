@props([
    'model' => 'recaptchaToken',
    'errorClass' => 'mt-1 text-xs text-red-600',
])

<div wire:ignore 
     x-data="{
        widgetId: null,
        init() {
            if (typeof grecaptcha === 'undefined') {
                let checkInterval = setInterval(() => {
                    if (typeof grecaptcha !== 'undefined') {
                        clearInterval(checkInterval);
                        this.renderRecaptcha();
                    }
                }, 100);
            } else {
                this.renderRecaptcha();
            }

            $wire.on('reset-recaptcha', () => {
                if (this.widgetId !== null) {
                    grecaptcha.reset(this.widgetId);
                }
                $wire.set('{{ $model }}', null);
            });
        },
        renderRecaptcha() {
            this.widgetId = grecaptcha.render('recaptcha-{{ $this->getId() }}', {
                'sitekey': '{{ config('services.recaptcha.site_key') }}',
                'callback': (token) => {
                    $wire.set('{{ $model }}', token);
                },
                'expired-callback': () => {
                    $wire.set('{{ $model }}', null);
                }
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
