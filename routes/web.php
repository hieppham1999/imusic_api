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
    // Song Edit
    Route::get('/{song_id}/edit', [SongController::class, 'edit'])
        ->middleware(['admin'])->name('songs.edit');

    // Song Update
    Route::put('/{song_id}', [SongController::class, 'update'])
        ->middleware(['admin'])->name('songs.update');

    // Song Delete
    Route::delete('/{song_id}', [SongController::class, 'destroy'])
        ->middleware(['admin'])->name('songs.destroy');
});

Route::get('/users', [UserController::class, 'index'])
    ->middleware(['admin'])->name('users.index');

Route::get('/upload', [SongController::class, 'create'])
    ->middleware(['admin'])->name('songs.create');

Route::post('/upload', [SongController::class, 'store'])
    ->middleware(['admin'])->name('songs.store');

require __DIR__.'/auth.php';
