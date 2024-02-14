<x-admin-layout>
    {{--    <!-- season-events -->--}}
    <div class="container">
        @include('partial.season-events', ['seasonEvents' => $seasonEvents])
        <form action="{{route('admin.seasonEventsStore')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label for="title0">title</label>
                    <input type="text" name="title0" id="title0" value="{{ old('title0') }}">
                    <br>
                    <label for="slug0">slug</label>
                    <input type="text" name="slug0" id="slug0" value="{{ old('slug0') }}">
                    <br>
                    <label for="year0">year</label>
                    <input type="number" name="year0" id="year0" value="{{ old('year0') }}">
                    <br>
                    <label for="img0">img</label>
                    <input type="file" name="img0" id="img0" value="{{ old('img0') }}">
                    <br>
                    <select name="genres0[]" id="countries0" multiple>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="title1">title</label>
                    <input type="text" name="title1" id="title1" value="{{ old('title1') }}">
                    <br>
                    <label for="slug1">slug</label>
                    <input type="text" name="slug1" id="slug1" value="{{ old('slug1') }}">
                    <br>
                    <label for="year1">year</label>
                    <input type="number" name="year1" id="year1" value="{{ old('year1') }}">
                    <br>
                    <label for="img1">img</label>
                    <input type="file" name="img1" id="img1" value="{{ old('img1') }}">
                    <br>
                    <select name="genres1[]" id="countries1" multiple>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <button type="submit">SEND</button>
        </form>

    </div>


</x-admin-layout>
