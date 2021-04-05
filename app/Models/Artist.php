<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    public function songs() {
        return $this->belongsToMany(Song::class, 'artirsts_songs', 'artist_id', 'song_id');
    }
    public function albums(){
        return $this->hasMany(Album::class);
    }
}
