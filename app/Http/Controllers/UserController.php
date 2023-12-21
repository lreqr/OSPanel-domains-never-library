<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request): RedirectResponse
    {


        $formFields = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'name' => ['required', 'min:4', Rule::unique('users', 'name')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create user
        $user = User::create($formFields);

        auth()->login($user);

        return redirect(route('release.index'));
    }

    public function login(): View
    {
        return view('user.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
           'email' => ['required'],
           'password' => ['required'],
        ]);

        $remember = $request->has('remember_token');
        
        if (auth()->attempt($formFields, $remember)){
            $request->session()->regenerate();
            return redirect(route('release.index'));
        }

        return back()->withErrors(['email' => 'Неверный email или пароль'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('release.index'));
    }

    public function profile(): View
    {
        $user = Auth::user();
        return \view('user.profile', [
            'user' => $user,
        ]);
    }
}
