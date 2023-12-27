<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/images/icons/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('js/playerjs.js')}}"></script>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <!-- Header Line -->
        <div class="container">
            <div class="d-flex justify-content-between headline" style="background: url({{asset('images/header/winter_header.gif')}});">
                <ul class="subscribe list-inline m-0">
                    <li><a class="mx-1" href="/"><span class="icon-mug"></span> <span>Подпишись</span></a></li>
                </ul>
                <a class="logo text-uppercase" href="/"><span class="icon-logo mx-1"></span> {{$title}}</a>
                <ul class="d-flex m-0 headline-authorization align-items-center">
                    @auth()
                        <li><a class="authorization-link mx-1 my-1 d-flex align-items-center" href="{{route('user.profile')}}"><span class="icon-user mx-1"></span> <span>Профиль {{auth()->user()->name}}</span></a></li>
                        <form action="{{route('user.logout')}}" method="POST">@csrf <button type="submit" class="logout-link mx-1 d-flex align-items-center"><span class="icon-exit mx-1"></span> Выход</button></form>
                    @else
                        <li><a class="register-link mx-1 my-1 d-flex align-items-center" href="{{route('user.create')}}"><span class="icon-key mx-1"></span> <span>Регистрация</span></a></li>
                        <li><a class="authorization-link mx-1 my-1 d-flex align-items-center" href="{{route('user.login')}}"><span class="icon-user mx-1"></span> <span>Вход</span></a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <!-- Navbar -->
        <div class="container">
            <!-- header navbar -->
            <nav class="header-nav navbar position-relative">
                <div class="header-nav-wrapper container-fluid">
                    <x-navbar :genres="$genres" />
                </div>
            </nav>
        </div>
    </header>
    {{-- View output --}}
    <main class="main">
    {{$slot}}
    </main>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-wrapper px-3 py-4">
                        <h5 class="footer-title">{{$title}}</h5>
                        <hr>
                        <p class="footer-text">Все материалы на сайте представлены только для ознакомления.</p>
                        <p class="footer-text">Дизайн: <a href="">Slav</a></p>
                        <p class="footer-text">Тех. Часть: <a href="">Slav</a></p>
                        <p class="footer-text">Появилась проблема? - Пиши: <a href="">support@neverlibrary.com</a></p>
                        <p class="footer-text">Для правообладателей / Сотрудничество: <a href="">partners@neverlibrary.com</a></p>
                        <a class="footer-text" href="">Политика конфиденциальности</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/89847e8da7.js" crossorigin="anonymous"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
