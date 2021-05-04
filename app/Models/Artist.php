<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $primaryKey = 'artist_id';

    protected $fillable = ['artist_name'];


    public function songs() {
        return $this->belongsToMany(Song::class, 'artists_songs', 'artist_id', 'song_id')->withTimestamps();
    }
    public function albums(){
        return $this->hasMany(Album::class);
    }
}
