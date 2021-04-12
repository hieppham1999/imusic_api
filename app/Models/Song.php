<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $table = 'songs';
    protected $primaryKey = 'song_id';

    protected $fillable = ['song_url', 'title', 'artist', 'album_id', 'release_date', 'duration', 'genre_id', 'language_id'];

    public function artists() {
        return $this->belongsToMany(Artist::class, 'artists_songs', 'song_id', 'artist_id');
    }
    public function album() {
        return $this->belongsTo(Album::class, 'album_id');
    }
    public function composers() {
        return $this->belongsToMany(Composer::class, 'composers_songs', 'song_id', 'composer_id');
    }
    public function playlists() {
        return $this->belongsToMany(Playlist::class, 'playlists_songs', 'song_id', 'playlist_id');
    }
    public function genre() {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
    public function language() {
        return $this->belongsTo(Language::class, 'language_id');
    }
    public function usersLiked() {
        return $this->belongsToMany(User::class, 'users_like_songs', 'song_id', 'user_id');
    }
    public function listenHistories() {
        return $this->belongsToMany(User::class, 'listen_histories', 'song_id', 'user_id');
    }
    public function usersSkipped() {
        return $this->belongsToMany(User::class, 'users_skip_songs', 'song_id', 'user_id');
    }


}
