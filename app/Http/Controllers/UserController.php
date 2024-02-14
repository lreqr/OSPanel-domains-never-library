<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ReleaseComment;
use App\Models\ReleaseUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function create(): View
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
        $formFields['is_admin'] = 0;
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

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('release.index'));
    }

    public function profile(): View
    {
        $user = \auth()->user();
                                     //
        $releases = $user->releases()
            //Сортировка в таблице release_users по desc
            ->orderBy('release_users.created_at', 'desc')
            ->get();
        return \view('user.profile', [
            'user' => $user,
            'releases' => $releases,
        ]);
    }

    public function edit(): View
    {
        $user = \auth()->user();

        return \view('user.edit', [
            'user' => $user,
        ]);
    }

    public function modify(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'email' => ['email', Rule::unique('users', 'email')],
            'name' => ['min:4', Rule::unique('users', 'name')],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => ['confirmed', 'min:6'],
        ]);

        $user = \auth()->user();
        dd($formFields);
        User::find($user->id)->update($formFields);


    }

    public function statistic(Request $request): View
    {
        $user = auth()->user();
        $type = $request->input('type');

        if (!$type) {
            $releases = $user->releases()->paginate(9);
        } else {
            $releases = $user->releases()->wherePivot('type', $type)->paginate(9);
        }

        return view('user.statistic', [
            'user' => $user,
            'releases' => $releases,
        ]);
    }


    public function updateUserImg(Request $request)
    {
        $user = \auth()->user();

        // Включаем валидацию изображения
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('image');
        if ($file) {
            $path = storage_path("app/public/user_logo/{$user->id}");

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Убеждаемся, что $user->logo не пустое
            if (!empty($user->logo) && file_exists(storage_path("app/public/{$user->logo}"))) {
                unlink(storage_path("app/public/{$user->logo}"));
            }

            $formFields['logo'] = $file->store("user_logo/{$user->id}", 'public');
            $formFields['id'] = $user->id;

            User::find($user->id)->update($formFields);
        }

        return redirect(route('user.profile'));
    }


    public function updateAnimeStatus($animeId, $animeSlug, Request $request)
    {
        $user = \auth()->user();
        $response = $request->get('type');
        $rating = $request->get('rating') * 2;
        if (!$rating){
            $formFields = [
                'release_id' => $animeId,
                'user_id' => $user->id,
                'type' => $response,
            ];
        } elseif (!$response){
            $formFields = [
                'release_id' => $animeId,
                'user_id' => $user->id,
                'rating' => $rating,
            ];
        }


        $existingRecord = ReleaseUser::where('release_id', $formFields['release_id'])->where('user_id', $formFields['user_id'])->first();
        if ($existingRecord){
            //Обновляем именно эту строку existingRecord
            $existingRecord->update($formFields);
        } else {
            ReleaseUser::create($formFields);
        }

        return \response()->json(['type' => $response, 'rating' => ($rating / 2)], 200);
    }

    public function comment($animeId, $animeSlug, Request $request)
    {
        $user = auth()->user();

        $releaseComment['release_id'] = $animeId;
        $releaseComment['user_id'] = $user['id'];
        $releaseComment['comment'] = $request['comment'];
        $releaseComment['rating'] = 0;
        ReleaseComment::create($releaseComment);
        return response()->json(['comment' => $releaseComment]);
    }
}
