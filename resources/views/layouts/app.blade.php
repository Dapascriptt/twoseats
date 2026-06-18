<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TwoSeats') — A quiet place where we keep our stories.</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── Page Loader ── */
        #page-loader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: #FAFAF7;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            transition: opacity 0.55s ease, visibility 0.55s ease;
        }
        #page-loader.hide {
            opacity: 0;
            visibility: hidden;
        }
        #page-loader .loader-label {
            font-family: 'Playfair Display', Georgia, serif;
            font-style: italic;
            font-size: 0.9rem;
            color: #618764;
            letter-spacing: 0.08em;
            opacity: 0.7;
        }
        /* ── Coffee Animation ── */
        .coffee {
            --bg: #FAFAF7;
            --fg: #618764;
            font-size: 0.6em;
            position: relative;
            width: 21.5em;
            height: 9em;
            color: var(--fg);
        }
        .coffee:before {
            border-bottom: 0.25em dashed var(--fg);
            opacity: 0.25;
            content: "";
            display: block;
            position: absolute;
            top: 7.5em;
            width: 100%;
        }
        .coffee__cup,
        .coffee__cup-part,
        .coffee__cup-handle,
        .coffee__steam-part {
            animation-duration: 8s;
            animation-iteration-count: infinite;
        }
        .coffee__cup,
        .coffee__cup-part,
        .coffee__cup-handle {
            animation-timing-function: cubic-bezier(0.9,0,0.1,1);
        }
        .coffee__cup {
            animation-name: cup;
            position: relative;
            width: 11.25em;
            height: 9em;
        }
        .coffee__cup-part {
            background-color: var(--bg);
            position: absolute;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .coffee__cup-part--a {
            animation-name: cup-part-a;
            border-radius: 5.625em 5.625em 5.625em 5.625em / 2em 2em 2.7em 2.7em;
            box-shadow: 0 0 0 0.3em var(--fg) inset;
            top: 4.3em; width: 11.25em; height: 4.7em;
        }
        .coffee__cup-part--b {
            animation-name: cup-part-b;
            background-color: transparent;
            border-radius: 5.625em / 2em;
            box-shadow: 0 0 0 0.2em var(--fg) inset;
            top: 4.3em; width: 11.25em; height: 4em;
        }
        .coffee__cup-part--c {
            animation-name: cup-part-c;
            border-radius: 1.7em / 0.45em;
            box-shadow: 0 0 0 0.2em var(--fg) inset;
            top: 7.1em; left: 3.925em; width: 3.4em; height: 0.9em;
        }
        .coffee__cup-part--d,
        .coffee__cup-part--e,
        .coffee__cup-part--f { z-index: 1; }
        .coffee__cup-part--d {
            animation-name: cup-part-d;
            border-radius: 3.6em 3.6em 3.3em 3.3em / 1em 1em 3.5em 3.5em;
            box-shadow: 0 0 0 0.2em var(--fg) inset;
            top: 2.55em; left: 2.025em; width: 7.2em; height: 5.15em;
        }
        .coffee__cup-part--e {
            animation-name: cup-part-e;
            background-color: var(--fg);
            box-shadow: 0 0 0 0.2em var(--fg) inset, 0 1em 0 var(--bg) inset;
            border-radius: 3.5em / 1em;
            top: 2.65em; left: 2.125em; width: 7em; height: 2em;
        }
        .coffee__cup-part--f {
            animation-name: cup-part-f;
            background-color: transparent;
            top: 4.1em; left: 5.925em; width: 4.8em; height: 3em;
        }
        .coffee__cup-handle { animation-name: cup-handle; }
        .coffee__cup,
        .coffee__steam { transform: translateX(-50%); }
        .coffee__steam {
            display: block; position: absolute;
            top: 0; left: 0; width: 3.5em; height: 3.5em;
        }
        .coffee__steam--right { right: 0; left: auto; transform: translateX(50%); }
        .coffee__steam-part {
            animation-name: steam-left;
            animation-timing-function: linear;
            stroke-dashoffset: 48;
        }
        .coffee__steam--right .coffee__steam-part { animation-name: steam-right; stroke-dashoffset: 35; }
        .coffee__steam-part--a { stroke-dasharray: 24 142; }
        .coffee__steam-part--b { stroke-dasharray: 30 8 10 130; }
        .coffee__steam-part--c { stroke-dasharray: 15 6 1 134; }
        .coffee__steam-part--d { stroke-dasharray: 18 6 1 90; }
        .coffee__steam-part--e { stroke-dasharray: 25 6 4 76; }
        @keyframes cup {
            from, 25%, 75%, to { left: 0; }
            50% { left: 21.5em; }
        }
        @keyframes cup-part-a {
            from, 50%, to { width: 11.25em; }
            25%, 75% { width: calc(11.25em + 21.5em); }
        }
        @keyframes cup-part-b {
            from, 50%, to { width: 11.25em; }
            25%, 75% { width: calc(11.25em + 21.5em); }
        }
        @keyframes cup-part-c {
            from, 50%, to { width: 3.4em; }
            25%, 75% { width: calc(3.4em + 21.5em); }
        }
        @keyframes cup-part-d {
            from, 50%, to { width: 7.2em; }
            25%, 75% { width: calc(7.2em + 21.5em); }
        }
        @keyframes cup-part-e {
            from, 50%, to { box-shadow: 0 0 0 0.2em var(--fg) inset, 0 1em 0 var(--bg) inset; width: 7em; }
            25%, 75% { box-shadow: 0 0 0 0.2em var(--fg) inset, 0 1.5em 0 var(--bg) inset; width: calc(7em + 21.5em); }
        }
        @keyframes cup-part-f {
            from { left: 5.925em; z-index: 0; }
            25% { left: calc(5.925em + 8.35em); z-index: 0; }
            50% { left: 0.525em; z-index: 0; }
            50.01% { left: 0.525em; z-index: 1; }
            75% { left: calc(5.925em + 8.35em); z-index: 1; }
            to { left: 5.925em; z-index: 1; }
        }
        @keyframes cup-handle {
            from, to {
                animation-timing-function: ease-in;
                d: path("M64,4.413s6.64-2.913,11-2.913c11.739,0,19.5,10.759,19.5,22.497,0,23.475-45,22.497-45,22.497");
                transform: translate(0,0);
            }
            10%, 40%, 60%, 90% {
                animation-timing-function: ease-out;
                d: path("M48.036,4.415s-.03-2.913-.049-2.913c-.052,0-.087,10.759-.087,22.497,0,23.475,.2,22.497,.2,22.497");
                transform: translate(0,15px);
            }
            50% {
                animation-timing-function: ease-in;
                d: path("M32,4.413s-6.64-2.913-11-2.913C9.261,1.5,1.5,12.259,1.5,23.997c0,23.475,45,22.497,45,22.497");
                transform: translate(0,0);
            }
        }
        @keyframes steam-left {
            from { stroke-dashoffset: 48; }
            25%, to { stroke-dashoffset: -66; }
        }
        @keyframes steam-right {
            from, 50% { stroke-dashoffset: 35; }
            75%, to { stroke-dashoffset: -76; }
        }
        /* ── Navbar ── */
        #main-nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background: transparent;
            border-bottom: 1px solid transparent;
            transition: background 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease;
        }
        #main-nav.nav-scrolled {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgb(243 244 246);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        }
        #nav-inner {
            transition: padding 0.4s ease;
        }
        #main-nav.nav-scrolled #nav-inner {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
    </style>
</head>
<body class="font-sans bg-white text-gray-800 antialiased" style="cursor:none;">

    {{-- Page Loader --}}
    <div id="page-loader" role="status" aria-label="Loading">
        <div class="coffee" aria-label="Coffee cup loading animation">
            <div class="coffee__cup">
                <div class="coffee__cup-part coffee__cup-part--a"></div>
                <div class="coffee__cup-part coffee__cup-part--b"></div>
                <div class="coffee__cup-part coffee__cup-part--c"></div>
                <div class="coffee__cup-part coffee__cup-part--d"></div>
                <div class="coffee__cup-part coffee__cup-part--e"></div>
                <svg class="coffee__cup-part coffee__cup-part--f" width="96px" height="60px" viewBox="0 0 96 60" aria-hidden="true">
                    <g fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round">
                        <path class="coffee__cup-handle" d="M64,4.413s6.64-2.913,11-2.913c11.739,0,19.5,10.759,19.5,22.497,0,23.475-45,22.497-45,22.497"/>
                    </g>
                </svg>
            </div>
            <svg class="coffee__steam" width="56px" height="56px" viewBox="0 0 56 56" aria-hidden="true">
                <g fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round">
                    <path class="coffee__steam-part coffee__steam-part--a" d="M13.845,54s-5.62-10.115-4.496-16.859,6.83-11.497,8.992-17.983c1.037-3.11,.161-6.937-1.083-10.158"/>
                    <path class="coffee__steam-part coffee__steam-part--b" d="M27.844,54s-5.652-10.174-4.522-16.957,6.869-11.564,9.043-18.087c2.261-6.783-4.522-16.957-4.522-16.957"/>
                    <path class="coffee__steam-part coffee__steam-part--c" d="M40.434,50.999c-1.577-3.486-3.818-9.462-3.071-13.944,1.121-6.723,6.809-11.462,8.964-17.928,1.033-3.1,.161-6.916-1.08-10.127"/>
                </g>
            </svg>
            <svg class="coffee__steam coffee__steam--right" width="56px" height="56px" viewBox="0 0 56 56" aria-hidden="true">
                <g fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round">
                    <path class="coffee__steam-part coffee__steam-part--d" d="M19.845,54s-5.62-10.115-4.496-16.859,6.83-11.497,8.992-17.983c1.037-3.11,.161-6.937-1.083-10.158"/>
                    <path class="coffee__steam-part coffee__steam-part--e" d="M34.434,44c-1.577-3.486-3.818-9.462-3.071-13.944,1.121-6.723,6.809-11.462,8.964-17.928,1.033-3.1,.161-6.916-1.08-10.127"/>
                </g>
            </svg>
        </div>
        <p class="loader-label">brewing your memories…</p>
    </div>

    <header id="main-nav">
        <div id="nav-inner" class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-serif text-xl font-medium text-primary tracking-tight">
                TwoSeats
            </a>
            <nav class="flex items-center gap-8">
                <a href="{{ route('home') }}"
                   class="text-sm transition-colors {{ request()->routeIs('home') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">
                    Home
                </a>
                <a href="{{ route('explore') }}"
                   class="text-sm transition-colors {{ request()->routeIs('explore') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">
                    Explore
                </a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-gray-100 mt-24 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="font-serif italic text-gray-400 text-sm">A small place for our memories.</p>
        </div>
    </footer>

    @stack('scripts')

    {{-- Loader dismiss --}}
    <script>
    (function () {
        var loader = document.getElementById('page-loader');
        function hideLoader() {
            loader.classList.add('hide');
            setTimeout(function () { loader.style.display = 'none'; }, 600);
        }
        if (document.readyState === 'complete') {
            hideLoader();
        } else {
            window.addEventListener('load', hideLoader);
        }
    })();
    </script>

    {{-- Navbar scroll effect --}}
    <script>
    (function () {
        var nav = document.getElementById('main-nav');
        function onScroll() {
            nav.classList.toggle('nav-scrolled', window.scrollY > 40);
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    })();
    </script>

    {{-- Global coffee-bean cursor trail --}}
    <canvas id="g-cursor" style="position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:9999;" aria-hidden="true"></canvas>
    <script>
    (function(){
        var c    = document.getElementById('g-cursor');
        var ctx  = c.getContext('2d');
        var tr   = [];
        var LIFE = 520; /* ms each particle lives */

        function resize(){ c.width = window.innerWidth; c.height = window.innerHeight; }
        resize();
        window.addEventListener('resize', resize, {passive:true});

        window.addEventListener('mousemove', function(e){
            tr.push({x:e.clientX, y:e.clientY, r:Math.random()*Math.PI*2, t:performance.now()});
            if(tr.length > 28) tr.shift();
        }, {passive:true});

        (function loop(){
            var now = performance.now();
            /* Remove particles older than LIFE ms — this prevents "stuck" trail */
            tr = tr.filter(function(p){ return now - p.t < LIFE; });

            ctx.clearRect(0,0,c.width,c.height);
            var len = tr.length;
            tr.forEach(function(p,i){
                var prog  = i / Math.max(len, 1);
                var alive = 1 - (now - p.t) / LIFE; /* 1 → 0 as particle ages */
                var sz    = 2.5 + prog * 4.5;
                ctx.save();
                ctx.translate(p.x, p.y);
                ctx.rotate(p.r + i * 0.12);
                ctx.globalAlpha = prog * 0.38 * alive;
                ctx.fillStyle   = '#618764';
                ctx.beginPath();
                ctx.ellipse(0, 0, sz, sz * 0.58, 0, 0, Math.PI * 2);
                ctx.fill();
                if(sz > 4){
                    ctx.strokeStyle = '#3D5C3D';
                    ctx.lineWidth   = 0.9;
                    ctx.beginPath();
                    ctx.moveTo(0, -sz * 0.58);
                    ctx.lineTo(0,  sz * 0.58);
                    ctx.stroke();
                }
                ctx.restore();
            });
            requestAnimationFrame(loop);
        })();
    })();
    </script>
</body>
</html>
