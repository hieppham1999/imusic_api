<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $primaryKey = 'playlist_id';

    protected $fillable = ['playlist_name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function songs() {
        return $this->belongsToMany(Song::class, 'playlists_songs', 'playlist_id', 'song_id');
    }
}
