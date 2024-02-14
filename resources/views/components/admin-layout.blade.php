<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title> Responsiive Admin Dashboard | CodingLab </title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/images/icons/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <span class="icon-logo mx-1 fs-1" style="color: #000;"></span>
        <a href="{{route('admin.index')}}" style="color: white">NEVER LIBRARY</a>
    </div>
    <ul class="nav-links">
        <li>
            <a href="{{route('admin.index')}}" class="{{url()->current() == route('admin.index') ? 'active' : ''}}">
                <i class='bx bx-grid-alt' ></i>
                <span class="links_name">Anime row</span>
            </a>
        </li>
        <li>
            <a href="{{route('admin.seasonEvents')}}" class="{{url()->current() == route('admin.seasonEvents') ? 'active' : ''}}">
                <i class='bx bx-box' ></i>
                <span class="links_name">Season Events</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-user'></i>
                <span class="links_name">Users</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-message' ></i>
                <span class="links_name">Comments</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-cog' ></i>
                <span class="links_name">Setting</span>
            </a>
        </li>
        <li class="log_out">
            <a href="{{route('release.index')}}">
                <i class='bx bx-log-out'></i>
                <span class="links_name">Log out</span>
            </a>
        </li>
    </ul>
</div>

<div class="d-flex justify-content-end">
    <div class="col-10">
        <form action="{{route('admin.index', ['genre' => 'all'])}}" method="GET" class="d-flex my-1">

            <input class="header-search form-control me-2" type="text" name="search" value="{{request('search') ? request('search') : old('search')}}" placeholder="Search" required>
            <button class="icon-search position-absolute" type="submit"></button>

        </form>
        {{$slot}}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('countries0')  // id
    new MultiSelectTag('countries1')  // id
</script>
</body>
</html>
