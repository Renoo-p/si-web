<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/', function () { return redirect()->route('dashboard'); });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/ai-recommend', [DashboardController::class, 'aiRecommend'])->name('dashboard.ai');
    
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
    Route::get('/search', [RecipeController::class, 'search'])->name('search');
    
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'chat'])->name('chat.submit');
    
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle/{recipe}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
