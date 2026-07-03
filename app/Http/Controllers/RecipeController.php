<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $recipes = Recipe::where('title', 'LIKE', "%{$query}%")->get();
        return view('recipes.search', compact('recipes', 'query'));
    }
}