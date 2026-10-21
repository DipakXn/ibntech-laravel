<input
    type="hidden"
    wire:model="pageUrl"
    x-data
    x-init="
        const pageUrl = window.location.href.split('#')[0];
        if (pageUrl && !pageUrl.includes('/livewire-') && !pageUrl.includes('/livewire/')) {
            $wire.set('pageUrl', pageUrl);
        }
    "
>
