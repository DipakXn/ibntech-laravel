<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ContactModal extends Component
{
    public bool $isOpen = false;

    public string $variant = 'default';

    public ?string $service = null;

    /**
     * @var list<string>
     */
    public array $planOptions = [
        'Silver',
        'Gold',
        'Platinum',
    ];

    #[On('open-contact-modal')]
    public function open(?string $service = null, ?string $variant = null): void
    {
        $this->variant = in_array($variant, ['default', 'vapt-quote'], true) ? $variant : 'default';
        $this->service = is_string($service) && $service !== '' ? $service : null;

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

        $this->dispatch('contact-modal-closed');
    }

    public function isQuoteVariant(): bool
    {
        return $this->variant === 'vapt-quote';
    }

    public function render()
    {
        return view('livewire.contact-modal');
    }
}
