<x-layout>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="col-12" style="background: var(--bg-color)">
                    <form method="POST" action="{{route('get-anime', ['token' => $token])}}" enctype="application/x-www-form-urlencoded" class="row g-3">
                        @csrf
                        <div class="col-12" style="text-align: center">
                            <h1>Get season anime</h1>
                        </div>
                        <div class="col-md-6">
                            <label for="inputState" class="form-label">Season</label>
                            <select id="inputState" class="form-select" name="season">
                                <option selected>Choose...</option>
                                <option>winter</option>
                                <option>spring</option>
                                <option>summer</option>
                                <option>fall</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputSeasonLimit" class="form-label">Limit</label>
                            <input type="number" class="form-control" id="inputSeasonLimit" name="limit" placeholder="Limit">
                        </div>
                        <div class="col-6">
                            <label for="inputSeasonYear" class="form-label">Year</label>
                            <input type="number" class="form-control" id="inputSeasonYear" name="year" placeholder="Year">
                        </div>
                        <div class="col-md-6 d-none">
                            <label for="type" class="form-label">Search type</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="Limit" value="season">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-12" style="background: var(--bg-color)">
                    <form method="POST" action="{{route('get-anime', ['token' => $token])}}" enctype="application/x-www-form-urlencoded" class="row g-3">
                        @csrf
                        <div class="col-12" style="text-align: center">
                            <h1>Get anime Search</h1>
                        </div>
                        <div class="col-md-6">
                            <label for="inputSearch" class="form-label">Search</label>
                            <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search">
                        </div>
                        <div class="col-md-6">
                            <label for="inputSeasonLimit" class="form-label">Limit</label>
                            <input type="number" class="form-control" id="inputSeasonLimit" name="limit" placeholder="Limit">
                        </div>
                        <div class="col-md-6 d-none">
                            <label for="type" class="form-label">Search type</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="Limit" value="search">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-12" style="background: var(--bg-color)">
                    <form method="POST" action="{{route('get-anime', ['token' => $token])}}" enctype="application/x-www-form-urlencoded" class="row g-3">
                        @csrf
                        <div class="col-12" style="text-align: center">
                            <h1>Get anime ranking</h1>
                        </div>
                        <div class="col-md-6">
                            <label for="ranking_type" class="form-label">Ranking type</label>
                            <select id="ranking_type" class="form-select" name="ranking_type">
                                <option selected>Top Anime...</option>
                                <option>all</option>
                                <option>airing</option>
                                <option>upcoming</option>
                                <option>tv</option>
                                <option>ova</option>
                                <option>movie</option>
                                <option>special</option>
                                <option>popularity</option>
                                <option>special</option>
                                <option>favorite</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputSeasonLimit" class="form-label">Limit</label>
                            <input type="number" class="form-control" id="inputSeasonLimit" name="limit" placeholder="Limit">
                        </div>
                        <div class="col-md-6 d-none">
                            <label for="type" class="form-label">Search type</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="ranking" value="ranking">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
