<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/auth/register', [Api\AuthController::class, 'register']);

Route::post('/auth/login', [Api\AuthController::class, 'login']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function(Request $request) {
        return auth()->user();
    })->name('api.user_info');

    Route::get('/auth/logout', [Api\AuthController::class, 'logout']);

    Route::get('/songs/listen/{song_id}', [Api\SongController::class, 'songIsListened']);
});



Route::prefix('songs')->group(function () {

    Route::get('/recently', [Api\SongController::class, 'getRecentlyUploadedSongs'])
    ->name('api.songs.recently_upload');

    Route::get('/genre/{genre_id}', [Api\SongController::class, 'getSongsByGenre'])
    ->name('api.songs.by_genre');

    Route::get('/language/{language_id}', [Api\SongController::class, 'getSongsByLanguage'])
    ->name('api.songs.by_language');
});