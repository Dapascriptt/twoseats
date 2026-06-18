@extends('layouts.app')

@section('title', 'TwoSeats')

@section('content')

<section id="hero" class="relative min-h-screen flex items-center overflow-hidden bg-[#FAFAF7]">

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(circle, #61876422 1.2px, transparent 1.2px); background-size: 28px 28px;"></div>

    {{-- Ambient blobs --}}
    <div class="blob-1 absolute w-[28rem] h-[28rem] rounded-full bg-primary pointer-events-none" style="top:5%;left:2%;opacity:0.05;filter:blur(80px);"></div>
    <div class="blob-2 absolute w-72 h-72 rounded-full bg-amber-300 pointer-events-none" style="bottom:15%;right:8%;opacity:0.07;filter:blur(60px);"></div>

    <div class="max-w-7xl mx-auto px-6 w-full py-24 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

        {{-- ===== LEFT : Text ===== --}}
        <div class="z-10">

            <p class="hero-label inline-flex items-center gap-3 text-xs font-medium tracking-[0.22em] text-primary uppercase mb-8 opacity-0">
                <span class="block w-8 h-px bg-primary"></span>
                Our Coffee Journal
            </p>

            <h1 class="font-serif leading-[1.02] mb-6">
                <span class="hero-w1 block text-[5.5rem] md:text-[7rem] xl:text-[8rem] font-medium text-gray-900 opacity-0 translate-y-8">Two</span>
                <span class="hero-w2 block text-[5.5rem] md:text-[7rem] xl:text-[8rem] font-medium text-primary italic opacity-0 translate-y-8">Seats.</span>
            </h1>

            <p class="hero-sub text-gray-500 text-lg leading-relaxed max-w-sm mb-4 opacity-0">
                Places we stop by,<br>
                <span id="rotating-word" class="font-serif italic text-primary">moments</span>
                worth keeping.
            </p>

            <div class="hero-cta flex flex-wrap items-center gap-5 opacity-0 mt-8">
                <a href="{{ route('explore') }}"
                   class="group inline-flex items-center gap-3 bg-primary text-white px-7 py-3.5 rounded-full text-sm font-medium shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 hover:scale-105 transition-all duration-300">
                    Let's Go
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                @if($totalCount > 0)
                <span class="text-sm text-gray-400">{{ $totalCount }} sudah marva datagin ^-^</span>
                @endif
            </div>

        </div>

        {{-- ===== RIGHT : Illustrated Scene ===== --}}
        <div id="illo-wrapper" class="relative flex justify-center items-center opacity-0">

            <svg id="main-illo" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"
                 class="w-full max-w-md select-none drop-shadow-2xl">
                <defs>
                    <radialGradient id="bgGrad" cx="50%" cy="42%" r="56%">
                        <stop offset="0%"   stop-color="#FFFCF0"/>
                        <stop offset="100%" stop-color="#FFE2B8"/>
                    </radialGradient>
                    <radialGradient id="tableGrad" cx="46%" cy="36%" r="60%">
                        <stop offset="0%"   stop-color="#F8DEBC"/>
                        <stop offset="70%"  stop-color="#E8C490"/>
                        <stop offset="100%" stop-color="#CEAA6C"/>
                    </radialGradient>
                    <radialGradient id="cupL" cx="36%" cy="30%" r="65%" gradientUnits="userSpaceOnUse"
                                    x1="120" y1="230" x2="196" y2="296">
                        <stop offset="0%"   stop-color="#FFFAF2"/>
                        <stop offset="55%"  stop-color="#EDE0CC"/>
                        <stop offset="100%" stop-color="#D4C0A4"/>
                    </radialGradient>
                    <radialGradient id="cupR" cx="36%" cy="30%" r="65%" gradientUnits="userSpaceOnUse"
                                    x1="304" y1="230" x2="380" y2="296">
                        <stop offset="0%"   stop-color="#FFFAF2"/>
                        <stop offset="55%"  stop-color="#EDE0CC"/>
                        <stop offset="100%" stop-color="#D4C0A4"/>
                    </radialGradient>
                    <radialGradient id="coffeeL" cx="38%" cy="32%" r="62%" gradientUnits="userSpaceOnUse"
                                    x1="128" y1="238" x2="188" y2="290">
                        <stop offset="0%"   stop-color="#7A3C14"/>
                        <stop offset="40%"  stop-color="#2C0E04"/>
                        <stop offset="100%" stop-color="#0E0200"/>
                    </radialGradient>
                    <radialGradient id="coffeeR" cx="38%" cy="32%" r="62%" gradientUnits="userSpaceOnUse"
                                    x1="312" y1="238" x2="372" y2="290">
                        <stop offset="0%"   stop-color="#7A3C14"/>
                        <stop offset="40%"  stop-color="#2C0E04"/>
                        <stop offset="100%" stop-color="#0E0200"/>
                    </radialGradient>
                    <filter id="softDrop" x="-10%" y="-10%" width="120%" height="130%">
                        <feDropShadow dx="1" dy="5" stdDeviation="5" flood-color="#00000018"/>
                    </filter>
                    <filter id="glow">
                        <feGaussianBlur stdDeviation="2.5" result="b"/>
                        <feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge>
                    </filter>
                </defs>

                {{-- Background circle --}}
                <g id="illo-bg">
                    <circle cx="250" cy="250" r="232" fill="url(#bgGrad)"/>
                    <g opacity="0.14" fill="#618764">
                        <circle cx="128" cy="128" r="3.5"/><circle cx="168" cy="96" r="2.5"/>
                        <circle cx="352" cy="116" r="3.5"/><circle cx="392" cy="146" r="2.5"/>
                        <circle cx="96"  cy="302" r="2.5"/><circle cx="74"  cy="354" r="3.5"/>
                        <circle cx="408" cy="280" r="2.5"/><circle cx="432" cy="334" r="3.5"/>
                        <circle cx="250" cy="58"  r="2.5"/><circle cx="250" cy="442" r="2.5"/>
                    </g>
                </g>

                {{-- Table --}}
                <g id="illo-table">
                    <ellipse cx="250" cy="284" rx="183" ry="164" fill="#C8A060" opacity="0.28"/>
                    <ellipse cx="250" cy="280" rx="180" ry="160" fill="url(#tableGrad)"/>
                    <ellipse cx="250" cy="270" rx="166" ry="145" fill="#FBE8CA" opacity="0.55"/>
                    <ellipse cx="250" cy="265" rx="155" ry="133" fill="none" stroke="#FFFFFF" stroke-width="1.8" opacity="0.25"/>
                </g>

                {{-- Leaves --}}
                <g id="illo-leaves">
                    <g class="leaf">
                        <path d="M76 196 Q52 166 68 142 Q96 160 76 196Z" fill="#3D6844"/>
                        <path d="M76 196 Q100 166 84 142 Q56 160 76 196Z" fill="#618764"/>
                        <path d="M76 196 Q82 170 76 144" stroke="#2E5234" stroke-width="1.6" fill="none" stroke-linecap="round"/>
                    </g>
                    <g class="leaf">
                        <path d="M424 158 Q448 128 432 104 Q404 122 424 158Z" fill="#3D6844"/>
                        <path d="M424 158 Q400 128 416 104 Q444 122 424 158Z" fill="#618764"/>
                        <path d="M424 158 Q418 132 424 106" stroke="#2E5234" stroke-width="1.6" fill="none" stroke-linecap="round"/>
                    </g>
                    <g class="leaf">
                        <path d="M88 376 Q64 350 80 326 Q106 342 88 376Z" fill="#335838"/>
                        <path d="M88 376 Q112 350 96 326 Q70 342 88 376Z" fill="#618764"/>
                        <path d="M88 376 Q94 350 88 328" stroke="#2E5234" stroke-width="1.6" fill="none" stroke-linecap="round"/>
                    </g>
                    <g class="leaf">
                        <path d="M414 374 Q438 348 422 324 Q396 340 414 374Z" fill="#3D6844"/>
                        <path d="M414 374 Q390 348 406 324 Q432 340 414 374Z" fill="#618764"/>
                        <path d="M414 374 Q408 348 414 326" stroke="#2E5234" stroke-width="1.6" fill="none" stroke-linecap="round"/>
                    </g>
                </g>

                {{-- Coffee beans --}}
                <g id="illo-beans">
                    <g class="bean">
                        <ellipse cx="100" cy="304" rx="14" ry="8.5" fill="#5C3010" transform="rotate(25 100 304)"/>
                        <ellipse cx="100" cy="304" rx="11" ry="6"   fill="#8B5030" transform="rotate(25 100 304)" opacity="0.6"/>
                        <line x1="100" y1="296" x2="100" y2="312" stroke="#3A1C08" stroke-width="2" transform="rotate(25 100 304)"/>
                    </g>
                    <g class="bean">
                        <ellipse cx="408" cy="322" rx="13" ry="8" fill="#4E2808" transform="rotate(-20 408 322)"/>
                        <ellipse cx="408" cy="322" rx="10" ry="5.5" fill="#7A4428" transform="rotate(-20 408 322)" opacity="0.6"/>
                        <line x1="408" y1="314" x2="408" y2="330" stroke="#3A1C08" stroke-width="2" transform="rotate(-20 408 322)"/>
                    </g>
                    <g class="bean">
                        <ellipse cx="384" cy="108" rx="12.5" ry="7.5" fill="#5C3010" transform="rotate(40 384 108)"/>
                        <ellipse cx="384" cy="108" rx="9.5"  ry="5.5" fill="#8B5030" transform="rotate(40 384 108)" opacity="0.6"/>
                        <line x1="384" y1="101" x2="384" y2="115" stroke="#3A1C08" stroke-width="2" transform="rotate(40 384 108)"/>
                    </g>
                    <g class="bean">
                        <ellipse cx="118" cy="116" rx="12" ry="7.5" fill="#4E2808" transform="rotate(-35 118 116)"/>
                        <ellipse cx="118" cy="116" rx="9"  ry="5.5" fill="#7A4428" transform="rotate(-35 118 116)" opacity="0.6"/>
                        <line x1="118" y1="109" x2="118" y2="123" stroke="#3A1C08" stroke-width="2" transform="rotate(-35 118 116)"/>
                    </g>
                    <g class="bean">
                        <ellipse cx="252" cy="86" rx="11.5" ry="7" fill="#5C3010" transform="rotate(10 252 86)"/>
                        <ellipse cx="252" cy="86" rx="8.5"  ry="5" fill="#8B5030" transform="rotate(10 252 86)" opacity="0.6"/>
                        <line x1="252" y1="79" x2="252" y2="93" stroke="#3A1C08" stroke-width="2" transform="rotate(10 252 86)"/>
                    </g>
                </g>

                {{-- Sparkles --}}
                <g id="illo-sparkles">
                    <path d="M441 196 l3.5-9 3.5 9 9 3.5-9 3.5-3.5 9-3.5-9-9-3.5Z" fill="#F5C040" opacity="0.75" filter="url(#glow)"/>
                    <path d="M56 148 l2.5-6.5 2.5 6.5 6.5 2.5-6.5 2.5-2.5 6.5-2.5-6.5-6.5-2.5Z" fill="#618764" opacity="0.65"/>
                    <path d="M462 334 l2-5 2 5 5 2-5 2-2 5-2-5-5-2Z" fill="#F5C040" opacity="0.55"/>
                    <path d="M38 338 l2-5 2 5 5 2-5 2-2 5-2-5-5-2Z" fill="#618764" opacity="0.50"/>
                    <circle cx="462" cy="148" r="3.5" fill="#F5C040" opacity="0.45"/>
                    <circle cx="40"  cy="202" r="2.5" fill="#618764" opacity="0.40"/>
                </g>

                {{-- Journal --}}
                <g id="illo-journal" style="cursor:pointer;" filter="url(#softDrop)">
                    <rect x="196" y="222" width="108" height="77" rx="4" fill="#2E4A2E" opacity="0.14"/>
                    <path d="M198 221 Q198 298 246 300 L246 220 Q226 217 198 221Z" fill="#FFFEF5"/>
                    <path d="M254 220 L254 300 Q302 298 302 222 Q282 218 254 220Z" fill="#FFF9EE"/>
                    <rect x="245" y="220" width="9" height="80" rx="3" fill="#618764"/>
                    <line x1="206" y1="236" x2="241" y2="236" stroke="#DDD5C0" stroke-width="1.5"/>
                    <line x1="206" y1="246" x2="241" y2="246" stroke="#DDD5C0" stroke-width="1.5"/>
                    <line x1="206" y1="256" x2="241" y2="256" stroke="#DDD5C0" stroke-width="1.5"/>
                    <line x1="206" y1="266" x2="239" y2="266" stroke="#DDD5C0" stroke-width="1.5"/>
                    <line x1="206" y1="276" x2="240" y2="276" stroke="#DDD5C0" stroke-width="1.5"/>
                    <line x1="258" y1="236" x2="293" y2="236" stroke="#DDD5C0" stroke-width="1.5"/>
                    <line x1="258" y1="246" x2="293" y2="246" stroke="#DDD5C0" stroke-width="1.5"/>
                    <line x1="258" y1="256" x2="293" y2="256" stroke="#DDD5C0" stroke-width="1.5"/>
                    <line x1="258" y1="266" x2="290" y2="266" stroke="#DDD5C0" stroke-width="1.5"/>
                    <line x1="258" y1="276" x2="291" y2="276" stroke="#DDD5C0" stroke-width="1.5"/>
                    <line x1="297" y1="222" x2="306" y2="297" stroke="#3A2A18" stroke-width="2.5" stroke-linecap="round"/>
                    <path d="M306 297 L309 306 L303 299Z" fill="#3A2A18"/>
                    <path d="M249 214 Q251 209 255 214 Q259 209 261 214 Q261 220 255 226 Q249 220 249 214Z" fill="#D86060" opacity="0.9"/>
                </g>

                {{-- Left Cup --}}
                <g id="cup-left" style="cursor:pointer;">
                    <ellipse cx="158" cy="282" rx="60" ry="17" fill="#C4B098" opacity="0.45"/>
                    <ellipse cx="158" cy="279" rx="57" ry="14" fill="#EDE0CA"/>
                    <circle  cx="158" cy="264" r="52" fill="#C8B898"/>
                    <circle  cx="158" cy="264" r="48" fill="#E8D8C0"/>
                    <circle  cx="158" cy="264" r="44" fill="url(#cupL)"/>
                    <circle  cx="158" cy="264" r="38" fill="url(#coffeeL)"/>
                    <ellipse cx="150" cy="256" rx="16" ry="10" fill="#7A3C14" opacity="0.50"/>
                    <ellipse cx="146" cy="253" rx="7"  ry="4.5" fill="#B06030" opacity="0.35"/>
                    <g class="steam-grp">
                        <path class="s1" d="M146 218 Q142 204 149 193 Q154 183 149 172" stroke="#C8B8A0" stroke-width="3" fill="none" stroke-linecap="round"/>
                        <path class="s2" d="M158 215 Q161 200 155 189 Q149 179 155 168" stroke="#BCA890" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path class="s3" d="M170 218 Q167 203 174 192 Q179 182 173 171" stroke="#C8B8A0" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                    </g>
                    <circle id="ripple-l" cx="158" cy="264" r="38" fill="none" stroke="#618764" stroke-width="2.5" opacity="0"/>
                </g>

                {{-- Right Cup --}}
                <g id="cup-right" style="cursor:pointer;">
                    <ellipse cx="342" cy="282" rx="60" ry="17" fill="#C4B098" opacity="0.45"/>
                    <ellipse cx="342" cy="279" rx="57" ry="14" fill="#EDE0CA"/>
                    <circle  cx="342" cy="264" r="52" fill="#C8B898"/>
                    <circle  cx="342" cy="264" r="48" fill="#E8D8C0"/>
                    <circle  cx="342" cy="264" r="44" fill="url(#cupR)"/>
                    <circle  cx="342" cy="264" r="38" fill="url(#coffeeR)"/>
                    <ellipse cx="334" cy="256" rx="16" ry="10" fill="#7A3C14" opacity="0.50"/>
                    <ellipse cx="330" cy="253" rx="7"  ry="4.5" fill="#B06030" opacity="0.35"/>
                    <g class="steam-grp">
                        <path class="s1" d="M330 218 Q326 204 333 193 Q338 183 333 172" stroke="#C8B8A0" stroke-width="3" fill="none" stroke-linecap="round"/>
                        <path class="s2" d="M342 215 Q345 200 339 189 Q333 179 339 168" stroke="#BCA890" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path class="s3" d="M354 218 Q351 203 358 192 Q363 182 357 171" stroke="#C8B8A0" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                    </g>
                    <circle id="ripple-r" cx="342" cy="264" r="38" fill="none" stroke="#618764" stroke-width="2.5" opacity="0"/>
                </g>

            </svg>

        </div>

    </div>

    {{-- Hint text --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-center scroll-cue opacity-0 select-none">
        <p class="text-xs tracking-widest text-gray-300 uppercase mb-2">Klik cangkir untuk menyeruput</p>
        <div class="w-px h-10 bg-gradient-to-b from-gray-200 to-transparent mx-auto"></div>
    </div>


</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
<style>
.steam-grp .s1 { animation: steamRise 3.2s ease-in-out infinite; }
.steam-grp .s2 { animation: steamRise 3.2s ease-in-out infinite 0.7s; }
.steam-grp .s3 { animation: steamRise 3.2s ease-in-out infinite 1.4s; }
#cup-right .steam-grp .s1 { animation-delay: 0.4s; }
#cup-right .steam-grp .s2 { animation-delay: 1.1s; }
#cup-right .steam-grp .s3 { animation-delay: 1.8s; }
@keyframes steamRise {
    0%   { opacity:0; transform:translateY(0) scaleX(1); }
    25%  { opacity:0.6; transform:translateY(-5px) scaleX(1.04); }
    65%  { opacity:0.35; transform:translateY(-13px) scaleX(0.96); }
    100% { opacity:0; transform:translateY(-22px) scaleX(1); }
}
</style>
<script>
/* ======================================================
   GSAP Entrance
====================================================== */
gsap.set([".hero-label",".hero-w1",".hero-w2",".hero-sub",".hero-cta"], { y: 24, opacity: 0 });
gsap.set("#illo-wrapper", { x: 50, opacity: 0 });

const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
tl.to(".hero-label",   { opacity: 1, y: 0, duration: 0.6 }, 0.2)
  .to(".hero-w1",      { opacity: 1, y: 0, duration: 0.9 }, 0.4)
  .to(".hero-w2",      { opacity: 1, y: 0, duration: 0.9 }, 0.55)
  .to(".hero-sub",     { opacity: 1, y: 0, duration: 0.7 }, 0.72)
  .to(".hero-cta",     { opacity: 1, y: 0, duration: 0.6 }, 0.88)
  .to("#illo-wrapper", { opacity: 1, x: 0, duration: 1.2, ease: "power2.out" }, 0.45)
  .to(".scroll-cue",   { opacity: 1, duration: 0.5 }, 1.3);

/* ======================================================
   Blob parallax (still works)
====================================================== */
const hero = document.getElementById("hero");
hero.addEventListener("mousemove", (e) => {
    const r  = hero.getBoundingClientRect();
    const dx = ((e.clientX - r.left) / r.width  - 0.5) * 2;
    const dy = ((e.clientY - r.top)  / r.height - 0.5) * 2;
    gsap.to(".blob-1", { x: dx * 50, y: dy * 35, duration: 1.8, ease: "power1.out" });
    gsap.to(".blob-2", { x: -dx * 35, y: -dy * 25, duration: 1.8, ease: "power1.out" });
});

/* ======================================================
   Rotating Word
====================================================== */
const words  = ["moments", "stories", "memories", "feelings", "sips"];
let wordIdx  = 0;
const wordEl = document.getElementById("rotating-word");
setInterval(() => {
    wordIdx = (wordIdx + 1) % words.length;
    gsap.to(wordEl, { opacity: 0, y: -10, duration: 0.22,
        onComplete: () => {
            wordEl.textContent = words[wordIdx];
            gsap.fromTo(wordEl, { opacity: 0, y: 12 }, { opacity: 1, y: 0, duration: 0.28 });
        }
    });
}, 2400);

/* ======================================================
   Floating emoji (shared)
====================================================== */
function spawnEmoji(char) {
    const span = document.createElement("span");
    span.textContent = char;
    span.style.cssText = "position:fixed;font-size:1.8rem;pointer-events:none;z-index:999;user-select:none;";
    const box = document.getElementById("illo-wrapper").getBoundingClientRect();
    span.style.left = (box.left + box.width  / 2 - 14) + "px";
    span.style.top  = (box.top  + box.height * 0.45) + "px";
    document.body.appendChild(span);
    gsap.to(span, { y: -90, opacity: 0, scale: 1.5, duration: 1.2,
        ease: "power2.out", onComplete: () => span.remove() });
}

/* ======================================================
   Sip Interaction
====================================================== */
function sipCup(cupId, rippleId, tiltDir) {
    gsap.timeline()
        .to("#" + cupId, { rotation: tiltDir * 14, duration: 0.18, ease: "power2.out", transformOrigin: "50% 80%" })
        .to("#" + cupId, { rotation: 0, duration: 0.48, ease: "elastic.out(1, 0.4)" });
    const rp = document.getElementById(rippleId);
    gsap.fromTo(rp,
        { attr: { r: 38 }, opacity: 0.85 },
        { attr: { r: 82 }, opacity: 0, duration: 0.65, ease: "power2.out" }
    );
    const steamPaths = document.getElementById(cupId).querySelectorAll(".steam-grp path");
    gsap.fromTo(steamPaths, { opacity: 0.9 }, { opacity: 0.4, duration: 0.8, ease: "power1.out" });
    spawnEmoji(cupId === "cup-left" ? "☕" : "🌿");
}
document.getElementById("cup-left").addEventListener("click",  () => sipCup("cup-left",  "ripple-l", -1));
document.getElementById("cup-right").addEventListener("click", () => sipCup("cup-right", "ripple-r",  1));

/* ======================================================
   Journal hover
====================================================== */
const journal = document.getElementById("illo-journal");
journal.addEventListener("mouseenter", () =>
    gsap.to("#illo-journal", { scale: 1.06, duration: 0.35, ease: "back.out(2)", transformOrigin: "250px 260px" }));
journal.addEventListener("mouseleave", () =>
    gsap.to("#illo-journal", { scale: 1, duration: 0.3, ease: "power2.out", transformOrigin: "250px 260px" }));

/* ======================================================
   Mouse Parallax
====================================================== */
hero.addEventListener("mousemove", (e) => {
    const r  = hero.getBoundingClientRect();
    const dx = ((e.clientX - r.left) / r.width  - 0.5) * 2;
    const dy = ((e.clientY - r.top)  / r.height - 0.5) * 2;
    gsap.to("#illo-beans",    { x: dx * 20, y: dy * 14, duration: 0.9,  ease: "power1.out" });
    gsap.to("#illo-sparkles", { x: dx * 28, y: dy * 20, duration: 0.9,  ease: "power1.out" });
    gsap.to("#illo-leaves",   { x: dx * 12, y: dy * 9,  duration: 1.1,  ease: "power1.out" });
    gsap.to("#main-illo",     { rotateY: dx * 5, rotateX: -dy * 5, duration: 1.1,
                                ease: "power1.out", transformPerspective: 900 });
    gsap.to(".blob-1",        { x: dx * 50, y: dy * 35, duration: 1.8,  ease: "power1.out" });
    gsap.to(".blob-2",        { x: -dx * 35, y: -dy * 25, duration: 1.8, ease: "power1.out" });
});

/* ======================================================
   Idle float — beans & leaves
====================================================== */
document.querySelectorAll(".bean").forEach((el, i) => {
    gsap.to(el, { y: -(8 + Math.random() * 6),
        rotation: (i % 2 === 0 ? 1 : -1) * (10 + Math.random() * 8),
        duration: 2.5 + i * 0.38, repeat: -1, yoyo: true, ease: "sine.inOut", delay: i * 0.28 });
});
document.querySelectorAll(".leaf").forEach((el, i) => {
    gsap.to(el, { y: -7, rotation: (i % 2 === 0 ? 1 : -1) * 6,
        duration: 3 + i * 0.3, repeat: -1, yoyo: true, ease: "sine.inOut", delay: i * 0.5 });
});


</script>
@endpush
