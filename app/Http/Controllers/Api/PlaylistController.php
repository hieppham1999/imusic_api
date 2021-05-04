<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller{
    public function store(Request $request) {
        $user = auth()->user();
        $userId = $user->user_id;
        $playlist = Playlist::create([
            'user_id' => $userId,
            'playlist_name' => $request->input('playlistName'),
        ]);

        return [
            'message' => 'Playlist created successfully!!'
        ];  
    }

    public function addSongToPlaylist(Request $request) {
        $user = auth()->user();
        $userId = $user->user_id;
        $songId = $request->input('serverId');
        $playlistId = $request->input('playlistId');

        $song = Song::find($songId);
        $playlist = Playlist::find($playlistId);

        if($playlist->user_id === $userId) {

            $playlist->songs()->sync([$song->song_id], false);
            return [
                'message' => 'Song "'.$song->title.'" was added successfully!!'
            ];  
        } else {
            return [
                'message' => 'Add song failed!!'
            ];  
        }
    }

    public function index() {
        $user = auth()->user();
        $userId = $user->user_id;

        $playlists = Playlist::where('user_id', '=', $userId)->get()->makeHidden(['created_at', 'updated_at']);

        return response()->json($playlists);
    }

    public function getSongsfromPlaylist($playlistId) {
        $user = auth()->user();
        $userId = $user->user_id;

        $playlist = Playlist::find($playlistId);

        if($playlist->user_id === $userId) {
            $songs = $playlist->songs;
        }

        return response()->json($songs->makeHidden(['pivot']));
    }
}