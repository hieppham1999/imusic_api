<?php

namespace App\Http\Controllers;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Helpers\mp3file;
use App\Models\Artist;
use App\Models\Album;
use Illuminate\Support\Facades\Log;

class SongController extends Controller
{
    //

    function index(){
        $songs = Song::all();
        return view('song_index', ['songs' => $songs]);
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
            Log::info($data);
            $song = Song::create([
            'title' => $data['title'],
            'song_url' => $song_url,
            'duration' => $song_duration,
            'artist' => $data['artist_name'],
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
        return view('song_edit', ['song' => $song]);
    }

    function update(Request $request, $song_id){
        Log::info($song_id);
        $data = $request->input();
        $song = Song::find($song_id);
        Log::info($song->title);
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
        $song->save(); 
        
        
        return redirect()->route('songs.edit', [$song_id])->with('success', "Updated successfully!!!");
    }
}
