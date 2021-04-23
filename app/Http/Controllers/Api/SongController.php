<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Song::all());


    }

    public function getSongsByGenre($genre_id, Request $request){
        $songs = Song::where('genre_id', $genre_id)
                        ->orderBy('title');
        if ($request->has('lim')) {
            $songs->limit($request->input('lim'));
        }
        return response()->json($songs->get());
    }

    public function getRecentlyUploadedSongs(Request $request){
        $songs = Song::latest();
        if ($request->has('lim')) {
            $songs->limit($request->input('lim'));
        }
        return response()->json($songs->get());
    }

    public function songIsListened($song_id) {
        $user = auth()->user();
        $song = Song::find($song_id);
        if ($song) {
            $song->listenHistories()->attach($user);
        }
        return [
            'message' => 'Song listened!!'
        ];
    }

    public function getSongsByLanguage($language_id, Request $request){
        $songs = Song::where('language_id', $language_id)
                        ->orderByDesc('year');
        if ($request->has('lim')) {
            $songs->limit($request->input('lim'));
        }
        return response()->json($songs->get());
    }

}
