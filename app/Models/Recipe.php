<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['title', 'category', 'category_time', 'image_url', 'ingredients', 'steps', 'source_url'];

    protected $casts = [
        'ingredients' => 'array',
        'steps' => 'array',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function isFavoritedBy($userId)
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }
}