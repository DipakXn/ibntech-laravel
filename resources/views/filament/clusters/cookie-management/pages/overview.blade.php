<x-filament-panels::page>
    @php($stats = $this->stats())

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        @foreach ([
            'Total choices' => $stats['total'],
            'Accept all' => $stats['accept_all'],
            'Reject all' => $stats['reject_all'],
            'Custom choices' => $stats['custom'],
            'Withdrawals' => $stats['withdrawal'],
        ] as $label => $value)
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $label }}</p>
                <p class="mt-2 text-3xl font-semibold text-gray-950 dark:text-white">{{ number_format($value) }}</p>
            </div>
        @endforeach
    </div>

    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
        These totals count consent actions only. They do not store a visitor identifier, IP address, or any other personal information.
    </p>
</x-filament-panels::page>
