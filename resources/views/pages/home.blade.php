@extends('layouts.app')

@section('content')
    <section class="home-hero">
        <div class="site-shell home-hero__inner">
            <div class="home-hero__content">
                <div class="home-hero__badge"><i class="fa-solid fa-medal" aria-hidden="true"></i> Expert Accounting, Delivered Remotely</div>
                <h1>
                    Lead with Confidence in <span>Outsource Accounting and Bookkeeping Services</span>
                </h1>
                <p class="home-hero__eyebrow">Accounting | Bookkeeping | Compliance | Reporting | Insights</p>
                <p class="home-hero__description">
                    Global leader in remote bookkeeping and accounting, delivering 100% accuracy, efficiency,
                    and growth-focused operations for modern businesses.
                </p>
                <div class="home-hero__actions">
                    <a href="{{ route('page.show', ['slug' => 'contact']) }}" class="home-hero__primary"><i class="fa-regular fa-paper-plane" aria-hidden="true"></i> Contact Our Expert</a>
                    <a href="{{ route('case-studies.index') }}" class="home-hero__secondary"><i class="fa-regular fa-folder-open" aria-hidden="true"></i> Explore Case Studies</a>
                </div>
            </div>

            <div class="home-hero__visual" aria-hidden="true">
                <div class="home-hero__portrait"></div>
            </div>
        </div>
    </section>

    <section class="strength-panel">
        <div class="site-shell">
            <div class="strength-panel__frame">
                <div class="strength-panel__notch" aria-hidden="true"></div>
                <h2>Navigate Our <span>Core Strengths</span></h2>

                <div class="strength-panel__grid">
                    <article class="strength-card">
                        <div class="strength-card__icon strength-card__icon--navy"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></div>
                        <h3>Cybersecurity</h3>
                        <p>VAPT, SEIM, SOC, vCISO</p>
                    </article>
                    <article class="strength-card">
                        <div class="strength-card__icon strength-card__icon--sky"><i class="fa-solid fa-cloud" aria-hidden="true"></i></div>
                        <h3>Cloud</h3>
                        <p>AWS, Azure, Migration</p>
                    </article>
                    <article class="strength-card">
                        <div class="strength-card__icon strength-card__icon--green"><i class="fa-solid fa-calculator" aria-hidden="true"></i></div>
                        <h3>Finance &amp; Accounting</h3>
                        <p>Bookkeeping, Payroll</p>
                    </article>
                    <article class="strength-card">
                        <div class="strength-card__icon strength-card__icon--blue"><i class="fa-solid fa-robot" aria-hidden="true"></i></div>
                        <h3>Automation</h3>
                        <p>RPA, AP/AR</p>
                    </article>
                    <article class="strength-card">
                        <div class="strength-card__icon strength-card__icon--violet"><i class="fa-solid fa-building" aria-hidden="true"></i></div>
                        <h3>BPO</h3>
                        <p>Back Office, Documentation</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="leadership-band">
        <div class="site-shell">
            <div class="section-heading">
                <p class="section-heading__eyebrow">Proven Leadership</p>
                <h2>We lead not only with strategy, but with clarity of purpose and a commitment to excellence.</h2>
            </div>

            <div class="leadership-band__stats">
                <article>
                    <strong>2.5K+</strong>
                    <span>Global Clients</span>
                </article>
                <article>
                    <strong>26+</strong>
                    <span>Years of Expertise</span>
                </article>
                <article>
                    <strong>100%</strong>
                    <span>Compliance Rate</span>
                </article>
                <article>
                    <strong>99.9%</strong>
                    <span>Cloud Uptime</span>
                </article>
            </div>
        </div>
    </section>

    <section class="service-matrix">
        <div class="site-shell">
            <div class="section-heading section-heading--left">
                <p class="section-heading__eyebrow">Integrated Expertise</p>
                <h2>Flexible delivery teams built for finance, cloud, automation, and operational scale.</h2>
            </div>

            <div class="service-matrix__grid">
                <article>
                    <h3>Accounting Delivery</h3>
                    <ul>
                        <li>Bookkeeping and month-end close support</li>
                        <li>Tax return preparation workflows</li>
                        <li>Payroll, AP/AR, and reporting operations</li>
                    </ul>
                </article>
                <article>
                    <h3>Cloud and Infrastructure</h3>
                    <ul>
                        <li>Migration planning for modern business systems</li>
                        <li>Managed cloud and security governance</li>
                        <li>Business continuity and resilience design</li>
                    </ul>
                </article>
                <article>
                    <h3>Automation Programs</h3>
                    <ul>
                        <li>AP and AR automation opportunities</li>
                        <li>RPA implementation across finance teams</li>
                        <li>Process standardization and monitoring</li>
                    </ul>
                </article>
                <article>
                    <h3>Business Support</h3>
                    <ul>
                        <li>Documentation and remote back-office execution</li>
                        <li>Operational reporting and SLA tracking</li>
                        <li>Dedicated support cells for growing teams</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="download-promo">
        <div class="site-shell download-promo__inner">
            <div>
                <p class="section-heading__eyebrow">Featured Resource</p>
                <h2>Download the migration playbook used to structure complex CMS transitions.</h2>
                <p>
                    Use this gated asset to validate the ebook funnel, lead capture forms, and a more realistic
                    marketing journey from homepage to conversion.
                </p>
            </div>
            <div class="download-promo__form">
                <livewire:forms.ebook-download-form />
            </div>
        </div>
    </section>
@endsection
