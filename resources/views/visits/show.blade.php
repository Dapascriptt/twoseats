@extends('layouts.app')

@section('title', $visit->title)

@section('content')

{{-- Reading progress bar --}}
<div id="progress-bar" class="fixed top-0 left-0 h-[3px] bg-primary z-[60]" style="width:0%;"></div>

{{-- ================================================================
     HERO — full-width photo gallery
================================================================ --}}
<div class="max-w-2xl mx-auto px-6 pt-10 gallery-section opacity-0">
    <div class="relative rounded-3xl overflow-hidden shadow-lg bg-[#F2EDE8] aspect-[4/3]">

        @if($visit->images->isNotEmpty())

        <div class="swiper w-full h-full">
            <div class="swiper-wrapper">
                @foreach($visit->images as $img)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $img->image_path) }}"
                         alt="{{ $visit->title }}"
                         class="w-full h-full object-cover object-center">
                </div>
                @endforeach
            </div>
            @if($visit->images->count() > 1)
            <div class="swiper-pagination !bottom-5"></div>
            <button class="swiper-button-prev !w-10 !h-10 !rounded-full !bg-white/20 backdrop-blur-sm !shadow-md after:!text-xs after:!font-bold after:!text-white"></button>
            <button class="swiper-button-next !w-10 !h-10 !rounded-full !bg-white/20 backdrop-blur-sm !shadow-md after:!text-xs after:!font-bold after:!text-white"></button>
            @endif
        </div>

        {{-- Bottom gradient overlay --}}
        <div class="absolute inset-x-0 bottom-0 h-40 pointer-events-none"
             style="background:linear-gradient(to top,rgba(0,0,0,0.35) 0%,transparent 100%);"></div>

        {{-- Cat sitting at bottom-right of photo --}}
        <div id="cat-lottie"
             class="absolute bottom-0 right-6 select-none pointer-events-none z-10"
             style="width:110px;height:96px;"></div>

        @if($visit->images->count() > 1)
        <div id="img-counter"
             class="absolute top-4 left-4 bg-black/30 backdrop-blur-sm text-white text-xs px-3 py-1.5 rounded-full font-medium z-10">
            1 / {{ $visit->images->count() }}
        </div>
        @endif

        @else

        {{-- No photo placeholder --}}
        <div class="w-full h-full flex flex-col items-center justify-center gap-3"
             style="background:linear-gradient(145deg,#FFF9F2 0%,#FFF0E2 60%,#FFE8D0 100%);">
            <svg class="w-14 h-14 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="font-serif italic text-primary/30 text-sm">Belum ada foto</p>
        </div>

        @endif

    </div>
</div>

{{-- ================================================================
     ARTICLE
================================================================ --}}
<div class="bg-[#FDFAF8] relative">

    <article class="max-w-2xl mx-auto px-6 py-14">

        {{-- Date --}}
        <p class="story-el text-xs font-medium tracking-[0.22em] text-primary uppercase mb-4 flex items-center gap-2 opacity-0">
            <span class="block w-5 h-px bg-primary"></span>
            {{ $visit->visit_date->translatedFormat('d F Y') }}
        </p>

        {{-- Title --}}
        <h1 class="story-el font-serif text-5xl sm:text-6xl font-medium text-gray-900 leading-tight mb-7 opacity-0">
            {{ $visit->title }}
        </h1>

        {{-- Location pill --}}
        <div class="story-el mb-10 opacity-0">
            <span class="inline-flex items-center gap-2 bg-primary/[0.08] text-primary/80 text-xs font-medium px-4 py-2 rounded-full">
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $visit->location }}
            </span>
        </div>

        {{-- Decorative divider --}}
        <div class="story-el opacity-0 flex items-center gap-4 mb-10">
            <span class="flex-1 h-px bg-gradient-to-r from-transparent via-primary/20 to-transparent"></span>
            <span class="text-primary/25 font-serif text-base select-none">✦</span>
            <span class="flex-1 h-px bg-gradient-to-r from-transparent via-primary/20 to-transparent"></span>
        </div>

        {{-- Story --}}
        @if($visit->story)
        <div class="story-el opacity-0 mb-10">
            <div class="border-l-[3px] border-primary/20 pl-6 py-1">
                <div class="font-sans text-gray-700 text-[15.5px] leading-[1.95] whitespace-pre-line">{{ $visit->story }}</div>
            </div>
        </div>
        @endif

        {{-- External links --}}
        @if($visit->gmaps_link || $visit->instagram_link)
        <div class="story-el flex flex-wrap gap-3 mt-12 pt-8 border-t border-gray-200/60 opacity-0">
            @if($visit->gmaps_link)
            <a href="{{ $visit->gmaps_link }}" target="_blank" rel="noopener noreferrer"
               class="group inline-flex items-center gap-2.5 px-5 py-2.5 rounded-2xl border border-gray-200
                      hover:border-primary hover:text-primary text-sm text-gray-600 font-medium transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Lihat di Maps
            </a>
            @endif
            @if($visit->instagram_link)
            <a href="{{ $visit->instagram_link }}" target="_blank" rel="noopener noreferrer"
               class="group inline-flex items-center gap-2.5 px-5 py-2.5 rounded-2xl border border-gray-200
                      hover:border-primary hover:text-primary text-sm text-gray-600 font-medium transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zM17.5 6.5h.01"/>
                </svg>
                Instagram
            </a>
            @endif
        </div>
        @endif

        {{-- Fin --}}
        <div class="story-el mt-12 flex items-center gap-4 opacity-0">
            <span class="flex-1 h-px bg-gray-200/60"></span>
            <span class="text-gray-300 font-serif italic text-sm">fin.</span>
            <span class="flex-1 h-px bg-gray-200/60"></span>
        </div>

    </article>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lottie-web@5.12.2/build/player/lottie.min.js"></script>
<script>
/* Reading progress bar */
window.addEventListener('scroll', () => {
    const pct = Math.min(window.scrollY / (document.body.scrollHeight - window.innerHeight) * 100, 100);
    document.getElementById('progress-bar').style.width = pct + '%';
}, { passive: true });

/* Hero entrance */
gsap.set('.gallery-section', { y: 36 });
gsap.to('.gallery-section', { opacity: 1, y: 0, duration: 0.9, ease: 'power2.out', delay: 0.06 });

/* Article stagger */
gsap.set('.story-el', { y: 20 });
gsap.to('.story-el', { opacity: 1, y: 0, duration: 0.65, ease: 'power2.out', stagger: 0.08, delay: 0.45 });

/* Swiper */
@if($visit->images->isNotEmpty())
const sw = new Swiper('.swiper', {
    slidesPerView: 1, spaceBetween: 0,
    loop: {{ $visit->images->count() > 1 ? 'true' : 'false' }},
@if($visit->images->count() > 1)
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    autoplay:   { delay: 5500, disableOnInteraction: false },
    @endif
});
@if($visit->images->count() > 1)
const ctr = document.getElementById('img-counter');
if (ctr) sw.on('slideChange', () => { ctr.textContent = (sw.realIndex + 1) + ' / {{ $visit->images->count() }}'; });
@endif
@endif

/* Lottie cat — floating in article margin */
(function () {
    var el = document.getElementById('cat-lottie');
    if (!el || typeof lottie === 'undefined') return;
    lottie.loadAnimation({
        container: el,
        renderer:  'svg',
        loop:      true,
        autoplay:  true,
        path:      '/animations/lovely-cat.json'
    });
}());
</script>
<style>
.swiper-button-prev, .swiper-button-next { color: #fff !important; }
.swiper-button-prev::after, .swiper-button-next::after { font-size: 11px !important; font-weight: 800 !important; }
.swiper-pagination-bullet { background: #fff !important; opacity: 0.55; }
.swiper-pagination-bullet-active { opacity: 1 !important; }
</style>
@endpush
