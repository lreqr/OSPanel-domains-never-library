<x-layout>
    @error('image')
    <h1>{{$message}}</h1>
    @enderror
    <div class="container profile-page register-page">
        <div class="row">
            <div class="container">
                <div class="profile-user-wrapper h-auto">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="text-center mt-4" action="{{route('user.modify')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-groups">
                                    <div class="d-flex" style="width: 25%">
                                        <label for="email">Email address</label>
                                    </div>
                                    <input class="mt-2 px-2 py-2" type="text" name="email" id="email"
                                           placeholder="name@domain.com">
                                    @error('email')
                                    <div
                                        class="username-error-message  d-flex justify-content-center align-items-center mt-1">
                                        <i class="fa-solid fa-circle-exclamation" style="color: #d31225;"></i>
                                        <p class="px-1" style="color: #d31225;">{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="input-groups">
                                    <div class="d-flex" style="width: 25%">
                                        <label for="name">Nickname</label>
                                    </div>
                                    <input class="mt-2 px-2 py-2" type="text" name="name" id="name"
                                           placeholder="Example">
                                    @error('name')
                                    <div
                                        class="username-error-message  d-flex justify-content-center align-items-center mt-1">
                                        <i class="fa-solid fa-circle-exclamation" style="color: #d31225;"></i>
                                        <p class="px-1" style="color: #d31225;">{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="input-groups">
                                    <div class="d-flex" style="width: 25%">
                                        <label for="password">Password</label>
                                    </div>
                                    <input class="mt-2 px-2 py-2" type="password" name="password" id="password"
                                           placeholder="Password">
                                    @error('password')
                                    <div
                                        class="username-error-message  d-flex justify-content-center align-items-center mt-1">
                                        <i class="fa-solid fa-circle-exclamation" style="color: #d31225;"></i>
                                        <p class="px-1" style="color: #d31225;">{{$message}}</p>
                                    </div>
                                    @enderror
                                    <input class="mt-2 px-2 py-2" type="password" name="password_confirmation"
                                           id="password_confirmation" placeholder="Confirm password">
                                    @error('password_confirmation')
                                    <div
                                        class="username-error-message  d-flex justify-content-center align-items-center mt-1">
                                        <i class="fa-solid fa-circle-exclamation" style="color: #d31225;"></i>
                                        <p class="px-1" style="color: #d31225;">{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="input-groups">
                                    <div class="input-image w-25">
                                        <label for="name">Image</label>
                                        <input class="mt-2 px-2 py-2 w-auto" type="file" name="image" id="image">
                                        @error('image')
                                        <div
                                            class="username-error-message  d-flex justify-content-center align-items-center mt-1">
                                            <i class="fa-solid fa-circle-exclamation" style="color: #d31225;"></i>
                                            <p class="px-1" style="color: #d31225;">{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <button class="mt-3" type="submit">Next</button>
                                </div>
                                <div class="d-flex justify-content-center text-center">
                                    <hr style="width: 25%">
                                </div>
                                <p class="mt-3">Don`t want to edit account? <a href="{{ route('user.profile') }}">Profile</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
