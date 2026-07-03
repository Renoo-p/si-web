@extends('layouts.app')

@section('content')
<div class="mb-6">
    <form action="{{ route('search') }}" method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Cari masakan kesukaanmu (misal: Rendang)..." class="w-full bg-white px-4 py-3 rounded-xl border border-stone-200 focus:outline-emerald-500 text-sm">
        <button type="submit" class="bg-emerald-600 text-white px-6 py-3 rounded-xl font-bold text-sm cursor-pointer hover:bg-emerald-700 transition">Cari</button>
    </form>
</div>

@if(isset($recipes))
    <h2 class="text-md font-bold text-stone-600 mb-4">Hasil pencarian untuk: "{{ $query }}"</h2>
    @if($recipes->isEmpty())
        <p class="text-stone-400 text-center py-10">Resep tidak ditemukan. Coba kata kunci lain!</p>
    @else
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
    @endif
@endif
@endsection