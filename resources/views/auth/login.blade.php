<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — TwoSeats</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&family=Playfair+Display:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-50 min-h-screen flex items-center justify-center antialiased">

<div class="w-full max-w-sm px-6">
    <div class="text-center mb-10">
        <a href="{{ route('home') }}" class="font-serif text-2xl text-gray-900">TwoSeats</a>
        <p class="text-gray-400 text-sm mt-1 italic">A quiet place where we keep our stories.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-base font-medium text-gray-800 mb-6">Masuk ke admin panel</h2>

        @if($errors->any())
        <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Password</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" id="remember" name="remember" class="rounded text-primary">
                <label for="remember" class="text-xs text-gray-500">Ingat saya</label>
            </div>
            <button type="submit"
                    class="w-full bg-primary text-white py-2.5 rounded-xl text-sm font-medium hover:bg-primary/90 transition-colors mt-2">
                Masuk
            </button>
        </form>
    </div>

    <p class="text-center mt-6 text-xs text-gray-400">
        <a href="{{ route('home') }}" class="hover:text-gray-600 transition-colors">← Kembali ke website</a>
    </p>
</div>

</body>
</html>
