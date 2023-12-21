<x-layout>
    @include('partial.filter-row', ['paddingTop' => 'pt-3'])
    <div id="content" class="container">
        <div class="content-row">
            @if($releases->all())
                <!-- anime-row -->
                <div class="row">
                    @foreach($releases as $release)
                        <x-poster-wrapper :release="$release" />
                    @endforeach
                </div>
                <!-- pagination -->
                <div class="container col-lg-12 d-flex justify-content-center pb-3">
                    <nav aria-label="Page navigation">
                        {{$releases->links()}}
                    </nav>
                </div>
            @else
                <div id="content" class="container">
                    <div class="content-row">
                        <h1 class="text-center my-0 pb-5 pt-3   ">Empty response</h1>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-layout>
