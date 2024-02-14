<div class="container">
    <div id="carouselExampleIndicators" class="carousel slide pb-4 pt-3">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-container-block d-flex justify-content-between">
                    @foreach($carousel as $carouselItem)
                        <div class="carousel-block">
                            <div class="carousel-img-bg">
                                <a href="{{route('release.show', [$carouselItem->id, $carouselItem->slug])}}"><img
                                        src="
                                        @if($carouselItem['image_url'])
                                        {{$carouselItem['image_url']}}
                                        @else
                                        {{asset('images/no-image.svg')}}
                                        @endif
                                        "
                                        alt=""></a>
                            </div>
                            <div class="carousel-text-block">
                                <a href="{{route('release.show', [$carouselItem->id, $carouselItem->slug])}}">{{$carouselItem['title']}}</a>
                            </div>
                            <div class="carousel-text-info">
                                <p>{{$carouselItem->release_year}}, {{$carouselItem->production_studio}},
                                    @foreach($carouselItem->genres as $genre)
                                        {{$genre->title}}@if(!$loop->last)
                                            ,
                                        @endif
                                    @endforeach</p>
                            </div>
                        </div>
                        @if($loop->iteration == 7)
                            @break
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="carousel-item">
                <div class="carousel-container-block d-flex justify-content-between">
                    @foreach($carousel as $carouselItem)
                        @if($loop->iteration > 7)
                            <div class="carousel-block">
                                <div class="carousel-img-bg">
                                    <a href="{{route('release.show', [$carouselItem->id, $carouselItem->slug])}}"><img
                                            src="
                                        @if($carouselItem['image_url'])
                                        {{$carouselItem['image_url']}}
                                        @else
                                        {{asset('images/no-image.svg')}}
                                        @endif
                                        "
                                            alt=""></a>
                                </div>
                                <div class="carousel-text-block">
                                    <a href="{{route('release.show', [$carouselItem->id, $carouselItem->slug])}}">{{$carouselItem['title']}}</a>
                                </div>
                                <div class="carousel-text-info">
                                    <p>{{$carouselItem->release_year}}, {{$carouselItem->production_studio}},
                                        @foreach($carouselItem->genres as $genre)
                                            {{$genre->title}}@if(!$loop->last),
                                            @endif
                                        @endforeach</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
        @unless(count($carousel) < 8)
            <button class="carousel-control-prev opacity-100 fs-4" type="button"
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                <span aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next opacity-100 fs-4" type="button"
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                <span aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
</div>
