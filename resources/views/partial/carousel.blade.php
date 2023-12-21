<div class="container">
    <div id="carouselExampleIndicators" class="carousel slide pb-4 pt-3">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-container-block d-flex justify-content-between">
                    @for($i = 0; $i < 7; $i++)
                        @if($i < count($carousel))
                            <div class="carousel-block">
                                <div class="carousel-img-bg">
                                    <a href="{{route('release.show', [$carousel[$i]->id, $carousel[$i]->slug])}}"><img
                                            src="
                                        @if($carousel[$i]['image_url'])
                                        {{$carousel[$i]['image_url']}}
                                        @else
                                        {{asset('images/no-image.svg')}}
                                        @endif
                                        "
                                            alt=""></a>
                                </div>
                                <div class="carousel-text-block">
                                    <a href="{{route('release.show', [$carousel[$i]->id, $carousel[$i]->slug])}}">{{$carousel[$i]['title']}}</a>
                                </div>
                                <div class="carousel-text-info">
                                    <p>{{$carousel[$i]->release_year}}, {{$carousel[$i]->production_studio}},
                                        @foreach($carousel[$i]->genres as $genre)
                                            {{$genre->title}}@if(!$loop->last),
                                            @endif
                                        @endforeach</p>
                                </div>

                            </div>
                        @else
                            <div class="carousel-block">
                                <div class="carousel-img-bg">
                                    <a href="/"><img src="{{asset('images/no-image.svg')}}" alt=""></a>
                                </div>
                                <div class="carousel-text-block">
                                    <a href="/">Empty</a>
                                </div>
                                <div class="carousel-text-info">
                                    <p>2023, США, Детективы</p>
                                </div>

                            </div>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-container-block d-flex justify-content-between">
                    @for($i = 8; $i < 15; $i++)
                        @if($i < count($carousel))
                            <div class="carousel-block">
                                <div class="carousel-img-bg">
                                    <a href="{{route('release.show', [$carousel[$i]->id, $carousel[$i]->slug])}}"><img
                                            src="
                                        @if($carousel[$i]['image_url'])
                                        {{asset('images/' . $carousel[$i]['image_url'])}}
                                        @else
                                        {{asset('images/no-image.svg')}}
                                        @endif
                                        "
                                            alt=""></a>
                                </div>
                                <div class="carousel-text-block">
                                    <a href="/">{{$carousel[$i]['title']}}</a>
                                </div>
                                <div class="carousel-text-info">
                                    <p>2023, США, Детективы</p>
                                </div>

                            </div>
                        @else
                            <div class="carousel-block">
                                <div class="carousel-img-bg">
                                    <a href="/"><img src="{{asset('images/no-image.svg')}}" alt=""></a>
                                </div>
                                <div class="carousel-text-block">
                                    <a href="/">Empty</a>
                                </div>
                                <div class="carousel-text-info">
                                    <p>2023, США, Детективы</p>
                                </div>

                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <button class="carousel-control-prev opacity-100 fs-4" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
            <span aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next opacity-100 fs-4" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
            <span aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
