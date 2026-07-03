<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('recipe')->get();
        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Recipe $recipe)
    {
        $userId = Auth::id();
        $favorite = Favorite::where('user_id', $userId)->where('recipe_id', $recipe->id)->first();

        if ($favorite) {
            $favorite->delete();
            $status = 'removed';
        } else {
            Favorite::create([
                'user_id' => $userId,
                'recipe_id' => $recipe->id
            ]);
            $status = 'added';
        }

        return back()->with('status', $status);
    }
}