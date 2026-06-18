@extends('layouts.app')

@section('title', 'Explore')

@section('content')

<div class="relative overflow-hidden">

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(circle, #61876422 1.2px, transparent 1.2px); background-size: 28px 28px;"></div>

    {{-- Ambient blobs --}}
    <div class="absolute w-96 h-96 rounded-full bg-primary pointer-events-none" style="top:-6%;right:-4%;opacity:0.04;filter:blur(80px);"></div>
    <div class="absolute w-72 h-72 rounded-full bg-amber-300 pointer-events-none" style="bottom:20%;left:-3%;opacity:0.06;filter:blur(60px);"></div>

{{-- ===== HEADER ===== --}}
<section class="max-w-7xl mx-auto px-6 pt-16 pb-12 relative">
    <div id="explore-head">
        <p class="text-xs font-medium tracking-[0.22em] text-primary uppercase mb-3 flex items-center gap-2">
            <span class="block w-5 h-px bg-primary"></span>Sudah kemana aja ?
        </p>
        <h1 class="font-serif text-5xl md:text-6xl font-medium text-gray-900 mb-2">Explore</h1>
        <p class="text-gray-400 font-serif italic text-sm mb-10">
            {{ $visits->count() }} tempat yang Marva udah datangin sesuai BM nya.
        </p>

        <form method="GET" action="{{ route('explore') }}">
            <div class="relative max-w-sm">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari tempat atau lokasi..."
                       class="w-full pl-11 pr-10 py-3 bg-white border border-gray-200 rounded-2xl text-sm
                              focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary
                              transition-colors placeholder-gray-400 shadow-sm">
                @if(request('search'))
                <a href="{{ route('explore') }}"
                   class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
                @endif
            </div>
        </form>
    </div>
</section>

{{-- ===== CARDS ===== --}}
<section class="max-w-7xl mx-auto px-6 pb-28">

    @if($visits->isEmpty())
    <div class="text-center py-24">
        <p class="font-serif italic text-gray-400 text-xl">
            @if(request('search'))
                Tidak ada tempat yang cocok dengan "{{ request('search') }}".
            @else
                Belum ada kenangan yang tersimpan.
            @endif
        </p>
    </div>
    @else

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($visits as $visit)
        <a href="{{ route('visit.show', $visit) }}"
           class="card group block bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl
                  transition-shadow duration-500 border border-gray-100/80">

            <div class="flex gap-0">

                {{-- Photo --}}
                <div class="w-40 shrink-0 aspect-square overflow-hidden relative">
                    @if($visit->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $visit->images->first()->image_path) }}"
                         alt="{{ $visit->title }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                         loading="lazy">
                    @else
                    <div class="w-full h-full bg-gray-50 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="flex-1 p-5 flex flex-col justify-between min-w-0">
                    <div>
                        <h2 class="font-serif text-base font-medium text-gray-900 group-hover:text-primary
                                   transition-colors leading-snug line-clamp-2 mb-2">
                            {{ $visit->title }}
                        </h2>
                        <p class="text-xs text-gray-500 flex items-center gap-1.5">
                            <svg class="w-3 h-3 shrink-0 text-primary/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="truncate">{{ $visit->location }}</span>
                        </p>
                    </div>

                    <div class="flex items-center justify-between mt-3">
                        <p class="text-xs text-gray-400">
                            {{ $visit->visit_date->translatedFormat('d M Y') }}
                        </p>
                        {{-- Animated emoji sticker (changes on hover via JS) --}}
                        <span class="card-sticker text-lg select-none transition-transform duration-300
                                     group-hover:scale-125 group-hover:rotate-12">
                            {{ ['☕','📸','🌿','✨','📍','☕','📖','🎞'][$loop->index % 8] }}
                        </span>
                    </div>
                </div>

            </div>

        </a>
        @endforeach
    </div>

    @endif
</section>

</div>{{-- end texture wrapper --}}

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
<script>
/* ============================================================
   Header entrance
============================================================ */
anime.set('#explore-head', { opacity: 0, translateY: 24 });
anime({
    targets:  '#explore-head',
    opacity:  1,
    translateY: 0,
    duration: 700,
    easing:  'easeOutExpo',
    delay:    80
});

/* ============================================================
   Cards stagger entrance
============================================================ */
const cards = document.querySelectorAll('.card');
anime.set(cards, { opacity: 0, translateY: 28 });

const io = new IntersectionObserver((entries) => {
    const visible = entries.filter(e => e.isIntersecting);
    if (!visible.length) return;
    anime({
        targets:    visible.map(e => e.target),
        opacity:    1,
        translateY: 0,
        duration:   620,
        easing:    'easeOutExpo',
        delay:      anime.stagger(70)
    });
    visible.forEach(e => io.unobserve(e.target));
}, { threshold: 0.08 });

cards.forEach(el => io.observe(el));

/* ============================================================
   Card sticker bounce on hover
============================================================ */
document.querySelectorAll('.card-sticker').forEach(el => {
    el.closest('a').addEventListener('mouseenter', () => {
        anime({
            targets:  el,
            scale:    [1, 1.35, 1.2],
            rotate:   [0, 18, 12],
            duration: 450,
            easing:   'spring(1, 60, 10, 0)'
        });
    });
    el.closest('a').addEventListener('mouseleave', () => {
        anime({
            targets:  el,
            scale:    1,
            rotate:   0,
            duration: 400,
            easing:   'easeOutElastic(1, 0.5)'
        });
    });
});
</script>
@endpush
