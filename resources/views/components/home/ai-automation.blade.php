@php
    $services = [
        [
            'title' => 'AI Consulting Services',
            'text' => 'Align AI strategy with business goals to identify high-impact automation opportunities.',
            'icon' => 'fa-lightbulb',
        ],
        [
            'title' => 'Agentic AI Services',
            'text' => 'Deploy autonomous AI agents that execute tasks, make decisions, and streamline operations.',
            'icon' => 'fa-brain',
        ],
        [
            'title' => 'AI Development Services',
            'text' => 'Build custom AI solutions, copilots, and intelligent applications tailored to your workflows.',
            'icon' => 'fa-code',
        ],
        [
            'title' => 'Robotic Process Automation (RPA)',
            'text' => 'Eliminate repetitive tasks through intelligent bots that work faster and more accurately.',
            'icon' => 'fa-robot',
        ],
    ];
@endphp

<section class="home-section home-section--tint" aria-labelledby="home-ai-title">
    <div class="home-shell">
        <div class="flex items-center gap-3">
            <span class="inline-grid h-11 w-11 place-items-center rounded-xl bg-[#2f6fd6] text-white">
                <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i>
            </span>
            <div>
                <h2 id="home-ai-title" class="text-2xl font-bold text-[#2f6fd6] md:text-3xl">AI and Automation Services</h2>
                <p class="text-[var(--home-muted)]">Automate workflows. Increase efficiency.</p>
            </div>
        </div>

        <div class="home-ai__intro">
            <p class="home-section-lead !mt-0">
                From AI consulting to intelligent automation, we help businesses optimize workflows, improve productivity, and accelerate digital transformation.
            </p>
            <div class="home-ai__metrics">
                <article>
                    <strong>360°</strong>
                    <span>AI Services</span>
                </article>
                <article>
                    <strong>3x</strong>
                    <span>Productivity</span>
                </article>
            </div>
        </div>

        <div class="home-ai__body">
            <div class="home-ai__grid">
                @foreach ($services as $service)
                    <article class="home-card home-service-card">
                        <div class="home-service-card__icon home-service-card__icon--violet !bg-[#2f6fd6]">
                            <i class="fa-solid {{ $service['icon'] }}" aria-hidden="true"></i>
                        </div>
                        <h3 class="!text-[#2f6fd6]">{{ $service['title'] }}</h3>
                        <p>{{ $service['text'] }}</p>
                    </article>
                @endforeach
            </div>

            <aside class="home-ai__feature">
                <h3>Tansform Operations with Intelligent Automation</h3>
                <p>
                    Transform your business with AI-powered automation that streamlines workflows, eliminates repetitive tasks, and improves efficiency, accuracy, and scalability across every stage of your operations.
                </p>
                <div class="home-ai__feature-stats">
                    <div>
                        <strong>Measurable ROI</strong>
                        <span>Business outcomes</span>
                    </div>
                    <div>
                        <strong>6+ Core Capabilities</strong>
                        <span>Automation coverage</span>
                    </div>
                </div>
            </aside>
        </div>

        <div class="home-cta-bar home-cta-bar--blue">
            <div>
                <h3>Ready to Eliminate Repetitive Work?</h3>
                <p>Let IBN's automation experts map your workflows, deploy bots, and deliver measurable ROI — with zero disruption to your existing systems.</p>
            </div>
            <a href="#" class="home-btn home-btn--white" data-contact-modal-trigger>Book Free Assessment →</a>
        </div>
    </div>
</section>
