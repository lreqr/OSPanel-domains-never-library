<x-admin-layout>
    @if($releases->all())
        @foreach($releases as $release)
            <x-admin-poster-wrapper :release="$release"/>
        @endforeach
    @else
        <x-admin-poster-wrapper :release="null"/>
    @endif
</x-admin-layout>
