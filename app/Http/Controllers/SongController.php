<?php

namespace App\Http\Controllers;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Helpers\mp3file;
use Illuminate\Support\Facades\Log;

class SongController extends Controller
{
    //

    function showUploadPage(){
        return view('admin.file_upload');

    }

    function upload(Request $request) {
        $path = 'storage/media/songs/';
        $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
        $song_url = $path.$newname;

        $upload = $request->_file->move(public_path($path), $newname);
        Log::info($upload);
        if ($upload) {
            echo 'File has been successfully uploaded';

            $mp3file = new mp3file($upload);
            $song_duration = $mp3file->getDuration()*1000;
            
            $data = $request->input();
            $song = Song::create([
            'title' => $data['title'],
            'song_url' => $song_url,
            'duration' => $song_duration,
            'album' => $data['album'],

        ]);
        } else {
            echo 'Something went wrong';
        }
    }

}
