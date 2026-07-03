<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            
            // TAMBAHAN: Menghubungkan ke tabel 'users' (Siapa yang menyukai resep ini)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // TAMBAHAN: Menghubungkan ke tabel 'recipes' (Resep apa yang disukai)
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};