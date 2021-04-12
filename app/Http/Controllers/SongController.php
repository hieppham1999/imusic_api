<?php

namespace App\Http\Controllers;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Helpers\mp3file;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Language;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SongController extends Controller
{
    //

    function index(){
        $songs = Song::all();
        return view('song_index', [
            'songs' => $songs
            ]);
    }

    function create(){
        $languages = Language::all();
        $genres = Genre::all();
        return view('file_upload', [
            'languages' => $languages,
            'genres' => $genres
            ]);
    }

    function store(Request $request) {
        $path = 'storage/media/songs/';
        $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
        $song_url = $path.$newname;
        $upload = $request->_file->move(public_path($path), $newname);
        if ($upload) {

            $mp3file = new mp3file($upload);
            $song_duration = $mp3file->getDuration()*1000;
            
            $data = $request->input();
            $song = Song::create([
            'title' => $data['title'],
            'song_url' => $song_url,
            'duration' => $song_duration,
            'artist' => $data['artist_name'],
            'language_id' => $data['language'],
            'genre_id' => $data['genre']
            ]);

            // store artist info
            if ($request->has('artist_name')) {
                $artist_inputs = explode(";", $data['artist_name']);
                foreach ($artist_inputs as $artist_name) {
                    $artist_name = trim($artist_name);
                    $artist = Artist::firstOrCreate([
                        'artist_name' => $artist_name,
                    ]);
                    $song->artists()->attach($artist);
                }
            }

            // store album info
            if ($request->has('album')) {
                    $album = Album::firstOrCreate([
                        'album_name' => $data['album']
                    ]);
                    $song->album()->associate($album);
                    $song->save();
                
            }

            return redirect()->route('songs.create')->with('success', "Uploaded successfully!!!");


        } else {
            echo 'Something went wrong';
        }
    }
    function edit($song_id){
        $song = Song::findOrFail($song_id);
        $languages = Language::all();
        $genres = Genre::all();
        return view('song_edit', [
            'song' => $song,
            'languages' => $languages,
            'genres' => $genres,
            ]);
    }

    function update(Request $request, $song_id){
        $data = $request->input();
        $song = Song::find($song_id);

        $song->title = $data['title'];

        // Artist
        if ($song->artist != $request->artist_name) {
            $song->artists()->detach();
            $song->artist = $request->artist_name;
            $artist_inputs = explode(";", $request->artist_name);

            foreach ($artist_inputs as $artist_name) {
                $artist_name = trim($artist_name);
                $artist = Artist::firstOrCreate([
                    'artist_name' => $artist_name,
                ]);
                $song->artists()->attach($artist);
            }
        }
        

        // Album
        $album = Album::firstOrCreate([
            'album_name' => $request->album
        ]);
        $song->album()->associate($album);

        // Language
        $song->language_id = $request->language;

        $song->genre_id = $request->genre;
        $song->save(); 
        
        
        return redirect()->route('songs.edit', [$song_id])->with('success', "Updated successfully!!!");
    }

    function destroy(Request $request, $song_id){
        $song = Song::find($song_id);
        $song_title = $song->title;
        $song_artist = $song->artist;
        $song_url = $song->song_url;
        $song->artists()->detach();
        $song->forceDelete();
        File::delete(public_path($song_url));
        return redirect()->route('songs.index')->with('success', "Song '$song_title - $song_artist' has been deleted successfully!!!");
    }
}
