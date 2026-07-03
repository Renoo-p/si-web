<?php

namespace App\Models;

// Pastikan semua import di bawah ini ada dan tidak ada yang typo
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;

#[Fillable(['name', 'email', 'phone', 'password', 'profile_photo'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    // PENTING: Baris ini yang mengaktifkan method User::factory()
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Hubungan relasi ke model Favorite
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}