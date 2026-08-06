@php
    $strengths = [
        ['title' => 'Cybersecurity', 'text' => 'VAPT, SOC, SEIM, vCISO', 'icon' => 'fa-shield-halved', 'tone' => 'navy'],
        ['title' => 'Cloud', 'text' => 'AWS, Azure, Jio', 'icon' => 'fa-cloud', 'tone' => 'sky'],
        ['title' => 'Finance & Accounting', 'text' => 'Bookkeeping, Tax', 'icon' => 'fa-calculator', 'tone' => 'green'],
        ['title' => 'AI & Automation', 'text' => 'RPA, AP/AR', 'icon' => 'fa-robot', 'tone' => 'blue'],
        ['title' => 'BPO', 'text' => 'Civil Engg, Hedge Fund.', 'icon' => 'fa-building', 'tone' => 'violet'],
    ];
@endphp

<section class="home-strengths" aria-labelledby="home-core-strengths-title">
    <div class="home-shell">
        <div class="home-strengths__panel">
            <h2 id="home-core-strengths-title">Navigate Our <span class="accent" style="color: var(--home-green)">Core Strengths</span></h2>
            <div class="home-strengths__grid">
                @foreach ($strengths as $strength)
                    <article class="home-card home-strength-card">
                        <div class="home-strength-card__icon home-strength-card__icon--{{ $strength['tone'] }}">
                            <i class="fa-solid {{ $strength['icon'] }}" aria-hidden="true"></i>
                        </div>
                        <h3>{{ $strength['title'] }}</h3>
                        <p>{{ $strength['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
