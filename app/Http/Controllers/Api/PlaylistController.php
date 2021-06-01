<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function getPlaylistInfo(Request $request, $playlistId) {
        $user = auth()->user();
        $userId = $user->user_id;
        $playlist = Playlist::find($playlistId);
        if($playlist->user_id === $userId) {
            return response()->json($playlist);
        }
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
        $song = Song::find($songId);

        if(!$song) return ['message' => 'Song does not exist!!'];

        $playlist = Playlist::find($playlistId);

        if(!$playlist) return ['message' => 'Playlist does not exist!!'];

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
            $songs = $playlist->songs->reverse()->values();
            // $songs = $songs->collapse();
        }

        return response()->json($songs->makeHidden(['pivot']));
    }

    public function update($playlistId, Request $request) {
        $user = auth()->user();
        $userId = $user->user_id;
        $validate = $request->validate([
            'playlistName' => 'required | max:255',
        ]);
        $playlistName = $request->input('playlistName');

        $playlist = Playlist::findOrFail($playlistId);
        if($playlist->user_id === $userId) {

            $playlist->playlist_name = $playlistName;

            $playlist->save();
            return [
                'message' => 'Playlist was updated successfully!!'
            ];  
        } else {
            return [
                'message' => 'Updated failed!!'
            ];  
        }
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