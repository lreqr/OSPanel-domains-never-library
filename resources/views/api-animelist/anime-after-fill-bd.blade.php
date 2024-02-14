@if($result)
    <h1 style="color: #8a60ab">Аниме с именем</h1> <p style="color: #8a60ab">{{$result['title']}}</p> <h1 style="color: #8a60ab">было добавлено в бд</h1>
@else
    <h1 style="color: darkred">Аниме уже есть в бд</h1>
@endif
<br>
<hr>
@if($genres)
    <h1 style="color: #17784a">Жанры с именами {{$genres}} были добавлено в бд</h1>
@else
    <h1 style="color: darkred">Жанры уже есть в бд</h1>
@endif
<br>
<hr>
@if($video)
    <h1 style="color: royalblue">Видео для аниме:</h1> <p style="color: royalblue">{{$result['title']}}</p> <p style="color: royalblue">с именами {{$video}} было добавлено в бд</p>
@else
    <h1 style="color: darkred">Видео уже есть в бд</h1>
@endif
