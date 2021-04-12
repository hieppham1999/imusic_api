<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendPoint extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'genre_id', 'language_id', 'point'];

    public function users() {
        return $this->belongsToMany(User::class, 'artists_songs', 'song_id', 'artist_id');
    }
}
