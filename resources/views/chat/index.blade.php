@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-sm border border-stone-100 overflow-hidden flex flex-col h-[75vh]">
    
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white p-4 flex items-center justify-between shadow-xs">
        <div class="flex items-center">
            <span class="text-2xl mr-3"><img width="32" height="32" src="https://img.icons8.com/liquid-glass-color/32/sparkling.png" alt="sparkling"/></span>
            <div>
                <h2 class="font-bold text-sm tracking-tight">Asisten Koki AI Professional</h2>
                <p class="text-[10px] text-emerald-100/90">Resep otomatis, tips dapur, & kreasi kuliner</p>
            </div>
        </div>
        <span class="flex h-2 w-2 relative">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
        </span>
    </div>

    <div class="flex border-b border-stone-100 bg-stone-50/50 text-center">
        <button id="tab-chat" onclick="switchTab('chat')" class="flex-1 py-3 text-xs font-bold border-b-2 border-emerald-600 text-emerald-600 focus:outline-hidden transition cursor-pointer">
            💬 Tanya Chef Bebas
        </button>
        <button id="tab-bahan" onclick="switchTab('bahan')" class="flex-1 py-3 text-xs font-bold border-b-2 border-transparent text-stone-500 hover:text-stone-700 focus:outline-hidden transition cursor-pointer">
            🧺 Isi Bahan Kulkas
        </button>
    </div>
    
    @if($errors->any())
        <div class="bg-red-50 text-red-600 p-3 text-xs rounded-xl mx-4 mt-3 font-semibold border border-red-100">
            ⚠️ {{ $errors->first() }}
        </div>
    @endif

    <div class="flex-1 p-4 overflow-y-auto space-y-4 bg-stone-50/60" id="chat-stream">
        
        <div class="bg-emerald-600 text-white p-3.5 rounded-2xl rounded-tl-none max-w-[85%] text-sm shadow-xs leading-relaxed">
            Halo! Saya Koki AI. Kamu bisa mengobrol bebas denganku untuk menanyakan tips dapur, atau beralih ke tab "Isi Bahan Kulkas" agar aku bisa meracik resep khusus dari bahan-bahan yang kamu punya saat ini! 🍳
        </div>
        
        @if(session('user_msg') || $rekomendasi || $bahan)
            <div class="bg-white text-stone-800 p-3.5 rounded-2xl rounded-tr-none max-w-[85%] text-sm ml-auto border border-stone-200 shadow-xs">
                <span class="block text-[10px] font-bold text-stone-400 uppercase mb-1">
                    @if(session('active_tab') === 'bahan' || (!session('active_tab') && $bahan))
                        Bahan Kulkas Anda:
                    @else
                        Pertanyaan Anda:
                    @endif
                </span>
                <p class="font-medium text-stone-700">{{ session('user_msg') ?? $bahan }}</p>
            </div>
            
            <div class="bg-emerald-50 text-stone-800 p-4 rounded-2xl rounded-tl-none max-w-[85%] text-sm shadow-xs border border-emerald-100/50 leading-relaxed">
                <span class="block text-[10px] font-bold text-emerald-600 uppercase mb-2">🧑‍🍳 Saran Menu & Solusi Chef:</span>
                <div class="prose prose-sm text-stone-700 font-sans">
                    {!! nl2br(e(session('ai_msg') ?? $rekomendasi)) !!}
                </div>
            </div>
        @endif
    </div>
    
    <div class="border-t bg-white p-3">
        
        <form id="form-chat" action="{{ route('chat.submit') }}" method="POST" class="flex gap-2">
            @csrf
            <input type="text" name="message" placeholder="Tanyakan tips memasak, resep kue, trik bumbu..." class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-emerald-500 focus:bg-white transition">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition cursor-pointer shadow-xs">Kirim</button>
        </form>

        <form id="form-bahan" action="{{ route('chat.submit') }}" method="POST" class="flex flex-col gap-2 hidden">
            @csrf
            <textarea name="bahan" rows="2" placeholder="Tulis bahan kulkasmu di sini (Contoh: ayam, wortel, bawang putih, santan...)" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-2 text-sm focus:outline-hidden focus:border-amber-500 focus:bg-white transition resize-none">{{ old('bahan', $bahan) }}</textarea>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white py-2 rounded-xl text-sm font-bold transition cursor-pointer shadow-xs flex items-center justify-center gap-1">
                ✨ Racik Resep dari Bahan Kulkas
            </button>
        </form>

    </div>
</div>

<script>
    function switchTab(mode) {
        const tabChat = document.getElementById('tab-chat');
        const tabBahan = document.getElementById('tab-bahan');
        const formChat = document.getElementById('form-chat');
        const formBahan = document.getElementById('form-bahan');
        
        if (mode === 'chat') {
            tabChat.className = "flex-1 py-3 text-xs font-bold border-b-2 border-emerald-600 text-emerald-600 focus:outline-hidden transition cursor-pointer";
            tabBahan.className = "flex-1 py-3 text-xs font-bold border-b-2 border-transparent text-stone-500 hover:text-stone-700 focus:outline-hidden transition cursor-pointer";
            
            formChat.classList.remove('hidden');
            formBahan.classList.add('hidden');
            formChat.querySelector('input').setAttribute('required', 'required');
            formBahan.querySelector('textarea').removeAttribute('required');
            localStorage.setItem('chef_prefer_mode', 'chat');
        } else {
            tabBahan.className = "flex-1 py-3 text-xs font-bold border-b-2 border-amber-500 text-amber-600 focus:outline-hidden transition cursor-pointer";
            tabChat.className = "flex-1 py-3 text-xs font-bold border-b-2 border-transparent text-stone-500 hover:text-stone-700 focus:outline-hidden transition cursor-pointer";
            
            formBahan.classList.remove('hidden');
            formChat.classList.add('hidden');
            formBahan.querySelector('textarea').setAttribute('required', 'required');
            formChat.querySelector('input').removeAttribute('required');
            localStorage.setItem('chef_prefer_mode', 'bahan');
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const chatStream = document.getElementById('chat-stream');
        chatStream.scrollTop = chatStream.scrollHeight;

        // PROTEKSI GABUNGAN: Mengunci fokus tab berdasarkan data session ataupun variable mentah (Prioritas File Pertama)
        @if(session('active_tab') === 'bahan' || $rekomendasi || $bahan)
            switchTab('bahan');
        @elseif(session('active_tab') === 'chat')
            switchTab('chat');
        @else
            const activeSavedMode = localStorage.getItem('chef_prefer_mode') || 'chat';
            switchTab(activeSavedMode);
        @endif
    });
</script>
@endsection