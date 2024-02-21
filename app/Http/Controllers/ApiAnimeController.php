<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Release;
use App\Models\ReleaseGenre;
use App\Models\ReleaseVideo;
use App\Models\Video;
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
        $code_challenge = 'NklUDX_CzS8qrMGWaDzgKs6VqrinuVFHa0xnpWPDy7_fggtM6kAar4jnTwOgzK7nPYfE9n60rsY4fhDExWzr5bf7sEvMMmSXcT2hWkCstFGIJKoaimoq5GvAEQD8NZ8g';
        $response = Http::asForm()->post('https://myanimelist.net/v1/oauth2/token', [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'code' => $code,
            'code_verifier' => $code_challenge,
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
        if (\request('type') == 'season') {
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
        if (\request('type') == 'search') {
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

        //Ranking anime
        if (\request('type') == 'ranking') {
            $formFields = $request->validate([
                'type' => ['required'],
                'ranking_type' => ['required'],
            ]);
            if ($request['limit'] === 0) {
                $formFields['limit'] = 500;
            } else {
                $formFields['limit'] = $request['limit'];
            }
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
            ])->get("https://api.myanimelist.net/v2/anime/ranking?ranking_type={$formFields['ranking_type']}&limit={$formFields['limit']}");
            if ($response->successful()) {
                $responseData = $response->json();
                // Обработка успешного ответа
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

        //Ranking 100 anime
        if (\request('type') == 'ranking-100') {
            $formFields = $request->validate([
                'type' => ['required'],
                'ranking_type' => ['required'],
            ]);
            //Если limit = 0 то поставить 500, если нет то лимит берется с $request
            $formFields['limit'] = optional($request)->input('limit', 0) == 0 ? 500 : $request->input('limit');
            //Интервал для цикла
            $intervalEnd = intval($request['end']) > $request['limit'] ? intval($request['limit']) : intval($request['end']);
            //Получаем массив с анимеАйди и Названием по указаному лимиту и типу рейтинга
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
            ])->get("https://api.myanimelist.net/v2/anime/ranking?ranking_type={$formFields['ranking_type']}&limit={$formFields['limit']}");
            //Успешый ответ
            if ($response->successful()) {
                $responseData = $response->json();
                //Массив чтобы в него положить все аниме
                $responseArray = [];
                // Обработка успешного ответа
                $releases = [];
                $a = 0;
                for ($i = intval($request['start']); $i < $intervalEnd; $i++) {
                    //Запрос по каждому аниме, чтобы получить все данные по каждому аниме
                    $release = Http::withHeaders([
                        'Authorization' => "Bearer {$token}",
                    ])->get("https://api.myanimelist.net/v2/anime/{$responseData['data'][$i]['node']['id']}?fields=id,title,main_picture,alternative_titles,start_date,end_date,synopsis,mean,num_list_users,num_scoring_users,nsfw,created_at,updated_at,media_type,status,genres,my_list_status,num_episodes,start_season,broadcast,source,average_episode_duration,rating,pictures,background,related_anime,related_manga,recommendations,studios,statistics,videos");
                    //Если ответ успешный записываем его в массив со всемя аниме
                    if ($release->successful()) {
                        if ($this->issetProperties($release)
                            &&
                            !Release::where('id', $release->json()['id'])->exists()) {
                            $releases[$a] = $this->renameProperties($release);
                            //Full array with anime NOT FOR DB
                            $responseArray[$a] = $release->json();
                            $a++;
                        }
                    }
                }

                //Получаем жанры из каждого массива $responseArray со всемя аниме
                $genres = $this->genresArrForDb($responseArray, 'genres', 'id', 'name', 'id', 'title');
                $videos = $this->videoArrForDb($responseArray, 'videos', ['id', 'title', 'url', 'thumbnail'], ['id', 'title', 'url', 'poster']);
                //Create Release
                foreach ($releases as $release) {
                    Release::create($release);
                }

                //Create Genres
                foreach ($genres as $genreArr) {
                    foreach ($genreArr as $genre) {
                        if (!Genre::where('id', $genre['id'])->exists()) {
                            $genreDb['id'] = $genre['id'];
                            $genreDb['title'] = $genre['name'];
                            Genre::create($genreDb);
                        }
                    }
                }
                //Create ReleaseGenre
                for ($i = 0; $i < count($genres); $i++) {
                    foreach ($genres[$i] as $genre) {
                        $releaseGenre['release_id'] = $releases[$i]['id'];
                        $releaseGenre['genre_id'] = $genre['id'];
                        if (!ReleaseGenre::where('release_id', $releaseGenre['release_id'])->where('genre_id', $releaseGenre['genre_id'])->exists()) {
                            ReleaseGenre::create($releaseGenre);
                        }
                    }
                }
                //Create Video
                foreach ($videos as $videoArr) {
                    if ($videoArr && is_array($videoArr)) {
                        foreach ($videoArr as $video) {
                            if ($video && !Video::where('id', $video['id'])->exists()
                                &&
                                isset($video['id'], $video['title'], $video['thumbnail'], $video['url'])) {

                                $videoDb['id'] = $video['id'];
                                $videoDb['title'] = $video['title'];
                                $videoDb['poster'] = $video['thumbnail'];
                                $videoDb['url'] = $video['url'];
                                Video::create($videoDb);
                            }
                        }
                    }
                }
                //Create ReleaseVideo
                for ($i = 0; $i < count($videos); $i++) {
                    foreach ($videos[$i] as $video) {
                        $releaseVideo['release_id'] = $releases[$i]['id'];
                        $releaseVideo['video_id'] = $video['id'];
                        if (!ReleaseVideo::where('release_id', $releaseVideo['release_id'])
                                ->where('video_id', $releaseVideo['video_id'])
                                ->exists()
                            &&
                            isset($video['id'], $video['title'], $video['thumbnail'], $video['url'])) {
                            ReleaseVideo::create($releaseVideo);
                        }
                    }
                }


            } else {
                // Обработка ошибки, если запрос неудачен
                $statusCode = $response->status();
                // Дополнительная обработка ошибки...
                return redirect(route('send-request'));
            }
        }

        //Update Anime
        if (\request('type') == 'update'){
            $formFields = $request->validate([
                'animeId' => ['required'],
            ]);

            $response = $this->getSingleAnime($token, $formFields['animeId']);
            if ($this->issetProperties($response)){
                $release = $this->renameProperties($response);
                $releaseUpdate = Release::find($release['id']);
                $releaseUpdate->update($release);
                return redirect(route('admin.show', ['id' => $release['id'], 'slug' => $release['slug']]));
            } else{
                return view('api-animelist.anime-show', [
                    'release' => $response,
                    'token' => $token,
                    'url' => url()->previous(),
                ]);
            }


        }

    }

    public function getAnimeById($token, Request $request)
    {

        $formFields = $request->validate([
            'animeId' => ['required'],
        ]);

        $response = $this->getSingleAnime($token, $formFields['animeId']);

        if ($response->successful()) {
            $responseData = $response->json();
            // Обработка успешного ответа
            return view('api-animelist.anime-show', [
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

    public
    function fillAnimeInDb(Request $request)
    {
        dd($request->all());
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
        //Translate release_season to russian
        $formFields['release_season'] = $this->translateSeason($formFields['release_season_slug']);

        //Add released episodes
        if ($request['status'] == 'finished_airing') {
            $formFields['episodes_released'] = $formFields['total_episodes'];
        }

        //Genres
        $genresTitle = explode(',', str_replace(' ', '', $request['genres']));
        $genresId = explode(',', str_replace(' ', '', $request['genre_id']));
        $genres = [];
        for ($i = 0; $i < count($genresTitle); $i++) {
            $genres[$i]['id'] = intval($genresId[$i]);
            $genres[$i]['title'] = str_replace('-', '', $genresTitle[$i]);
        }

        //Fields created_at & updated_at
        $formFields['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
        $formFields['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');

        //ReleaseGenres table
        $releaseGenres = [];
        for ($i = 0; $i < count($genresId); $i++) {
            $releaseGenres[$i]['release_id'] = intval($formFields['id']);
            $releaseGenres[$i]['genre_id'] = intval($genresId[$i]);
        }

        //For page with anime that have been added and genres
        $result = [];
        $genresResult = '';
        $videosResult = '';


        //Create Release
        if (!Release::where('id', $formFields['id'])->exists()) {
            Release::create($formFields);
            $result['title'] = $formFields['title'];

        }

        //Create genres
        foreach ($genres as $genre) {
            if (!Genre::where('id', $genre['id'])->exists()) {
                Genre::create($genre);
                $genresResult .= $genre['title'] . ', ';
            }
        }

        //Create ReleaseGenres
        foreach ($releaseGenres as $releaseGenre) {
            if (!ReleaseGenre::where('release_id', $releaseGenre['release_id'])->where('genre_id', $releaseGenre['genre_id'])->exists()) {
                ReleaseGenre::create($releaseGenre);
            }
        }

        //Videos and ReleaseVideos
        if ($request['videos_title']) {
            $videos_title = explode(',', $request['videos_title']);
            $videos_id = explode(',', $request['videos_id']);
            $videos_poster = explode(',', $request['videos_poster']);
            $videos_url = explode(',', $request['videos_url']);

            $videos = [];

            for ($i = 0; $i < count($videos_id); $i++) {
                $videos[$i]['id'] = intval($videos_id[$i]);
                $videos[$i]['title'] = $videos_title[$i];
                $videos[$i]['poster'] = $videos_poster[$i];
                $videos[$i]['url'] = $videos_url[$i];
            }

            //ReleaseVideo table
            $releaseVideos = [];
            for ($i = 0; $i < count($videos_id); $i++) {
                $releaseVideos[$i]['release_id'] = intval($formFields['id']);
                $releaseVideos[$i]['video_id'] = intval($videos[$i]['id']);
            }
            //Create Videos
            foreach ($videos as $video) {
                if (!Video::where('id', $video['id'])->exists()) {
                    Video::create($video);
                    $videosResult .= $video['title'] . ', ';
                }
            }

            //Create ReleaseVideos
            foreach ($releaseVideos as $releaseVideo) {
                if (!ReleaseVideo::where('release_id', $releaseVideo['release_id'])->where('video_id', $releaseVideo['video_id'])->exists()) {
                    ReleaseVideo::create($releaseVideo);
                };
            }
        }


        //Page with anime that have been added and genres
        return view('api-animelist.anime-after-fill-bd', [
            'result' => $result,
            'genres' => $genresResult,
            'video' => $videosResult,
        ]);
    }


    public function genresArrForDb($arr, $genres, $firstArr, $secondArr, $firstRes, $secondRes)
    {
        $res = [];
        for ($i = 0; $i < count($arr); $i++) {
            $genre = $arr[$i][$genres];
            $res[$i] = $genre;
        }
        return $res;
    }

    public function videoArrForDb($arr, $videos, $arrAtr, $arrRes)
    {
        $res = [];

        for ($i = 0; $i < count($arr); $i++) {
            $video = $arr[$i][$videos];
            $res[$i] = $video;
        }

        return $res;
    }

    public function translateSeason($atr)
    {
        //Translate release_season to russian
        if ($atr == 'spring') {
            $res = 'Весна';
        } elseif ($atr == 'winter') {
            $res = 'Зима';
        } elseif ($atr == 'summer') {
            $res = 'Лето';
        } else {
            $res = 'Осень';
        }
        return $res;
    }

    public function getSingleAnime($token, $id)
    {
        $res = Http::withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->get("https://api.myanimelist.net/v2/anime/{$id}?fields=id,title,main_picture,alternative_titles,start_date,end_date,synopsis,mean,rank,popularity,num_list_users,num_scoring_users,nsfw,created_at,updated_at,media_type,status,genres,my_list_status,num_episodes,start_season,broadcast,source,average_episode_duration,rating,pictures,background,related_anime,related_manga,recommendations,studios,statistics,videos");

        return $res;
    }

    public function renameProperties($response)
    {
        $res = [];

        $res['id'] = $response->json()['id'];
        $res['title'] = $response->json()['title'];
        $res['original_title'] = $response->json()['alternative_titles']['en'];
        $res['type'] = $response->json()['media_type'];
        $res['release_year'] = $response->json()['start_season']['year'];
        $res['release_season_slug'] = $response->json()['start_season']['season'];
        $res['production_studio'] = $response->json()['studios'][0]['name'];
        $res['total_episodes'] = $response->json()['num_episodes'];
        $res['description'] = preg_match('/[\[\]()]/', $response->json()['synopsis']) ? preg_replace('/\[[^\]]*\]|\([^)]*\)/', '', $response->json()['synopsis']) : $response->json()['synopsis'];
        $res['image_url'] = $response->json()['main_picture']['large'];
        $res['rating'] = $response->json()['mean'];
        $res['votes_count'] = $response->json()['num_scoring_users'];
        //Edit field episodes_released
        $response->json()['status'] == 'finished_airing' ? $res['episodes_released'] = $response->json('num_episodes') : $res['episodes_released'] = null;
        //Edit field release_season
        $res['release_season'] = $this->translateSeason($response->json()['start_season']['season']);
        //Edit field slug
        $cleanSlug = preg_replace('/[^\w\d\s]/u', '', $response->json()['title']);
        $slug = preg_replace('/\s+/u', '-', $cleanSlug);
        $res['slug'] = strtolower($slug);

        return $res;
    }

    public function issetProperties($response)
    {
        return isset($response->json()['id'],
            $response->json()['title'],
            $response->json()['alternative_titles']['en'],
            $response->json()['media_type'],
            $response->json()['start_season']['year'],
            $response->json()['start_season']['season'],
            $response->json()['studios'][0]['name'],
            $response->json()['num_episodes'],
            $response->json()['synopsis'],
            $response->json()['main_picture']['large'],
            $response->json()['mean'],
            $response->json()['num_scoring_users']);
    }

}
