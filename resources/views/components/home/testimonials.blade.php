@props([
    'items' => null,
    'title' => 'What Our Clients Say',
    'subtitle' => 'Trusted by industry leaders',
    'autoplay' => false,
])

@php
    $resolvedItems = is_array($items) && $items !== []
        ? $items
        : \App\Support\Testimonials\Testimonials::cards('home');
@endphp

<section
    class="home-testimonials"
    aria-labelledby="home-testimonials-title"
    data-home-testimonials
    @if ($autoplay) data-home-testimonials-autoplay @endif
>
    <div class="home-testimonials__banner">
        <div class="home-shell">
            <h2 id="home-testimonials-title">{{ $title }}</h2>
            <p>{{ $subtitle }}</p>

            <div class="home-testimonials__carousel">
                <button type="button" class="home-testimonials__arrow" data-home-testimonials-prev aria-label="Previous testimonials">
                    <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                </button>

                <div class="home-testimonials__viewport" data-home-testimonials-viewport>
                    <div class="home-testimonials__track" data-home-testimonials-track>
                        @foreach ($resolvedItems as $testimonial)
                            <article class="home-testimonial" data-home-testimonial-card>
                                <div class="home-testimonial__card">
                                    <div class="home-testimonial__head">
                                        <div class="home-testimonial__avatar" aria-hidden="true">
                                            @if (! empty($testimonial['image']))
                                                <img src="{{ $testimonial['image'] }}" alt="">
                                            @else
                                                <i class="fa-solid fa-user"></i>
                                            @endif
                                        </div>
                                        <div class="home-testimonial__meta">
                                            <strong>{{ $testimonial['name'] }}</strong>
                                            @if (! empty($testimonial['rating']))
                                                <span class="home-testimonial__stars" aria-label="{{ (int) $testimonial['rating'] }} star rating">{{ str_repeat('★', (int) $testimonial['rating']) }}{{ str_repeat('☆', max(0, 5 - (int) $testimonial['rating'])) }}</span>
                                            @endif
                                            <span>&#64;{{ $testimonial['role'] }}</span>
                                        </div>
                                    </div>
                                    <blockquote class="home-testimonial__quote">“{{ $testimonial['quote'] }}”</blockquote>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <button type="button" class="home-testimonials__arrow" data-home-testimonials-next aria-label="Next testimonials">
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>

            <div class="home-testimonials__dots" role="group" aria-label="Testimonial pages" data-home-testimonials-dots></div>
        </div>
    </div>
</section>
