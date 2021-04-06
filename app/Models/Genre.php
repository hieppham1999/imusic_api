<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $primaryKey = 'genre_id';

    protected $fillable = ['genre_name'];

    public function songs() {
        return $this->belongsToMany(Song::class, 'genres_songs', 'genre_id', 'song_id');
    }
}
