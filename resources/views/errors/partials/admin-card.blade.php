<main class="flex min-h-screen items-center justify-center px-6 py-12">
    <section class="w-full max-w-xl rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-xl shadow-slate-200/70 sm:p-10">
        <p class="text-sm font-semibold uppercase tracking-[0.32em] text-slate-500">Error {{ $errorPage['code'] }}</p>
        <h1 class="mt-4 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">{{ $errorPage['admin_title'] }}</h1>
        <p class="mt-4 text-base leading-7 text-slate-600">
            {{ $errorPage['admin_message'] }}
        </p>
        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
            <a
                href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/admin') }}"
                class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
            >
                Go Back
            </a>
            <a
                href="{{ url('/admin') }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50"
            >
                Admin Dashboard
            </a>
        </div>
    </section>
</main>
