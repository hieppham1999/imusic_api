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
})->middleware(['auth'])->name('dashboard');



Route::prefix('songs')->group(function () {
    Route::get('/', [SongController::class, 'index'])
        ->middleware(['auth'])->name('songs.index');

    // Song Upload
    Route::get('/upload', [SongController::class, 'create'])
    ->middleware(['auth'])->name('songs.create');

    // Song Edit
    Route::get('/{song_id}/edit', [SongController::class, 'edit'])
        ->middleware(['auth'])->name('songs.edit');

    // Song Update
    Route::put('/{song_id}', [SongController::class, 'update'])
        ->middleware(['auth'])->name('songs.update');

    // Song Delete
    Route::delete('/{song_id}', [SongController::class, 'destroy'])
        ->middleware(['auth'])->name('songs.destroy');

});


Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])
        ->middleware(['auth'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])
        ->middleware(['auth'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])
        ->middleware(['auth'])->name('users.store');
});

Route::post('/upload', [SongController::class, 'store'])
    ->middleware(['auth'])->name('songs.store');

require __DIR__.'/auth.php';
