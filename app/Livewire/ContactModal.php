<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ContactModal extends Component
{
    public bool $isOpen = false;

    #[On('open-contact-modal')]
    public function open(): void
    {
        $this->isOpen = true;

        $this->dispatch('contact-modal-opened');
    }

    #[On('close-contact-modal')]
    public function close(): void
    {
        $this->isOpen = false;

        $this->dispatch('contact-modal-closed');
    }

    public function render()
    {
        return view('livewire.contact-modal');
    }
}
