@extends('layouts.app')

@section('content')
<section class="mb-8">
    <h2 class="text-lg font-bold mb-4 text-stone-700">Pilih Kategori Koki</h2>
    <div class="grid grid-cols-5 gap-2 md:gap-4">
        @foreach(['Pagi' => '🌅', 'Siang' => '☀️', 'Malam' => '🌙', 'Cepat' => '⚡', 'Sehat' => '🥗'] as $cat => $emoji)
            <button onclick="askAI('{{ $cat }}')" class="flex flex-col items-center justify-center p-3 rounded-xl bg-white border border-stone-100 shadow-xs hover:border-emerald-500 hover:bg-emerald-50/30 transition text-center group cursor-pointer">
                <span class="text-2xl mb-1 group-hover:scale-110 transition duration-200">{{ $emoji }}</span>
                <span class="text-xs font-semibold text-stone-600">{{ $cat }}</span>
            </button>
        @endforeach
    </div>
</section>

<div class="mb-8 p-5 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl text-white shadow-md relative overflow-hidden hidden" id="ai-box">
    <h3 class="font-bold text-lg mb-1 flex items-center">✨ Rekomendasi Koki AI untuk Anda:</h3>
    <p id="ai-result" class="text-sm text-emerald-50 leading-relaxed font-mono">Memformulasikan menu terbaik...</p>
</div>

<section>
    <h2 class="text-xl font-extrabold mb-4 text-stone-800 tracking-tight">Rekomendasi Hari Ini</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($recipes as $recipe)
            <div onclick="window.location='{{ route('recipes.show', $recipe->id) }}'" class="bg-white rounded-2xl overflow-hidden shadow-xs border border-stone-100 flex flex-col group hover:shadow-md transition cursor-pointer">
                
                <div class="relative overflow-hidden aspect-video">
                    <img src="{{ $recipe->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="{{ $recipe->title }}">
                    <span class="absolute top-2 left-2 bg-white/90 text-stone-800 text-[10px] font-bold px-2 py-1 rounded-md backdrop-blur-xs shadow-xs">{{ $recipe->category }}</span>
                </div>
                <div class="p-3 flex flex-col flex-1 justify-between">
                    <a href="{{ route('recipes.show', $recipe->id) }}" class="font-bold text-sm text-stone-800 hover:text-emerald-600 transition line-clamp-2 mb-2">{{ $recipe->title }}</a>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-[11px] text-stone-400">⏱️ {{ $recipe->category_time }}</span>
                        
                        <form action="{{ route('favorites.toggle', $recipe->id) }}" method="POST" onclick="event.stopPropagation()">
                            @csrf
                            <button class="text-stone-400 hover:text-red-500 heart-beat cursor-pointer">
                                {{ $recipe->isFavoritedBy(auth()->id()) ? '❤️' : '🤍' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<script>
    function askAI(category) {
        const aiBox = document.getElementById('ai-box');
        const aiResult = document.getElementById('ai-result');
        aiBox.classList.remove('hidden');
        aiResult.innerText = "Koki AI sedang meracik ide untuk kategori " + category + "... 🍳";
        
        fetch(`/dashboard/ai-recommend?category=${category}`)
            .then(res => res.json())
            .then(data => {
                aiResult.innerText = data.recommendation || data.error;
            })
            .catch(() => {
                aiResult.innerText = "Koki AI gagal terhubung. Coba cek koneksi internet Anda.";
            });
    }
</script>
@endsection