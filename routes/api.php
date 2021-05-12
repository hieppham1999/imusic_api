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

    Route::prefix('me')->group(function () {

        Route::put('/listen', [Api\SongController::class, 'listenByUser']);

        Route::put('/skip', [Api\SongController::class, 'songIsSkipped']);

        Route::get('/listen-histories', [Api\UserController::class, 'getUserListenHistories']);

        Route::put('/plus-rcm-point', [Api\UserController::class, 'increaseRecommendPoint']);

        Route::put('/sub-rcm-point', [Api\UserController::class, 'decreaseRecommendPoint']);

        Route::get('/recommend', [Api\SongController::class, 'getRecommendSongs']);
    });

    Route::post('/playlists/create', [Api\PlaylistController::class, 'store']);

    Route::post('/playlists/add', [Api\PlaylistController::class, 'addSongToPlaylist']);

    Route::get('/playlists/index', [Api\PlaylistController::class, 'index']);

    Route::get('/playlists/{playlistId}', [Api\PlaylistController::class, 'getSongsfromPlaylist']);
    
});

Route::put('/guest/listen', [Api\SongController::class, 'listenByGuest']);

Route::prefix('songs')->group(function () {

    Route::get('/recently', [Api\SongController::class, 'getRecentlyUploadedSongs'])
    ->name('api.songs.recently_upload');

    Route::get('/genre/{genre_id}', [Api\SongController::class, 'getSongsByGenre'])
    ->name('api.songs.by_genre');

    Route::get('/language/{language_id}', [Api\SongController::class, 'getSongsByLanguage'])
    ->name('api.songs.by_language');

    Route::get('/hot', [Api\SongController::class, 'getHotMusic'])
    ->name('api.songs.hot');

    Route::get('/search', [Api\SongController::class, 'searchByTitle'])
    ->name('api.songs.search');
});