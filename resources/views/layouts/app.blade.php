<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TwoSeats') — A quiet place where we keep our stories.</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-white text-gray-800 antialiased" style="cursor:none;">

    <header class="border-b border-gray-100 sticky top-0 bg-white/95 backdrop-blur-sm z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
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
