<x-admin-layout>
    @if(isset($releases))
        <!-- filter-row -->
        @include('partial.filter-row', ['paddingTop' => 'pt-4'])
        <!-- anime-row -->
        <div id="content" class="container">
            <div class="content-row">
                <!-- anime-row -->
                <div class="row">
                    @if($releases->all())
                        @foreach($releases as $release)
                            <x-admin-poster-wrapper :release="$release"/>
                        @endforeach
                    @else
                        <x-admin-poster-wrapper :release="null"/>
                    @endif


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
</x-admin-layout>
