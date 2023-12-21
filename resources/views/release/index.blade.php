<x-layout>

    <!-- carousel -->
    @include('partial.carousel', ['carousel' => $carousel])
    <!-- season-events -->
    @include('partial.season-events', ['seasonEvents' => $seasonEvents])

    @if($releases)
        <!-- filter-row -->
        @include('partial.filter-row', ['paddingTop' => 'pt-4'])
        <!-- anime-row -->
        <div id="content" class="container">
            <div class="content-row">
                <!-- anime-row -->
                <div class="row">

                    @foreach($releases as $release)
                        <x-poster-wrapper :release="$release"/>
                    @endforeach

                </div>
                <!-- pagination -->
                <div class="container col-lg-12 d-flex justify-content-center pb-3">
                    <nav aria-label="Page navigation">
                        {{$releases->links()}}
                    </nav>
                </div>

            </div>
        </div>
    @else
        @include('partial.filter-row-empty', ['paddingTop' => 'pt-4'])
        <div id="content" class="container">
            <div class="content-row">
                <h1 class="text-center my-0 py-5">Empty response</h1>
            </div>
        </div>
    @endif

</x-layout>
