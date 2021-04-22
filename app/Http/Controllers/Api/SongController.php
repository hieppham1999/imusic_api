<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;


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

}
