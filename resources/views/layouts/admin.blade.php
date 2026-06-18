<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'TwoSeats')</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500&family=Playfair+Display:ital,wght@0,400;0,500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-50 text-gray-800 antialiased">

<div class="flex min-h-screen">
    <aside class="w-60 bg-white border-r border-gray-100 flex flex-col fixed inset-y-0">
        <div class="px-6 py-6 border-b border-gray-100">
            <a href="{{ route('home') }}" class="block">
                <span class="font-serif text-lg font-medium text-gray-900">TwoSeats</span>
                <span class="block text-xs text-gray-400 mt-0.5">Admin Panel</span>
            </a>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="{{ route('admin.visits.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors
                      {{ request()->routeIs('admin.visits.index') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Semua Kunjungan
            </a>
            <a href="{{ route('admin.visits.create') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors
                      {{ request()->routeIs('admin.visits.create') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kunjungan
            </a>
            <div class="pt-2">
                <a href="{{ route('explore') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Website
                </a>
            </div>
        </nav>
        <div class="px-4 py-4 border-t border-gray-100">
            <div class="px-3 py-2 mb-2">
                <p class="text-xs text-gray-500">Logged in as</p>
                <p class="text-sm font-medium text-gray-800 truncate">{{ auth()->user()->email }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-red-50 hover:text-red-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="ml-60 flex-1 flex flex-col">
        <div class="flex-1 p-10">
            @if(session('success'))
            <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
                {{ session('success') }}
            </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
