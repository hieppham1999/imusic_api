<?php

use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
})->middleware(['guest']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['admin'])->name('dashboard');

Route::get('/songs', [SongController::class, 'index'])
    ->middleware(['admin'])->name('songs.index');

Route::get('/users', [UserController::class, 'index'])
    ->middleware(['admin'])->name('users.index');

Route::get('/upload', function () {
    return view('file_upload');
})->middleware(['admin'])->name('upload.page');

Route::post('/upload', [SongController::class, 'upload'])
    ->middleware(['admin'])->name('song.upload');

require __DIR__.'/auth.php';
