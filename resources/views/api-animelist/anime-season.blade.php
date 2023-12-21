<x-layout>
    <div id="content" class="container">
        <div class="content-row">
            <!-- anime-row -->
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align: center">Search type: {{$type}}</h1>
                </div>
                @foreach($releases['data'] as $releaseNode)
                    @if(isset($releaseNode['ranking']['rank']))
                            <div class="col-lg-3 col-md-4 col-sm-12 poster">
                                <div>
                                    <div class="poster-img">
                                            <span class="poster-rating" style="color: var(--bg-color)">ID: {{$releaseNode['node']['id']}}</span>
                                        @if(isset($releaseNode['node']['main_picture']['large']))
                                            <img src="{{$releaseNode['node']['main_picture']['large']}}" alt="">
                                        @endif
                                        <div class="poster-info">
                                            @if(isset($releaseNode['node']['title']))
                                                <h2>{{$releaseNode['node']['title']}}</h2>
                                            @endif
                                            <p class="poster-original-title fw-light fs-6">...</p>
                                            <hr>
                                            <div class="text-block d-flex">
                                                <h1 style="color: red">RANKING: {{$releaseNode['ranking']['rank']}}</h1>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php $token = request('token') ? request('token') : request()->session()->get('token') @endphp
                                @if(isset($releaseNode['node']['id']))
                                    <form action="{{route('get-animeById', ['token' => request('token'), 'animeId' => $releaseNode['node']['id']])}}" enctype="application/x-www-form-urlencoded" method="POST">
                                        @csrf
                                        <label for="animeId">Id</label>
                                        <input type="number" name="animeId" id="animeId" value="{{$releaseNode['node']['id']}}">
                                        <button type="submit">Get anime info</button>
                                    </form>
                                @endif
                            </div>

                    @else
                        @foreach($releaseNode as $release)
                            <div class="col-lg-3 col-md-4 col-sm-12 poster">
                                <div>
                                    <div class="poster-img">
                                        @if(isset($release["id"]))
                                            <span class="poster-rating" style="color: var(--bg-color)">{{$release["id"]}}</span>
                                        @endif
                                        @if(isset($release['main_picture']['large']))
                                            <img src="{{$release['main_picture']['large']}}" alt="">
                                        @endif
                                        <div class="poster-info">
                                            @if(isset($release['title']))
                                                <h2>{{$release['title']}}</h2>
                                            @endif
                                            <hr>
                                        </div>
                                    </div>
                                </div>

                                @if(isset($release['id']))
                                    <form action="{{route('get-animeById', ['token' => request('token'), 'animeId' => $release['id']])}}" enctype="application/x-www-form-urlencoded" method="POST">
                                        @csrf
                                        <label for="animeId">Id</label>
                                        <input type="number" name="animeId" id="animeId" value="{{$release['id']}}">
                                        <button type="submit">Get anime info</button>
                                    </form>
                                @endif
                            </div>

                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
