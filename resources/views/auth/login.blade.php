<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DapurAI</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-emerald-50 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white border border-stone-100 p-8 rounded-3xl max-w-sm w-full shadow-md">
        <h2 class="text-2xl font-black text-center text-emerald-600 mb-2">Dapur<span class="text-amber-500">AI</span></h2>
        <p class="text-center text-xs text-stone-400 mb-6">Masuk untuk menjelajah cita rasa kuliner dunia</p>
        
        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 text-xs rounded-xl mb-4 font-semibold">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-bold text-stone-600 block mb-1">Email atau No Handphone</label>
                <input type="text" name="login" placeholder="Contoh: user@mail.com atau 08123..." class="w-full bg-stone-50 border rounded-xl px-4 py-2.5 text-sm focus:outline-emerald-500" required>
            </div>
            <div>
                <label class="text-xs font-bold text-stone-600 block mb-1">Password</label>
                <input type="password" name="password" placeholder="••••••••" class="w-full bg-stone-50 border rounded-xl px-4 py-2.5 text-sm focus:outline-emerald-500" required>
            </div>
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-xl text-sm font-bold transition cursor-pointer">Masuk Sekarang</button>
        </form>
        <p class="text-xs text-stone-500 text-center mt-6">Belum punya akun? <a href="{{ route('register') }}" class="text-emerald-600 font-bold hover:underline">Daftar</a></p>
    </div>
</body>
</html>