<x-layout>
    <div class="container show-page">
        <div class="wrapper container">
            <div class="row my-3">
                <div class="col-md-4">
                    <div class="image">
                        <img src="@if($release->image_url)
                            {{$release->image_url}}
                            @else
                            {{asset('images/season-anime2.jpg')}}
                            @endif" alt="">
                    </div>
                    <!-- view-status -->
                    <div class="view-status text-uppercase text-center">
                        <div class="view-watching">
                            <a class="fs-4" href="" id="watchingButton">Смотрю</a>
                        </div>
                        <input type="hidden" id="animeId" value="{{$release->id}}">
                        <input type="hidden" id="animeSlug" value="{{$release->slug}}">
                        <div class="view-watched">
                            <a class="fs-4" href="" id="watchedButton">Просмотрено</a>
                        </div>
                        <div class="view-planned">
                            <a class="fs-4" href="" id="plannedButton">Запланировано</a>
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
                        <div class="rating-num fs-1">{{$release->rating}} <span class="fs-6">из 10</span></div>
                        <div class="rating-total">голосов: {{$release->votes_count}}</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="poster-inner">
                        <div class="poster-item">
                            <h3>{{$release->title}} / {{$release->original_title}}</h3>
                        </div>
                        <hr>
                        <div class="poster-item">
                            <span>Год:</span> <a href="{{route('release.filterByGenre', ['genre' => 'all']) . '?year=' . $release->release_year}}">{{$release->release_year}}</a>
                        </div>
                        <div class="poster-item">
                            <span>Сезон:</span> <a href="{{route('release.filterByGenre', ['genre' => 'all']) . '?season=' . $release->release_season_slug . '&year=' . $release->release_year}}">{{$release->release_season}}</a>
                        </div>
                        <div class="poster-item">
                            <span>Студия:</span> <a href="{{route('release.filterByGenre', ['genre' => 'all']) . '?studio=' . $release->production_studio}}">{{$release->production_studio}}</a>
                        </div>
                        <div class="poster-item">
                            <span>Эпизодов:</span> <a href="/" onclick="return false" style="--hover: var(--bg-color)">@if(isset($release->episodes_released)) {{$release->episodes_released}} @else {{'?'}}@endif
                                из {{$release->total_episodes}}</a>
                        </div>
                        <div class="poster-item">
                            <span>Жанр:</span>@foreach($genres_release as $key => $genre_releas)
                                <a href="{{route('release.filterByGenre', ['genre' => $genre_releas->title])}}">{{$genre_releas->title}}</a>@if(!$loop->last),@endif
                            @endforeach


                        </div>
                        <hr>
                        <div class="poster-item">
                            <span>Описание:</span>
                            <p class="description">
                                {{$release->description}}
                            </p>
                        </div>
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
                            "file": "https://youtu.be/D9yYeb_JElI?si=qIaeOamQ0MRv72XX"
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
                    @foreach($comments as $comment)
                        <div class="row d-flex py-3">
                            <div class="col-2">
                                <div class="user-img text-center">
                                    <img src="{{asset('images/user.jpg')}}" alt="user_a">
                                    <p>{{$comment->created_at}}</p>
                                </div>
                                <div class="user-name text-center">
                                    <a href="">{{$comment->user_name}}</a>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="user-comment w-100"><p>{{$comment->user_comment}}</p><a class="comment-like" href=""><i class="fa-solid fa-heart mx-1"></i>
                                        <p>({{$comment->user_likes}})</p></a></div>
                            </div>
                        </div>
                    @endforeach
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
