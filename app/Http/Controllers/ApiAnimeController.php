<?php

namespace App\Http\Controllers;
use App\Models\Genre;
use App\Models\Release;
use App\Models\ReleaseGenre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ApiAnimeController extends Controller
{
    public function sendRequestToAPI(): RedirectResponse
    {
        $client_id = 'c1921a8c5de00a329abc6b86d04edc00';
        $code_challenge = 'NklUDX_CzS8qrMGWaDzgKs6VqrinuVFHa0xnpWPDy7_fggtM6kAar4jnTwOgzK7nPYfE9n60rsY4fhDExWzr5bf7sEvMMmSXcT2hWkCstFGIJKoaimoq5GvAEQD8NZ8g';
        $state = 'RequestID42';
        return redirect("https://myanimelist.net/v1/oauth2/authorize?response_type=code&client_id={$client_id}&code_challenge={$code_challenge}&state={$state}");
    }

    public function getToken()
    {
        $code = \request('code');
        $client_id = 'c1921a8c5de00a329abc6b86d04edc00';
        $client_secret = '26275401557b276ab4cd89f3d436a6fbf2016c0b3e84e280323e754bf95016a2';
        $response = Http::asForm()->post('https://myanimelist.net/v1/oauth2/token', [
            'client_id' => $client_id,
            'client_secret' =>  $client_secret,
            'code' => $code,
            'code_verifier' => 'NklUDX_CzS8qrMGWaDzgKs6VqrinuVFHa0xnpWPDy7_fggtM6kAar4jnTwOgzK7nPYfE9n60rsY4fhDExWzr5bf7sEvMMmSXcT2hWkCstFGIJKoaimoq5GvAEQD8NZ8g',
            'grant_type' => 'authorization_code',
        ]);

        if ($response->successful()) {
            $jsonResponse = $response->json();
            return view('api-animelist.anime-forms', [
                'token' => $jsonResponse['access_token']
            ]);
        } else {
            // Обработка ошибки, если запрос не успешен
            $statusCode = $response->status();
            // Дополнительная обработка ошибки...
            return redirect(route('send-request'));
        }
    }

    public function getAnime($token, Request $request)
    {

        //Season search
        if (\request('type') == 'season'){
            $formFields = $request->validate([
                'season' => ['required'],
                'year' => ['required'],
                'limit' => ['required'],
                'type' => ['required'],
            ]);
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
            ])->get("https://api.myanimelist.net/v2/anime/season/{$formFields['year']}/{$formFields['season']}?limit={$formFields['limit']}");

            if ($response->successful()) {
                $responseData = $response->json();
                // Обработка успешного ответа
                $request->session()->put('releases', $responseData);
                $request->session()->put('token', $token);
                $request->session()->put('type', $formFields['type']);
                return view('api-animelist.anime-season', [
                    'releases' => $responseData,
                    'token' => $token,
                    'type' => $formFields['type'],
                ]);
            } else {
                // Обработка ошибки, если запрос неудачен
                $statusCode = $response->status();
                // Дополнительная обработка ошибки...
                return redirect(route('send-request'));
            }
        }

        //Search anime
        if (\request('type') == 'search'){
            $formFields = $request->validate([
                'search' => ['required'],
                'limit' => ['required'],
                'type' => ['required'],
            ]);
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
            ])->get("https://api.myanimelist.net/v2/anime?q={$formFields['search']}&limit={$formFields['limit']}");

            if ($response->successful()) {
                $responseData = $response->json();
                // Обработка успешного ответа
                $request->session()->put('releases', $responseData);
                $request->session()->put('token', $token);
                $request->session()->put('type', $formFields['type']);
                return view('api-animelist.anime-season', [
                    'releases' => $responseData,
                    'token' => $token,
                    'type' => $formFields['type'],
                ]);
            } else {
                // Обработка ошибки, если запрос неудачен
                $statusCode = $response->status();
                // Дополнительная обработка ошибки...
                return redirect(route('send-request'));
            }
        }

        //Search anime
        if (\request('type') == 'ranking'){
            $formFields = $request->validate([
                'ranking_type' => ['required'],
                'limit' => ['required'],
                'type' => ['required'],
            ]);
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
            ])->get("https://api.myanimelist.net/v2/anime/ranking?ranking_type={$formFields['ranking_type']}&limit={$formFields['limit']}");

            if ($response->successful()) {
                $responseData = $response->json();
                // Обработка успешного ответа
                $request->session()->put('releases', $responseData);
                $request->session()->put('token', $token);
                $request->session()->put('type', $formFields['type']);
                return view('api-animelist.anime-season', [
                    'releases' => $responseData,
                    'token' => $token,
                    'type' => $formFields['type'],
                ]);
            } else {
                // Обработка ошибки, если запрос неудачен
                $statusCode = $response->status();
                // Дополнительная обработка ошибки...
                return redirect(route('send-request'));
            }
        }

    }

    public function getAnimeById($token, Request $request)
    {
        $formFields = $request->validate([
            'animeId' => ['required'],
        ]);
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->get("https://api.myanimelist.net/v2/anime/{$formFields['animeId']}?fields=id,title,main_picture,alternative_titles,start_date,end_date,synopsis,mean,rank,popularity,num_list_users,num_scoring_users,nsfw,created_at,updated_at,media_type,status,genres,my_list_status,num_episodes,start_season,broadcast,source,average_episode_duration,rating,pictures,background,related_anime,related_manga,recommendations,studios,statistics");

        if ($response->successful()) {
            $responseData = $response->json();
            // Обработка успешного ответа
//            dd($responseData);
            return view('api-animelist.anime-show',[
                'release' => $responseData,
                'token' => $token,
                'url' => url()->previous(),
            ]);
        } else {
            // Обработка ошибки, если запрос неудачен
            $statusCode = $response->status();
            // Дополнительная обработка ошибки...
            return redirect(route('send-request'));
        }
    }

    public function fillAnimeInDb(Request $request)
    {
        $formFields = $request->validate([
            'id' => ['required'],
            'title' => ['required'],
            'original_title' => ['required'],
            'type' => ['required'],
            'release_year' => ['required'],
            'release_season_slug' => ['required'],
            'production_studio' => ['required'],
            'total_episodes' => ['required'],
            'description' => ['required'],
            'image_url' => ['required'],
            'rating' => ['required'],
            'votes_count' => ['required'],
            'slug' => ['required'],
        ]);
        if ($formFields['release_season_slug'] == 'spring'){
            $formFields['release_season'] = 'Весна';
        } elseif ($formFields['release_season_slug'] == 'winter'){
            $formFields['release_season'] = 'Зима';
        } elseif ($formFields['release_season_slug'] == 'summer'){
            $formFields['release_season'] = 'Лето';
        } else{
            $formFields['release_season'] = 'Осень';
        }

        if ($request['status'] == 'finished_airing'){
            $formFields['episodes_released'] = $formFields['total_episodes'];
        }

        $genresTitle = explode(',' ,str_replace(' ', '', $request['genres']));
        $genresId = explode(',' ,str_replace(' ', '', $request['genre_id']));
        $genres = [];
        for ($i = 0; $i < count($genresTitle); $i++){
            $genres[$i]['id'] = intval($genresId[$i]);
            $genres[$i]['title'] = str_replace('-', '', $genresTitle[$i]);
        }

        $formFields['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
        $formFields['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');

        $releaseGenres = [];
        for ($i = 0; $i < count($genresId); $i++){
            $releaseGenres[$i]['release_id'] = intval($formFields['id']);
            $releaseGenres[$i]['genre_id'] = intval($genresId[$i]);
        }

        if (!Release::where('id', $formFields['id'])->exists()){
            Release::create($formFields);
        }
        foreach ($genres as $genre){
            if (!Genre::where('id', $genre['id'])->exists()){
                Genre::create($genre);
            }
        }
        foreach ($releaseGenres as $releaseGenre){
            if (!ReleaseGenre::where('release_id', $releaseGenre['release_id'])->where('genre_id', $releaseGenre['genre_id'])->exists()){
                ReleaseGenre::create($releaseGenre);
            }
        }


    }
}
