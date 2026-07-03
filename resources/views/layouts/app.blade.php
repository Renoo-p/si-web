<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Kuliner Interaktif & AI</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        /* Custom dynamic transitions */
        .heart-beat:active { transform: scale(1.3); transition: transform 0.1s ease-in-out; }
    </style>
</head>
<body class="bg-emerald-50 text-stone-800 pb-24 font-sans">

    <header class="bg-white shadow-xs sticky top-0 z-50 border-b border-stone-100">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-black text-emerald-600 tracking-tight">Dapur<span class="text-amber-500">AI</span></h1>
            <div class="hidden md:flex space-x-6 font-medium">
                <a href="{{ route('dashboard') }}" class="hover:text-emerald-600 transition">Beranda</a>
                <a href="{{ route('search') }}" class="hover:text-emerald-600 transition">Cari Resep</a>
                <a href="{{ route('chat.index') }}" class="hover:text-emerald-600 transition">Tanya AI</a>
                <a href="{{ route('favorites.index') }}" class="hover:text-emerald-600 transition">Favorit</a>
                <a href="{{ route('profile.index') }}" class="hover:text-emerald-600 transition">Akun</a>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 mt-6">
        @yield('content')
    </main>

    <nav class="md:hidden fixed bottom-4 left-4 right-4 bg-white/90 backdrop-blur-md shadow-xl rounded-2xl border border-stone-200/50 py-3 px-6 z-50">
        <div class="flex justify-between items-center text-stone-500 text-xs font-medium">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center {{ Route::is('dashboard') ? 'text-emerald-600 font-bold' : '' }}">
                <span class="text-xl">🏠</span><span>Beranda</span>
            </a>
            <a href="{{ route('search') }}" class="flex flex-col items-center {{ Route::is('search') ? 'text-emerald-600 font-bold' : '' }}">
                <span class="text-xl">🔍</span><span>Cari</span>
            </a>
            <a href="{{ route('chat.index') }}" class="flex flex-col items-center {{ Route::is('chat.index') ? 'text-emerald-600 font-bold' : '' }}">
                <span class="text-xl"><img width="32" height="32" src="https://img.icons8.com/liquid-glass-color/32/sparkling.png" alt="sparkling"/></span><span>Koki AI</span>
            </a>
            <a href="{{ route('favorites.index') }}" class="flex flex-col items-center {{ Route::is('favorites.index') ? 'text-emerald-600 font-bold' : '' }}">
                <span class="text-xl">❤️</span><span>Favorit</span>
            </a>
            <a href="{{ route('profile.index') }}" class="flex flex-col items-center {{ Route::is('profile.index') ? 'text-emerald-600 font-bold' : '' }}">
                <span class="text-xl">👤</span><span>Akun</span>
            </a>
        </div>
    </nav>

</body>
</html>