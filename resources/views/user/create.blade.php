<x-layout>
    <div class="register-page container d-flex justify-content-center text-center align-items-center">
        <div class="container register-page-wrapper" style="background: var(--bg-white); color: var(--black)">
            <div class="heading text-center">
                <h1>Sign up</h1>
            </div>
            <form action="{{route('user.store')}}" method="POST">
                @csrf
                <div class="input-groups">
                    <div class="d-flex" style="width: 25%">
                        <label for="email">Email address</label>
                    </div>
                    <input class="mt-2 px-2 py-2" type="text" name="email" id="email" placeholder="name@domain.com">
                    @error('email')
                    <div class="username-error-message  d-flex justify-content-center align-items-center mt-1">
                        <i class="fa-solid fa-circle-exclamation" style="color: #d31225;"></i>
                        <p class="px-1" style="color: #d31225;">{{$message}}</p>
                    </div>
                    @enderror
                </div>
                <div class="input-groups">
                    <div class="d-flex" style="width: 25%">
                        <label for="name">Nickname</label>
                    </div>
                    <input class="mt-2 px-2 py-2" type="text" name="name" id="name" placeholder="Example">
                    @error('name')
                    <div class="username-error-message  d-flex justify-content-center align-items-center mt-1">
                        <i class="fa-solid fa-circle-exclamation" style="color: #d31225;"></i>
                        <p class="px-1" style="color: #d31225;">{{$message}}</p>
                    </div>
                    @enderror
                </div>
                <div class="input-groups">
                    <div class="d-flex" style="width: 25%">
                        <label for="password">Password</label>
                    </div>
                    <input class="mt-2 px-2 py-2" type="password" name="password" id="password" placeholder="Password">
                    @error('password')
                    <div class="username-error-message  d-flex justify-content-center align-items-center mt-1">
                        <i class="fa-solid fa-circle-exclamation" style="color: #d31225;"></i>
                        <p class="px-1" style="color: #d31225;">{{$message}}</p>
                    </div>
                    @enderror
                    <input class="mt-2 px-2 py-2" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
                    @error('password_confirmation')
                    <div class="username-error-message  d-flex justify-content-center align-items-center mt-1">
                        <i class="fa-solid fa-circle-exclamation" style="color: #d31225;"></i>
                        <p class="px-1" style="color: #d31225;">{{$message}}</p>
                    </div>
                    @enderror
                    <button class="mt-3" type="submit">Next</button>
                </div>
                <div class="input-groups">
                </div>
                <div class="d-flex justify-content-center text-center">
                    <hr class=" " style="width: 25%">
                </div>
                <p class="mt-3">Already have an account? <a href="">Log in here.</a></p>
            </form>

        </div>
    </div>
</x-layout>
