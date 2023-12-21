<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public function releases()
    {
        return $this->belongsToMany(Genre::class, 'release_genres', 'release_id', 'genre_id');
    }
}
