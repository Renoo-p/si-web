@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-black text-stone-800 mb-6 tracking-tight">Resep Favorit Anda</h1>

@if($favorites->isEmpty())
    <div class="text-center py-20 text-stone-400">
        <span class="text-4xl block mb-2">❤️</span>
        <p>Belum ada resep yang difavoritkan.</p>
    </div>
@else
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($favorites as $fav)
            <div onclick="window.location='{{ route('recipes.show', $fav->recipe->id) }}'" class="bg-white rounded-2xl overflow-hidden shadow-xs border border-stone-100 flex flex-col justify-between cursor-pointer hover:shadow-md transition">
                <div>
                    <img src="{{ $fav->recipe->image_url }}" class="w-full aspect-video object-cover" alt="{{ $fav->recipe->title }}">
                    <div class="p-3">
                        <a href="{{ route('recipes.show', $fav->recipe->id) }}" class="font-bold text-sm text-stone-800 hover:text-emerald-600 transition block line-clamp-2">{{ $fav->recipe->title }}</a>
                    </div>
                </div>
                
                {{-- 2. Tambahkan onclick="event.stopPropagation()" di tag div pembungkus form ini --}}
                <div class="p-3 pt-0" onclick="event.stopPropagation()">
                    <form action="{{ route('favorites.toggle', $fav->recipe->id) }}" method="POST">
                        @csrf
                        <button class="w-full bg-stone-100 text-stone-600 hover:bg-red-50 hover:text-red-600 py-1.5 rounded-lg text-xs font-semibold cursor-pointer transition">Hapus Favorit</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection