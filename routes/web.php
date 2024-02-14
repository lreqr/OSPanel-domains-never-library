<?php

use App\Http\Controllers\ReleasesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAnimeController;
use App\Http\Controllers\Admin;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ReleasesController::class, 'index'])->name('release.index');

Route::prefix('release')->group(function () {
    Route::get('/events/{event}-{year}', [ReleasesController::class, 'seasonEvent'])->name('release.seasonEvents');
    Route::get('/{id}-{slug}', [ReleasesController::class, 'show'])->name('release.show');
    Route::get('/{genre}', [ReleasesController::class, 'filterByGenre'])->name('release.filterByGenre');
});

//User
Route::prefix('user')->group(function () {
    //Show Create Page
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    //Store User
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    //Show Login Page
    Route::get('/login', [UserController::class, 'login'])->name('user.login');
    //Authenticate User
    Route::post('/authenticate', [UserController::class, 'authenticate'])->name('user.authenticate');
    //Show Profile
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
    //Show Edit Profile Page
    Route::get('/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
    //Modify User Info
    Route::post('/edit', [UserController::class, 'modify'])->name('user.modify')->middleware('auth');
    //Fetch Upload Img User
    Route::post('/profile', [UserController::class, 'updateUserImg'])->name('user.updateUserImg')->middleware('auth');
    //User Anine Stats
    Route::get('/statistic', [UserController::class, 'statistic'])->name('user.statistic')->middleware('auth');
    //Logout User
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
    //Update Anime Status
    Route::post('/{animeId}/{animeSlug}', [UserController::class, 'updateAnimeStatus'])->middleware('auth');
    //Add Comment To Anime
    Route::post('/comment/{animeId}/{animeSlug}', [UserController::class, 'comment'])->middleware('auth');

});

//API My Anime List
Route::prefix('anime-list')->group(function () {
    Route::get('/send-request', [ApiAnimeController::class, 'sendRequestToAPI'])->name('send-request');
    Route::get('/get-token', [ApiAnimeController::class, 'getToken'])->name('get-token');
    Route::post('/get-anime/{token}', [ApiAnimeController::class, 'getAnime'])->name('get-anime');
    Route::post('/get-anime/id/{token}', [ApiAnimeController::class, 'getAnimeById'])->name('get-animeById');
    Route::post('/fill-anime', [ApiAnimeController::class, 'fillAnimeInDb'])->name('fill-anime');
});

//Admin
Route::prefix('admin')->group(function () {
    //Show Select Page Show All Releases
    Route::get('/index', [Admin::class, 'index'])->name('admin.index')->middleware('auth');
    //Show Single Release
    Route::get('/{id}-{slug}', [Admin::class, 'show'])->name('admin.show')->middleware('auth');
    //Edit Single Release
    Route::post('/edit/{id}', [Admin::class, 'edit'])->name('admin.edit')->middleware('auth');
    //Delete Single Release
    Route::post('/delete/{id}', [Admin::class, 'delete'])->name('admin.delete')->middleware('auth');
    //Update Single Release
    Route::post('/update/{id}', [Admin::class, 'update'])->name('admin.update')->middleware('auth');
    //Season Events Show
    Route::get('/seasonevents', [Admin::class, 'seasonEvents'])->name('admin.seasonEvents')->middleware('auth');
    //Season Events Add or Update
    Route::post('/seasonevents', [Admin::class, 'seasonEventsStore'])->name('admin.seasonEventsStore')->middleware('auth');
});


