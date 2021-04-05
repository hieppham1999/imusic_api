<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $table = 'songs';
    protected $primaryKey = 'song_id';

    protected $fillable = ['song_url', 'title', 'album', 'release_date', 'duration'];

    public function artists() {
        return $this->belongsToMany(Artist::class, 'artirsts_songs', 'song_id', 'artist_id');
    }
    public function albums() {
        return $this->belongsToMany(Album::class, 'albums_songs', 'song_id', 'album_id');
    }
    public function composers() {
        return $this->belongsToMany(Composer::class, 'composers_songs', 'song_id', 'composer_id');
    }
    public function playlists() {
        return $this->belongsToMany(Playlist::class, 'playlists_songs', 'song_id', 'playlist_id');
    }
    public function genres() {
        return $this->belongsToMany(Genre::class, 'genres_songs', 'song_id', 'genre_id');
    }
    public function languages() {
        return $this->belongsToMany(Language::class, 'languages_songs', 'song_id', 'language_id');
    }
    public function users() {
        return $this->belongsToMany(User::class, 'users_like_songs', 'song_id', 'user_id');
    }

}
