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



Route::prefix('songs')->group(function () {
    Route::get('/', [SongController::class, 'index'])
        ->middleware(['admin'])->name('songs.index');

    Route::get('/{song_id}/edit', [SongController::class, 'edit'])
        ->middleware(['admin'])->name('songs.edit');
    Route::post('/{song_id}', [SongController::class, 'update'])
        ->middleware(['admin'])->name('songs.update');
});

Route::get('/users', [UserController::class, 'index'])
    ->middleware(['admin'])->name('users.index');

Route::get('/upload', function () {
    return view('file_upload');
})->middleware(['admin'])->name('songs.create');

Route::post('/upload', [SongController::class, 'store'])
    ->middleware(['admin'])->name('songs.store');

require __DIR__.'/auth.php';
