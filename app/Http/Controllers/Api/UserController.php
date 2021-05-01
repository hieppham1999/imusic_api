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
}