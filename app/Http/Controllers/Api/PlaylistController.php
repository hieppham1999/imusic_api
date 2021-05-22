<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
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

    public function addSongToPlaylist($playlistId, Request $request) {
        $user = auth()->user();
        $userId = $user->user_id;
        $songId = $request->input('serverId');

        $song = Song::find($songId);
        $playlist = Playlist::find($playlistId);

        if($playlist->user_id === $userId) {

            $playlist->songs()->sync([$song->song_id], false);
            $playlist->touch();
            return [
                'message' => 'Song "'.$song->title.'" was added successfully!!'
            ];  
        } else {
            return [
                'message' => 'Add song failed!!'
            ];  
        }
    }

    public function removeSongFromPlaylist($playlistId, Request $request) {
        $user = auth()->user();
        $userId = $user->user_id;
        $songId = $request->input('serverId');

        $playlist = Playlist::find($playlistId);

        $doesPlaylistContainSong = DB::table('playlists_songs')->where('playlist_id', $playlistId)
                                    ->where('song_id', $songId)->exists();

        if($playlist->user_id === $userId) {
            if ($doesPlaylistContainSong) {
                $playlist->songs()->detach($songId);
                $playlist->touch();
                return ['message' => 'Song was remove successfully!!'];  
            }
            return ['message' => 'There is no song in playlist!!'];  
        }
        return ['message' => 'You dont own that playlist!!'];  
    }

    public function index() {
        $user = auth()->user();
        $userId = $user->user_id;

        $playlists = Playlist::where('user_id', '=', $userId)->orderByDesc('updated_at')->get();

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

    public function destroy($playlistId) {
        $user = auth()->user();
        $userId = $user->user_id;

        $playlist = Playlist::find($playlistId);

        if($playlist->user_id === $userId) {
            $playlist->songs()->detach();
            $playlist->forceDelete();
            return [
                'message' => 'Playlist was deleted successfully!!'
            ];  
        }
        return [
            'message' => 'There were some errors!!'
        ];  
    }

    
}