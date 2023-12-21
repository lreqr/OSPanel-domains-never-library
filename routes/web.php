<?php

use App\Http\Controllers\ReleasesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAnimeController;


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

Route::prefix('release')->group(function (){
    Route::get('/events/{event}-{year}', [ReleasesController::class, 'seasonEvent'])->name('release.seasonEvents');
    Route::get('/{id}-{slug}', [ReleasesController::class, 'show'])->name('release.show');
    Route::get('/{genre}', [ReleasesController::class, 'filterByGenre'])->name('release.filterByGenre');
});

//User
Route::prefix('user')->group(function (){
   Route::get('/create', [UserController::class, 'create'])->name('user.create');
   Route::post('/store', [UserController::class, 'store'])->name('user.store');
   Route::get('/login', [UserController::class, 'login'])->name('user.login');
   Route::post('/authenticate', [UserController::class, 'authenticate'])->name('user.authenticate');
   Route::get('/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
   Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});

//API My Anime List
Route::prefix('anime-list')->group(function (){
    Route::get('/send-request', [ApiAnimeController::class, 'sendRequestToAPI'])->name('send-request');
    Route::get('/get-token', [ApiAnimeController::class, 'getToken'])->name('get-token');
    Route::post('/get-anime/{token}', [ApiAnimeController::class, 'getAnime'])->name('get-anime');
    Route::post('/get-anime/id/{token}', [ApiAnimeController::class, 'getAnimeById'])->name('get-animeById');
    Route::post('/fill-anime', [ApiAnimeController::class, 'fillAnimeInDb'])->name('fill-anime');
});

