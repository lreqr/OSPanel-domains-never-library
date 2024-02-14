<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;
use Illuminate\Support\Facades\DB;

class Release extends Model
{
    use HasFactory;

    //GENRE FILTER
    public function scopeFilterByGenre($query, $genreName)
    {

        if ($genreName == 'all'){
            return $query;
        } elseif ($genreName == 'newest'){
            return $query->orderBy('release_year', 'desc');
        } else{
            $query->whereHas('genres', function ($query) use ($genreName) {
                $query->where('title', $genreName);
            });
        }

        return $query;
    }

    //CAROUSEL FILTER
    public function scopeFilterCarousel($query, $minRating, $minReleaseYear)
    {
        return $query->where('rating', '>', $minRating)
            ->where('release_year', '=', $minReleaseYear)
            ->orWhere('release_year', '>', $minReleaseYear)
            ->orderBy('rating', 'desc')
            ->limit(14);
    }


    //EVENTS FILTER
    public function scopeFilterEvents($query, $event, $year)
    {
        $month = ['winter', 'summer', 'spring', 'fall'];

        if (in_array($event, $month, true)){
            return $query->where('releases.release_season_slug', '=', $event)
                ->where('releases.release_year', '=', $year)
                ->orderBy('releases.rating', 'desc');
        }

         return $query->
             when($event === 'rating', function ($query) use ($year) {
                 return $query->orderBy('release_season_slug')
                     ->orderBy('release_year', 'desc');
             })
             ->whereExists(function ($subQuery) use ($event){
                $subQuery->select(DB::raw(1))
                    ->from('season_events')
                    ->join('season_event_genres', 'season_events.id', '=', 'season_event_genres.season_event_id')
                    ->join('release_genres', 'release_genres.genre_id', '=', 'season_event_genres.genre_id')
                    ->whereColumn('release_genres.release_id', 'releases.id')
                    ->where('season_events.slug', $event);
         });
    }

    public function scopeFilterByRequest($query, $filter = false, $type = false, $year = false, $season = false, $studio = false, $search = false)
    {
        if ($search){
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('original_title', 'LIKE', "%{$search}%")
                ->orWhere('release_year', 'LIKE', "%{$search}%")
                ->orWhere('release_season', 'LIKE', "%{$search}%")
                ->orWhere('production_studio', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        }

        if ($filter == 'rating'){
            $query->orderBy('rating', 'desc');
        } elseif ($filter == 'latest'){
            $query->orderBy('created_at', 'desc');
        }
        if ($type){
            $query->where('type', $type);
        }
        if ($year){
            $query->where('release_year', $year);
        }
        if ($season){
            $query->where('release_season_slug', $season);
        }
        if ($studio){
            $query->where('production_studio', $studio);
        }

        return $query;
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'release_genres', 'release_id', 'genre_id');
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'release_videos', 'release_id', 'video_id');
    }


}
