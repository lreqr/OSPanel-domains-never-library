<x-layout>
    <div class="register-page container d-flex justify-content-center text-center align-items-center">
        <div class="container register-page-wrapper" style="background: var(--bg-white); color: var(--black)">
            <form action="{{route('user.authenticate')}}" method="post">
                @csrf
                <div class="heading text-center">
                    <h1>Sign in</h1>
                </div>
                <div class="input-groups">
                    <div class="d-flex" style="width: 25%">
                        <label for="email">Email address</label>
                    </div>
                    <input class="mt-2 px-2 py-2" type="text" name="email" id="email" placeholder="name@domain.com">
                    @error('email')
                    <div class="username-error-message d-flex align-items-center mt-1">
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
                    <div class="d-flex mt-2" style="width: 25%">
                        <label for="remember_token">Запомнить меня</label>
                        <input type="checkbox" name="remember_token" id="remember_token" class="mx-2" style="width: 15px">
                    </div>
                    <button class="mt-3" type="submit">Next</button>
                </div>
                <div class="d-flex justify-content-center text-center">
                    <hr class=" " style="width: 25%">
                </div>
                <p class="mt-3">Don't you have an account? <a href="">Sign up here.</a></p>
            </form>
        </div>

    </div>
</x-layout>
