<div class="ibn-login-shell">
    <div class="ibn-login-card">
        <section class="ibn-login-panel">
            <div class="ibn-login-panel__intro">
                <div class="ibn-brand-lockup ibn-brand-lockup-login">
                    <div class="ibn-brand-mark ibn-brand-mark-lg">
                        <span>I</span>
                        <span>B</span>
                        <span>N</span>
                    </div>
                    <div class="ibn-brand-wordmark">
                        <strong>IBNTECH</strong>
                        <small>Control Panel</small>
                    </div>
                </div>

                <p class="ibn-login-kicker">Secure access</p>
                <h1>{{ $this->getHeading() }}</h1>
                <p>{{ $this->getSubheading() }}</p>
            </div>

            <div class="ibn-login-panel__form">
                {{ $this->content }}
            </div>
        </section>

        <aside class="ibn-login-aside">
            <div class="ibn-login-aside__surface">
                <p class="ibn-login-kicker">Why this workspace</p>
                <h2>Built for IBN Technologies website operations.</h2>

                <div class="ibn-login-points">
                    <article>
                        <span class="ibn-login-point__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3.2 4.2 7.4 12 11.6 19.8 7.4 12 3.2Z" />
                                <path d="m4.2 12 7.8 4.2L19.8 12" />
                                <path d="m4.2 16.4 7.8 4.2 7.8-4.2" />
                            </svg>
                        </span>
                        <div>
                            <strong>Publishing</strong>
                            <p>Manage blogs, case studies, eBooks, pages, and SEO from one control center.</p>
                        </div>
                    </article>
                    <article>
                        <span class="ibn-login-point__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 19.2V10.5" />
                                <path d="M12 19.2V5.2" />
                                <path d="M19 19.2V8.4" />
                            </svg>
                        </span>
                        <div>
                            <strong>Submission Flow</strong>
                            <p>Track form submissions and campaign responses alongside content performance.</p>
                        </div>
                    </article>
                    <article>
                        <span class="ibn-login-point__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3.2 19.2 6.4v5.4c0 4.3-2.9 7.4-7.2 9-4.3-1.6-7.2-4.7-7.2-9V6.4L12 3.2Z" />
                                <path d="m8.7 12.1 2.2 2.2 4.4-4.6" />
                            </svg>
                        </span>
                        <div>
                            <strong>Brand System</strong>
                            <p>Green and navy accents, cleaner hierarchy, and responsive admin surfaces throughout.</p>
                        </div>
                    </article>
                </div>

                <svg class="ibn-login-aside__waves" viewBox="0 0 640 240" preserveAspectRatio="none" aria-hidden="true">
                    <path d="M-10 150C70 112 120 196 210 150s130-78 220-18 150 78 230-8" fill="none" stroke="rgba(125, 214, 196, 0.55)" stroke-width="1.6" />
                    <path d="M-10 176C90 138 150 214 250 168s150-86 240-16 130 70 180-18" fill="none" stroke="rgba(76, 175, 80, 0.45)" stroke-width="1.6" />
                    <path d="M-10 198C100 168 180 228 290 186s170-62 360 8" fill="none" stroke="rgba(186, 220, 255, 0.4)" stroke-width="1.3" stroke-dasharray="2 5" />
                    <path d="M-10 128C80 156 150 92 240 128s140 62 230 8 120-48 190 18" fill="none" stroke="rgba(255, 255, 255, 0.16)" stroke-width="1.2" />
                </svg>
            </div>
        </aside>
    </div>

    <x-filament-actions::modals />
</div>
