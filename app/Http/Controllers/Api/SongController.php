<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function songIsListened(Request $request) {
        $user = auth()->user();
        $song = Song::find($request->input('serverId'));
        if ($song) {
            $song->listenHistories()->attach($user);
        }
        return [
            'message' => 'Song is listened!!'
        ];
    }

    public function songIsSkipped(Request $request) {
        $user = auth()->user();
        $song = Song::find($request->input('serverId'));
        if ($song) {
            $song->usersSkipped()->attach($user);
        }
        return [
            'message' => 'Song is skipped!!'
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

    public function getHotMusic(Request $request) {
        if ($request->has('t')) {
            switch ($request->input('t')) {
                case 'd':
                    $days = 1;
                    break;
                case 'w':
                    $days = 7;
                    break;
                case 'm':
                    $days = 30;
                    break;
                case 'y': 
                    $days = 365;
                    break;
            }
            $songs = DB::table('listen_histories')
                    ->select('song_id', DB::raw('count(*) as listen_count'))
                    ->whereDate('created_at', '>', Carbon::now()->subDays($days))
                    ->groupBy('song_id')
                    ->orderBy('listen_count', 'desc')
                    ->limit(10)
                    ->get();
            return response()->json($songs);
        } else {
            $songs = DB::table('listen_histories')
                    ->select('song_id', DB::raw('count(*) as listen_count'))
                    ->groupBy('song_id')
                    ->orderBy('listen_count', 'desc')
                    ->limit(10)
                    ->get();
        }
    }

    public function getRecommendSongs() {
        $user = auth()->user();
        $userId = $user->user_id;
        $collection = collect();
        $arrays = $this->getTopGenreAndLanguage($userId);


        // Tier 1
        $songTier1 = Song::where('genre_id', '=', $arrays[0]->genre_id)
                        ->where('language_id', '=', $arrays[0]->language_id)
                        ->get();
        $songTier1 = $songTier1->sortByDesc('total_listen')->slice(0, 4);
        $collection->push($songTier1);

    
        // Tier 2
        $songTier2 = Song::where('genre_id', '=', $arrays[1]->genre_id)
                        ->where('language_id', '=', $arrays[1]->language_id)
                        ->get();
        $songTier2 = $songTier2->sortByDesc('total_listen')->slice(0, 3);
        $collection->push($songTier2);


        // Tier 3
        $songTier3 = Song::where('genre_id', '=', $arrays[2]->genre_id)
                        ->where('language_id', '=', $arrays[2]->language_id)
                        ->get();
        $songTier3 = $songTier3->sortByDesc('total_listen')->slice(0, 2);
        $collection->push($songTier3);

        // Tier 4
        $songTier4 = Song::where('genre_id', '=', $arrays[3]->genre_id)
                        ->where('language_id', '=', $arrays[3]->language_id)
                        ->get();
        $songTier4 = $songTier4->sortByDesc('total_listen')->slice(0, 2);
        $collection->push($songTier4);

        $collection = $collection->collapse();
        return response()->json($collection);
    }

    public function getTopGenreAndLanguage($userId) {
        $query = DB::table('recommend_point')
                ->where('user_id', '=', $userId)
                ->orderBy('point', 'desc')
                ->limit(4)
                ->get(['genre_id', 'language_id', 'point']);

        return $query->toArray();
    }
}
