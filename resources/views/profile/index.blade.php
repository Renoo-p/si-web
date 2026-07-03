@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white border border-stone-100 rounded-3xl p-6 shadow-xs">
    <h1 class="text-xl font-black text-stone-800 mb-6">Manajemen Profil</h1>
    
    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 p-3 text-xs rounded-xl mb-4 font-semibold">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div class="flex flex-col items-center mb-4">
            <img src="{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=10B981&color=fff' }}" class="w-24 h-24 rounded-full object-cover border border-stone-200 mb-2 shadow-xs" alt="Avatar">
            <label class="text-xs text-emerald-600 font-bold cursor-pointer hover:underline">
                Ubah Foto
                <input type="file" name="profile_photo" class="hidden" accept="image/*">
            </label>
        </div>

        <div>
            <label class="text-xs font-bold text-stone-600 block mb-1">Nama Lengkap</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-stone-50 border rounded-xl px-4 py-2.5 text-sm focus:outline-emerald-500" required>
        </div>

        <div>
            <label class="text-xs font-bold text-stone-400 block mb-1">Kredensial Akun</label>
            <input type="text" disabled value="{{ $user->email ?? $user->phone }}" class="w-full bg-stone-100 border text-stone-400 rounded-xl px-4 py-2.5 text-sm cursor-not-allowed">
        </div>

        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-xl text-sm font-bold cursor-pointer transition">Simpan Perubahan</button>
    </form>

    <div class="mt-6 pt-4 border-t border-stone-100">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 py-2.5 rounded-xl text-sm font-bold cursor-pointer transition">Keluar Akun (Logout)</button>
        </form>
    </div>
</div>

<script>
    document.querySelector('input[name="profile_photo"]').addEventListener('change', function(e) {
        const previewImg = document.querySelector('img[alt="Avatar"]');
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(x) {
                previewImg.src = x.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection