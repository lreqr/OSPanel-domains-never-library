<div class="container">
    <div class="filter-row {{$paddingTop}}">
        <div class="row">
            <div class="col-lg-6">
                <div class="filter-list">
                    <ul>
                        <li class="filter-li @php if (str_contains(url()->full(), 'latest') || !str_contains(url()->full(), 'filter')) echo 'active' @endphp">
                            <a href="@php
                            echo str_contains(url()->full(), '?') ? Request::fullUrlWithQuery(['filter' => 'latest', 'page' => '1']) : '?filter=latest';
                        @endphp">Последние поступления</a></li>
                        <li class="filter-li @php if (str_contains(url()->full(), 'rating')) echo 'active' @endphp"><a
                                href="@php
                            echo str_contains(url()->full(), '?') ? Request::fullUrlWithQuery(['filter' => 'rating', 'page' => '1']) : '?filter=rating';
                        @endphp">Популярные</a></li>
                        {{--                        <li><a href="?filter=soon">В ожидании</a></li>--}}
                        {{--                        <li><a href="?filter=watching">Сейчас смотрят</a></li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="filter-list d-flex">
                    <ul>
                        <li class="filter-list-no-hover"><span>Отображать:</span></li>
                        <li class="filter-li @php if (!str_contains(url()->full(), 'type')) echo 'active' @endphp"><a href="{{url()->current().'?'.http_build_query(request()->except('type'))}}">Все</a></li>
                        <li class="filter-li @php if (str_contains(url()->full(), 'tv')) echo 'active' @endphp"><a href="@php
                            echo str_contains(url()->full(), '?') ? Request::fullUrlWithQuery(['type' => 'tv', 'page' => '1']) : '?type=tv';
                        @endphp">Аниме</a></li>
                        <li class="filter-li @php if (str_contains(url()->full(), 'movie')) echo 'active' @endphp"><a href="@php
                            echo str_contains(url()->full(), '?') ? Request::fullUrlWithQuery(['type' => 'movie', 'page' => '1']) : '?type=movie';
                        @endphp">Фильмы</a></li>
                        <li class="filter-li @php if (str_contains(url()->full(), 'special')) echo 'active' @endphp"><a href="@php
                            echo str_contains(url()->full(), '?') ? Request::fullUrlWithQuery(['type' => 'special', 'page' => '1']) : '?type=special';
                        @endphp">OVA/ONA</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
