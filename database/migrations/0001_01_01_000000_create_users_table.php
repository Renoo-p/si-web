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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // MODIFIKASI: Email dibuat nullable karena pendaftaran bisa pakai No HP saja
            $table->string('email')->unique()->nullable(); 
            $table->timestamp('email_verified_at')->nullable();
            // TAMBAHAN: Kolom nomor HP (nullable & unique)
            $table->string('phone')->unique()->nullable(); 
            $table->string('password');
            // TAMBAHAN: Kolom foto profil untuk fitur Akun
            $table->string('profile_photo')->nullable(); 
            $table->rememberToken();
            $table->timestamps();
        });

        // Tetap pertahankan ini untuk fitur reset password bawaan Laravel
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tetap pertahankan ini untuk session login berbasis database
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};