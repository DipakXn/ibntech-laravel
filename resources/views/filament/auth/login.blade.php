<div class="ibn-login-shell">
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
                    <small>Control</small>
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
            <h2>Built for IBNTECH website operations.</h2>

            <div class="ibn-login-points">
                <article>
                    <span>Publishing</span>
                    <p>Manage blogs, case studies, eBooks, pages, and SEO from one control center.</p>
                </article>
                <article>
                    <span>Submission flow</span>
                    <p>Track form submissions and campaign responses alongside content performance.</p>
                </article>
                <article>
                    <span>Brand system</span>
                    <p>Green and navy accents, cleaner hierarchy, and responsive admin surfaces throughout.</p>
                </article>
            </div>
        </div>
    </aside>

    <x-filament-actions::modals />
</div>
