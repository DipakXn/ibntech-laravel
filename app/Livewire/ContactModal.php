<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ContactModal extends Component
{
    public bool $isOpen = false;

    public string $variant = 'default';

    public ?string $service = null;

    public ?string $customTitle = null;

    public ?string $customSubtitle = null;

    /**
     * @var list<string>
     */
    public array $planOptions = [
        'Silver',
        'Gold',
        'Platinum',
    ];

    #[On('open-contact-modal')]
    public function open(
        ?string $service = null,
        ?string $variant = null,
        ?string $title = null,
        ?string $subtitle = null,
    ): void {
        $this->variant = in_array($variant, ['default', 'vapt-quote', 'pricing-enquire'], true) ? $variant : 'default';
        $this->service = is_string($service) && $service !== '' ? $service : null;
        $this->customTitle = is_string($title) && $title !== '' ? $title : null;
        $this->customSubtitle = is_string($subtitle) && $subtitle !== '' ? $subtitle : null;

        if ($this->variant === 'vapt-quote' && $this->service !== null && ! in_array($this->service, $this->planOptions, true)) {
            $this->service = null;
        }

        $this->isOpen = true;

        $this->dispatch('contact-modal-opened');
    }

    #[On('close-contact-modal')]
    public function close(): void
    {
        $this->isOpen = false;
        $this->variant = 'default';
        $this->service = null;
        $this->customTitle = null;
        $this->customSubtitle = null;

        $this->dispatch('contact-modal-closed');
    }

    public function isQuoteVariant(): bool
    {
        return $this->variant === 'vapt-quote';
    }

    public function isPricingEnquire(): bool
    {
        return $this->variant === 'pricing-enquire';
    }

    public function render()
    {
        return view('livewire.contact-modal');
    }
}
