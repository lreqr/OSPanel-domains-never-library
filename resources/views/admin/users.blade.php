<x-admin-layout>
    @foreach($users as $user)
        <x-user-wrapper :user="$user"/>
    @endforeach
</x-admin-layout>
