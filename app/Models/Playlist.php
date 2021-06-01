<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Playlist extends Model
{
    use HasFactory;

    protected $table = 'playlists';

    protected $primaryKey = 'playlist_id';

    protected $fillable = ['playlist_name', 'user_id', 'updated_at'];

    protected $appends = ['tracks', 'last_updated'];

    protected $hidden = ['created_at', 'updated_at', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function songs() {
        return $this->belongsToMany(Song::class, 'playlists_songs', 'playlist_id', 'song_id')->withTimestamps();
    }

    public function countTracks() {
        return DB::table('playlists_songs')->where('playlist_id', $this->playlist_id)->count();
    }
    public function getTracksAttribute() {
        return $this->countTracks();
    }

    public function getLastUpdatedAttribute() {
        return $this->updated_at->format('d/m/Y');
    }
}
