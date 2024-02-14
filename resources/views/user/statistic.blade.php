{{--@dd($releases)--}}
<x-layout>
    <div class="container profile-page statistic-page position-relative">
        <div class="row">
            <div class="container">
                <div class="profile-user-wrapper">
                    <div class="col-12">
                        <div class="up-links-container py-1">
                            <div class="d-flex justify-content-between">
                                <a href="{{route('user.statistic')}}" class="up-links @php if (!str_contains(url()->full(), 'type')) echo 'active' @endphp fs-5">All Anime</a>
                                <a href="{{route('user.statistic', ['type' => 'watching'])}}" class="up-links @php if (str_contains(url()->full(), 'watching')) echo 'active' @endphp fs-5">Currently Watching</a>
                                <a href="{{route('user.statistic', ['type' => 'watched'])}}" class="up-links @php if (str_contains(url()->full(), 'watched')) echo 'active' @endphp fs-5">Completed</a>
                                <a href="{{route('user.statistic', ['type' => 'planned'])}}" class="up-links @php if (str_contains(url()->full(), 'planned')) echo 'active' @endphp fs-5">Plan to Watch</a>
                            </div>
                        </div>
                    </div>
                    <div class="container-user-info-inner d-flex">
                        <div class="col-12 py-2">
                            <div class="container user-info-text-link">
                                <p>Statistics</p>
                                <hr class="mt-1 mb-2">
                            </div>
                            @if($releases)
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 row">
                                        @foreach($releases as $release)
                                            <div class="user-last-anime col-md-4 mt-2 mb-2 d-flex">
                                                <div class="user-anime-img">
                                                    <img
                                                        src="@if(isset($release['image_url'])) {{$release['image_url']}} @else {{asset('images/no-image.svg')}} @endif"
                                                        alt="">
                                                </div>
                                                <div class="user-last-anime-info">
                                                    <div class="container user-last-anime-info-inner d-flex">
                                                        <a href="{{route('release.show', ['id' => $release['id'], 'slug' => $release['slug']])}}">
                                                            @if(isset($release['title']))
                                                                {{$release['title']}}
                                                            @else
                                                                {{$release['original_title']}}
                                                            @endif</a>
                                                        <span class="graph {{$release['pivot']['type']}}"></span>
                                                        @if($release['pivot']['type'] == 'watched')
                                                            <p>Completed {{$release['total_episodes']}}/{{$release['total_episodes']}} ·
                                                                Scored @if(isset($release['pivot']['rating']))
                                                                    {{$release['pivot']['rating']}}★
                                                                @else
                                                                    -
                                                                @endif</p>
                                                        @elseif($release['pivot']['type'] == 'watching')
                                                            <p>Watching ·
                                                                Scored @if(isset($release['pivot']['rating']))
                                                                    {{$release['pivot']['rating']}}★
                                                                @else
                                                                    -
                                                                @endif</p>
                                                        @else
                                                            <p>Planned ·
                                                                Scored @if(isset($release['pivot']['rating']))
                                                                    {{$release['pivot']['rating']}}★
                                                                @else
                                                                    -
                                                                @endif</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="{{asset('images/no-video.png')}}" alt="No Statistic" style="height: 300px">
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <h1>No statistic here yet</h1>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="statistic-paginate container col-lg-12 d-flex justify-content-center pb-3 position-absolute">
                        <nav aria-label="Page navigation">
                                {{$releases->links()}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
