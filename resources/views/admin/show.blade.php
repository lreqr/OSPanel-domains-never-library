{{--@dd($release)--}}
<x-admin-layout>
    <div class="container show-page">
        <form action="{{route('admin.edit', ['id' => $release->id])}}" enctype="application/x-www-form-urlencoded"
              method="POST">
            @csrf
            <div class="wrapper container">
                <div class="row my-3">
                    <div class="col-md-4">
                        <div class="image">
                            <img src="@if(isset($release->image_url))
                            {{$release->image_url}}
                            @else
                            {{asset('images/season-anime2.jpg')}}
                            @endif" alt="">
                            <label for="image_url">image_url</label>
                            <input type="text" name="image_url" id="image_url" style="background: darksalmon "
                                   value="{{$release->image_url}}">
                        </div>
                        <!-- view-status -->
                        <div class="view-status text-uppercase text-center">
                            <div class="view-watching">
                                <a class="fs-4" href="" id="watching">Смотрю</a>
                            </div>
                            <div class="view-watched">
                                <a class="fs-4" href="" id="watched">Просмотрено</a>
                            </div>
                            <div class="view-planned">
                                <a class="fs-4" href="" id="planned">Запланировано</a>
                            </div>
                            <input type="hidden" id="animeId" value="{{$release->id}}">
                            <input type="hidden" id="animeSlug" value="{{$release->slug}}">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" id="animeType"
                                   value="@if(isset($users[0]->type)){{$users[0]->type}}@endif">
                            <input type="hidden" id="animeRating"
                                   value="@if(isset($users[0]->rating)){{$users[0]->rating}}@endif">
                        </div>
                        <!-- stars -->
                        <div class="container d-flex justify-content-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="" class="star px-2" id="star1"></a>
                                    <a href="" class="star px-2" id="star2"></a>
                                    <a href="" class="star px-2" id="star3"></a>
                                    <a href="" class="star px-2" id="star4"></a>
                                    <a href="" class="star px-2" id="star5"></a>
                                </div>
                            </div>
                        </div>
                        <!-- rating-num -->
                        <div class="rating-block text-center">
                            <div class="rating-num fs-1">{{$release->rating}} <span class="fs-6">из 10</span></div>
                            <label for="rating">rating</label>
                            <input type="number" name="rating" id="rating" style="background: darksalmon "
                                   value="{{$release->rating}}">
                            <div class="rating-total">голосов: {{$release->votes_count}}</div>
                            <label for="votes_count">votes_count</label>
                            <input type="number" name="votes_count" id="votes_count" style="background: darksalmon "
                                   value="{{$release->votes_count}}">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="poster-inner">
                            <div class="poster-item">
                                <h3>{{$release->title}}
                                    <input type="text" name="title" id="title" style="background: darksalmon "
                                           value="{{$release->title}}">
                                    <br>/
                                    {{$release->original_title}}
                                    <input type="text" name="original_title" id="original_title" style="background: darksalmon "
                                           value="{{$release->original_title}}">
                                </h3>

                            </div>
                            <hr>
                            <div class="poster-item">
                                <span>Год:</span> <a
                                    href="{{route('release.filterByGenre', ['genre' => 'all']) . '?year=' . $release->release_year}}">{{$release->release_year}}</a>
                                <label for="release_year">release_year</label>
                                <input type="text" name="release_year" id="release_year" style="background: darksalmon "
                                       value="{{$release->release_year}}">
                            </div>
                            <div class="poster-item">
                                <span>Сезон:</span> <a
                                    href="{{route('release.filterByGenre', ['genre' => 'all']) . '?season=' . $release->release_season_slug . '&year=' . $release->release_year}}">{{$release->release_season}}</a>
                                <label for="release_season">release_season</label>
                                <input type="text" name="release_season" id="release_season" style="background: darksalmon "
                                       value="{{$release->release_season}}">
                            </div>
                            <div class="poster-item">
                                <span>Студия:</span> <a
                                    href="{{route('release.filterByGenre', ['genre' => 'all']) . '?studio=' . $release->production_studio}}">{{$release->production_studio}}</a>
                                <label for="production_studio">production_studio</label>
                                <input type="text" name="production_studio" id="production_studio"
                                       style="background: darksalmon " value="{{$release->production_studio}}">
                            </div>
                            <div class="poster-item">
                                <span>Эпизодов:</span> <a href="/" onclick="return false"
                                                          style="--hover: var(--bg-color)">
                                    @if(isset($release->episodes_released))
                                        {{$release->episodes_released}}
                                        <label for="episodes_released">episodes_released</label>
                                        <input type="text" name="episodes_released" id="episodes_released"
                                               style="background: darksalmon " value="{{$release->episodes_released}}">
                                    @else
                                        {{'?'}}
                                        <label for="episodes_released">episodes_released</label>
                                        <input type="text" name="episodes_released" id="episodes_released"
                                               style="background: darksalmon " value="{{'?'}}">
                                    @endif
                                    из
                                    {{$release->total_episodes}}</a>
                                <label for="total_episodes">total_episodes</label>
                                <input type="text" name="total_episodes" id="total_episodes" style="background: darksalmon "
                                       value="{{$release->total_episodes}}">
                            </div>
                            <div class="poster-item">
                                <span>Жанр:</span>@foreach($genres_release as $key => $genre_releas)
                                    <a href="{{route('release.filterByGenre', ['genre' => $genre_releas->title])}}">{{$genre_releas->title}}</a>@if(!$loop->last)
                                        ,
                                    @endif
                                @endforeach


                            </div>
                            <hr>
                            <div class="poster-item">
                                <span>Описание:</span>
                                <p class="description">
                                    {{$release->description}}
                                </p>
                            </div>


                            <label for="description">description</label>
                            <textarea class="w-100" id="description"
                                      name="description">{{$release->description}}</textarea>
                            <button type="submit">SUBMIT</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
            <h1 style="color: #198754">COPY ID: {{$release->id}}</h1>
            <a href="{{route('send-request')}}" style="color: dodgerblue; height: 80px; width: 120px">UPDATE ANIME WITH API</a>
        <form action="{{route('admin.delete', ['id' => $release->id])}}" method="post" class="d-flex justify-content-center" style="background: red;">
            @csrf
            <button type="submit" style="color: red; height: 80px; width: 120px">DELETE ANIME</button>
        </form>
        @if($videos)
            <!-- player -->
            <div class="wrapper container py-2">
                <div id="player"></div>
                <script>
                    let player = new Playerjs({
                        id: "player", file: [
                                @foreach($videos as $video)
                            {

                                "title": "{{$video->title}}",
                                "file": "{{$video->url}}",
                                "poster": "{{$video->poster}}",

                            }@if(!$loop->last),@endif
                            @endforeach
                        ]
                    });
                </script>

            </div>
        @else
            <div class="wrapper container">
                <div class="video-not-exists text-center py-2">
                    <h1>Video doesn't exists</h1>
                    <img src="{{asset('images/no-video.png')}}" alt="no-video">
                </div>
            </div>
        @endif
        <!-- comments -->
        <div class="wrapper py-2">
            <div class="comment-title">
                <div class="comment-title-wrapper d-flex justify-content-center align-items-center">
                    <span class="icon-comment mx-2"></span>
                    <p>Комментарии</p>
                </div>
            </div>
            <div class="comment-textarea container">
                <label for="comment" class="col-md-12 fs-3 text-center my-2">Твой отзыв на аниме</label>
                <textarea class="col-md-12 justify-self-center" id="comment" name="comment" cols="60" rows="3"
                          placeholder="Написать отзыв"></textarea>
                <div class="col-md-12 btn-send d-flex justify-content-end px-0 my-2">
                    <button type="submit" id="submitDescription">Отправить</button>
                </div>
            </div>
            <div class="users-comments m-3">
                <div class="container comment-block">
                    @foreach($comments as $comment)
                        <div class="row d-flex py-3">
                            <div class="col-2">
                                <div class="user-img text-center">
                                    <img
                                        src="{{ $comment->users->logo ? asset("storage/{$comment->users->logo}") : asset('images/no-video.svg')}}"
                                        alt="user_a">
                                    <p>{{\Carbon\Carbon::parse($comment->created_at)->isoFormat('MMM D, YYYY')}}</p>
                                </div>
                                <div class="user-name text-center">
                                    <a href="">{{$comment->users->name}}</a>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="user-comment w-100"><p>{{$comment->comment}}</p></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
