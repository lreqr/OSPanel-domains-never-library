<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    public function releases()
    {
        return $this->belongsToMany(Release::class, 'release_videos', 'video_id', 'release_id');
    }
}
