<?php

namespace App\Http\Controllers;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    //

    function showUploadPage(){
        return view('admin.file_upload');

    }

    function upload(Request $request) {
        $path = 'storage/media/songs/';
        $newname = $request->file('_file')->getClientOriginalName();

        $upload = $request->_file->move(public_path($path), $newname);
        if ($upload) {
            echo 'File has been successfully uploaded';
        } else {
            echo 'Something went wrong';
        }
    }

    function store(Request $request) {
        $request->validate([
            // TODO - write validate for song upload 
        ]
        );

        // $input = $request->all();
        // if ($request->hasFile('song'))
        // {
        //     $destination_path = ''
        // }
    }
}
