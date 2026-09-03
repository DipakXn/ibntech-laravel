@php
    $isAdminRequest = request()->is('admin') || request()->is('admin/*');
    $seo = [
        'meta_title' => '404 | Page Not Found | ' . config('app.name'),
        'meta_description' => 'The page you requested could not be found.',
        'robots' => 'noindex, nofollow',
    ];
@endphp

@if ($isAdminRequest)
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $seo['meta_title'] }}</title>
        <meta name="robots" content="{{ $seo['robots'] }}">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
        <main class="flex min-h-screen items-center justify-center px-6 py-12">
            <section class="w-full max-w-xl rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-xl shadow-slate-200/70 sm:p-10">
                <p class="text-sm font-semibold uppercase tracking-[0.32em] text-slate-500">Error 404</p>
                <h1 class="mt-4 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Page Not Found</h1>
                <p class="mt-4 text-base leading-7 text-slate-600">
                    The requested admin page could not be found or is no longer available.
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
    </body>
    </html>
@else
    @extends('layouts.app')

    @section('content')
        <style>
            .error-404 {
                position: relative;
                overflow: clip;
                padding: clamp(2.5rem, 5vw, 4.5rem) 0 clamp(3rem, 6vw, 5rem);
            }

            .error-404::before,
            .error-404::after {
                content: '';
                position: absolute;
                inset: auto;
                border-radius: 999px;
                pointer-events: none;
            }

            .error-404::before {
                top: 2rem;
                left: -5rem;
                width: 18rem;
                height: 18rem;
                background: radial-gradient(circle, rgba(76, 175, 80, 0.14) 0%, rgba(76, 175, 80, 0) 72%);
            }

            .error-404::after {
                right: -4rem;
                bottom: 2rem;
                width: 20rem;
                height: 20rem;
                background: radial-gradient(circle, rgba(46, 46, 128, 0.14) 0%, rgba(46, 46, 128, 0) 72%);
            }

            .error-404__panel {
                position: relative;
                overflow: hidden;
                border: 1px solid rgba(46, 46, 128, 0.12);
                border-radius: 2rem;
                background:
                    radial-gradient(circle at top left, rgba(76, 175, 80, 0.12), transparent 26%),
                    radial-gradient(circle at top right, rgba(46, 46, 128, 0.1), transparent 24%),
                    linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
                box-shadow: 0 28px 60px rgba(20, 31, 78, 0.12);
            }

            .error-404__panel::before {
                content: '';
                position: absolute;
                inset: 0;
                background:
                    linear-gradient(rgba(46, 46, 128, 0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(46, 46, 128, 0.03) 1px, transparent 1px);
                background-size: 36px 36px;
                mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.3), transparent 85%);
                pointer-events: none;
            }

            .error-404__inner {
                position: relative;
                z-index: 1;
                display: grid;
                grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr);
                gap: clamp(2rem, 4vw, 3.25rem);
                align-items: center;
                padding: clamp(2rem, 4vw, 3.5rem);
            }

            .error-404__eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 0.55rem;
                border-radius: 999px;
                background: rgba(46, 46, 128, 0.08);
                padding: 0.55rem 0.95rem;
                color: #2e2e80;
                font-size: 0.82rem;
                font-weight: 800;
                letter-spacing: 0.12em;
                text-transform: uppercase;
            }

            .error-404__digits {
                display: flex;
                align-items: flex-end;
                gap: clamp(0.35rem, 1vw, 0.85rem);
                margin-top: 1.4rem;
                color: #2e2e80;
                font-size: clamp(4.8rem, 15vw, 9rem);
                font-weight: 900;
                line-height: 0.9;
                letter-spacing: -0.07em;
            }

            .error-404__digits span:nth-child(2) {
                color: #4caf50;
            }

            .error-404__content h1 {
                margin-top: 1.5rem;
                color: #2e2e80;
                font-size: clamp(2rem, 4vw, 3.1rem);
                font-weight: 700;
                line-height: 1.05;
                letter-spacing: 0em;
            }

            .error-404__content p {
                max-width: 34rem;
                margin-top: 1rem;
                color: #5f6c87;
                font-size: 1.05rem;
                line-height: 1.85;
            }

            .error-404__actions {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                margin-top: 2rem;
            }

            .error-404__button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.7rem;
                min-width: 13rem;
                border-radius: 999px;
                background: linear-gradient(135deg, #4caf50 0%, #3f9d48 100%);
                padding: 1rem 1.6rem;
                color: #fff;
                text-decoration: none;
                font-weight: 800;
                box-shadow: 0 16px 32px rgba(76, 175, 80, 0.28);
                transition:
                    transform 0.25s ease,
                    box-shadow 0.25s ease;
            }

            .error-404__button:hover {
                transform: translateY(-2px);
                box-shadow: 0 22px 38px rgba(76, 175, 80, 0.3);
            }

            .error-404__button:focus-visible {
                outline: 3px solid rgba(76, 175, 80, 0.25);
                outline-offset: 4px;
            }

            .error-404__meta {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem 1.4rem;
                margin-top: 1.5rem;
                color: #2e2e80;
                font-size: 0.95rem;
                font-weight: 700;
            }

            .error-404__meta span {
                display: inline-flex;
                align-items: center;
                gap: 0.55rem;
            }

            .error-404__meta i {
                color: #4caf50;
            }

            .error-404__art {
                position: relative;
                min-height: 27rem;
            }

            .error-404__art img {
                display: block;
                width: 100%;
                height: auto;
                border-radius: 10px;
                max-height: 29rem;
                object-fit: contain;
                filter: drop-shadow(0 24px 38px rgba(22, 35, 74, 0.14));
            }

            @media (max-width: 980px) {
                .error-404__inner {
                    grid-template-columns: 1fr;
                }

                .error-404__content {
                    text-align: center;
                }

                .error-404__digits,
                .error-404__actions,
                .error-404__meta {
                    justify-content: center;
                }

                .error-404__content p {
                    margin-inline: auto;
                }

                .error-404__art {
                    order: -1;
                    min-height: 21rem;
                }
            }

            @media (max-width: 640px) {
                .error-404 {
                    padding-top: 1.5rem;
                }

                .error-404__panel {
                    border-radius: 1.5rem;
                }

                .error-404__inner {
                    padding: 1.5rem;
                }

                .error-404__digits {
                    font-size: clamp(4rem, 24vw, 6rem);
                }

                .error-404__button {
                    width: 100%;
                    min-width: 0;
                }

                .error-404__art {
                    min-height: 17rem;
                }
            }
        </style>

        <section class="error-404">
            <div class="site-shell">
                <div class="error-404__panel">
                    <div class="error-404__inner">
                        <div class="error-404__content">
                            <span class="error-404__eyebrow">
                                <i class="fa-solid fa-compass-drafting" aria-hidden="true"></i>
                                Navigation Error
                            </span>

                            <div class="error-404__digits" aria-label="404">
                                <span>4</span>
                                <span>0</span>
                                <span>4</span>
                            </div>

                            <h1>Oops! Page Not Found</h1>
                            <p>
                                The page you're trying to reach may have been moved, renamed, or no longer exists.
                                Use the button below to head back to the homepage and continue browsing IBN Technologies.
                            </p>

                            <div class="error-404__actions">
                                <a href="{{ route('home') }}" class="error-404__button">
                                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                                    Back to Homepage
                                </a>
                            </div>

                            <div class="error-404__meta" aria-label="Helpful guidance">
                                <span><i class="fa-solid fa-circle-check" aria-hidden="true"></i> Empowering Business Growth</span>
                                <span><i class="fa-solid fa-shield-heart" aria-hidden="true"></i> Your Trusted Technology Partner</span>
                            </div>
                        </div>

                        <div class="error-404__art" aria-hidden="true">
                            <img
                                src="{{ asset('/images/404-ibn-vector.webp') }}"
                                alt="Illustration for page not found"
                                loading="eager"
                                decoding="async"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
@endif
