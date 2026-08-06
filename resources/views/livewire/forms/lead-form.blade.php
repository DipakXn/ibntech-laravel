<form wire:submit="submit" class="space-y-3">
    <input type="hidden" wire:model="formName">
    <input type="hidden" wire:model="pageUrl">

    @if($submitted)
        <x-forms.success-alert title="Request received">
            Thanks. We will contact you shortly.
        </x-forms.success-alert>
    @endif

    <div>
        <label class="mb-1 block text-sm font-medium">Name</label>
        <input type="text" wire:model="name" class="w-full rounded-md border-slate-300">
        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Email</label>
        <input type="email" wire:model="email" class="w-full rounded-md border-slate-300">
        @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Company</label>
        <input type="text" wire:model="company" class="w-full rounded-md border-slate-300">
        @error('company') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <x-forms.recaptcha />

    <button type="submit" class="rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white" wire:loading.attr="disabled" wire:target="submit">Get Proposal</button>
</form>
