<ul class="header-nav-links">
    <li class="header-nav-links-li">
        <a href="">Аниме</a> <span class="icon-ctrl"></span>
        <!-- Mega drop down -->
        <div class="mega-dropdown-block">
            <div class="mega-dropdown-content">
                <ul id="film" class="mega-dropdown-ul row">
                    @if(isset($genres))
                        @foreach($genres as $genre)
                            <li class="col-lg-2 col-md-3 col-sm-4"><a href="/release/{{$genre->title}}">{{$genre->title}}</a></li>
                        @endforeach
                    @endif
                </ul>
                <div class="col-lg-12 mt-3 pb-3">
                    <div class="mega-search d-flex justify-content-center align-items-center">
                        <div class="mega-search-text mx-2">
                            <p>Найти лучшие фильмы</p>
                        </div>
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-secondary dropdown-toggle text-uppercase btn-mega-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Любого жанра
                            </button>
                            <ul class="small-dropdown dropdown-menu">
                                @if(isset($genres))
                                    @foreach($genres as $genre)
                                        <li><a href="?genre={{$genre->title}}">{{$genre->title}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="btn-group dropup mx-2">
                            <button type="button" class="btn btn-secondary dropdown-toggle text-uppercase" data-bs-toggle="dropdown" aria-expanded="false">
                                За все время
                            </button>
                            <ul class="small-dropdown dropdown-menu">
                                <li><a href="">Action</a></li>
                                <li><a href="">Action</a></li>
                                <li><a href="">Action</a></li>
                                <li><a href="">Action</a></li>
                                <li><a href="">Action</a></li>
                                <li><a href="">Action</a></li>
                                <li><a href="">Action</a></li>
                                <li><a href="">Action</a></li>
                                <li><a href="">Action</a></li>
                                <li><a href="">Action</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="header-nav-links-li"><a href="{{route('release.filterByGenre', ['genre' => 'all'])}}">Новинки</a></li>
    <li class="header-nav-links-li"><a href="">Анонсы</a></li>
    <li class="header-nav-links-li" style="color: red;"><a href="http://never-library/anime-list/send-request">SEND REQUEST</a></li>
</ul>
<form action="{{route('release.filterByGenre', ['genre' => 'all'])}}" method="GET" class="d-flex position-absolute">

        <input class="header-search form-control me-2" type="text" name="search" value="{{request('search') ? request('search') : old('search')}}" placeholder="Search" required>
        <button class="icon-search position-absolute" type="submit"></button>

</form>
{{--<form action="{{route('release.filterByGenre', ['genre' => 'all'])}}" method="GET">--}}
{{--    <input type="text" name="search" value="{{old('search')}}" required/>--}}
{{--    <button type="submit">Search</button>--}}
{{--</form>--}}

