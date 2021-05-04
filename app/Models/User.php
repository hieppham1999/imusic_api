<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'user_id',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $appends = ['avatar'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $primaryKey = 'user_id';

    // protected $with = ['listenHistories'];

    public function getAvatarAttribute() {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email)));
    }

    public function playlists(){
        return $this->hasMany(Playlist::class);
    }
    public function songsLiked() {
        return $this->belongsToMany(Song::class, 'users_like_songs', 'user_id', 'song_id')->withTimestamps();
    }

    public function listenCount()
    {
        return $this->listenHistories->sum('pivot.count');
    }

    public function listenHistories() {
        return $this->belongsToMany(Song::class, 'listen_histories', 'user_id', 'song_id')->as('listen_histories')->withTimestamps();
    }
    public function skippedSongs() {
        return $this->belongsToMany(Song::class, 'users_skip_songs', 'user_id', 'song_id')->withTimestamps();
    }
    public function recommendPoints() {
        return $this->hasMany(RecommendPoint::class, 'user_id', 'user_id');
    }
}
