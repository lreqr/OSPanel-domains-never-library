{{--@dd($user)--}}
<x-layout>
    @error('image')
    <h1>{{$message}}</h1>
    @enderror
    <div class="container profile-page">
        <div class="row">
            <div class="container">
                <div class="profile-user-wrapper">
                    <div class="col-12">
                        <div class="container py-1 d-flex align-items-center" style="background: #222; border-bottom: solid 1px #585858;">
                            <p style="color: var(--bg-white)" class="fs-5">Профиль {{$user->name}}</p>
{{--                            <a href="{{route('user.edit')}}" class="mx-3 fs-5">Edit</a>--}}
                        </div>
                    </div>
                    <div class="container-user-info-inner d-flex">
                        <div class="col-2 py-2">
                            <div style="border-right: solid 1px #272727">
                                <div class="profile-user-info-container px-2">
                                    <div class="container-profile-picture" style="background: #2e3439; border-radius: 3px">
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        @if(!$user->logo)
                                            <form action="{{route('user.profile')}}" method="POST" enctype="multipart/form-data">
                                                <label id="label-logo" for="profileImg" class="profile-picture d-flex justify-content-center align-items-center">
                                                    <label for="image" class="fa-solid fa-camera" style="content: '\e96d'; font-size: 70px;"></label>
                                                    <input id="image" type="file" name="image" class="profile-picture-link d-inline-block d-flex justify-content-center align-items-center d-none">
                                                    <input id="submit" type="submit">
                                                    @csrf
                                                </label>
                                            </form>
                                        @else
                                            <div class="profile-image position-relative">
                                                <img id="img-logo" class="profile-img" src="{{asset("storage/{$user->logo}")}}" alt="no-img">
                                                <form action="{{route('user.profile')}}" method="POST" id="formEditImage" class="edit-span-absolute d-flex align-items-center position-absolute" enctype="multipart/form-data">
                                                    @csrf
                                                    <label for="editImage" class="mx-1">Edit</label>
                                                    <label for="editImage" class="icon-pencil"></label>
                                                    <input type="file" name="image" id="editImage" class="d-none">
                                                    <button id="submitEditImage" type="submit" class="d-none"></button>
                                                </form>
                                            </div>


                                        @endif
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="container d-flex user-info-text justify-content-between mb-2">
                                        <p style="color: var(--bg-white)">Joined</p>
                                        <p>{{\Carbon\Carbon::parse($user->created_at)->isoFormat('MMM D, YYYY')}}</p>
                                    </div>
                                    <a href="{{route('user.statistic')}}" class="container text-center user-anime-list my-2 w-100">
                                        <p class="w-100" >Anime List</p>
                                    </a>
                                    <hr class="mt-2" style="margin-bottom: 5px">
                                    <div class="container d-flex user-info-text">
                                        <a href="">Favorites</a>
                                    </div>
                                    <div class="user-info-text-link mt-3 container d-flex justify-content-between">
                                        <p>Friends</p>
                                        <a href="">All (1)</a>
                                    </div>
                                    <hr class="mt-1 mb-2">
                                    <div class="user-info-text-link mt-3 container">
                                        <a href="">tobeallsmiles, </a>
                                        <a href="">lreqr, </a>
                                        <a href="">Diana, </a>
                                        <a href="">Diana, </a>
                                        <a href="">Diana, </a>
                                        <a href="">Diana, </a>
                                        <a href="">Diana, </a>
                                        <a href="">Vlad</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 py-2">
                            <div class="container user-info-text-link">
                                <p>Statistics</p>
                                <hr class="mt-1 mb-2">
                            </div>
                            @if(isset($releases))
                                @php
                                    foreach ($releases as $release){

                                        if ($release['pivot']['type'] == 'watched'){
                                            $user['total_episodes'] += $release['total_episodes'];
                                            $user['total_watched'] += 1;
                                            if ($release['type'] == 'movie'){
                                                $user['total_time'] += (((($release['total_episodes'] * 90) * 100) / 1440) / 100);
                                            } else{
                                                 $user['total_time'] += (((($release['total_episodes'] * 20) * 100) / 1440) / 100);
                                            }
                                        }
                                        if ($release['pivot']['rating']){
                                            $user['total_rating'] += $release['pivot']['rating'];
                                            $user['total_with_rating'] += 1;
                                        }
                                        if ($release['pivot']['type'] == 'watching'){
                                            $user['total_watching'] += 1;
                                        }
                                        if ($release['pivot']['type'] == 'planned'){
                                            $user['total_planned'] += 1;
                                        }
                                    }
                                @endphp
                            @endif
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="user-info-text-link">
                                            <p>Anime Stats</p>
                                            <hr class="mt-1 mb-2">
                                            <div>
                                                <div class="container-days-score mt-3 d-flex justify-content-between">
                                                    <div class="container d-flex justify-content-start">
                                                        <p class="mx-1 fw-light">Days: </p>
                                                        <p>@if(isset($user['total_time'])) {{round($user['total_time'], 1)}}@else - @endif</p>
                                                    </div>
                                                    <div class="container d-flex justify-content-end">
                                                        <p class="mx-1 fw-light">Mean Score:</p>
                                                        <p>@if(isset($user['total_rating'])) {{round(($user['total_rating'] / $user['total_with_rating']), 1)}} @else - @endif</p>
                                                    </div>
                                                </div>
                                                @if(isset($releases)) @php $user['total_releases'] = $user['total_watching'] + $user['total_watched'] + $user['total_planned'] @endphp @endif
                                                <div class="container-stats-graph mt-3 d-flex">
                                                    <span class="graph watching" @if(isset($user['total_watching'])) style="width: {{round(($user['total_watching'] * 100) / $user['total_releases'], 2)}}%"@endif></span>
                                                    <span class="graph watched" @if(isset($user['total_watched'])) style="width: {{round(($user['total_watched'] * 100) / $user['total_releases'], 2)}}%"@endif></span>
                                                    <span class="graph planned" @if(isset($user['total_planned'])) style="width: {{round(($user['total_planned'] * 100) / $user['total_releases'], 2)}}%" @endif></span>
                                                </div>
                                                <div class="container-stats-list mt-4 d-flex justify-content-between">
                                                    <ul>
                                                        <li class="d-flex align-items-center">
                                                            <span class="list watching"></span>
                                                            <a href="{{route('user.statistic', ['type' => 'watching'])}}">Watching</a>
                                                            <p>@if($user['total_watching']) {{$user['total_watching']}}@else - @endif</p></li>
                                                        <li class="d-flex align-items-center">
                                                            <span class="list watched"></span>
                                                            <a href="{{route('user.statistic', ['type' => 'watched'])}}">Completed</a>
                                                            <p>@if(isset($user['total_watched'])) {{$user['total_watched']}}@else - @endif</p></li>
                                                        <li class="d-flex align-items-center">
                                                            <span class="list planned"></span>
                                                            <a href="{{route('user.statistic', ['type' => 'planned'])}}">Plan to watch</a>
                                                            <p>@if($user['total_planned']) {{$user['total_planned']}}@else - @endif</p></li>
                                                    </ul>
                                                    <ul>
                                                        <li class="d-flex align-items-center justify-content-between">
                                                            <p class="fw-light mx-3">Total Entries</p>
                                                            <p>@if(!count($releases) == 0) {{count($releases)}}@else - @endif</p>
                                                        </li>
                                                        <li class="d-flex align-items-center justify-content-between">
                                                            <p class="fw-light mx-3">Episodes</p>
                                                            <p>@if(isset($user['total_episodes'])) {{$user['total_episodes']}} @else - @endif</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="user-info-text-link">
                                            <p>Last Anime Updates</p>
                                            <hr class="mt-1 mb-2">
                                        </div>
                                        @if(count($releases) < 3)
                                            @for($i = 0; $i < count($releases); $i++)
                                                <div class="user-last-anime mt-2 mb-2 d-flex">
                                                    <div class="user-anime-img">
                                                        <img
                                                            src="@if(isset($releases[$i]['image_url'])) {{$releases[$i]['image_url']}} @else {{asset('images/no-image.svg')}} @endif"
                                                            alt="">
                                                    </div>
                                                    <div class="user-last-anime-info">
                                                        <div class="container user-last-anime-info-inner d-flex">
                                                            <a href="{{route('release.show', ['id' => $releases[$i]['id'], 'slug' => $releases[$i]['slug']])}}">
                                                                @if(isset($releases[$i]['title']))
                                                                    {{$releases[$i]['title']}}
                                                                @else
                                                                    {{$releases[$i]['original_title']}}
                                                                @endif</a>
                                                            <span class="graph {{$releases[$i]['pivot']['type']}}"></span>
                                                            @if($releases[$i]['pivot']['type'] == 'watched')
                                                                <p>Completed {{$releases[$i]['total_episodes']}}/{{$releases[$i]['total_episodes']}} · Scored @if(isset($releases[$i]['pivot']['rating'])) {{$releases[$i]['pivot']['rating']}}★ @else - @endif</p>
                                                            @elseif($releases[$i]['pivot']['type'] == 'watching')
                                                                <p>Watching · Scored @if(isset($releases[$i]['pivot']['rating'])) {{$releases[$i]['pivot']['rating']}}★ @else - @endif</p>
                                                            @else
                                                                <p>Planned · Scored @if(isset($releases[$i]['pivot']['rating'])) {{$releases[$i]['pivot']['rating']}}★ @else - @endif</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        @else
                                            @for($i = 0; $i < 3; $i++)
                                                <div class="user-last-anime mt-2 mb-2 d-flex">
                                                    <div class="user-anime-img">
                                                        <img
                                                            src="@if(isset($releases[$i]['image_url'])) {{$releases[$i]['image_url']}} @else {{asset('images/no-image.svg')}} @endif"
                                                            alt="">
                                                    </div>
                                                    <div class="user-last-anime-info">
                                                        <div class="container user-last-anime-info-inner d-flex">
                                                            <a href="{{route('release.show', ['id' => $releases[$i]['id'], 'slug' => $releases[$i]['slug']])}}">
                                                                @if(isset($releases[$i]['title']))
                                                                    {{$releases[$i]['title']}}
                                                                @else
                                                                    {{$releases[$i]['original_title']}}
                                                                @endif</a>
                                                            <span class="graph {{$releases[$i]['pivot']['type']}}"></span>
                                                            @if($releases[$i]['pivot']['type'] == 'watched')
                                                                <p>Completed {{$releases[$i]['total_episodes']}}/{{$releases[$i]['total_episodes']}} · Scored @if(isset($releases[$i]['pivot']['rating'])) {{$releases[$i]['pivot']['rating']}}★ @else - @endif </p>
                                                            @elseif($releases[$i]['pivot']['type'] == 'watching')
                                                                <p>Watching · Scored  @if(isset($releases[$i]['pivot']['rating'])){{$releases[$i]['pivot']['rating']}}★ @else - @endif</p>
                                                            @else
                                                                <p>Planned · Scored @if(isset($releases[$i]['pivot']['rating'])) {{$releases[$i]['pivot']['rating']}}★@else - @endif</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
