@if(isset($release))
    <div class="col-lg-3 col-md-4 col-sm-12 poster">
        <a href="{{route('admin.show', ['id' => $release->id, 'slug' => $release->slug])}}">
            <div class="poster-img">
                <span class="poster-rating">{{$release->rating}}</span>
                <img src="@if($release->image_url)
            {{$release->image_url}}
            @else
            {{asset('images/no-image.svg')}}
            @endif" alt="">
                <div class="poster-info">
                    <h2 class="poster-info-title">{{$release->title}}</h2>
                    <p class="poster-original-title fw-light fs-6">{{$release->original_title}}</p>
                    <hr>
                    <div class="text-block">
                        <h2 class="d-flex">Тип: <small class="text-block-type">{{$release->type}}</small></h2>
                    </div>
                    <div class="text-block d-flex">
                        <h2>Год: </h2>
                        <p>{{$release->release_year}}</p>
                    </div>
                    <div class="text-block d-flex">
                        <h2>Сезон: </h2>
                        <p>{{$release->release_season}}</p>
                    </div>
                    <div class="text-block d-flex">
                        <h2>Студия: </h2>
                        <p>{{$release->production_studio}}</p>
                    </div>
                    @if($release->type == 'tv')
                        <div class="text-block d-flex">
                            <h2>Эпизодов: </h2>
                            <p>@if(isset($release->episodes_released)) {{$release->episodes_released}}@else {{'?'}} @endif из {{$release->total_episodes}}</p>
                        </div>
                    @endif
                    <div class="text-block d-flex">
                        <h2>Жанр: </h2>
                        <p class="text-genres">@foreach($release->genres as $genre)
                                {{$genre->title}}@if(!$loop->last),
                                @endif
                            @endforeach</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
@else
    <div class="py-2 text-center">
        <h1>Empty response</h1>
    </div>
@endif

