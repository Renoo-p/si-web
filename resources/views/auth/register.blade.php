<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DapurAI</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-emerald-50 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white border border-stone-100 p-8 rounded-3xl max-w-md w-full shadow-md">
        <h2 class="text-xl font-black text-stone-800 mb-1">Buat Akun Baru</h2>
        <p class="text-xs text-stone-400 mb-6">Lengkapi data untuk bergabung ke komunitas DapurAI</p>
        
        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 text-xs rounded-xl mb-4 font-semibold">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-bold text-stone-600 block mb-1">Nama Lengkap</label>
                <input type="text" name="name" placeholder="Nama lengkap Anda" class="w-full bg-stone-50 border rounded-xl px-4 py-2.5 text-sm focus:outline-emerald-500" required>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="text-xs font-bold text-stone-600 block mb-1">Email</label>
                    <input type="email" name="email" placeholder="nama@email.com" class="w-full bg-stone-50 border rounded-xl px-4 py-2.5 text-sm focus:outline-emerald-500">
                </div>
                <div>
                    <label class="text-xs font-bold text-stone-600 block mb-1">Nomor HP</label>
                    <input type="text" name="phone" placeholder="0812345678" class="w-full bg-stone-50 border rounded-xl px-4 py-2.5 text-sm focus:outline-emerald-500">
                </div>
            </div>
            <div>
                <label class="text-xs font-bold text-stone-600 block mb-1">Password</label>
                <input type="password" name="password" placeholder="Min. 6 Karakter" class="w-full bg-stone-50 border rounded-xl px-4 py-2.5 text-sm focus:outline-emerald-500" required>
            </div>
            <div>
                <label class="text-xs font-bold text-stone-600 block mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password" class="w-full bg-stone-50 border rounded-xl px-4 py-2.5 text-sm focus:outline-emerald-500" required>
            </div>
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-xl text-sm font-bold transition cursor-pointer">Daftar Akun</button>
        </form>
        <p class="text-xs text-stone-500 text-center mt-6">Sudah memiliki akun? <a href="{{ route('login') }}" class="text-emerald-600 font-bold hover:underline">Login</a></p>
    </div>
</body>
</html>