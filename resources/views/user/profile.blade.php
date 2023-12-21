{{--@dd($user->all())--}}
<x-layout>
    <div class="container profile-page">
        <div class="row">
            <div class="container">
                <div class="profile-user-wrapper">
                    <div class="col-12">
                        <div class="container py-1" style="background: #222; border-bottom: solid 1px #585858;">
                            <p style="color: var(--bg-white)" class="fs-5">Профиль {{$user->name}}</p>
                        </div>
                    </div>
                    <div class="container-user-info-inner d-flex">
                        <div class="col-2 py-2">
                            <div style="border-right: solid 1px #272727">
                                <div class="profile-user-info-container px-2">
                                    <div class="container" style="background: #2e3439; border-radius: 3px">
                                        <div class="profile-picture">
                                            <a class="profile-picture-link d-inline-block d-flex justify-content-center align-items-center"
                                               href="">
                                                <i class="fa-solid fa-camera"></i>
                                                <i class="fa-solid fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="container d-flex user-info-text justify-content-between">
                                        <p style="color: var(--bg-white)">Joined</p>
                                        <p>{{\Carbon\Carbon::parse($user->created_at)->isoFormat('MMM D, YYYY')}}</p>
                                    </div>
                                    <div class="container text-center user-anime-list my-2">
                                        <a class="w-100" href="">Anime List</a>
                                    </div>
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
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="user-info-text-link">
                                            <p>Anime Stats</p>
                                            <hr class="mt-1 mb-2">
                                            <div>
                                                <div class="container-days-score mt-3 d-flex justify-content-between">
                                                    <div class="container d-flex justify-content-start">
                                                        <p class="mx-1 fw-light">Days:</p>
                                                        <p>0.0</p>
                                                    </div>
                                                    <div class="container d-flex justify-content-end">
                                                        <p class="mx-1 fw-light">Mean Score:</p>
                                                        <p>10.00</p>
                                                    </div>
                                                </div>
                                                <div class="container-stats-graph mt-3 d-flex">
                                                    <span class="graph watching" style="width: 33.33%"></span>
                                                    <span class="graph completed" style="width: 33.33%"></span>
                                                    <span class="graph plan-to-watch" style="width: 33.33%"></span>
                                                </div>
                                                <div class="container-stats-list mt-4">
                                                    <ul>
                                                        <li class="d-flex align-items-center"><span class="list watching"></span><a href="">Watching</a> <p>1</p></li>
                                                        <li class="d-flex align-items-center"><span class="list completed"></span><a href="">Completed</a> <p>1</p></li>
                                                        <li class="d-flex align-items-center"><span class="list plan-to-watch"></span><a href="">Plan to watch</a> <p>1</p></li>
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
                                        <div class="user-last-anime mt-2 mb-2 d-flex">
                                            <div class="user-anime-img">
                                                <img src="https://cdn.myanimelist.net/r/80x120/images/anime/1806/126216.webp?s=21efa202a5c7f795df406dfd55100993" alt="">
                                            </div>
                                            <div class="user-last-anime-info">
                                                <div class="container user-last-anime-info-inner d-flex">
                                                    <a href="">Chainsaw Man</a>
                                                    <span class="graph watching"></span>
                                                    <p>Completed 12/12 · Scored -</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-last-anime mt-2 mb-2 d-flex">
                                            <div class="user-anime-img">
                                                <img src="https://cdn.myanimelist.net/r/80x120/images/anime/1384/136408.webp?s=f892d88e56ca95992f120b5dcad0158a" alt="">
                                            </div>
                                            <div class="user-last-anime-info">
                                                <div class="container user-last-anime-info-inner d-flex">
                                                    <a href="">Zom 100: Zombie ni Naru made ni Shitai 100 no Koto</a>
                                                    <span class="graph completed"></span>
                                                    <p>Completed 12/12 · Scored -</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-last-anime mt-2 mb-2 d-flex">
                                            <div class="user-anime-img">
                                                <img src="https://cdn.myanimelist.net/r/80x120/images/anime/1179/136000.webp?s=e78f9983a3cdfff3785b733ac8a509c5" alt="">
                                            </div>
                                            <div class="user-last-anime-info">
                                                <div class="container user-last-anime-info-inner d-flex">
                                                    <a href="">Eiyuu Kyoushitsu</a>
                                                    <span class="graph plan-to-watch"></span>
                                                    <p>Completed 12/12 · Scored -</p>
                                                </div>
                                            </div>
                                        </div>
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
