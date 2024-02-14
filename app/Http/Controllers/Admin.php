<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Release;
use App\Models\ReleaseComment;
use App\Models\ReleaseUser;
use App\Models\SeasonEvent;
use App\Models\SeasonEventGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class Admin extends Controller
{
    //

    public function index(Request $request)
    {
        $releases = Release::with('genres')
            ->filterByRequest($request['filter'], $request['type'], $request['year'], $request['season'], $request['studio'], $request['search'])
            ->latest()
            ->paginate(16)
            ->appends(request()->query());
        return view('admin.releases', [
            'releases' => $releases,
        ]);
    }

    public function show($id, $slug, Release $release): View
    {
        $release = $release->find($id);
        $comments = ReleaseComment::where('release_id', $id)->with('users')->get();
        return \view('admin.show', [
            'release' => $release,
            'genres_release' => $release->genres()->get(),
            'videos' => $release->videos()->get()->all(),
            'comments' => $comments,
        ]);
    }

    public function edit($id, Request $request)
    {
        $release = Release::find($id);
        $formFields = $request->validate([
            'image_url' => '',
            'rating' => '',
            'votes_count' => '',
            'title' => '',
            'original_title' => '',
            'release_year' => '',
            'release_season' => '',
            'production_studio' => '',
            'episodes_released' => '',
            'total_episodes' => '',
            'description' => '',
        ]);
        $release->update($formFields);

        return redirect(route('admin.show', ['id' => $release['id'], 'slug' => $release['slug']]));
    }

    public function delete($id, Request $request)
    {
        $release = Release::find($id);
        $release->delete();
        return redirect(route('admin.releases'));
    }

    public function seasonEvents()
    {
        $seasonEvents = SeasonEvent::all();
        $genres = Genre::all();
        return \view('admin.season-events', [
            'seasonEvents' => $seasonEvents,
            'genres' => $genres,
        ]);
    }

    public function seasonEventsStore(Request $request)
    {
        $request->validate([
            'title0' => 'required',
            'slug0' => 'required',
            'year0' => 'required',
            'img0' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
        $request->validate([
            'title1' => 'required',
            'slug1' => 'required',
            'year1' => 'required',
            'img1' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $formFields = [];

        $seasonEventImages = SeasonEvent::all()->toArray();
        if (!$seasonEventImages == []){
            foreach ($seasonEventImages as $seasonEvent){
                if (file_exists(storage_path("app/public/{$seasonEvent['image_url']}"))) {
                    unlink(storage_path("app/public/{$seasonEvent['image_url']}"));
                }
            }
        }
        SeasonEventGenre::truncate();

        for ($i = 0; $i < 2; $i++) {
            $formFields[$i]['title'] = $request["title{$i}"];
            $formFields[$i]['slug'] = $request["slug{$i}"];
            $formFields[$i]['year'] = $request["year{$i}"];
            $file = $request->file("img{$i}");
            $formFields[$i]['image_url'] = $file->store("season_events", 'public');

            $seasonEventImages == []
                ? $seasonEvent = SeasonEvent::create($formFields[$i])
                : $seasonEvent = SeasonEvent::where('id', $seasonEventImages[$i]['id'])->update($formFields[$i]);

            if (!is_array($seasonEvent)){
                $seasonEvent = SeasonEvent::find($seasonEventImages[$i]['id']);
            }

            foreach ($request["genres{$i}"] as $genreId) {
                $genre['season_event_id'] = $seasonEvent['id'];
                $genre['genre_id'] = $genreId;
                SeasonEventGenre::create($genre);
            }


        }


        return redirect(url()->previous());

    }


}
