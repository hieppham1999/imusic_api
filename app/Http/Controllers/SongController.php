<?php

namespace App\Http\Controllers;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Helpers\mp3file;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Composer;
use App\Models\Genre;
use App\Models\Language;
use Illuminate\Support\Facades\File;

use JamesHeinrich\GetID3\GetID3;
use App\Exceptions\Handler;
use Exception;

class SongController extends Controller
{
    //

    function index(){
        $songs = Song::paginate(10)->withPath('/songs');
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

        // Validate input
        $validated = $request->validate([
            'title' => 'required | max:255',
            'artist_name' => 'required | max:255',
            'album' => 'required | max:255',
            'composer' => 'max:255',
            'year' => 'required | numeric | digits:4',
            'language' => 'required',
            'genre' => 'required',
            '_file' => 'required | file'
        ]);

        // Change file name before store
        $path = 'storage/media/songs/';
        $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
        $song_url = $path.$newname;
        $upload = $request->_file->move(public_path($path), $newname);
        if ($upload) {

            $mp3file = new mp3file($upload);
            $song_duration = $mp3file->getDuration()*1000;

            // Extract album cover from mp3 file
            $image_name = $this->storeImageFromMp3File($song_url, $newname);
                    // TODO - what if cant extract


            $data = $request->input();
            $song = Song::create([
            'title' => $data['title'],
            'song_url' => $song_url,
            'duration' => $song_duration,
            'artist' => $data['artist_name'],
            'composer' => $data['composer'] ? $data['composer'] : "Unknown",
            'year' => $data['year'],
            'art_uri' => $image_name,
            'language_id' => $data['language'],
            'genre_id' => $data['genre']
            ]);

            // store artist info
            $artist_inputs = explode(";", $data['artist_name']);
            foreach ($artist_inputs as $artist_name) {
                $artist_name = trim($artist_name);
                $artist = Artist::firstOrCreate([
                    'artist_name' => $artist_name,
                ]);
                $song->artists()->attach($artist);
            }

            // store composer info
            if (!empty($data['composer'])){
                $composer_inputs = explode(";", $data['composer']);
                foreach ($composer_inputs as $composer_name) {
                    $composer_name = trim($composer_name);
                    $composer = Composer::firstOrCreate([
                        'composer_name' => $composer_name,
                    ]);
                    $song->composers()->attach($composer);
                }

            }

            // store album info
            $album = Album::firstOrCreate([
                'album_name' => $data['album']
            ]);
            $song->album()->associate($album);
            $song->save();
                

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


        // Composer
        if ($song->composer != $request->composer) {
            $song->composers()->detach();
            if (empty($request->composer)) {
                $song->composer = "Unknown";
            } else {
                $song->composer = $request->composer;
                $composer_inputs = explode(";", $request->composer);
    
                foreach ($composer_inputs as $composer_name) {
                    $composer_name = trim($composer_name);
                    $composer = Composer::firstOrCreate([
                        'composer_name' => $composer_name,
                    ]);
                    $song->composers()->attach($composer);
                }
            }
        }
        
        $song->save(); 
        return redirect()->route('songs.edit', [$song_id])->with('success', "Updated successfully!!!");
    }

    function destroy($song_id){
        $song = Song::find($song_id);
        $song_title = $song->title;
        $song_artist = $song->artist;
        $song_url = $song->song_url;
        $songArtUrl = $song->art_uri;
        $song->artists()->detach();
        $song->forceDelete();
        try {
            File::delete(public_path($song_url));
            File::delete(public_path($songArtUrl));
        } catch (Exception $e) {
            report($e);
        }
        
        return redirect()->route('songs.index')->with('success', "Song '$song_title - $song_artist' has been deleted successfully!!!");
    }

    function storeImageFromMp3File($file, $fileName) {
        $getID3 = new GetID3;
        $image_name = basename($fileName, '.mp3').'.jpg';
        $OldThisFileInfo = $getID3->analyze($file);
        if(isset($OldThisFileInfo['comments']['picture'][0])) {

            $image= $OldThisFileInfo['comments']['picture'][0]['data'];

            if ($handle = fopen('storage/media/album_arts/'.$image_name, 'a')) {
                fwrite($handle, $image);
                return 'storage/media/album_arts/'.$image_name;
            } 
            return null;
            

        // TODO - return something when cant extract
        }
        return null;
    }
}
