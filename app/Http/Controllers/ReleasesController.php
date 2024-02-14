<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Release;
use App\Models\ReleaseComment;
use App\Models\ReleaseGenre;
use App\Models\ReleaseUser;
use App\Models\SeasonEvent;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class ReleasesController extends Controller
{
    public function index(Request $request): View
    {

        $releases = Release::with('genres')
            ->filterByRequest($request['filter'], $request['type'])
            ->latest()
            ->paginate(16)
            ->appends(request()->query());

                                                   //filterCarousel(мин Рейтинг, Год выпуска)
        $carousel = Release::with('genres')->filterCarousel(9, 2023)->get();
        $seasonEvents = SeasonEvent::all();
        return view('release.index', [
            'releases' => $releases,
            'carousel' => $carousel,
            'seasonEvents' => $seasonEvents,
        ]);
    }

    public function show($id, $slug, Release $release): View
    {
        $release = $release->find($id);
        if (auth()->user()){
            $users = ReleaseUser::where('release_id', $id)->where('user_id', auth()->user()->id)->get()->all();
        }
        $comments = ReleaseComment::where('release_id', $id)->with('users')->get();
//        dd($comments);
        return \view('release.show', [
            'release' => $release,
            'genres_release' => $release->genres()->get(),
            'videos' => $release->videos()->get()->all(),
            'users' => $users ?? null,
            'comments' => $comments,
        ]);
    }

    public function filterByGenre($genreName, Request $request): View
    {
        $releases = Release::with('genres')
            ->filterByGenre($genreName)
            ->filterByRequest($request['filter'], $request['type'], $request['year'], $request['season'], $request['studio'], $request['search'])
            ->paginate(16)->appends(request()->query());

        return view('release.filterByGenre', [
            'releases' => $releases,
        ]);
    }

//    public function filterByYear($year, Request $request): View
//    {
//        $releases = Release::with('genres')->filterByGenre($genreName)->filterByRequest($request['filter'], $request['type'])->get();
//        return view('release.filterByGenre', [
//            'releases' => $releases,
//        ]);
//    }

    public function seasonEvent($event, $year, Request $request): View
    {
        $releases = Release::with('genres')
            ->filterEvents($event, $year)
            ->filterByRequest($request['filter'], $request['type'])
            ->paginate(16)->appends(request()->query());
        return \view('release.filterByGenre', [
           'releases' => $releases,
        ]);
    }


}
