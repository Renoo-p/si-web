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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nama masakan
            $table->string('category'); // Cemilan, Minuman, Roti, Makanan Berat
            $table->string('category_time'); // Pagi, Siang, Malam, Cepat, Sehat
            $table->string('image_url'); // Link foto makanan
            $table->text('ingredients'); // Daftar bahan (Disimpan sebagai teks/JSON)
            $table->text('steps'); // Langkah pembuatan (Disimpan sebagai teks/JSON)
            $table->string('source_url')->nullable(); // Link eksternal (misal: Cookpad), boleh dikosongkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};