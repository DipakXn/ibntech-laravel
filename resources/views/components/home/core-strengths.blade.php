@php
    $strengths = [
        ['title' => 'Cybersecurity', 'text' => 'VAPT, SOC, SEIM, vCISO', 'icon' => 'fa-shield-halved', 'tone' => 'navy', 'scroll_target' => 'cybersecurity-section'],
        ['title' => 'Cloud', 'text' => 'AWS, Azure, Jio', 'icon' => 'fa-cloud', 'tone' => 'sky', 'scroll_target' => 'cloud-section'],
        ['title' => 'Finance & Accounting', 'text' => 'Bookkeeping, Tax', 'icon' => 'fa-calculator', 'tone' => 'green', 'scroll_target' => 'finance-section'],
        ['title' => 'AI & Automation', 'text' => 'RPA, AP/AR', 'icon' => 'fa-robot', 'tone' => 'blue', 'scroll_target' => 'ai-section'],
        ['title' => 'BPO', 'text' => 'Civil Engg, Hedge Fund.', 'icon' => 'fa-building', 'tone' => 'violet', 'scroll_target' => 'bpo-section'],
    ];
@endphp

<section class="home-strengths" aria-labelledby="home-core-strengths-title">
    <div class="home-shell">
        <div class="home-strengths__panel">
            <h2 id="home-core-strengths-title">Navigate Our <span class="accent">Core Strengths</span></h2>
            <div class="home-strengths__grid">
                @foreach ($strengths as $strength)
                    <article class="home-strength-card">
                        <button
                            type="button"
                            class="home-strength-card__trigger"
                            data-scroll-target="{{ $strength['scroll_target'] }}"
                            aria-label="{{ $strength['title'] }} — {{ $strength['text'] }}. Go to {{ $strength['title'] }} section."
                        >
                            <span class="home-strength-card__icon home-strength-card__icon--{{ $strength['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $strength['icon'] }}"></i>
                            </span>
                            <span class="home-strength-card__copy">
                                <span class="home-strength-card__title">{{ $strength['title'] }}</span>
                                <span class="home-strength-card__text">{{ $strength['text'] }}</span>
                            </span>
                        </button>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
