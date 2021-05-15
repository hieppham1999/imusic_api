<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $table = 'songs';
    protected $primaryKey = 'song_id';

    protected $fillable = ['song_url', 'title', 'artist', 'album_id', 'year', 'duration', 'genre_id', 'language_id', 'art_uri', 'composer'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'genre_id',
        'album_id',
        'language_id',
        'song_url',

    ];

    protected $appends = [
        'album_name',
        'language_name',
        'genre_name',
        'url',
        'total_listen'

    ];

 
    public function getUrlAttribute() {
        return  'http://192.168.0.150:8000/'.$this->attributes['song_url'];
    }

    public function getArtUriAttribute() {
        if ($this->attributes['art_uri'] == null) {
            return null;
        }
        return  'http://192.168.0.150:8000/'.$this->attributes['art_uri'];
    }

    public function getAlbumNameAttribute() {
        $song = Song::find($this->song_id);
        
        return $song ? $song->album->album_name : '';
    }

    public function getLanguageNameAttribute() {
        $song = Song::find($this->song_id);

        return $song ? $song->language->language_name : '';
    }

    public function getTotalListenAttribute() {
        $song = Song::find($this->song_id);

        return $song ? $song->listenHistories->count() : '0';
    }

    public function getGenreNameAttribute() {
        $song = Song::find($this->song_id);

        return $song ? $song->genre->genre_name : '';
    }


    public function artists() {
        return $this->belongsToMany(Artist::class, 'artists_songs', 'song_id', 'artist_id')->withTimestamps();
    }
    public function album() {
        return $this->belongsTo(Album::class, 'album_id');
    }
    public function composers() {
        return $this->belongsToMany(Composer::class, 'composers_songs', 'song_id', 'composer_id')->withTimestamps();
    }
    public function playlists() {
        return $this->belongsToMany(Playlist::class, 'playlists_songs', 'song_id', 'playlist_id')->withTimestamps();
    }
    public function genre() {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
    public function language() {
        return $this->belongsTo(Language::class, 'language_id');
    }
    public function usersLiked() {
        return $this->belongsToMany(User::class, 'users_like_songs', 'song_id', 'user_id')->withTimestamps();
    }
    public function listenHistories() {
        return $this->belongsToMany(User::class, 'listen_histories', 'song_id', 'user_id')->withTimestamps();
    }
    public function usersSkipped() {
        return $this->belongsToMany(User::class, 'users_skip_songs', 'song_id', 'user_id');
    }


}
