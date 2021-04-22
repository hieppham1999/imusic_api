<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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


Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
    
    $user = $request->user();
    $user->tokens()->delete();
    return 'Token are deleted';

});


Route::post('/auth/register', [Api\AuthController::class, 'register']);

Route::post('/auth/login', [Api\AuthController::class, 'login']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function(Request $request) {
        return auth()->user();
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});



Route::prefix('songs')->group(function () {

    Route::get('/recently', [Api\SongController::class, 'getRecentlyUploadedSongs'])
    ->name('api.songs.recently_upload');

    Route::get('/genre/{genre_id}', [Api\SongController::class, 'getSongsByGenre'])
    ->name('api.songs.by_genre');
});