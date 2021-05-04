<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {


    public function getUserListenHistories() {
        $user = auth()->user();
        $listenHistories = DB::table('listen_histories')
                            ->select('song_id', 'created_at')
                            ->where('user_id', '=', $user->user_id)
                            ->orderByDesc('created_at')->get();
        return response()->json($listenHistories);
    }


    public function changeRecommendPoint($userId, $songId, $pointChange) {
        $song = Song::find($songId);
        $genre_id = $song->genre_id;
        $language_id = $song->language_id;
        $user = User::find($userId);
        $rcm_point = $user->recommendPoints()
                    ->updateOrCreate([
                        'user_id' => $userId,
                        'genre_id' => $genre_id,
                        'language_id' => $language_id
                    ],[
                        'point' => DB::raw('GREATEST(point +'.$pointChange.', 0)') // Point can't go below 0
                    ]);          
    }
    
    public function increaseRecommendPoint(Request $request) {
        $user = auth()->user();
        $userId = $user->user_id;
        $SongId = $request->input('serverId');
        $point = 1;
        $this->changeRecommendPoint($userId, $SongId, $point);

        return [
            'message' => 'Recommend point has been plus '.$point.' point!!'
        ];  
    }

    public function decreaseRecommendPoint(Request $request) {
        $user = auth()->user();
        $userId = $user->user_id;
        $SongId = $request->input('serverId');
        $point = -0.25;
        $this->changeRecommendPoint($userId, $SongId, $point);

        return [
            'message' => 'Recommend point has been plus '.$point.' point!!'
        ];  
    }

}