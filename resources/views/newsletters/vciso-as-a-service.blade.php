@extends('layouts.newsletter')

@push('styles')
    @vite(['resources/css/newsletters/vciso-as-a-service.css'])
@endpush

@php
    $nlImg = fn (string $file): string => asset('images/newsletter/'.$file);
@endphp

@section('content')
    <article class="nl-vciso">
        <section class="nl-vciso-hero" style="--nl-vciso-hero-image: url('{{ $nlImg('Strategic-vCISO-Engagement-Newsletter-hero-bg.webp') }}')">
            <div class="site-shell nl-vciso-hero__inner">
                <h1>vCISO-as-a-Service: Executive Cyber Leadership Without the Full-Time Cost</h1>
                <p class="nl-vciso-hero__lede">
                    How IBN helped a global hospitality enterprise strengthen governance, improve risk visibility, and achieve compliance readiness across multiple properties.
                </p>
                <ul class="nl-vciso-hero__meta">
                    <li><i class="fa-regular fa-user" aria-hidden="true"></i> By IBN Technologies</li>
                    <li><i class="fa-regular fa-calendar" aria-hidden="true"></i> February 2026 Edition</li>
                    <li><i class="fa-regular fa-clock" aria-hidden="true"></i> 2 min read</li>
                </ul>
            </div>
        </section>

        <div class="nl-vciso-body">
            <div class="site-shell nl-vciso-layout">
                <div class="nl-vciso-main">
                    <section class="nl-vciso-panel" aria-labelledby="nl-vciso-overview-title">
                        <header class="nl-vciso-heading">
                            <h2 id="nl-vciso-overview-title">Engagement Overview</h2>
                        </header>
                        <p class="nl-vciso-lead">Partnering for Cyber Resilience</p>
                        <div class="nl-vciso-cards">
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon" aria-hidden="true"><i class="fa-solid fa-building"></i></span>
                                <div>
                                    <h3>Global Hospitality Leader</h3>
                                    <p>A global hospitality leader operating multiple high-value properties with complex IT, compliance, and cybersecurity requirements.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon nl-vciso-card__icon--teal" aria-hidden="true"><i class="fa-solid fa-shield-halved"></i></span>
                                <div>
                                    <h3>Cybersecurity Governance &amp; Roadmap</h3>
                                    <p>To establish structured cybersecurity governance, define a security maturity roadmap, and enhance cyber risk management aligned with global standards and PCI DSS.</p>
                                </div>
                            </article>
                        </div>
                    </section>

                    <section class="nl-vciso-panel nl-vciso-panel--soft" aria-labelledby="nl-vciso-delivered-title">
                        <header class="nl-vciso-heading">
                            <h2 id="nl-vciso-delivered-title">What IBN Delivered</h2>
                        </header>
                        <p class="nl-vciso-lead">vCISO Responsibilities</p>
                        <div class="nl-vciso-cards">
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon" aria-hidden="true"><i class="fa-solid fa-shield-halved"></i></span>
                                <div>
                                    <h3>Strategic Governance</h3>
                                    <p>Strategic cybersecurity governance and steering committee leadership to align security objectives with business goals.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon nl-vciso-card__icon--teal" aria-hidden="true"><i class="fa-solid fa-chart-column"></i></span>
                                <div>
                                    <h3>Posture Reviews &amp; Maturity Tracking</h3>
                                    <p>Executive-level security posture reviews and maturity tracking to maintain continuous improvement.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon nl-vciso-card__icon--purple" aria-hidden="true"><i class="fa-solid fa-users"></i></span>
                                <div>
                                    <h3>Global Collaboration</h3>
                                    <p>Close collaboration with global cybersecurity leadership teams to ensure unified security strategy.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon nl-vciso-card__icon--slate" aria-hidden="true"><i class="fa-solid fa-table-columns"></i></span>
                                <div>
                                    <h3>Governance Dashboards &amp; Risk Register</h3>
                                    <p>Centralized governance dashboards and managed risk register for real-time visibility into risk posture.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon" aria-hidden="true"><i class="fa-solid fa-lock"></i></span>
                                <div>
                                    <h3>Endpoint &amp; Identity Governance</h3>
                                    <p>Endpoint security, MDR, vulnerability, and identity governance enhancements for comprehensive protection.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon nl-vciso-card__icon--orange" aria-hidden="true"><i class="fa-solid fa-triangle-exclamation"></i></span>
                                <div>
                                    <h3>Incident Response Readiness</h3>
                                    <p>Incident response tabletop exercises and IR retainer support to ensure rapid, effective response.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon nl-vciso-card__icon--teal" aria-hidden="true"><i class="fa-solid fa-clock"></i></span>
                                <div>
                                    <h3>24×7 Monitoring Strategy</h3>
                                    <p>SOC-aligned 24×7 monitoring strategy providing around-the-clock security operations coverage.</p>
                                </div>
                            </article>
                        </div>
                    </section>

                    <section class="nl-vciso-panel nl-vciso-panel--mint" aria-labelledby="nl-vciso-outcomes-title">
                        <header class="nl-vciso-heading">
                            <h2 id="nl-vciso-outcomes-title">Outcomes &amp; Business Impact</h2>
                        </header>
                        <p class="nl-vciso-lead">Key Results Achieved</p>
                        <div class="nl-vciso-cards">
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                                <div>
                                    <h3>Structured Security Maturity Roadmap</h3>
                                    <p>Defined and executed a structured security maturity roadmap, providing clear milestones and measurable progress toward a robust security posture.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                                <div>
                                    <h3>Executive Risk Visibility</h3>
                                    <p>Improved executive visibility into cyber risks and remediation progress, enabling informed decision-making at the leadership level.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                                <div>
                                    <h3>Strengthened Compliance Posture</h3>
                                    <p>Strengthened compliance posture across PCI DSS and contractual obligations, reducing audit gaps and regulatory exposure.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                                <div>
                                    <h3>Incident &amp; Third-Party Readiness</h3>
                                    <p>Enhanced readiness for incidents and third-party risks with proactive planning, tabletop exercises, and response protocols.</p>
                                </div>
                            </article>
                        </div>
                    </section>

                    <section class="nl-vciso-panel" aria-labelledby="nl-vciso-why-title">
                        <header class="nl-vciso-heading">
                            <h2 id="nl-vciso-why-title">Why vCISO-as-a-Service Makes Sense</h2>
                        </header>
                        <p class="nl-vciso-lead">
                            vCISO-as-a-Service makes sense for organizations that need executive-level cybersecurity guidance without the overhead of a permanent role.
                        </p>
                        <div class="nl-vciso-cards">
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon" aria-hidden="true"><i class="fa-solid fa-user-check"></i></span>
                                <div>
                                    <h3>No Full-Time CISO Required</h3>
                                    <p>Ideal for organizations that need executive security oversight without the cost of a full-time hire.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon nl-vciso-card__icon--teal" aria-hidden="true"><i class="fa-solid fa-scale-balanced"></i></span>
                                <div>
                                    <h3>Compliance &amp; Regulatory Readiness</h3>
                                    <p>Perfect for those facing compliance, audit, or regulatory pressures and need expert guidance.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon nl-vciso-card__icon--purple" aria-hidden="true"><i class="fa-solid fa-layer-group"></i></span>
                                <div>
                                    <h3>Structured Governance</h3>
                                    <p>Essential for organizations that need structured governance across cloud, endpoints, and applications.</p>
                                </div>
                            </article>
                            <article class="nl-vciso-card">
                                <span class="nl-vciso-card__icon nl-vciso-card__icon--orange" aria-hidden="true"><i class="fa-solid fa-chart-line"></i></span>
                                <div>
                                    <h3>Outcome-Driven Leadership</h3>
                                    <p>Designed for those who want measurable, outcome-driven cybersecurity leadership with clear ROI.</p>
                                </div>
                            </article>
                        </div>
                    </section>

                    <section class="nl-vciso-takeaway" aria-labelledby="nl-vciso-enquire-title">
                        <h2 id="nl-vciso-enquire-title">Enquire About vCISO Services</h2>
                        <p>
                            Talk to a vCISO expert about executive cybersecurity leadership without the full-time cost.
                        </p>
                    </section>
                </div>

                @include('newsletters.partials.sidebar')
            </div>
        </div>
    </article>
@endsection
