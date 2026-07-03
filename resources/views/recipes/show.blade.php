@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xs overflow-hidden border border-stone-100">
    <div class="relative h-72 md:h-96 w-full">
        <img src="{{ $recipe->image_url }}" class="w-full h-full object-cover" alt="{{ $recipe->title }}">
        <div class="absolute top-4 right-4">
            <form action="{{ route('favorites.toggle', $recipe->id) }}" method="POST">
                @csrf
                <button class="bg-white/95 backdrop-blur-xs p-3 rounded-full shadow-md text-xl heart-beat cursor-pointer">
                    {{ $recipe->isFavoritedBy(auth()->id()) ? '❤️' : '🤍' }}
                </button>
            </form>
        </div>
    </div>
    
    <div class="p-6 md:p-8">
        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">{{ $recipe->category }} • {{ $recipe->category_time }}</span>
        <h1 class="text-2xl md:text-3xl font-black text-stone-900 mt-2 mb-6">{{ $recipe->title }}</h1>
        
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h3 class="font-bold text-lg text-stone-800 border-b pb-2 mb-3">🛒 Bahan-bahan</h3>
                <ul class="space-y-2">
                    @foreach($recipe->ingredients as $ing)
                        <li class="flex items-start text-sm text-stone-600"><span class="text-emerald-500 mr-2">✓</span> {{ $ing }}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg text-stone-800 border-b pb-2 mb-3">🍳 Langkah Pembuatan</h3>
                <ol class="space-y-3 decimal list-inside">
                    @foreach($recipe->steps as $index => $step)
                        <li class="text-sm text-stone-600 leading-relaxed"><span class="font-bold text-emerald-600 mr-1">{{ $index + 1 }}.</span> {{ $step }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
        
        @if($recipe->source_url)
            <div class="mt-8 pt-4 border-t border-stone-100 text-center">
                <a href="{{ $recipe->source_url }}" target="_blank" class="text-xs text-stone-400 hover:text-amber-500 transition">Sumber Referensi Resep Asli</a>
            </div>
        @endif
    </div>
</div>
@endsection