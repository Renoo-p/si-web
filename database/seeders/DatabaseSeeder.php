<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. TETAP MEMBUAT TEST USER (Bawaan Kode Anda)
        // Akun ini bisa digunakan untuk login pertama kali
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // 2. GABUNGAN: Memanggil RecipeSeeder (Kode Baru)
        // Baris ini wajib ada agar 30 resep kuliner masuk ke database Anda
        $this->call([
            RecipeSeeder::class,
        ]);
    }
}