<div class="container">
    <div class="row season-events">
        <div class="season-events-inner">
            @foreach($seasonEvents as $seasonEvent)
                <a class="col-lg-6" href="{{route('release.seasonEvents', ['event' => $seasonEvent->slug, 'year' => $seasonEvent->year])}}">
                    <img src="{{asset('images/season_events/' . $seasonEvent->image_url)}}" alt="">
                    <span><strong class="text-uppercase">Аниме {{$seasonEvent->title}}</strong></span>
                </a>
            @endforeach
        </div>
    </div>
</div>
