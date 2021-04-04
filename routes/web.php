<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\SongController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('check', [UserAuthController::class, 'check'])->name('auth.check');
//Route::view('login', 'login');
Route::get('/login', function () {
    if (session()->has('user'))
    {
        return redirect('profile');
    }
    return view('login');
});

Route::get('profile', [UserAuthController::class, 'profile']);

Route::get('file_upload', [SongController::class, 'showUploadPage']);
Route::post('upload', [SongController::class, 'upload'])->name('song.upload');

Route::get('/logout', function () {
    if (session()->has('user'))
    {
        session()->pull('user');
    }
    return redirect('login');
});