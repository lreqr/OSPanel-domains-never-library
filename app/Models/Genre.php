<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public function releases()
    {
        return $this->belongsToMany(Release::class, 'release_genres', 'genre_id', 'release_id');
    }
}
