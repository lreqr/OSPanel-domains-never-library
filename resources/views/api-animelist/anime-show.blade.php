<x-layout>
    <div class="container show-page">
        <div class="wrapper container">
            <div class="row my-3">
                <div class="col-md-4">
                    <div class="image">
                        <img src="@if(isset($release['main_picture']['large']))
                        {{$release['main_picture']['large']}}
                        @elseif($release['main_picture']['medium'])
                        {{$release['main_picture']['medium']}}
                        @else
                        {{asset('images/no-image.svg')}}
                        @endif" alt="">
                    </div>
                    <!-- view-status -->
                    <div class="view-status text-uppercase text-center">
                        <div class="view-watching">
                            <a class="fs-4" href="/">Смотрю</a>
                        </div>
                        <div class="view-watched">
                            <a class="fs-4" href="/">Просмотрено</a>
                        </div>
                        <div class="view-planned">
                            <a class="fs-4" href="/">Запланировано</a>
                        </div>
                    </div>
                    <!-- stars -->
                    <div class="container d-flex justify-content-center">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="d-none" id="star-5" type="radio" value="5">
                                <label class="star px-2" for="star-5"></label>
                                <input class="d-none" id="star-4" type="radio" value="4">
                                <label class="star px-2" for="star-4"></label>
                                <input class="d-none" id="star-3" type="radio" value="3">
                                <label class="star px-2" for="star-3"></label>
                                <input class="d-none" id="star-2" type="radio" value="2">
                                <label class="star px-2" for="star-2"></label>
                                <input class="d-none" id="star-1" type="radio" value="1">
                                <label class="star px-2" for="star-1"></label>
                            </div>
                        </div>
                    </div>
                    <!-- rating-num -->
                    <div class="rating-block text-center">
                        <div class="rating-num fs-1">@if(isset($release['mean'])) {{$release['mean']}} @endif<span class="fs-6">из 10</span></div>
                        <div class="rating-total">голосов: {{$release['num_scoring_users']}}</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="poster-inner">
                        <div class="poster-item">
                            <h3>@if(isset($release['alternative_titles']['en']))
                                    {{$release['alternative_titles']['en']}}
                                @else
                                    {{$release['title']}}
                                @endif / @if(isset($release['alternative_titles']['ja']))
                                    {{$release['alternative_titles']['ja']}}
                                @else
                                    {{'...'}}
                                @endif </h3>
                        </div>
                        <hr>
                        @if(isset($release['start_season']['year']))
                            <div class="poster-item">
                                <span>Год:</span> <a href="/">{{$release['start_season']['year']}}</a>
                            </div>
                        @endif
                        @if(isset($release['media_type']))
                            <div class="poster-item">
                                <span>Тип:</span> <a href="/">{{$release['media_type']}}</a>
                            </div>
                        @endif
                        @if(isset($release['start_season']['season']))
                            <div class="poster-item">
                                <span>Сезон:</span> <a href="/">{{$release['start_season']['season']}}</a>
                            </div>
                        @endif
                        @if(isset($release['studios']))
                            <div class="poster-item">
                                <span>Студия:</span> <a href="/">@foreach($release['studios'] as $studio)
                                        {{$studio['name']}}@if(!$loop->last),
                                        @endif
                                    @endforeach</a>
                            </div>
                        @endif
                        @if(isset($release['num_episodes']))
                            <div class="poster-item">
                                <span>Эпизодов:</span> <a href="/">{{'?'}}
                                    из {{$release['num_episodes']}}</a>
                            </div>
                        @endif
                        @if(isset($release['genres']))
                            <div class="poster-item">
                                <span>Жанр:</span>@foreach($release['genres'] as $key => $genre)
                                    <a href="?genre={{$genre['name']}}">{{$genre['name']}}</a>@if(!$loop->last),
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @if(isset($release['status']))
                            <div class="poster-item">
                                <span>Статус:</span>
                                    <a href="">{{$release['status']}}</a>
                            </div>
                        @endif
                        <hr>
                        @if(isset($release['synopsis']))
                            <div class="poster-item">
                                <span>Описание:</span>
                                <p class="description">
                                    @php
                                        if (preg_match('/[\[\]()]/', $release['synopsis'])){
                                            $release['synopsis'] =preg_replace('/\[[^\]]*\]|\([^)]*\)/', '', $release['synopsis']);
                                        }
                                    @endphp
                                    {{$release['synopsis']}}
                                </p>
                            </div>
                        @endif
                        <form action="{{route('fill-anime')}}" enctype="application/x-www-form-urlencoded" method="POST">
                            @csrf
                            <label for="id"></label>
                            <input type="number" name="id" id="id" value="{{$release['id']}}">
                            <label for="title"></label>
                            <input type="text" name="title" id="title" value="{{$release['title']}}">
                            <label for="original_title"></label>
                            <input type="text" name="original_title" id="original_title" value="@if(isset($release['alternative_titles']['en']))
                            {{$release['alternative_titles']['en']}}
                                @else
                                    {{$release['title']}}
                                @endif">
                            <label for="type"></label>
                            <input type="text" name="type" id="type" value="{{$release['media_type']}}">
                            <label for="release_year"></label>
                            <input type="number" name="release_year" id="release_year" value="{{$release['start_season']['year']}}">
                            <label for="release_season_slug"></label>
                            <input type="text" name="release_season_slug" id="release_season_slug" value="{{$release['start_season']['season']}}">
                            <label for="production_studio"></label>
                            <input type="text" name="production_studio" id="production_studio" value="@if(isset($release['studios'][0])) {{$release['studios'][0]['name']}} @endif">
                            <label for="total_episodes"></label>
                            <input type="text" name="total_episodes" id="total_episodes" value="{{$release['num_episodes']}}">
                            <label for="description"></label>
                            <input type="text" name="description" id="description" value="{{$release['synopsis']}}">
                            <label for="image_url"></label>
                            <input type="text" name="image_url" id="image_url" value="@if(isset($release['main_picture']['large']))
                        {{$release['main_picture']['large']}}
                        @elseif($release['main_picture']['medium'])
                        {{$release['main_picture']['medium']}}
                        @else
                        {{asset('images/no-image.svg')}}
                        @endif">
                            <label for="rating"></label>
                            <input type="number" name="rating" id="rating" value="{{$release['mean']}}">
                            <label for="status"></label>
                            <input type="text" name="status" id="status" value="{{$release['status']}}">
                            <label for="votes_count"></label>
                            <input type="number" name="votes_count" id="votes_count" value="{{$release['num_scoring_users']}}">
                            <label for="genres"></label>
                            <input type="text" name="genres" id="genres" value="@foreach($release['genres'] as $key => $genre){{$genre['name']}}@if(!$loop->last),@endif @endforeach">
                            <label for="genre_id"></label>
                            <input type="text" name="genre_id" id="genre_id" value="@foreach($release['genres'] as $key => $genre){{$genre['id']}}@if(!$loop->last),@endif @endforeach">
                            <br>
                            <label for="slug">slug</label>
                            <input type="text" name="slug" id="slug" value="@php echo strtolower(str_replace(' ', '-', str_replace(':', '', str_replace('.', '', str_replace('(', '', str_replace(')', '', $release['title'])))))) @endphp">
                            <input type="hidden" name="url">
                            <button type="submit">Send to fill DB</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- player -->
        <div class="wrapper container py-2">
            <div id="player"></div>

            <script>
                let player = new Playerjs({
                    id: "player", file: [
                        {
                            "title": "Ненасытный Берсерк 1",
                            "file": "https://cdn.flowplayer.com/a30bd6bc-f98b-47bc-abf5-97633d4faea0/hls/de3f6ca7-2db3-4689-8160-0f574a5996ad/playlist.m3u8"
                        },
                        {
                            "title": "Ненасытный Берсерк 2",
                            "file": "https://cdn.flowplayer.com/a30bd6bc-f98b-47bc-abf5-97633d4faea0/hls/de3f6ca7-2db3-4689-8160-0f574a5996ad/playlist.m3u8"
                        }
                    ]
                });
            </script>

        </div>
        <!-- comments -->
        <div class="wrapper py-2">
            <div class="comment-title">
                <div class="comment-title-wrapper d-flex justify-content-center align-items-center">
                    <span class="icon-comment mx-2"></span>
                    <p>Комментарии</p>
                </div>
            </div>
            <div class="comment-textarea container">
                <form action="" class="row px-3">
                    <label for="description" class="col-md-12 fs-3 text-center my-2">Твой отзыв на аниме</label>
                    <textarea class="col-md-12 justify-self-center" name="description" cols="60" rows="3"
                              placeholder="Написать отзыв"></textarea>
                    <div class="col-md-12 btn-send d-flex justify-content-end px-0">
                        <button type="submit">Отправить</button>
                    </div>
                </form>
            </div>
            <div class="users-comments m-3">
                <div class="container comment-block">
                    {{--                    @foreach($comments as $comment)--}}
                    {{--                        <div class="row d-flex py-3">--}}
                    {{--                            <div class="col-2">--}}
                    {{--                                <div class="user-img text-center">--}}
                    {{--                                    <img src="{{asset('images/user.jpg')}}" alt="user_a">--}}
                    {{--                                    <p>{{$comment->created_at}}</p>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="user-name text-center">--}}
                    {{--                                    <a href="">{{$comment->user_name}}</a>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="col-10">--}}
                    {{--                                <div class="user-comment w-100"><p>{{$comment->user_comment}}</p><a class="comment-like"--}}
                    {{--                                                                                                    href=""><i--}}
                    {{--                                            class="fa-solid fa-heart mx-1"></i>--}}
                    {{--                                        <p>({{$comment->user_likes}})</p></a></div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    @endforeach--}}
                </div>
            </div>
            <div class="container col-lg-12 d-flex justify-content-start pb-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link">Предыдущая</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Следующий</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</x-layout>
