<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public function songs() {
        return $this->belongsToMany(Song::class, 'languages_songs', 'language_id', 'song_id');
    }
}
